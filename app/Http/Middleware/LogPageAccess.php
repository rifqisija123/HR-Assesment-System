<?php

namespace App\Http\Middleware;

use App\Services\AuditLogger;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class LogPageAccess
{
    /**
     * Catat aktivitas GET (akses halaman) oleh pengguna yang terautentikasi.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Hanya proses request GET yang berhasil (200), pengguna telah login, dan bukan request internal/AJAX/API
        if (
            $request->isMethod('GET') &&
            Auth::check() &&
            $response->getStatusCode() === 200 &&
            !$request->expectsJson() &&
            !$request->ajax() &&
            !$request->is('api/*') &&
            !$request->is('*/data*') &&
            !$request->is('*/detail/*') &&
            !$request->header('X-Requested-With')
        ) {
            $pageTitle = $this->resolvePageTitle($request);

            if ($pageTitle) {
                // Throttle 10 detik agar refresh halaman tidak menduplikasi audit log secara berlebihan
                $cacheKey = 'audit_page_get_' . Auth::id() . '_' . md5($request->path());

                if (!Cache::has($cacheKey)) {
                    Cache::put($cacheKey, true, now()->addSeconds(10));

                    try {
                        AuditLogger::log(
                            action: 'get',
                            description: "Mengakses halaman {$pageTitle}",
                            auditable: null,
                            newValues: [
                                'entity_code' => 'Halaman Web',
                                'page'        => $pageTitle,
                                'path'        => '/' . ltrim($request->path(), '/'),
                                'method'      => 'GET',
                            ],
                            user: Auth::user(),
                            request: $request
                        );
                    } catch (\Throwable $e) {
                        // Jangan biarkan kegagalan logging mengganggu rendering halaman
                        report($e);
                    }
                }
            }
        }

        return $response;
    }

    /**
     * Resolusi nama halaman berdasarkan pola URL.
     */
    protected function resolvePageTitle(Request $request): ?string
    {
        $path = trim($request->path(), '/');

        if ($request->is('settings*')) {
            return 'Pengaturan Sistem';
        }

        if ($request->is('usermanagement/add*')) {
            return 'Tambah Pengguna';
        }

        if ($request->is('usermanagement/edit*')) {
            return 'Edit Pengguna';
        }

        if ($request->is('usermanagement*')) {
            return 'Manajemen Pengguna';
        }

        if ($request->is('activity*')) {
            return 'Riwayat Aktivitas';
        }

        if ($request->is('dashboard*')) {
            return 'Dashboard';
        }

        // HR Admin Routes
        if ($request->is('hr/dashboard*')) {
            return 'Dashboard HR';
        }
        if ($request->is('hr/question-categories*')) {
            return 'Kategori Soal';
        }
        if ($request->is('hr/question-bank*')) {
            return 'Bank Soal';
        }
        if ($request->is('hr/test-packages*')) {
            return 'Paket Tes';
        }
        if ($request->is('hr/test-sessions*')) {
            return 'Sesi Tes';
        }
        if ($request->is('hr/candidates*')) {
            return 'Kandidat';
        }
        if ($request->is('hr/reports*')) {
            return 'Laporan Hasil';
        }

        // Reviewer Routes
        if ($request->is('reviewer/dashboard*')) {
            return 'Dashboard Reviewer';
        }
        if ($request->is('reviewer/review-essay*')) {
            return 'Review Essay';
        }
        if ($request->is('reviewer/history*')) {
            return 'Riwayat Penilaian';
        }

        // Candidate Routes
        if ($request->is('candidate*')) {
            return 'Portal Kandidat';
        }

        if (!empty($path)) {
            return ucwords(str_replace(['/', '-', '_'], ' ', $path));
        }

        return null;
    }
}
