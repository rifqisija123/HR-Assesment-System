<?php

namespace App\Http\Controllers;

use App\Exports\ActivityHistoryExport;
use App\Models\AuditLog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\LaravelPdf\Facades\Pdf;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ActivityHistoryController extends Controller
{
    /**
     * Tampilkan halaman Riwayat Aktivitas (Web View).
     */
    public function index(Request $request)
    {
        $users = User::orderBy('name')->get(['id', 'name', 'email', 'role']);

        return view('SuperAdmin.History.ActivityHistory', compact('users'));
    }

    /**
     * Ekspor seluruh riwayat aktivitas ke file Excel (.xlsx).
     */
    public function exportXlsx(Request $request): BinaryFileResponse
    {
        return Excel::download(
            new ActivityHistoryExport($request->all()),
            'DATA_RIWAYAT_AKTIVITAS.xlsx'
        );
    }

    /**
     * Ekspor seluruh riwayat aktivitas ke file PDF (.pdf).
     */
    public function exportPdf(Request $request): Response
    {
        $export = new ActivityHistoryExport($request->all());
        $logs = $export->collection();

        $tz = config('app.timezone', 'Asia/Jakarta');
        $generatedAt = now($tz)->locale('id');
        $generatedBy = $request->user();
        $filters = $request->only(['search', 'user_id', 'role', 'action', 'date_from', 'date_to']);

        $filteredUser = null;
        if (!empty($filters['user_id'])) {
            if ($filters['user_id'] === 'system') {
                $filteredUser = 'System Auto';
            } else {
                $filteredUser = User::find($filters['user_id'])?->name ?? $filters['user_id'];
            }
        }

        return Pdf::view('SuperAdmin.History.ActivityHistoryPdf', compact(
            'logs',
            'filters',
            'filteredUser',
            'generatedAt',
            'generatedBy'
        ))
            ->format('a4')
            ->landscape()
            ->name('DATA_RIWAYAT_AKTIVITAS.pdf')
            ->download('DATA_RIWAYAT_AKTIVITAS.pdf')
            ->toResponse($request);
    }

    /**
     * Ambil data audit logs dengan filter, pencarian, dan pagination (JSON).
     */
    public function data(Request $request): JsonResponse
    {
        $query = AuditLog::with('user');

        // Filter: Pencarian teks
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $term = "%{$search}%";
                $q->where('action', 'like', $term)
                  ->orWhere('ip_address', 'like', $term)
                  ->orWhere('user_agent', 'like', $term)
                  ->orWhere('new_values->description', 'like', $term)
                  ->orWhere('new_values->entity_code', 'like', $term)
                  ->orWhereHas('user', function ($uq) use ($term) {
                      $uq->where('name', 'like', $term)
                         ->orWhere('email', 'like', $term);
                  });

                if (stripos('System', $search) !== false || stripos('Auto', $search) !== false) {
                    $q->orWhereNull('user_id');
                }
            });
        }

        // Filter: Pengguna tertentu
        if ($request->filled('user_id')) {
            if ($request->user_id === 'system') {
                $query->whereNull('user_id');
            } else {
                $query->where('user_id', $request->user_id);
            }
        }

        // Filter: Role pengguna
        if ($request->filled('role')) {
            if ($request->role === 'system') {
                $query->whereNull('user_id');
            } else {
                $query->whereHas('user', function ($uq) use ($request) {
                    $uq->where('role', $request->role);
                });
            }
        }

        // Filter: Jenis aktivitas (action)
        if ($request->filled('action')) {
            $query->where('action', strtolower($request->action));
        }

        // Filter: Rentang Tanggal Mulai
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        // Filter: Rentang Tanggal Selesai
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $perPage = (int) $request->input('per_page', 10);
        if (!in_array($perPage, [10, 25, 50, 100])) {
            $perPage = 10;
        }
        $logs = $query->latest('created_at')->latest('id')->paginate($perPage);

        $logs->getCollection()->transform(function (AuditLog $log) {
            return $this->transformLog($log);
        });

        return response()->json($logs);
    }

    /**
     * Tampilkan detail satu riwayat aktivitas (JSON).
     */
    public function show(int $id): JsonResponse
    {
        $log = AuditLog::with('user')->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data'   => $this->transformLog($log, true),
        ]);
    }

    /**
     * Transform data audit log untuk response frontend.
     */
    protected function transformLog(AuditLog $log, bool $detailed = false): array
    {
        $browserInfo = $log->browser_info;
        $actionStyle = $log->action_style;
        $userStyle   = $log->user_avatar_style;
        $tz          = config('app.timezone', 'Asia/Jakarta');
        $created     = $log->created_at ? Carbon::parse($log->created_at)->setTimezone($tz) : now($tz);
        $created->locale('id');

        $data = [
            'id'          => $log->id,
            'action'      => $log->action,
            'action_label'=> $actionStyle['label'],
            'action_style'=> $actionStyle,
            'description' => $log->description,

            'entity_type' => $log->entity_type_label,
            'entity_id'   => $log->entity_identifier,
            'auditable_type' => $log->auditable_type,
            'auditable_id'   => $log->auditable_id,

            'ip_address'  => $log->ip_address ?? '127.0.0.1',
            'browser'     => $browserInfo['browser'],
            'os'          => $browserInfo['os'],
            'user_agent'  => $browserInfo['full'],

            'date'        => $log->formatted_date,
            'time'        => $log->formatted_time,
            'created_at'  => $created->toIso8601String(),
            'time_ago'    => $created->diffForHumans(),

            'user'        => [
                'id'         => $log->user?->id,
                'name'       => $log->user?->name ?? 'System Auto',
                'email'      => $log->user?->email ?? 'system@internal',
                'role'       => $log->user?->role ?? 'system',
                'role_label' => $log->user_role_label,
                'initials'   => $log->user_initials,
                'style'      => $userStyle,
                'is_active'  => $log->user?->is_active ?? true,
            ],

            'old_values'  => $log->old_values,
            'new_values'  => $log->new_values,
        ];

        return $data;
    }
}
