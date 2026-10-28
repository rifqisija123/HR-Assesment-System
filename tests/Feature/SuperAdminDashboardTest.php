<?php

namespace Tests\Feature;

use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SuperAdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_super_admin_dashboard(): void
    {
        $response = $this->get('/dashboard');
        $response->assertRedirect(route('login'));
    }

    public function test_non_super_admin_cannot_access_super_admin_dashboard(): void
    {
        $user = User::factory()->create([
            'role' => 'hr_admin',
        ]);

        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertRedirect('/hr/dashboard');
    }

    public function test_super_admin_can_access_dashboard_with_real_user_name(): void
    {
        $admin = User::factory()->create([
            'name' => 'Budi Santoso',
            'role' => 'super_admin',
            'is_active' => true,
        ]);

        $response = $this->actingAs($admin)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Selamat datang, Budi Santoso');
    }

    public function test_dashboard_displays_real_user_counts(): void
    {
        $admin = User::factory()->create([
            'role' => 'super_admin',
            'is_active' => true,
        ]);

        // 2 active users, 1 inactive user (plus 1 active admin = 3 active, 4 total)
        User::factory()->create(['role' => 'hr_admin', 'is_active' => true]);
        User::factory()->create(['role' => 'reviewer', 'is_active' => true]);
        User::factory()->create(['role' => 'reviewer', 'is_active' => false]);

        $response = $this->actingAs($admin)->get('/dashboard');

        $response->assertStatus(200);
        // Total users = 4
        $response->assertSee('Total pengguna');
        $response->assertSee('4');
        // Active users = 3 (75%)
        $response->assertSee('Pengguna aktif');
        $response->assertSee('3');
        $response->assertSee('75% dari seluruh pengguna');
    }

    public function test_dashboard_displays_real_recent_activities(): void
    {
        $admin = User::factory()->create([
            'name' => 'Admin Verta',
            'role' => 'super_admin',
            'is_active' => true,
        ]);

        AuditLog::create([
            'user_id' => $admin->id,
            'action' => 'create',
            'auditable_type' => 'App\Models\User',
            'auditable_id' => 10,
            'new_values' => ['description' => 'Membuat akun pengguna baru'],
            'ip_address' => '127.0.0.1',
            'user_agent' => 'Mozilla/5.0',
            'created_at' => now(),
        ]);

        $response = $this->actingAs($admin)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Aktivitas terbaru');
        $response->assertSee('Admin Verta membuat akun pengguna baru');
    }
}
