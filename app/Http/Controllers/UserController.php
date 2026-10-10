<?php

namespace App\Http\Controllers;

use App\Models\SystemSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLogin()
    {
        // If already logged in, redirect to dashboard based on role
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user());
        }

        return view('Login');
    }

    /**
     * Authenticate user via session and redirect based on role.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $maxAttempts = (int) SystemSetting::getValue('max_login_attempts', 5);
        $throttleKey = 'login:' . Str::lower($request->input('email')) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, $maxAttempts)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return back()->withErrors([
                'email' => "Batas percobaan login tercapai ({$maxAttempts} kali). Silakan coba lagi dalam {$seconds} detik.",
            ])->withInput($request->only('email'))->with('lockout_seconds', $seconds);
        }

        $user = User::where('email', $request->email)->first();

        // Check credentials
        if (! $user || ! Hash::check($request->password, $user->password)) {
            RateLimiter::hit($throttleKey, 60);

            if (RateLimiter::tooManyAttempts($throttleKey, $maxAttempts)) {
                $seconds = RateLimiter::availableIn($throttleKey);
                return back()->withErrors([
                    'email' => "Batas percobaan login tercapai ({$maxAttempts} kali). Silakan coba lagi dalam {$seconds} detik.",
                ])->withInput($request->only('email'))->with('lockout_seconds', $seconds);
            }

            return back()->withErrors([
                'email' => 'Email atau password yang Anda masukkan salah.',
            ])->withInput($request->only('email'));
        }

        // Check if account is active
        if (! $user->is_active) {
            return back()->withErrors([
                'email' => 'Akun Anda tidak aktif. Silakan hubungi administrator.',
            ])->withInput($request->only('email'));
        }

        RateLimiter::clear($throttleKey);

        // Login the user into the session
        Auth::login($user, $request->boolean('remember'));

        // Regenerate session to prevent fixation
        $request->session()->regenerate();

        // Update last login timestamp
        $user->update(['last_login_at' => now()]);

        // Redirect based on role
        return $this->redirectByRole($user);
    }

    /**
     * Logout the user and invalidate session.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Redirect user to their role-specific dashboard.
     */
    protected function redirectByRole($user)
    {
        return match ($user->role) {
            'super_admin' => redirect('/dashboard'),
            'hr_admin'    => redirect('/hr/dashboard'),
            'reviewer'    => redirect('/reviewer/dashboard'),
            default       => redirect('/dashboard'),
        };
    }

    // ── API Methods (Sanctum) ────────────────────────────

    /**
     * Authenticate user and issue a Sanctum token (API).
     */
    public function apiLogin(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $maxAttempts = (int) SystemSetting::getValue('max_login_attempts', 5);
        $throttleKey = 'login:' . Str::lower($request->input('email')) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, $maxAttempts)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            throw ValidationException::withMessages([
                'email' => ["Batas percobaan login tercapai ({$maxAttempts} kali). Silakan coba lagi dalam {$seconds} detik."],
            ]);
        }

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            RateLimiter::hit($throttleKey, 60);
            throw ValidationException::withMessages([
                'email' => ['Email atau password yang Anda masukkan salah.'],
            ]);
        }

        if (! $user->is_active) {
            throw ValidationException::withMessages([
                'email' => ['Akun Anda tidak aktif. Silakan hubungi administrator.'],
            ]);
        }

        RateLimiter::clear($throttleKey);

        $user->update(['last_login_at' => now()]);

        $token = $user->createToken('auth-token', [$user->role])->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil.',
            'token'   => $token,
            'user'    => [
                'id'     => $user->id,
                'name'   => $user->name,
                'email'  => $user->email,
                'role'   => $user->role,
                'avatar' => $user->avatar,
            ],
        ]);
    }

    /**
     * Revoke the current access token (API logout).
     */
    public function apiLogout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout berhasil.',
        ]);
    }

    /**
     * Get the authenticated user profile (API).
     */
    public function me(Request $request)
    {
        return response()->json([
            'user' => $request->user(),
        ]);
    }
}
