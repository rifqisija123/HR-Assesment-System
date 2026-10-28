<?php

namespace Tests\Feature;

use App\Models\AuditLog;
use App\Models\QuestionCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KategoriSoalTest extends TestCase
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

    public function test_guest_cannot_access_question_categories(): void
    {
        $response = $this->get('/hr/question-categories');
        $response->assertRedirect(route('login'));

        $apiResponse = $this->getJson('/api/question-categories');
        $apiResponse->assertStatus(401);
    }

    public function test_non_hr_role_cannot_access_question_categories_api(): void
    {
        $reviewer = User::factory()->create([
            'name'      => 'Reviewer Verta',
            'email'     => 'reviewer@verta.com',
            'role'      => 'reviewer',
            'is_active' => true,
        ]);

        $response = $this->actingAs($reviewer)->getJson('/api/question-categories');
        $response->assertStatus(403);
    }

    public function test_hr_admin_can_view_question_categories_index_without_edit_modal(): void
    {
        $response = $this->actingAs($this->hrAdmin)->get('/hr/question-categories');

        $response->assertStatus(200);
        $response->assertSee('Kategori soal');
        $response->assertSee('Tambah kategori');
        $response->assertSee('/hr/question-categories/edit', false);
        $response->assertDontSee('Edit Kategori Soal');
    }

    public function test_hr_admin_can_view_add_category_page(): void
    {
        $response = $this->actingAs($this->hrAdmin)->get('/hr/question-categories/create');

        $response->assertStatus(200);
        $response->assertSee('Tambah kategori soal');
        $response->assertSee('Informasi kategori');
        $response->assertSee('Simpan kategori');
    }

    public function test_hr_admin_can_view_edit_category_page(): void
    {
        $cat = QuestionCategory::create([
            'name'            => 'Analisis Data',
            'description'     => 'Soal analisis numerik dan tabel.',
            'type'            => 'essay',
            'total_questions' => 12,
            'is_active'       => false,
            'created_by'      => $this->hrAdmin->id,
        ]);

        $response = $this->actingAs($this->hrAdmin)->get('/hr/question-categories/edit/' . $cat->id);

        $response->assertStatus(200);
        $response->assertSee('Edit kategori soal');
        $response->assertSee('Informasi kategori');
        $response->assertSee('Simpan perubahan');
        $response->assertSee('Analisis Data');
        $response->assertSee('Soal analisis numerik dan tabel.');
    }

    public function test_hr_admin_can_store_new_question_category_via_api(): void
    {
        $payload = [
            'nama_kategori' => 'Logika & Penalaran',
            'deskripsi'     => 'Mengukur kemampuan berpikir logis dan analitis.',
            'jumlah_soal'   => 15,
            'tipe'          => 'pilihan_ganda',
            'status'        => 'aktif',
        ];

        $response = $this->actingAs($this->hrAdmin)->postJson('/api/question-categories', $payload);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
                'message' => 'Kategori soal berhasil ditambahkan.',
            ]);

        $this->assertDatabaseHas('question_categories', [
            'name'            => 'Logika & Penalaran',
            'description'     => 'Mengukur kemampuan berpikir logis dan analitis.',
            'type'            => 'multiple_choice',
            'total_questions' => 15,
            'is_active'       => true,
            'created_by'      => $this->hrAdmin->id,
        ]);

        $category = QuestionCategory::where('name', 'Logika & Penalaran')->firstOrFail();

        $createAuditLog = AuditLog::where('action', 'create')
            ->where('auditable_type', QuestionCategory::class)
            ->where('auditable_id', $category->id)
            ->latest('id')
            ->first();

        $this->assertNotNull($createAuditLog);
        $this->assertSame('Menambahkan kategori soal: Logika & Penalaran', $createAuditLog->description);
        $this->assertSame('Mengukur kemampuan berpikir logis dan analitis.', $createAuditLog->new_values['deskripsi'] ?? null);

        // Periksa tampilan di halaman index
        $indexResponse = $this->actingAs($this->hrAdmin)->get('/hr/question-categories');
        $indexResponse->assertStatus(200);
        $indexResponse->assertSee('Logika & Penalaran', false);
        $indexResponse->assertSee('Mengukur kemampuan berpikir logis dan analitis.');
        $indexResponse->assertSee('15');
        $indexResponse->assertSee('Pilihan ganda');
        $indexResponse->assertSee('Aktif');
    }

    public function test_store_validates_required_fields(): void
    {
        $response = $this->actingAs($this->hrAdmin)->postJson('/api/question-categories', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['nama_kategori', 'tipe', 'status']);
    }

    public function test_api_index_and_show_endpoints_work_with_filters(): void
    {
        $pg = QuestionCategory::create([
            'name'            => 'Logika PG',
            'type'            => 'multiple_choice',
            'total_questions' => 10,
            'is_active'       => true,
            'created_by'      => $this->hrAdmin->id,
        ]);

        $essay = QuestionCategory::create([
            'name'            => 'Kompetensi Essay',
            'type'            => 'essay',
            'total_questions' => 5,
            'is_active'       => false,
            'created_by'      => $this->hrAdmin->id,
        ]);

        // Filter tipe via API
        $tipeResponse = $this->actingAs($this->hrAdmin)->getJson('/api/question-categories?tipe=essay');
        $tipeResponse->assertStatus(200)
            ->assertJsonCount(1, 'data')
            ->assertJsonFragment(['name' => 'Kompetensi Essay'])
            ->assertJsonMissing(['name' => 'Logika PG']);

        // Filter status via API
        $statusResponse = $this->actingAs($this->hrAdmin)->getJson('/api/question-categories?status=aktif');
        $statusResponse->assertStatus(200)
            ->assertJsonCount(1, 'data')
            ->assertJsonFragment(['name' => 'Logika PG'])
            ->assertJsonMissing(['name' => 'Kompetensi Essay']);

        // Show detail via API
        $showResponse = $this->actingAs($this->hrAdmin)->getJson('/api/question-categories/' . $pg->id);
        $showResponse->assertStatus(200)
            ->assertJson([
                'success' => true,
                'data'    => [
                    'id'   => $pg->id,
                    'name' => 'Logika PG',
                ],
            ]);
    }

    public function test_hr_admin_can_update_category_via_api_and_logs_update_audit(): void
    {
        $cat = QuestionCategory::create([
            'name'            => 'Kategori Lama',
            'description'     => 'Deskripsi lama',
            'type'            => 'multiple_choice',
            'total_questions' => 5,
            'is_active'       => true,
            'created_by'      => $this->hrAdmin->id,
        ]);

        $response = $this->actingAs($this->hrAdmin)->putJson('/api/question-categories/' . $cat->id, [
            'nama_kategori' => 'Kategori Baru',
            'deskripsi'     => 'Deskripsi baru',
            'jumlah_soal'   => 20,
            'tipe'          => 'essay',
            'status'        => 'nonaktif',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Kategori soal berhasil diperbarui.',
            ]);

        $this->assertDatabaseHas('question_categories', [
            'id'              => $cat->id,
            'name'            => 'Kategori Baru',
            'description'     => 'Deskripsi baru',
            'type'            => 'essay',
            'total_questions' => 20,
            'is_active'       => false,
        ]);

        // Pastikan audit log tercatat dengan action = 'update'
        $this->assertDatabaseHas('audit_logs', [
            'user_id'        => $this->hrAdmin->id,
            'action'         => 'update',
            'auditable_type' => QuestionCategory::class,
            'auditable_id'   => $cat->id,
        ]);

        $auditLog = AuditLog::where('action', 'update')
            ->where('auditable_type', QuestionCategory::class)
            ->where('auditable_id', $cat->id)
            ->latest('id')
            ->first();

        $this->assertNotNull($auditLog);
        $this->assertSame('Memperbarui kategori soal: Kategori Baru', $auditLog->description);
        $this->assertSame('Kategori Lama', $auditLog->old_values['name'] ?? null);
        $this->assertSame('Kategori Baru', $auditLog->new_values['name'] ?? null);
        $this->assertSame('Deskripsi lama', $auditLog->old_values['deskripsi'] ?? null);
        $this->assertSame('Deskripsi baru', $auditLog->new_values['deskripsi'] ?? null);
    }

    public function test_hr_admin_can_delete_category_via_api(): void
    {
        $cat = QuestionCategory::create([
            'name'            => 'Kategori Dihapus',
            'type'            => 'multiple_choice',
            'total_questions' => 0,
            'is_active'       => true,
            'created_by'      => $this->hrAdmin->id,
        ]);

        $response = $this->actingAs($this->hrAdmin)->deleteJson('/api/question-categories/' . $cat->id);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Kategori soal berhasil dihapus.',
            ]);

        $this->assertDatabaseMissing('question_categories', [
            'id' => $cat->id,
        ]);

        $deleteAuditLog = AuditLog::where('action', 'delete')
            ->where('auditable_type', QuestionCategory::class)
            ->where('auditable_id', $cat->id)
            ->latest('id')
            ->first();

        $this->assertNotNull($deleteAuditLog);
        $this->assertSame('Menghapus kategori soal: Kategori Dihapus', $deleteAuditLog->description);
    }
}
