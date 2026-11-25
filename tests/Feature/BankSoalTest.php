<?php

namespace Tests\Feature;

use App\Models\AuditLog;
use App\Models\Question;
use App\Models\QuestionCategory;
use App\Models\QuestionOption;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BankSoalTest extends TestCase
{
    use RefreshDatabase;

    protected User $hrAdmin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->hrAdmin = User::factory()->create([
            'name'      => 'HR Verta',
            'email'     => 'hr@verta.com',
            'role'      => 'hr_admin',
            'is_active' => true,
        ]);
    }

    public function test_hr_admin_can_store_multiple_choice_questions_via_api_and_logs_audit(): void
    {
        $category = QuestionCategory::create([
            'name'            => 'Logika & Penalaran',
            'type'            => 'multiple_choice',
            'total_questions' => 2,
            'is_active'       => true,
            'created_by'      => $this->hrAdmin->id,
        ]);

        $payload = [
            'kategori'  => $category->id,
            'questions' => [
                [
                    'pertanyaan'    => 'Jika semua A adalah B dan semua B adalah C, maka...',
                    'opsi_a'        => 'Semua A adalah C',
                    'opsi_b'        => 'Sebagian A bukan C',
                    'opsi_c'        => 'Semua C adalah A',
                    'opsi_d'        => 'Tidak ada kesimpulan',
                    'jawaban_benar' => 'a',
                    'skor'          => 10,
                    'status'        => 'aktif',
                    'keterangan'    => 'Silogisme dasar',
                ],
                [
                    'pertanyaan'    => '2, 4, 8, 16, ... angka selanjutnya adalah?',
                    'opsi_a'        => '24',
                    'opsi_b'        => '32',
                    'opsi_c'        => '30',
                    'opsi_d'        => '64',
                    'jawaban_benar' => 'b',
                    'skor'          => 15,
                    'status'        => 'aktif',
                    'keterangan'    => 'Deret geometri',
                ],
            ],
        ];

        $response = $this->actingAs($this->hrAdmin)->postJson('/api/question-bank', $payload);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
            ]);

        $this->assertDatabaseHas('questions', [
            'category_id'   => $category->id,
            'type'          => 'multiple_choice',
            'question_text' => 'Jika semua A adalah B dan semua B adalah C, maka...',
            'max_score'     => 10,
            'status'        => 'active',
            'essay_rubric'  => 'Silogisme dasar',
        ]);

        $this->assertDatabaseCount('question_options', 8);

        $auditLog = AuditLog::where('action', 'create')
            ->where('auditable_type', Question::class)
            ->latest('id')
            ->first();

        $this->assertNotNull($auditLog);
        $this->assertSame('Menambahkan 2 soal pada kategori: Logika & Penalaran', $auditLog->description);

        $indexResponse = $this->actingAs($this->hrAdmin)->get('/hr/question-bank');
        $indexResponse->assertStatus(200);
        $indexResponse->assertSee('Jika semua A adalah B dan semua B adalah C, maka...', false);
    }

    public function test_hr_admin_can_store_essay_questions_via_api_with_dash_score_and_logs_audit(): void
    {
        $category = QuestionCategory::create([
            'name'            => 'Kompetensi Bidang',
            'type'            => 'essay',
            'total_questions' => 1,
            'is_active'       => true,
            'created_by'      => $this->hrAdmin->id,
        ]);

        $payload = [
            'kategori'  => $category->id,
            'questions' => [
                [
                    'pertanyaan' => 'Ceritakan pengalaman Anda menyelesaikan konflik tim.',
                    'status'     => 'aktif',
                    'keterangan' => 'Rubrik penilaian metode STAR',
                ],
            ],
        ];

        $response = $this->actingAs($this->hrAdmin)->postJson('/api/question-bank', $payload);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
            ]);

        $this->assertDatabaseHas('questions', [
            'category_id'   => $category->id,
            'type'          => 'essay',
            'question_text' => 'Ceritakan pengalaman Anda menyelesaikan konflik tim.',
            'max_score'     => 0,
            'status'        => 'active',
            'essay_rubric'  => 'Rubrik penilaian metode STAR',
        ]);

        $auditLog = AuditLog::where('action', 'create')
            ->where('auditable_type', Question::class)
            ->latest('id')
            ->first();

        $this->assertNotNull($auditLog);
        $this->assertSame('Menambahkan soal pada kategori: Kompetensi Bidang', $auditLog->description);
    }

    public function test_category_with_completed_questions_is_hidden_from_add_soal_dropdown(): void
    {
        $completedCategory = QuestionCategory::create([
            'name'            => 'Kepemimpinan & Manajerial',
            'type'            => 'multiple_choice',
            'total_questions' => 2,
            'is_active'       => true,
            'created_by'      => $this->hrAdmin->id,
        ]);

        $incompleteCategory = QuestionCategory::create([
            'name'            => 'Analisis Masalah',
            'type'            => 'essay',
            'total_questions' => 3,
            'is_active'       => true,
            'created_by'      => $this->hrAdmin->id,
        ]);

        Question::create([
            'category_id'   => $completedCategory->id,
            'type'          => 'multiple_choice',
            'question_text' => 'Soal Manajerial 1',
            'max_score'     => 10,
            'status'        => 'active',
            'created_by'    => $this->hrAdmin->id,
        ]);

        Question::create([
            'category_id'   => $completedCategory->id,
            'type'          => 'multiple_choice',
            'question_text' => 'Soal Manajerial 2',
            'max_score'     => 10,
            'status'        => 'active',
            'created_by'    => $this->hrAdmin->id,
        ]);

        $response = $this->actingAs($this->hrAdmin)->get('/hr/question-bank/create');

        $response->assertStatus(200);
        $response->assertDontSee('Kepemimpinan & Manajerial', false);
        $response->assertSee('Analisis Masalah', false);
    }

    public function test_hr_admin_can_view_edit_page_and_update_multiple_choice_question_with_audit_log(): void
    {
        $category = QuestionCategory::create([
            'name'            => 'Logika & Penalaran',
            'type'            => 'multiple_choice',
            'total_questions' => 5,
            'is_active'       => true,
            'created_by'      => $this->hrAdmin->id,
        ]);

        $question = Question::create([
            'category_id'   => $category->id,
            'type'          => 'multiple_choice',
            'question_text' => 'Pertanyaan lama PG',
            'max_score'     => 10,
            'essay_rubric'  => 'Keterangan lama',
            'status'        => 'active',
            'created_by'    => $this->hrAdmin->id,
        ]);

        QuestionOption::create(['question_id' => $question->id, 'option_text' => 'Opsi A Lama', 'is_correct' => true, 'order' => 1]);
        QuestionOption::create(['question_id' => $question->id, 'option_text' => 'Opsi B Lama', 'is_correct' => false, 'order' => 2]);
        QuestionOption::create(['question_id' => $question->id, 'option_text' => 'Opsi C Lama', 'is_correct' => false, 'order' => 3]);
        QuestionOption::create(['question_id' => $question->id, 'option_text' => 'Opsi D Lama', 'is_correct' => false, 'order' => 4]);

        $editPage = $this->actingAs($this->hrAdmin)->get("/hr/question-bank/edit/{$question->id}");
        $editPage->assertStatus(200);
        $editPage->assertSee('Edit soal', false);
        $editPage->assertSee('Pertanyaan lama PG', false);

        $updateResponse = $this->actingAs($this->hrAdmin)->putJson("/api/question-bank/{$question->id}", [
            'pertanyaan'    => 'Pertanyaan baru PG setelah diedit',
            'opsi_a'        => 'Opsi A Baru',
            'opsi_b'        => 'Opsi B Baru',
            'opsi_c'        => 'Opsi C Baru (Benar)',
            'opsi_d'        => 'Opsi D Baru',
            'jawaban_benar' => 'c',
            'skor'          => 20,
            'status'        => 'nonaktif',
            'keterangan'    => 'Keterangan baru setelah diedit',
        ]);

        $updateResponse->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);

        $this->assertDatabaseHas('questions', [
            'id'            => $question->id,
            'question_text' => 'Pertanyaan baru PG setelah diedit',
            'max_score'     => 20,
            'status'        => 'inactive',
            'essay_rubric'  => 'Keterangan baru setelah diedit',
        ]);

        $this->assertDatabaseHas('question_options', [
            'question_id' => $question->id,
            'option_text' => 'Opsi C Baru (Benar)',
            'is_correct'  => true,
            'order'       => 3,
        ]);

        $auditLog = AuditLog::where('action', 'update')
            ->where('auditable_type', Question::class)
            ->where('auditable_id', $question->id)
            ->latest('id')
            ->first();

        $this->assertNotNull($auditLog);
        $this->assertSame('Memperbarui soal pada kategori: Logika & Penalaran', $auditLog->description);
    }

    public function test_hr_admin_can_view_edit_page_and_update_essay_question_with_audit_log(): void
    {
        $category = QuestionCategory::create([
            'name'            => 'Kompetensi Bidang',
            'type'            => 'essay',
            'total_questions' => 5,
            'is_active'       => true,
            'created_by'      => $this->hrAdmin->id,
        ]);

        $question = Question::create([
            'category_id'   => $category->id,
            'type'          => 'essay',
            'question_text' => 'Pertanyaan essay lama',
            'max_score'     => 0,
            'essay_rubric'  => 'Rubrik lama',
            'status'        => 'active',
            'created_by'    => $this->hrAdmin->id,
        ]);

        $editPage = $this->actingAs($this->hrAdmin)->get("/hr/question-bank/edit/{$question->id}");
        $editPage->assertStatus(200);
        $editPage->assertSee('Pertanyaan essay lama', false);

        $updateResponse = $this->actingAs($this->hrAdmin)->putJson("/api/question-bank/{$question->id}", [
            'pertanyaan' => 'Pertanyaan essay baru yang telah diperbarui',
            'status'     => 'aktif',
            'keterangan' => 'Rubrik STAR diperbarui',
        ]);

        $updateResponse->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);

        $this->assertDatabaseHas('questions', [
            'id'            => $question->id,
            'question_text' => 'Pertanyaan essay baru yang telah diperbarui',
            'max_score'     => 0,
            'status'        => 'active',
            'essay_rubric'  => 'Rubrik STAR diperbarui',
        ]);

        $auditLog = AuditLog::where('action', 'update')
            ->where('auditable_type', Question::class)
            ->where('auditable_id', $question->id)
            ->latest('id')
            ->first();

        $this->assertNotNull($auditLog);
        $this->assertSame('Memperbarui soal pada kategori: Kompetensi Bidang', $auditLog->description);
    }

    public function test_hr_admin_can_delete_question_via_api_and_logs_audit(): void
    {
        $category = QuestionCategory::create([
            'name'            => 'Logika & Penalaran',
            'type'            => 'multiple_choice',
            'total_questions' => 5,
            'is_active'       => true,
            'created_by'      => $this->hrAdmin->id,
        ]);

        $question = Question::create([
            'category_id'   => $category->id,
            'type'          => 'multiple_choice',
            'question_text' => 'Soal yang akan dihapus',
            'max_score'     => 10,
            'essay_rubric'  => 'Catatan soal',
            'status'        => 'active',
            'created_by'    => $this->hrAdmin->id,
        ]);

        QuestionOption::create(['question_id' => $question->id, 'option_text' => 'Opsi A', 'is_correct' => true, 'order' => 1]);
        QuestionOption::create(['question_id' => $question->id, 'option_text' => 'Opsi B', 'is_correct' => false, 'order' => 2]);
        QuestionOption::create(['question_id' => $question->id, 'option_text' => 'Opsi C', 'is_correct' => false, 'order' => 3]);
        QuestionOption::create(['question_id' => $question->id, 'option_text' => 'Opsi D', 'is_correct' => false, 'order' => 4]);

        $deleteResponse = $this->actingAs($this->hrAdmin)->deleteJson("/api/question-bank/{$question->id}");

        $deleteResponse->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);

        $this->assertDatabaseMissing('questions', ['id' => $question->id]);
        $this->assertDatabaseMissing('question_options', ['question_id' => $question->id]);

        $auditLog = AuditLog::where('action', 'delete')
            ->where('auditable_type', Question::class)
            ->where('auditable_id', $question->id)
            ->latest('id')
            ->first();

        $this->assertNotNull($auditLog);
        $this->assertSame('Menghapus soal pada kategori: Logika & Penalaran', $auditLog->description);
    }

    public function test_hr_admin_can_bulk_delete_questions_via_api_and_logs_audit(): void
    {
        $category = QuestionCategory::create([
            'name'            => 'Logika & Penalaran',
            'type'            => 'multiple_choice',
            'total_questions' => 5,
            'is_active'       => true,
            'created_by'      => $this->hrAdmin->id,
        ]);

        $q1 = Question::create([
            'category_id'   => $category->id,
            'type'          => 'multiple_choice',
            'question_text' => 'Soal Bulk 1',
            'max_score'     => 10,
            'status'        => 'active',
            'created_by'    => $this->hrAdmin->id,
        ]);

        $q2 = Question::create([
            'category_id'   => $category->id,
            'type'          => 'multiple_choice',
            'question_text' => 'Soal Bulk 2',
            'max_score'     => 10,
            'status'        => 'active',
            'created_by'    => $this->hrAdmin->id,
        ]);

        $response = $this->actingAs($this->hrAdmin)->deleteJson('/api/question-bank/bulk-delete', [
            'ids' => [$q1->id, $q2->id],
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);

        $this->assertDatabaseMissing('questions', ['id' => $q1->id]);
        $this->assertDatabaseMissing('questions', ['id' => $q2->id]);

        $auditLog = AuditLog::where('action', 'delete')
            ->where('auditable_type', Question::class)
            ->latest('id')
            ->first();

        $this->assertNotNull($auditLog);
        $this->assertSame('Menghapus 2 soal pada kategori: Logika & Penalaran', $auditLog->description);
    }
}

