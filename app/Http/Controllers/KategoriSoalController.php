<?php

namespace App\Http\Controllers;

use App\Models\QuestionCategory;
use App\Models\User;
use App\Services\AuditLogger;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class KategoriSoalController extends Controller
{
    /**
     * Tampilkan daftar kategori soal dengan filter dan pencarian.
     */
    public function index(Request $request): View|JsonResponse
    {
        $query = QuestionCategory::query()
            ->with('creator')
            ->withCount('questions');

        // Pencarian nama kategori atau deskripsi
        if ($request->filled('search')) {
            $term = '%' . trim($request->search) . '%';
            $query->where(function ($q) use ($term) {
                $q->where('name', 'like', $term)
                  ->orWhere('description', 'like', $term);
            });
        }

        // Filter status (aktif / nonaktif)
        if ($request->filled('status')) {
            $status = strtolower($request->status);
            if ($status === 'aktif' || $status === '1') {
                $query->where('is_active', true);
            } elseif ($status === 'nonaktif' || $status === '0') {
                $query->where('is_active', false);
            }
        }

        // Filter tipe soal
        if ($request->filled('tipe')) {
            $tipe = strtolower($request->tipe);
            if (in_array($tipe, ['pilihan ganda', 'pilihan_ganda', 'multiple_choice'])) {
                $query->where('type', 'multiple_choice');
            } elseif ($tipe === 'essay') {
                $query->where('type', 'essay');
            }
        }

        // Filter rentang tanggal
        if ($request->filled('date_range')) {
            $dates = preg_split('/\s+(?:-|to)\s+/i', trim($request->date_range));
            $normalizeDate = function ($dateStr) {
                $idToEn = [
                    'Jan' => 'Jan', 'Feb' => 'Feb', 'Mar' => 'Mar', 'Apr' => 'Apr',
                    'Mei' => 'May', 'Jun' => 'Jun', 'Jul' => 'Jul', 'Agu' => 'Aug',
                    'Sep' => 'Sep', 'Okt' => 'Oct', 'Nov' => 'Nov', 'Des' => 'Dec',
                ];
                $str = str_replace(array_keys($idToEn), array_values($idToEn), trim($dateStr));
                return Carbon::parse($str);
            };

            if (count($dates) >= 2) {
                try {
                    $start = $normalizeDate($dates[0])->startOfDay();
                    $end   = $normalizeDate($dates[1])->endOfDay();
                    $query->whereBetween('updated_at', [$start, $end]);
                } catch (\Throwable $e) {
                    // Abaikan kesalahan parsing rentang tanggal
                }
            } elseif (count($dates) === 1 && !empty($dates[0])) {
                try {
                    $start = $normalizeDate($dates[0])->startOfDay();
                    $end   = $normalizeDate($dates[0])->endOfDay();
                    $query->whereBetween('updated_at', [$start, $end]);
                } catch (\Throwable $e) {
                    // Abaikan
                }
            }
        }

        $categories = $query->latest('updated_at')
                            ->paginate($request->integer('per_page', 10))
                            ->withQueryString();

        if ($request->expectsJson() || $request->is('api/*') || $request->ajax()) {
            return response()->json($categories);
        }

        return view('HRAdmin.QuestionCategory.KategoriSoal', compact('categories'));
    }

    /**
     * Tampilkan form pembuatan kategori soal baru.
     */
    public function create(): View
    {
        return view('HRAdmin.QuestionCategory.AddKategori');
    }

    /**
     * Tampilkan halaman edit kategori soal.
     */
    public function edit(int|string $id): View
    {
        $category = QuestionCategory::withCount('questions')->findOrFail($id);

        $categoryData = [
            'id'            => $category->id,
            'nama_kategori' => $category->name,
            'deskripsi'     => $category->description ?? '',
            'jumlah_soal'   => $category->total_questions ?? 0,
            'tipe'          => $category->type === 'essay' ? 'essay' : 'pilihan_ganda',
            'status'        => $category->is_active ? 'aktif' : 'nonaktif',
        ];

        return view('HRAdmin.QuestionCategory.EditKategori', compact('category', 'categoryData'));
    }

    /**
     * Ambil detail satu kategori soal (API JSON).
     */
    public function show(int|string $id): JsonResponse
    {
        $category = QuestionCategory::with('creator')
            ->withCount('questions')
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'data'    => $category,
        ]);
    }

    /**
     * Simpan kategori soal baru ke database.
     */
    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi'     => 'nullable|string|max:1000',
            'jumlah_soal'   => 'nullable|integer|min:0',
            'tipe'          => 'required|in:pilihan_ganda,essay,multiple_choice',
            'status'        => 'required|in:aktif,nonaktif,1,0',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.max'      => 'Nama kategori maksimal 255 karakter.',
            'deskripsi.max'          => 'Deskripsi maksimal 1000 karakter.',
            'jumlah_soal.integer'    => 'Jumlah soal harus berupa angka.',
            'jumlah_soal.min'        => 'Jumlah soal minimal 0.',
            'tipe.required'          => 'Tipe soal wajib dipilih.',
            'tipe.in'                => 'Tipe soal tidak valid.',
            'status.required'        => 'Status kategori wajib dipilih.',
            'status.in'              => 'Status kategori tidak valid.',
        ]);

        $type = in_array($validated['tipe'], ['pilihan_ganda', 'multiple_choice'], true)
            ? 'multiple_choice'
            : 'essay';

        $isActive = in_array($validated['status'], ['aktif', '1', 1], true);
        $totalQuestions = isset($validated['jumlah_soal']) ? (int) $validated['jumlah_soal'] : 0;

        $userId = Auth::id();
        if (!$userId) {
            $fallbackUser = User::where('role', 'hr_admin')->first() ?? User::first();
            $userId = $fallbackUser?->id;
        }

        $category = DB::transaction(function () use ($validated, $type, $totalQuestions, $isActive, $userId) {
            return QuestionCategory::create([
                'name'            => trim($validated['nama_kategori']),
                'description'     => !empty($validated['deskripsi']) ? trim($validated['deskripsi']) : null,
                'type'            => $type,
                'total_questions' => $totalQuestions,
                'is_active'       => $isActive,
                'created_by'      => $userId,
            ]);
        });

        // Audit Log
        AuditLogger::log(
            action: 'create',
            description: 'Menambahkan kategori soal: ' . $category->name,
            auditable: $category,
            newValues: [
                'entity_code'     => "ID: #CAT-{$category->id}",
                'name'            => $category->name,
                'deskripsi'       => $category->description,
                'type'            => $category->type,
                'total_questions' => $category->total_questions,
                'status'          => $category->is_active ? 'aktif' : 'nonaktif',
            ],
            request: $request
        );

        if ($request->expectsJson() || $request->is('api/*') || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Kategori soal berhasil ditambahkan.',
                'data'    => $category,
            ], 201);
        }

        return redirect('/hr/question-categories')
            ->with('success', 'Kategori soal berhasil ditambahkan.');
    }

    /**
     * Update kategori soal.
     */
    public function update(Request $request, int|string $id): RedirectResponse|JsonResponse
    {
        $category = QuestionCategory::findOrFail($id);

        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'deskripsi'     => 'nullable|string|max:1000',
            'jumlah_soal'   => 'nullable|integer|min:0',
            'tipe'          => 'required|in:pilihan_ganda,essay,multiple_choice',
            'status'        => 'required|in:aktif,nonaktif,1,0',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.max'      => 'Nama kategori maksimal 255 karakter.',
            'deskripsi.max'          => 'Deskripsi maksimal 1000 karakter.',
            'jumlah_soal.integer'    => 'Jumlah soal harus berupa angka.',
            'jumlah_soal.min'        => 'Jumlah soal minimal 0.',
            'tipe.required'          => 'Tipe soal wajib dipilih.',
            'tipe.in'                => 'Tipe soal tidak valid.',
            'status.required'        => 'Status kategori wajib dipilih.',
            'status.in'              => 'Status kategori tidak valid.',
        ]);

        $oldValues = [
            'entity_code'     => "ID: #CAT-{$category->id}",
            'name'            => $category->name,
            'deskripsi'       => $category->description,
            'type'            => $category->type,
            'total_questions' => $category->total_questions,
            'status'          => $category->is_active ? 'aktif' : 'nonaktif',
        ];

        $category->update([
            'name'            => trim($validated['nama_kategori']),
            'description'     => !empty($validated['deskripsi']) ? trim($validated['deskripsi']) : null,
            'type'            => in_array($validated['tipe'], ['pilihan_ganda', 'multiple_choice'], true) ? 'multiple_choice' : 'essay',
            'total_questions' => isset($validated['jumlah_soal']) ? (int) $validated['jumlah_soal'] : $category->total_questions,
            'is_active'       => in_array($validated['status'], ['aktif', '1', 1], true),
        ]);

        AuditLogger::log(
            action: 'update',
            description: 'Memperbarui kategori soal: ' . $category->name,
            auditable: $category,
            oldValues: $oldValues,
            newValues: [
                'entity_code'     => "ID: #CAT-{$category->id}",
                'name'            => $category->name,
                'deskripsi'       => $category->description,
                'type'            => $category->type,
                'total_questions' => $category->total_questions,
                'status'          => $category->is_active ? 'aktif' : 'nonaktif',
            ],
            request: $request
        );

        if ($request->expectsJson() || $request->is('api/*') || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Kategori soal berhasil diperbarui.',
                'data'    => $category,
            ]);
        }

        return redirect('/hr/question-categories')
            ->with('success', 'Kategori soal berhasil diperbarui.');
    }

    /**
     * Hapus kategori soal jika tidak memiliki soal aktif.
     */
    public function destroy(Request $request, int|string $id): RedirectResponse|JsonResponse
    {
        $category = QuestionCategory::findOrFail($id);

        if ($category->questions()->exists()) {
            $msg = 'Kategori tidak dapat dihapus karena masih memiliki soal di Bank Soal.';
            if ($request->expectsJson() || $request->is('api/*') || $request->ajax()) {
                return response()->json(['success' => false, 'message' => $msg], 422);
            }
            return back()->with('error', $msg);
        }

        $oldValues = [
            'entity_code'     => "ID: #CAT-{$category->id}",
            'name'            => $category->name,
            'deskripsi'       => $category->description,
            'type'            => $category->type,
            'total_questions' => $category->total_questions,
            'status'          => $category->is_active ? 'aktif' : 'nonaktif',
        ];
        $name = $category->name;

        AuditLogger::log(
            action: 'delete',
            description: 'Menghapus kategori soal: ' . $name,
            auditable: $category,
            oldValues: $oldValues,
            newValues: [
                'entity_code' => "ID: #CAT-{$category->id}",
            ],
            request: $request
        );

        $category->delete();

        if ($request->expectsJson() || $request->is('api/*') || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Kategori soal berhasil dihapus.',
            ]);
        }

        return redirect('/hr/question-categories')
            ->with('success', 'Kategori soal berhasil dihapus.');
    }
}

