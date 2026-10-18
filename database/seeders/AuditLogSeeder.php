<?php

namespace Database\Seeders;

use App\Models\AuditLog;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AuditLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan ada user di sistem
        $superAdmin = User::where('role', 'super_admin')->first();
        $hrAdmin    = User::where('role', 'hr_admin')->first();
        $reviewer   = User::where('role', 'reviewer')->first();

        // Jika belum ada user tertentu, kita ambil user pertama
        if (!$superAdmin) {
            $superAdmin = User::first();
        }

        $now = now(config('app.timezone', 'Asia/Jakarta'));

        $logs = [
            // Row 1: HR Admin membuat sesi tes baru
            [
                'user_id'        => $hrAdmin?->id,
                'action'         => 'create',
                'auditable_type' => 'App\Models\TestSession',
                'auditable_id'   => 2091,
                'old_values'     => null,
                'new_values'     => [
                    'description'  => 'Membuat sesi tes baru',
                    'entity_code'  => 'ID: #TS-2091',
                    'title'        => 'Seleksi Management Trainee 2026 Gelombang 1',
                    'duration'     => '120 menit',
                    'total_soal'   => 60,
                    'passing_grade'=> 75,
                ],
                'ip_address'     => '192.168.1.45',
                'user_agent'     => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36',
                'created_at'     => $now->copy()->subMinutes(28),
            ],

            // Row GET: Super Admin mengakses halaman pengaturan sistem
            [
                'user_id'        => $superAdmin?->id,
                'action'         => 'get',
                'auditable_type' => null,
                'auditable_id'   => null,
                'old_values'     => null,
                'new_values'     => [
                    'description' => 'Mengakses halaman Pengaturan Sistem',
                    'entity_code' => 'Halaman Web',
                    'page'        => 'Pengaturan Sistem',
                    'path'        => '/settings',
                    'method'      => 'GET',
                ],
                'ip_address'     => '114.120.35.12',
                'user_agent'     => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.5 Safari/605.1.15',
                'created_at'     => $now->copy()->subMinutes(12),
            ],

            // Row 2: Super Admin mengubah konfigurasi email
            [
                'user_id'        => $superAdmin?->id,
                'action'         => 'update',
                'auditable_type' => 'App\Models\CompanySetting',
                'auditable_id'   => 1,
                'old_values'     => [
                    'mail_mailer' => 'smtp',
                    'mail_host'   => 'mail.old-server.com',
                    'mail_port'   => 25,
                    'mail_encryption' => 'tls',
                ],
                'new_values'     => [
                    'description' => 'Mengubah konfigurasi email',
                    'entity_code' => '-',
                    'mail_mailer' => 'smtp',
                    'mail_host'   => 'smtp.gmail.com',
                    'mail_port'   => 587,
                    'mail_encryption' => 'tls',
                ],
                'ip_address'     => '114.120.35.12',
                'user_agent'     => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.5 Safari/605.1.15',
                'created_at'     => $now->copy()->subHours(1)->subMinutes(44),
            ],

            // Row 3: Reviewer berhasil masuk ke sistem
            [
                'user_id'        => $reviewer?->id,
                'action'         => 'login',
                'auditable_type' => null,
                'auditable_id'   => null,
                'old_values'     => null,
                'new_values'     => [
                    'description' => 'Berhasil masuk ke sistem',
                    'status'      => 'success',
                    'session_id'  => 'sess_99341fa8',
                    'login_type'  => 'Web Password',
                ],
                'ip_address'     => '182.253.111.4',
                'user_agent'     => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:113.0) Gecko/20100101 Firefox/113.0',
                'created_at'     => $now->copy()->subHours(3)->subMinutes(55),
            ],

            // Row 4: System Auto menghapus data token kedaluwarsa
            [
                'user_id'        => null,
                'action'         => 'delete',
                'auditable_type' => 'App\Models\Invitation',
                'auditable_id'   => 502,
                'old_values'     => [
                    'batch_code' => 'BATCH-502',
                    'expired_tokens_count' => 14,
                    'status' => 'expired',
                ],
                'new_values'     => [
                    'description' => 'Menghapus data token kedaluwarsa',
                    'entity_code' => 'Batch #502',
                    'cleaned_count' => 14,
                ],
                'ip_address'     => '127.0.0.1',
                'user_agent'     => 'Server Cron / Linux (PHP CLI 8.3)',
                'created_at'     => $now->copy()->subDay()->addHours(1)->subMinutes(15),
            ],

            // Row 5: Super Admin membuat user baru
            [
                'user_id'        => $superAdmin?->id,
                'action'         => 'create',
                'auditable_type' => 'App\Models\User',
                'auditable_id'   => $hrAdmin?->id ?? 2,
                'old_values'     => null,
                'new_values'     => [
                    'description' => 'Menambahkan akun pengguna baru HR Admin',
                    'entity_code' => 'ID: #USR-' . ($hrAdmin?->id ?? 2),
                    'name'        => $hrAdmin?->name ?? 'Nadia Putri',
                    'email'       => $hrAdmin?->email ?? 'hradmin@sii.com',
                    'role'        => 'hr_admin',
                    'is_active'   => true,
                ],
                'ip_address'     => '114.120.35.12',
                'user_agent'     => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.5 Safari/605.1.15',
                'created_at'     => $now->copy()->subDays(2)->addHours(4),
            ],

            // Row 6: HR Admin menambahkan kategori soal
            [
                'user_id'        => $hrAdmin?->id,
                'action'         => 'create',
                'auditable_type' => 'App\Models\QuestionCategory',
                'auditable_id'   => 101,
                'old_values'     => null,
                'new_values'     => [
                    'description' => 'Membuat kategori bank soal baru',
                    'entity_code' => 'ID: #QC-101',
                    'name'        => 'Logika Deduktif & Analitis',
                    'description_category' => 'Tes kemampuan penalaran logis',
                ],
                'ip_address'     => '192.168.1.45',
                'user_agent'     => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36',
                'created_at'     => $now->copy()->subDays(3)->addHours(2),
            ],

            // Row 7: Reviewer memberi nilai essay
            [
                'user_id'        => $reviewer?->id,
                'action'         => 'update',
                'auditable_type' => 'App\Models\EssayReview',
                'auditable_id'   => 88,
                'old_values'     => [
                    'score'    => null,
                    'status'   => 'pending',
                    'feedback' => null,
                ],
                'new_values'     => [
                    'description' => 'Menyelesaikan review jawaban esai',
                    'entity_code' => 'ID: #ER-88',
                    'score'       => 88.5,
                    'status'      => 'graded',
                    'feedback'    => 'Penalaran kasus sangat baik dan argumentasi terstruktur.',
                ],
                'ip_address'     => '182.253.111.4',
                'user_agent'     => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:113.0) Gecko/20100101 Firefox/113.0',
                'created_at'     => $now->copy()->subDays(3)->subHours(3),
            ],

            // Row 8: Super Admin memperbarui pengaturan keamanan
            [
                'user_id'        => $superAdmin?->id,
                'action'         => 'update',
                'auditable_type' => 'App\Models\SystemSetting',
                'auditable_id'   => 2,
                'old_values'     => [
                    'session_lifetime_minutes' => 60,
                    'max_login_attempts'       => 3,
                ],
                'new_values'     => [
                    'description'              => 'Memperbarui batasan percobaan login',
                    'entity_code'              => 'Setting #2',
                    'session_lifetime_minutes' => 120,
                    'max_login_attempts'       => 5,
                ],
                'ip_address'     => '114.120.35.12',
                'user_agent'     => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.5 Safari/605.1.15',
                'created_at'     => $now->copy()->subDays(4),
            ],

            // Row 9: HR Admin logout
            [
                'user_id'        => $hrAdmin?->id,
                'action'         => 'logout',
                'auditable_type' => null,
                'auditable_id'   => null,
                'old_values'     => null,
                'new_values'     => [
                    'description' => 'Keluar dari sistem secara manual',
                    'reason'      => 'User logout click',
                ],
                'ip_address'     => '192.168.1.45',
                'user_agent'     => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36',
                'created_at'     => $now->copy()->subDays(5),
            ],

            // Row 10: Super Admin login
            [
                'user_id'        => $superAdmin?->id,
                'action'         => 'login',
                'auditable_type' => null,
                'auditable_id'   => null,
                'old_values'     => null,
                'new_values'     => [
                    'description' => 'Berhasil masuk ke sistem Super Admin',
                    'login_type'  => 'Standard Auth',
                ],
                'ip_address'     => '114.120.35.12',
                'user_agent'     => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/16.5 Safari/605.1.15',
                'created_at'     => $now->copy()->subDays(6),
            ],
        ];

        foreach ($logs as $logData) {
            AuditLog::create($logData);
        }
    }
}
