<?php

namespace Tests\Feature;

use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActivityHistoryExportTest extends TestCase
{
    use RefreshDatabase;
    public function test_guest_cannot_export_activity_history(): void
    {
        $response = $this->get(route('superadmin.activity.export.xlsx'));
        $response->assertRedirect(route('login'));
    }

    public function test_non_super_admin_cannot_export_activity_history(): void
    {
        $user = User::factory()->create([
            'role' => 'hr_admin',
        ]);

        $response = $this->actingAs($user)->get(route('superadmin.activity.export.xlsx'));
        $response->assertRedirect('/hr/dashboard');
    }

    public function test_super_admin_can_export_activity_history_as_xlsx(): void
    {
        $admin = User::factory()->create([
            'role' => 'super_admin',
        ]);

        AuditLog::create([
            'user_id' => $admin->id,
            'action' => 'login',
            'auditable_type' => null,
            'auditable_id' => null,
            'ip_address' => '127.0.0.1',
            'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/120.0',
            'created_at' => now(),
        ]);

        $response = $this->actingAs($admin)->get(route('superadmin.activity.export.xlsx'));

        $response->assertStatus(200);
        $this->assertStringContainsString(
            'DATA_RIWAYAT_AKTIVITAS.xlsx',
            $response->headers->get('Content-Disposition')
        );
    }

    public function test_guest_cannot_export_activity_history_as_pdf(): void
    {
        $response = $this->get(route('superadmin.activity.export.pdf'));
        $response->assertRedirect(route('login'));
    }

    public function test_non_super_admin_cannot_export_activity_history_as_pdf(): void
    {
        $user = User::factory()->create([
            'role' => 'hr_admin',
        ]);

        $response = $this->actingAs($user)->get(route('superadmin.activity.export.pdf'));
        $response->assertRedirect('/hr/dashboard');
    }

    public function test_super_admin_can_export_activity_history_as_pdf(): void
    {
        $admin = User::factory()->create([
            'role' => 'super_admin',
        ]);

        AuditLog::create([
            'user_id' => $admin->id,
            'action' => 'login',
            'auditable_type' => null,
            'auditable_id' => null,
            'ip_address' => '127.0.0.1',
            'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/120.0',
            'created_at' => now(),
        ]);

        $response = $this->actingAs($admin)->get(route('superadmin.activity.export.pdf'));

        $response->assertStatus(200);
        $this->assertStringContainsString('application/pdf', $response->headers->get('Content-Type'));
        $this->assertStringContainsString(
            'DATA_RIWAYAT_AKTIVITAS.pdf',
            $response->headers->get('Content-Disposition')
        );
        $this->assertNotEmpty($response->getContent());
    }

    public function test_super_admin_can_export_activity_history_pdf_with_filters(): void
    {
        $admin = User::factory()->create([
            'role' => 'super_admin',
        ]);

        AuditLog::create([
            'user_id' => $admin->id,
            'action' => 'login',
            'auditable_type' => null,
            'auditable_id' => null,
            'ip_address' => '127.0.0.1',
            'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/120.0',
            'created_at' => now(),
        ]);

        $response = $this->actingAs($admin)->get(route('superadmin.activity.export.pdf', [
            'action' => 'login',
            'user_id' => $admin->id,
            'date_from' => now()->toDateString(),
            'date_to' => now()->toDateString(),
        ]));

        $response->assertStatus(200);
        $this->assertStringContainsString('application/pdf', $response->headers->get('Content-Type'));
        $this->assertNotEmpty($response->getContent());
    }
}

