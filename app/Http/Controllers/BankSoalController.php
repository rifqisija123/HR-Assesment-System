<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\QuestionCategory;
use App\Models\QuestionOption;
use App\Models\User;
use App\Services\AuditLogger;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class BankSoalController extends Controller
{
    /**
     * Tampilkan daftar soal pada Bank Soal dengan filter dan pencarian.
     */
    public function index(Request $request): View|JsonResponse
    {
        $query = Question::query()
            ->with(['category', 'creator', 'options']);

        // Pencarian pertanyaan atau keterangan/rubrik
        if ($request->filled('search')) {
            $term = '%' . trim($request->search) . '%';
            $query->where(function ($q) use ($term) {
                $q->where('question_text', 'like', $term)
                  ->orWhere('essay_rubric', 'like', $term)
                  ->orWhereHas('category', function ($cq) use ($term) {
                      $cq->where('name', 'like', $term);
                  });
            });
        }

        // Filter berdasarkan kategori
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter berdasarkan tipe soal
        if ($request->filled('tipe')) {
            $tipe = strtolower(trim($request->tipe));
            if (in_array($tipe, ['pilihan ganda', 'pilihan_ganda', 'multiple_choice'], true)) {
                $query->where('type', 'multiple_choice');
            } elseif ($tipe === 'essay') {
                $query->where('type', 'essay');
            }
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $status = strtolower(trim($request->status));
            if (in_array($status, ['aktif', 'active'], true)) {
                $query->where('status', 'active');
            } elseif (in_array($status, ['nonaktif', 'inactive'], true)) {
                $query->where('status', 'inactive');
            } elseif (in_array($status, ['arsip', 'archived'], true)) {
                $query->where('status', 'archived');
            }
        }

        $questions = $query->latest('updated_at')
                           ->latest('id')
                           ->paginate($request->integer('per_page', 10))
                           ->withQueryString();

        if ($request->expectsJson() || $request->is('api/*') || $request->ajax()) {
            return response()->json($questions);
        }

        $categories = QuestionCategory::orderBy('name')->get();

        return view('HRAdmin.QuestionBank.BankSoal', compact('questions', 'categories'));
    }

    /**
     * Tampilkan halaman tambah soal.
     * Hanya menampilkan kategori soal yang kuota jumlah soalnya belum terpenuhi.
     */
    public function create(): View
    {
        $categories = QuestionCategory::withCount('questions')
            ->orderBy('name')
            ->get()
            ->filter(function (QuestionCategory $cat) {
                $quota = max(1, (int) ($cat->total_questions ?? 0));
                return (int) $cat->questions_count < $quota;
            })
            ->values();

        return view('HRAdmin.QuestionBank.AddSoal', compact('categories'));
    }

    /**
     * Simpan kumpulan soal baru ke database sesuai kategori yang dipilih.
     */
    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $baseRules = [
            'kategori'               => 'required|exists:question_categories,id',
            'questions'              => 'required|array|min:1',
            'questions.*.pertanyaan' => 'required|string',
            'questions.*.status'     => 'required|in:aktif,nonaktif,active,inactive,archived',
            'questions.*.keterangan' => 'nullable|string|max:2000',
        ];

        $messages = [
            'kategori.required'               => 'Kategori soal wajib dipilih.',
            'kategori.exists'                 => 'Kategori soal yang dipilih tidak valid.',
            'questions.required'              => 'Daftar soal wajib diisi.',
            'questions.array'                 => 'Format data soal tidak valid.',
            'questions.min'                   => 'Minimal harus ada 1 soal.',
            'questions.*.pertanyaan.required' => 'Pertanyaan wajib diisi.',
            'questions.*.status.required'     => 'Status soal wajib dipilih.',
            'questions.*.status.in'           => 'Status soal tidak valid.',
            'questions.*.opsi_a.required'     => 'Opsi jawaban A wajib diisi.',
            'questions.*.opsi_b.required'     => 'Opsi jawaban B wajib diisi.',
            'questions.*.opsi_c.required'     => 'Opsi jawaban C wajib diisi.',
            'questions.*.opsi_d.required'     => 'Opsi jawaban D wajib diisi.',
            'questions.*.jawaban_benar.required' => 'Jawaban benar wajib dipilih.',
            'questions.*.jawaban_benar.in'    => 'Pilihan jawaban benar harus salah satu dari A, B, C, atau D.',
            'questions.*.skor.required'       => 'Skor wajib diisi.',
            'questions.*.skor.numeric'        => 'Skor harus berupa angka.',
            'questions.*.skor.min'            => 'Skor minimal adalah 1.',
        ];

        $category = $request->filled('kategori')
            ? QuestionCategory::find($request->input('kategori'))
            : null;

        if ($category && !$category->isEssay()) {
            $baseRules['questions.*.opsi_a']        = 'required|string';
            $baseRules['questions.*.opsi_b']        = 'required|string';
            $baseRules['questions.*.opsi_c']        = 'required|string';
            $baseRules['questions.*.opsi_d']        = 'required|string';
            $baseRules['questions.*.jawaban_benar'] = 'required|in:a,b,c,d,A,B,C,D';
            $baseRules['questions.*.skor']          = 'required|numeric|min:1';
        }

        $validated = Validator::make($request->all(), $baseRules, $messages)->validate();

        /** @var QuestionCategory $category */
        $category = $category ?? QuestionCategory::findOrFail($validated['kategori']);
        $quota = max(1, (int) ($category->total_questions ?? 0));
        $existingCount = $category->questions()->count();

        if ($existingCount >= $quota) {
            $msg = "Kategori {$category->name} sudah memiliki seluruh soal sesuai kuota ({$quota} soal).";
            if ($request->expectsJson() || $request->is('api/*') || $request->ajax()) {
                return response()->json([
                    'message' => $msg,
                    'errors'  => ['kategori' => [$msg]],
                ], 422);
            }
            return back()->withErrors(['kategori' => $msg]);
        }

        $isEssay  = $category->isEssay();
        $type     = $isEssay ? 'essay' : 'multiple_choice';

        $userId = Auth::id();
        if (!$userId) {
            $fallbackUser = User::where('role', 'hr_admin')->first() ?? User::first();
            $userId = $fallbackUser?->id;
        }

        $createdQuestions = DB::transaction(function () use ($validated, $category, $isEssay, $type, $userId) {
            $saved = [];

            foreach ($validated['questions'] as $item) {
                $rawStatus = strtolower(trim($item['status'] ?? 'aktif'));
                $status = match ($rawStatus) {
                    'aktif', 'active'       => 'active',
                    'arsip', 'archived'     => 'archived',
                    default                 => 'inactive',
                };

                $question = Question::create([
                    'category_id'       => $category->id,
                    'type'              => $type,
                    'question_text'     => trim($item['pertanyaan']),
                    'max_score'         => $isEssay ? 0 : (float) $item['skor'],
                    'essay_rubric'      => !empty($item['keterangan']) ? trim($item['keterangan']) : null,
                    'status'            => $status,
                    'created_by'        => $userId,
                ]);

                if (!$isEssay) {
                    $correctKey = strtolower(trim($item['jawaban_benar']));
                    $optionsMap = [
                        'a' => ['text' => trim($item['opsi_a']), 'order' => 1],
                        'b' => ['text' => trim($item['opsi_b']), 'order' => 2],
                        'c' => ['text' => trim($item['opsi_c']), 'order' => 3],
                        'd' => ['text' => trim($item['opsi_d']), 'order' => 4],
                    ];

                    foreach ($optionsMap as $key => $opt) {
                        QuestionOption::create([
                            'question_id' => $question->id,
                            'option_text' => $opt['text'],
                            'is_correct'  => $correctKey === $key,
                            'order'       => $opt['order'],
                        ]);
                    }
                }

                $saved[] = $question;
            }

            return $saved;
        });

        $count = count($createdQuestions);
        $firstQuestion = $createdQuestions[0] ?? null;
        $lastQuestion  = $createdQuestions[$count - 1] ?? null;

        $entityCode = $count > 1 && $firstQuestion && $lastQuestion
            ? "ID: #Q-{$firstQuestion->id} s/d #Q-{$lastQuestion->id}"
            : ($firstQuestion ? "ID: #Q-{$firstQuestion->id}" : '-');

        $auditDescription = $count > 1
            ? "Menambahkan {$count} bank soal pada kategori: {$category->name}"
            : "Menambahkan bank soal pada kategori: {$category->name}";

        AuditLogger::log(
            action: 'create',
            description: $auditDescription,
            auditable: $firstQuestion,
            newValues: [
                'entity_code'             => $entityCode,
                'category_id'             => $category->id,
                'kategori'                => $category->name,
                'type'                    => $type,
                'jumlah_soal_ditambahkan' => $count,
                'question_ids'            => array_map(fn (Question $q) => $q->id, $createdQuestions),
            ],
            request: $request
        );

        $successMessage = $count > 1
            ? "{$count} soal pada kategori {$category->name} berhasil ditambahkan."
            : "Soal pada kategori {$category->name} berhasil ditambahkan.";

        if ($request->expectsJson() || $request->is('api/*') || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $successMessage,
                'data'    => $createdQuestions,
            ], 201);
        }

        return redirect('/hr/question-bank')
            ->with('success', $successMessage);
    }

    /**
     * Tampilkan halaman edit soal.
     */
    public function edit(int|string $id): View
    {
        $question = Question::with(['category', 'options' => fn ($q) => $q->orderBy('order')])
            ->findOrFail($id);

        $options = $question->options->values();
        $optA = $options->firstWhere('order', 1) ?? $options->get(0);
        $optB = $options->firstWhere('order', 2) ?? $options->get(1);
        $optC = $options->firstWhere('order', 3) ?? $options->get(2);
        $optD = $options->firstWhere('order', 4) ?? $options->get(3);

        $jawabanBenar = '';
        if ($optA?->is_correct) {
            $jawabanBenar = 'a';
        } elseif ($optB?->is_correct) {
            $jawabanBenar = 'b';
        } elseif ($optC?->is_correct) {
            $jawabanBenar = 'c';
        } elseif ($optD?->is_correct) {
            $jawabanBenar = 'd';
        }

        $scoreNum = (float) ($question->max_score ?? 0);
        $formattedScore = $question->isEssay()
            ? ''
            : (fmod($scoreNum, 1.0) === 0.0 ? (int) $scoreNum : $scoreNum);

        $questionData = [
            'id'            => $question->id,
            'category_id'   => $question->category_id,
            'category_name' => $question->category?->name ?? '-',
            'tipe'          => $question->isEssay() ? 'essay' : 'pilihan_ganda',
            'pertanyaan'    => $question->question_text ?? '',
            'opsi_a'        => $optA?->option_text ?? '',
            'opsi_b'        => $optB?->option_text ?? '',
            'opsi_c'        => $optC?->option_text ?? '',
            'opsi_d'        => $optD?->option_text ?? '',
            'jawaban_benar' => $jawabanBenar,
            'skor'          => $formattedScore,
            'status'        => $question->status === 'active' ? 'aktif' : 'nonaktif',
            'keterangan'    => $question->essay_rubric ?? '',
        ];

        return view('HRAdmin.QuestionBank.EditSoal', compact('question', 'questionData'));
    }

    /**
     * Ambil detail satu soal (API JSON).
     */
    public function show(int|string $id): JsonResponse
    {
        $question = Question::with(['category', 'creator', 'options' => fn ($q) => $q->orderBy('order')])
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'data'    => $question,
        ]);
    }

    /**
     * Update data soal pada Bank Soal.
     */
    public function update(Request $request, int|string $id): RedirectResponse|JsonResponse
    {
        $question = Question::with(['category', 'options' => fn ($q) => $q->orderBy('order')])
            ->findOrFail($id);

        $isEssay = $question->isEssay();

        $rules = [
            'pertanyaan' => 'required|string',
            'status'     => 'required|in:aktif,nonaktif,active,inactive,archived',
            'keterangan' => 'nullable|string|max:2000',
        ];

        $messages = [
            'pertanyaan.required'    => 'Pertanyaan wajib diisi.',
            'status.required'        => 'Status soal wajib dipilih.',
            'status.in'              => 'Status soal tidak valid.',
            'opsi_a.required'        => 'Opsi jawaban A wajib diisi.',
            'opsi_b.required'        => 'Opsi jawaban B wajib diisi.',
            'opsi_c.required'        => 'Opsi jawaban C wajib diisi.',
            'opsi_d.required'        => 'Opsi jawaban D wajib diisi.',
            'jawaban_benar.required' => 'Jawaban benar wajib dipilih.',
            'jawaban_benar.in'       => 'Pilihan jawaban benar harus salah satu dari A, B, C, atau D.',
            'skor.required'          => 'Skor wajib diisi.',
            'skor.numeric'           => 'Skor harus berupa angka.',
            'skor.min'               => 'Skor minimal adalah 1.',
        ];

        if (!$isEssay) {
            $rules['opsi_a']        = 'required|string';
            $rules['opsi_b']        = 'required|string';
            $rules['opsi_c']        = 'required|string';
            $rules['opsi_d']        = 'required|string';
            $rules['jawaban_benar'] = 'required|in:a,b,c,d,A,B,C,D';
            $rules['skor']          = 'required|numeric|min:1';
        }

        $validated = Validator::make($request->all(), $rules, $messages)->validate();

        $categoryName = $question->category?->name ?? '-';
        $options = $question->options->values();
        $oldOptA = $options->firstWhere('order', 1) ?? $options->get(0);
        $oldOptB = $options->firstWhere('order', 2) ?? $options->get(1);
        $oldOptC = $options->firstWhere('order', 3) ?? $options->get(2);
        $oldOptD = $options->firstWhere('order', 4) ?? $options->get(3);

        $oldJawabanBenar = null;
        if ($oldOptA?->is_correct) {
            $oldJawabanBenar = 'A';
        } elseif ($oldOptB?->is_correct) {
            $oldJawabanBenar = 'B';
        } elseif ($oldOptC?->is_correct) {
            $oldJawabanBenar = 'C';
        } elseif ($oldOptD?->is_correct) {
            $oldJawabanBenar = 'D';
        }

        $oldValues = [
            'entity_code' => "ID: #Q-{$question->id}",
            'category_id' => $question->category_id,
            'kategori'    => $categoryName,
            'type'        => $question->type,
            'pertanyaan'  => $question->question_text,
            'skor'        => $isEssay ? '-' : (float) $question->max_score,
            'status'      => $question->status === 'active' ? 'aktif' : ($question->status === 'archived' ? 'arsip' : 'nonaktif'),
            'keterangan'  => $question->essay_rubric,
        ];

        if (!$isEssay) {
            $oldValues['opsi_a']        = $oldOptA?->option_text;
            $oldValues['opsi_b']        = $oldOptB?->option_text;
            $oldValues['opsi_c']        = $oldOptC?->option_text;
            $oldValues['opsi_d']        = $oldOptD?->option_text;
            $oldValues['jawaban_benar'] = $oldJawabanBenar;
        }

        $rawStatus = strtolower(trim($validated['status']));
        $newStatus = match ($rawStatus) {
            'aktif', 'active'   => 'active',
            'arsip', 'archived' => 'archived',
            default             => 'inactive',
        };

        DB::transaction(function () use ($question, $validated, $isEssay, $newStatus) {
            $question->update([
                'question_text' => trim($validated['pertanyaan']),
                'max_score'     => $isEssay ? 0 : (float) $validated['skor'],
                'essay_rubric'  => !empty($validated['keterangan']) ? trim($validated['keterangan']) : null,
                'status'        => $newStatus,
            ]);

            if (!$isEssay) {
                $correctKey = strtolower(trim($validated['jawaban_benar']));
                $optionsMap = [
                    'a' => ['text' => trim($validated['opsi_a']), 'order' => 1],
                    'b' => ['text' => trim($validated['opsi_b']), 'order' => 2],
                    'c' => ['text' => trim($validated['opsi_c']), 'order' => 3],
                    'd' => ['text' => trim($validated['opsi_d']), 'order' => 4],
                ];

                $question->options()->delete();

                foreach ($optionsMap as $key => $opt) {
                    QuestionOption::create([
                        'question_id' => $question->id,
                        'option_text' => $opt['text'],
                        'is_correct'  => $correctKey === $key,
                        'order'       => $opt['order'],
                    ]);
                }
            }
        });

        $question->refresh()->load(['category', 'options' => fn ($q) => $q->orderBy('order')]);

        $newValues = [
            'entity_code' => "ID: #Q-{$question->id}",
            'category_id' => $question->category_id,
            'kategori'    => $categoryName,
            'type'        => $question->type,
            'pertanyaan'  => $question->question_text,
            'skor'        => $isEssay ? '-' : (float) $question->max_score,
            'status'      => $question->status === 'active' ? 'aktif' : ($question->status === 'archived' ? 'arsip' : 'nonaktif'),
            'keterangan'  => $question->essay_rubric,
        ];

        if (!$isEssay) {
            $newValues['opsi_a']        = trim($validated['opsi_a']);
            $newValues['opsi_b']        = trim($validated['opsi_b']);
            $newValues['opsi_c']        = trim($validated['opsi_c']);
            $newValues['opsi_d']        = trim($validated['opsi_d']);
            $newValues['jawaban_benar'] = strtoupper(trim($validated['jawaban_benar']));
        }

        AuditLogger::log(
            action: 'update',
            description: "Memperbarui bank soal pada kategori: {$categoryName}",
            auditable: $question,
            oldValues: $oldValues,
            newValues: $newValues,
            request: $request
        );

        $successMessage = "Soal pada kategori {$categoryName} berhasil diperbarui.";

        if ($request->expectsJson() || $request->is('api/*') || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $successMessage,
                'data'    => $question,
            ]);
        }

        return redirect('/hr/question-bank')
            ->with('success', $successMessage);
    }

    /**
     * Hapus satu soal dari Bank Soal beserta opsi jawabannya.
     */
    public function destroy(Request $request, int|string $id): RedirectResponse|JsonResponse
    {
        $question = Question::with(['category', 'options' => fn ($q) => $q->orderBy('order')])
            ->findOrFail($id);

        $isEssay      = $question->isEssay();
        $categoryName = $question->category?->name ?? '-';
        $options      = $question->options->values();

        $oldOptA = $options->firstWhere('order', 1) ?? $options->get(0);
        $oldOptB = $options->firstWhere('order', 2) ?? $options->get(1);
        $oldOptC = $options->firstWhere('order', 3) ?? $options->get(2);
        $oldOptD = $options->firstWhere('order', 4) ?? $options->get(3);

        $oldJawabanBenar = null;
        if ($oldOptA?->is_correct) {
            $oldJawabanBenar = 'A';
        } elseif ($oldOptB?->is_correct) {
            $oldJawabanBenar = 'B';
        } elseif ($oldOptC?->is_correct) {
            $oldJawabanBenar = 'C';
        } elseif ($oldOptD?->is_correct) {
            $oldJawabanBenar = 'D';
        }

        $oldValues = [
            'entity_code' => "ID: #Q-{$question->id}",
            'category_id' => $question->category_id,
            'kategori'    => $categoryName,
            'type'        => $question->type,
            'pertanyaan'  => $question->question_text,
            'skor'        => $isEssay ? '-' : (float) $question->max_score,
            'status'      => $question->status === 'active' ? 'aktif' : ($question->status === 'archived' ? 'arsip' : 'nonaktif'),
            'keterangan'  => $question->essay_rubric,
        ];

        if (!$isEssay) {
            $oldValues['opsi_a']        = $oldOptA?->option_text;
            $oldValues['opsi_b']        = $oldOptB?->option_text;
            $oldValues['opsi_c']        = $oldOptC?->option_text;
            $oldValues['opsi_d']        = $oldOptD?->option_text;
            $oldValues['jawaban_benar'] = $oldJawabanBenar;
        }

        AuditLogger::log(
            action: 'delete',
            description: "Menghapus soal pada kategori: {$categoryName}",
            auditable: $question,
            oldValues: $oldValues,
            newValues: [
                'entity_code' => "ID: #Q-{$question->id}",
            ],
            request: $request
        );

        DB::transaction(function () use ($question) {
            $question->options()->delete();
            $question->delete();
        });

        $successMessage = "Soal pada kategori {$categoryName} berhasil dihapus.";

        if ($request->expectsJson() || $request->is('api/*') || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $successMessage,
            ]);
        }

        return redirect('/hr/question-bank')
            ->with('success', $successMessage);
    }

    /**
     * Hapus banyak soal sekaligus (bulk delete) dari Bank Soal.
     */
    public function bulkDestroy(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'ids'   => 'required|array|min:1',
            'ids.*' => 'required|integer|exists:questions,id',
        ], [
            'ids.required' => 'Pilih minimal satu soal untuk dihapus.',
            'ids.array'    => 'Format daftar soal tidak valid.',
            'ids.min'      => 'Pilih minimal satu soal untuk dihapus.',
        ]);

        $questions = Question::with('category')
            ->whereIn('id', $validated['ids'])
            ->orderBy('id')
            ->get();

        if ($questions->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada soal yang ditemukan untuk dihapus.',
            ], 404);
        }

        $count         = $questions->count();
        $firstQuestion = $questions->first();
        $lastQuestion  = $questions->last();
        $questionIds   = $questions->pluck('id')->values()->all();
        $categoryNames = $questions->map(fn (Question $q) => $q->category?->name)
            ->filter()
            ->unique()
            ->values()
            ->implode(', ');
        $categoryLabel = $categoryNames !== '' ? $categoryNames : '-';

        $entityCode = $count > 1 && $firstQuestion && $lastQuestion
            ? "ID: #Q-{$firstQuestion->id} s/d #Q-{$lastQuestion->id}"
            : ($firstQuestion ? "ID: #Q-{$firstQuestion->id}" : '-');

        $auditDescription = $count > 1
            ? "Menghapus {$count} soal pada kategori: {$categoryLabel}"
            : "Menghapus soal pada kategori: {$categoryLabel}";

        AuditLogger::log(
            action: 'delete',
            description: $auditDescription,
            auditable: $firstQuestion,
            oldValues: [
                'entity_code'      => $entityCode,
                'kategori'         => $categoryLabel,
                'jumlah_dihapus'   => $count,
                'question_ids'     => $questionIds,
                'pertanyaan_dihapus' => $questions->pluck('question_text')->all(),
            ],
            newValues: [
                'entity_code'    => $entityCode,
                'jumlah_dihapus' => $count,
            ],
            request: $request
        );

        DB::transaction(function () use ($questionIds) {
            QuestionOption::whereIn('question_id', $questionIds)->delete();
            Question::whereIn('id', $questionIds)->delete();
        });

        $successMessage = $count > 1
            ? "{$count} soal terpilih berhasil dihapus dari Bank Soal."
            : "Soal berhasil dihapus dari Bank Soal.";

        return response()->json([
            'success' => true,
            'message' => $successMessage,
        ]);
    }
}

