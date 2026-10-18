<?php

namespace App\Http\Controllers;

use App\Models\CompanySetting;
use App\Models\SystemSetting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SystemSettingsController extends Controller
{
    /**
     * Tampilkan halaman Pengaturan Sistem (Web Route: GET /settings)
     */
    public function index()
    {
        $company = CompanySetting::firstOrCreate([], [
            'company_name' => 'Verta Indonesia',
            'email'        => 'hello@verta.co.id',
            'phone'        => '+62 21 555 0188',
            'timezone'     => 'Asia/Jakarta',
            'address'      => 'Jl. Jenderal Sudirman No. 45, Jakarta Selatan',
            'website'      => 'https://verta.co.id',
        ]);

        $systemSettings = SystemSetting::all()->pluck('value', 'key')->toArray();

        $securitySettings = [
            'session_lifetime_minutes' => (int) SystemSetting::getValue('session_lifetime_minutes', 120),
            'max_login_attempts'       => (int) SystemSetting::getValue('max_login_attempts', 5),
            'enforce_strong_password'  => SystemSetting::getValue('enforce_strong_password', 'true') === 'true',
        ];

        return view('SuperAdmin.Settings.SystemSettings', compact('company', 'systemSettings', 'securitySettings'));
    }

    /**
     * API: Get profil perusahaan
     */
    public function getCompany(): JsonResponse
    {
        $company = CompanySetting::firstOrCreate([], [
            'company_name' => 'Verta Indonesia',
            'email'        => 'hello@verta.co.id',
            'phone'        => '+62 21 555 0188',
            'timezone'     => 'Asia/Jakarta',
            'address'      => 'Jl. Jenderal Sudirman No. 45, Jakarta Selatan',
            'website'      => 'https://verta.co.id',
        ]);

        return response()->json([
            'status' => 'success',
            'data'   => $company,
        ]);
    }

    /**
     * API / Form POST: Update profil perusahaan
     */
    public function updateCompany(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'company_name' => 'nullable|string|max:255',
            'email'        => 'nullable|email|max:255',
            'phone'        => 'nullable|string|max:50',
            'timezone'     => 'nullable|string|max:50',
            'address'      => 'nullable|string',
            'website'      => 'nullable|string|max:255',
            'logo'         => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
        ], [
            'email.email'  => 'Format email tidak valid.',
            'logo.image'   => 'File logo harus berupa gambar (PNG, JPG, SVG).',
            'logo.mimes'   => 'Format logo harus PNG, JPG, JPEG, atau SVG.',
            'logo.max'     => 'Ukuran logo maksimal 2 MB.',
        ]);

        $company = CompanySetting::first();
        if (! $company) {
            $company = new CompanySetting();
        }

        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada
            if ($company->logo && Storage::disk('public')->exists(str_replace('/storage/', '', $company->logo))) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $company->logo));
            }

            $path = $request->file('logo')->store('company_logos', 'public');
            $validated['logo'] = Storage::url($path);
        }

        $oldValues = $company->getOriginal();
        $company->fill($validated);
        $company->save();

        \App\Services\AuditLogger::log(
            action: 'update',
            description: 'Mengubah konfigurasi profil perusahaan',
            auditable: $company,
            oldValues: $oldValues,
            newValues: [
                'entity_code'  => 'Company Setting',
                'company_name' => $company->company_name,
                'email'        => $company->email,
                'phone'        => $company->phone,
                'website'      => $company->website,
            ],
            request: $request
        );

        return response()->json([
            'status'  => 'success',
            'message' => 'Profil perusahaan berhasil diperbarui.',
            'data'    => $company,
        ]);
    }

    /**
     * API: Get pengaturan keamanan & akses
     */
    public function getSecurity(): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data'   => [
                'session_lifetime_minutes' => (int) SystemSetting::getValue('session_lifetime_minutes', 120),
                'max_login_attempts'       => (int) SystemSetting::getValue('max_login_attempts', 5),
                'enforce_strong_password'  => SystemSetting::getValue('enforce_strong_password', 'true') === 'true',
            ],
        ]);
    }

    /**
     * API / Form POST: Update pengaturan keamanan & akses
     */
    public function updateSecurity(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'session_lifetime_minutes' => 'required|integer|min:1|max:1440',
            'max_login_attempts'       => 'required|integer|min:1|max:20',
            'enforce_strong_password'  => 'required|boolean',
        ], [
            'session_lifetime_minutes.required' => 'Durasi kedaluwarsa sesi wajib diisi.',
            'session_lifetime_minutes.min'      => 'Durasi kedaluwarsa sesi minimal 1 menit.',
            'max_login_attempts.required'       => 'Batas maksimal percobaan login wajib diisi.',
            'max_login_attempts.min'            => 'Batas maksimal percobaan login minimal 1 kali.',
        ]);

        $oldSecurity = [
            'session_lifetime_minutes' => (int) SystemSetting::getValue('session_lifetime_minutes', 120),
            'max_login_attempts'       => (int) SystemSetting::getValue('max_login_attempts', 5),
            'enforce_strong_password'  => SystemSetting::getValue('enforce_strong_password', 'true') === 'true',
        ];

        SystemSetting::setValue('session_lifetime_minutes', $validated['session_lifetime_minutes'], 'security');
        SystemSetting::setValue('max_login_attempts', $validated['max_login_attempts'], 'security');
        SystemSetting::setValue('enforce_strong_password', $validated['enforce_strong_password'] ? 'true' : 'false', 'security');

        \App\Services\AuditLogger::log(
            action: 'update',
            description: 'Memperbarui konfigurasi keamanan & akses sistem',
            auditable: null,
            oldValues: $oldSecurity,
            newValues: [
                'entity_code'              => 'Security Setting',
                'session_lifetime_minutes' => (int) $validated['session_lifetime_minutes'],
                'max_login_attempts'       => (int) $validated['max_login_attempts'],
                'enforce_strong_password'  => (bool) $validated['enforce_strong_password'],
            ],
            request: $request
        );

        return response()->json([
            'status'  => 'success',
            'message' => 'Pengaturan keamanan & akses berhasil disimpan.',
            'data'    => [
                'session_lifetime_minutes' => (int) $validated['session_lifetime_minutes'],
                'max_login_attempts'       => (int) $validated['max_login_attempts'],
                'enforce_strong_password'  => (bool) $validated['enforce_strong_password'],
            ],
        ]);
    }
}
