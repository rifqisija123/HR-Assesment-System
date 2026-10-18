<?php

namespace App\Http\Controllers;

use App\Mail\UserInvitationMail;
use App\Mail\UserResetPasswordMail;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password as PasswordRule;

class UserManagementController extends Controller
{
    /** Broker token khusus undangan (lihat config/auth.php → passwords.invites) */
    protected const INVITE_BROKER = 'invites';

    /** Daftar role yang valid */
    protected const ROLES = ['super_admin', 'hr_admin', 'reviewer'];

    // ── API: List Users ──────────────────────────────────

    /**
     * GET /api/users
     * Query: search, role, status (aktif|nonaktif), per_page, page
     */
    public function index(Request $request): JsonResponse
    {
        $request->validate([
            'search'   => 'nullable|string|max:100',
            'role'     => ['nullable', Rule::in(self::ROLES)],
            'status'   => ['nullable', Rule::in(['aktif', 'nonaktif'])],
            'per_page' => 'nullable|integer|min:1|max:100',
        ]);

        $users = User::query()
            ->when($request->filled('search'), function ($q) use ($request) {
                $term = '%' . $request->search . '%';
                $q->where(fn ($w) => $w->where('name', 'like', $term)->orWhere('email', 'like', $term));
            })
            ->when($request->filled('role'), fn ($q) => $q->where('role', $request->role))
            ->when($request->filled('status'), fn ($q) => $q->where('is_active', $request->status === 'aktif'))
            ->latest()
            ->paginate($request->integer('per_page', 10));

        $users->getCollection()->transform(fn (User $user) => $this->transformUser($user));

        return response()->json($users);
    }

    // ── API: Create User ─────────────────────────────────

    /**
     * POST /api/users
     * Body: name, email, role, status (aktif|nonaktif), send_invite (bool)
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email|max:255|unique:users,email',
            'role'        => ['required', Rule::in(self::ROLES)],
            'status'      => ['required', Rule::in(['aktif', 'nonaktif'])],
            'send_invite' => 'nullable|boolean',
        ], [
            'name.required'  => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
            'email.unique'   => 'Email sudah terdaftar.',
            'role.required'  => 'Role wajib dipilih.',
            'role.in'        => 'Role tidak valid.',
            'status.in'      => 'Status tidak valid.',
        ]);

        // Password acak sementara — pengguna akan membuat password sendiri via undangan
        $user = DB::transaction(fn () => User::create([
            'name'      => $validated['name'],
            'email'     => strtolower($validated['email']),
            'password'  => Str::password(32),
            'role'      => $validated['role'],
            'is_active' => $validated['status'] === 'aktif',
        ]));

        $inviteSent  = false;
        $inviteError = null;

        if ($request->boolean('send_invite')) {
            try {
                $this->sendInvitation($user);
                $inviteSent = true;
            } catch (\Throwable $e) {
                Log::error('Gagal mengirim undangan akses', [
                    'user_id' => $user->id,
                    'error'   => $e->getMessage(),
                ]);
                $inviteError = 'Pengguna berhasil dibuat, tetapi email undangan gagal dikirim. Periksa konfigurasi SMTP.';
            }
        }

        \App\Services\AuditLogger::log(
            action: 'create',
            description: "Menambahkan pengguna baru {$user->name}",
            auditable: $user,
            newValues: [
                'entity_code' => "ID: #USR-{$user->id}",
                'name'        => $user->name,
                'email'       => $user->email,
                'role'        => $user->role,
                'status'      => $validated['status'],
                'send_invite' => $request->boolean('send_invite'),
            ],
            request: $request
        );

        return response()->json([
            'message'      => $inviteError
                ?? ($inviteSent
                    ? "Pengguna berhasil dibuat dan undangan telah dikirim ke {$user->email}."
                    : 'Pengguna berhasil dibuat.'),
            'invite_sent'  => $inviteSent,
            'invite_error' => $inviteError,
            'data'         => $this->transformUser($user),
        ], 201);
    }

    // ── Web: Render Edit User Page ──────────────────────

    public function showEditPage(int $id)
    {
        $user = User::findOrFail($id);

        if ($user->email === 'superadmin@sii.com') {
            return redirect('/usermanagement')->with('error', 'Akun Super Admin utama tidak dapat diubah.');
        }

        $userData = [
            'id'             => $user->id,
            'name'           => $user->name,
            'email'          => $user->email,
            'role'           => $user->role,
            'status'         => $user->is_active ? 'aktif' : 'nonaktif',
            'invite_pending' => is_null($user->email_verified_at),
        ];

        return view('SuperAdmin.ManagementUser.EditUser', compact('userData'));
    }

    // ── API: Get User Detail ─────────────────────────────

    public function show(int $id): JsonResponse
    {
        $user = User::findOrFail($id);

        return response()->json([
            'data' => $this->transformUser($user),
        ]);
    }

    // ── API: Update User ─────────────────────────────────

    public function update(Request $request, int $id): JsonResponse
    {
        $user = User::findOrFail($id);

        if ($user->email === 'superadmin@sii.com') {
            return response()->json(['message' => 'Akun Super Admin utama tidak dapat diubah.'], 403);
        }

        $oldValues = [
            'name'      => $user->name,
            'email'     => $user->email,
            'role'      => $user->role,
            'status'    => $user->is_active ? 'aktif' : 'nonaktif',
        ];

        $invitePending = is_null($user->email_verified_at);

        if ($invitePending) {
            $validated = $request->validate([
                'name'        => 'required|string|max:255',
                'email'       => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
                'role'        => ['required', Rule::in(self::ROLES)],
                'status'      => ['required', Rule::in(['aktif', 'nonaktif'])],
                'send_invite' => 'nullable|boolean',
            ], [
                'name.required'  => 'Nama lengkap wajib diisi.',
                'email.required' => 'Alamat email wajib diisi.',
                'email.email'    => 'Format email tidak valid.',
                'email.unique'   => 'Email sudah terdaftar.',
                'role.required'  => 'Role wajib dipilih.',
                'role.in'        => 'Role tidak valid.',
                'status.in'      => 'Status tidak valid.',
            ]);

            $user->update([
                'name'      => $validated['name'],
                'email'     => strtolower($validated['email']),
                'role'      => $validated['role'],
                'is_active' => $validated['status'] === 'aktif',
            ]);

            \App\Services\AuditLogger::log(
                action: 'update',
                description: "Mengubah data pengguna {$user->name}",
                auditable: $user,
                oldValues: $oldValues,
                newValues: [
                    'entity_code' => "ID: #USR-{$user->id}",
                    'name'        => $user->name,
                    'email'       => $user->email,
                    'role'        => $user->role,
                    'status'      => $validated['status'],
                ],
                request: $request
            );

            $inviteSent  = false;
            $inviteError = null;

            if ($request->boolean('send_invite')) {
                try {
                    $this->sendInvitation($user);
                    $inviteSent = true;
                } catch (\Throwable $e) {
                    Log::error('Gagal mengirim ulang undangan akses', [
                        'user_id' => $user->id,
                        'error'   => $e->getMessage(),
                    ]);
                    $inviteError = 'Pengguna berhasil diperbarui, tetapi email undangan gagal dikirim. Periksa konfigurasi SMTP.';
                }
            }

            return response()->json([
                'message'      => $inviteError
                    ?? ($inviteSent
                        ? "Pengguna berhasil diperbarui dan undangan telah dikirim ulang ke {$user->email}."
                        : 'Pengguna berhasil diperbarui.'),
                'invite_sent'  => $inviteSent,
                'invite_error' => $inviteError,
                'data'         => $this->transformUser($user),
            ]);
        } else {
            $validated = $request->validate([
                'name'   => 'required|string|max:255',
                'role'   => ['required', Rule::in(self::ROLES)],
                'status' => ['required', Rule::in(['aktif', 'nonaktif'])],
            ], [
                'name.required' => 'Nama lengkap wajib diisi.',
                'role.required' => 'Role wajib dipilih.',
                'role.in'       => 'Role tidak valid.',
                'status.in'     => 'Status tidak valid.',
            ]);

            $user->update([
                'name'      => $validated['name'],
                'role'      => $validated['role'],
                'is_active' => $validated['status'] === 'aktif',
            ]);

            \App\Services\AuditLogger::log(
                action: 'update',
                description: "Mengubah data pengguna {$user->name}",
                auditable: $user,
                oldValues: $oldValues,
                newValues: [
                    'entity_code' => "ID: #USR-{$user->id}",
                    'name'        => $user->name,
                    'role'        => $user->role,
                    'status'      => $validated['status'],
                ],
                request: $request
            );

            return response()->json([
                'message' => 'Pengguna berhasil diperbarui.',
                'data'    => $this->transformUser($user),
            ]);
        }
    }

    // ── API: Delete User ─────────────────────────────────

    public function destroy(int $id, Request $request): JsonResponse
    {
        $user = User::findOrFail($id);

        if ($user->email === 'superadmin@sii.com') {
            return response()->json(['message' => 'Akun Super Admin utama tidak dapat dihapus.'], 403);
        }

        \App\Services\AuditLogger::log(
            action: 'delete',
            description: "Menghapus akun pengguna {$user->name}",
            auditable: $user,
            oldValues: [
                'entity_code' => "ID: #USR-{$user->id}",
                'name'        => $user->name,
                'email'       => $user->email,
                'role'        => $user->role,
            ],
            request: $request
        );

        $user->delete();

        return response()->json([
            'message' => 'Pengguna berhasil dihapus.',
        ]);
    }

    // ── API: Send Reset Password Invitation ──────────────

    /**
     * POST /api/users/{id}/reset-password
     */
    public function sendResetPassword(int $id, Request $request): JsonResponse
    {
        $user = User::findOrFail($id);

        if ($user->email === 'superadmin@sii.com') {
            return response()->json(['message' => 'Akun Super Admin utama tidak dapat direset.'], 403);
        }

        if (is_null($user->email_verified_at)) {
            return response()->json([
                'message' => 'Pengguna ini belum mengaktifkan akun/password pertama kali. Silakan gunakan kirim ulang undangan.',
            ], 422);
        }

        try {
            /** @var \Illuminate\Auth\Passwords\PasswordBroker $broker */
            $broker = Password::broker(self::INVITE_BROKER);
            $token  = $broker->createToken($user);

            $url = route('password.setup', [
                'token' => $token,
                'email' => $user->email,
            ]);

            $expireHours = (int) ceil(config('auth.passwords.' . self::INVITE_BROKER . '.expire', 1440) / 60);

            Mail::to($user->email)->send(new UserResetPasswordMail($user, $url, $expireHours));

            \App\Services\AuditLogger::log(
                action: 'reset_password',
                description: "Mengirimkan undangan reset password untuk pengguna {$user->name}",
                auditable: $user,
                newValues: [
                    'entity_code' => "ID: #USR-{$user->id}",
                    'name'        => $user->name,
                    'email'       => $user->email,
                    'role'        => $user->role,
                ],
                request: $request
            );

            return response()->json([
                'message' => "Undangan reset password telah berhasil dikirim ke {$user->email}.",
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal mengirim email reset password', [
                'user_id' => $user->id,
                'error'   => $e->getMessage(),
            ]);

            return response()->json([
                'message' => 'Gagal mengirim email reset password. Periksa konfigurasi SMTP.',
            ], 500);
        }
    }

    // ── Web: Set Password (dari link undangan) ──────────

    /**
     * GET /set-password/{token}?email=...
     */
    public function showSetPassword(Request $request, string $token)
    {
        $email = (string) $request->query('email');
        $user  = User::where('email', $email)->first();

        /** @var \Illuminate\Auth\Passwords\PasswordBroker $broker */
        $broker = Password::broker(self::INVITE_BROKER);
        $valid  = $user && $broker->tokenExists($user, $token);

        $enforceStrong = \App\Models\SystemSetting::getValue('enforce_strong_password', 'true') === 'true';

        return view('Auth.SetPassword', [
            'token'         => $token,
            'email'         => $email,
            'name'          => $user?->name,
            'valid'         => $valid,
            'enforceStrong' => $enforceStrong,
        ]);
    }

    /**
     * POST /set-password
     */
    public function setPassword(Request $request)
    {
        $enforceStrong = \App\Models\SystemSetting::getValue('enforce_strong_password', 'true') === 'true';

        $passwordRules = PasswordRule::min(8);
        if ($enforceStrong) {
            $passwordRules = $passwordRules->letters()->mixedCase()->numbers()->symbols();
        }

        $request->validate([
            'token'    => 'required|string',
            'email'    => 'required|email',
            'password' => ['required', 'confirmed', $passwordRules],
        ], [
            'password.required'   => 'Password wajib diisi.',
            'password.confirmed'  => 'Konfirmasi password tidak cocok.',
            'password.min'        => 'Password minimal 8 karakter.',
            'password.letters'    => 'Password harus mengandung huruf.',
            'password.mixed_case' => 'Password harus mengandung huruf besar dan kecil.',
            'password.numbers'    => 'Password harus mengandung angka.',
            'password.symbols'    => 'Password harus mengandung karakter spesial (!@#$%^&*).',
        ]);

        $status = Password::broker(self::INVITE_BROKER)->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password'          => $password, // otomatis di-hash (cast 'hashed')
                    'email_verified_at' => $user->email_verified_at ?? now(),
                    'remember_token'    => Str::random(60),
                ])->save();
            }
        );

        if ($status !== Password::PASSWORD_RESET) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['password' => 'Link undangan tidak valid atau sudah kedaluwarsa. Hubungi administrator.']);
        }

        return redirect()->route('login')
            ->with('status', 'Password berhasil dibuat. Silakan login dengan akun Anda.');
    }

    // ── Helpers ──────────────────────────────────────────

    /**
     * Buat token dan kirim email undangan untuk membuat password.
     */
    protected function sendInvitation(User $user): void
    {
        /** @var \Illuminate\Auth\Passwords\PasswordBroker $broker */
        $broker = Password::broker(self::INVITE_BROKER);
        $token  = $broker->createToken($user);

        $url = route('password.setup', [
            'token' => $token,
            'email' => $user->email,
        ]);

        $expireHours = (int) ceil(config('auth.passwords.' . self::INVITE_BROKER . '.expire', 1440) / 60);

        Mail::to($user->email)->send(new UserInvitationMail($user, $url, $expireHours));
    }

    /**
     * Format data user untuk response API.
     */
    protected function transformUser(User $user): array
    {
        return [
            'id'              => $user->id,
            'name'            => $user->name,
            'email'           => $user->email,
            'initials'        => $this->initials($user->name),
            'role'            => $user->role,
            'role_label'      => match ($user->role) {
                'super_admin' => 'Super Admin',
                'hr_admin'    => 'HR Admin',
                'reviewer'    => 'Reviewer',
                default       => $user->role,
            },
            'is_active'       => (bool) $user->is_active,
            'status_label'    => $user->is_active ? 'Aktif' : 'Nonaktif',
            'invite_pending'  => is_null($user->email_verified_at),
            'last_login_at'   => $user->last_login_at?->toIso8601String(),
            'last_activity'   => $user->last_login_at
                ? $user->last_login_at->locale('id')->diffForHumans()
                : (is_null($user->email_verified_at) ? 'Menunggu aktivasi' : 'Belum pernah login'),
            'created_at'      => $user->created_at?->toIso8601String(),
        ];
    }

    protected function initials(string $name): string
    {
        $parts = preg_split('/\s+/', trim($name)) ?: [];
        $first = $parts[0] ?? '';
        $last  = count($parts) > 1 ? end($parts) : '';

        return strtoupper(mb_substr($first, 0, 1) . mb_substr($last, 0, 1)) ?: '?';
    }
}
