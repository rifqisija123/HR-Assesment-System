<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * Accepts one or more roles as parameters.
     * Usage in route: middleware('role:super_admin') or middleware('role:super_admin,hr_admin')
     *
     * @param  Closure(Request): (Response)  $next
     * @param  string  ...$roles  Allowed roles for this route group
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // Check if user is authenticated
        if (! Auth::check()) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json(['message' => 'Unauthenticated.'], 401);
            }

            return redirect()->route('login')
                ->withErrors(['email' => 'Silakan login terlebih dahulu.']);
        }

        // Check if user has an allowed role
        $user = Auth::user();

        if (! empty($roles) && ! in_array($user->role, $roles)) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json(['message' => 'Anda tidak memiliki akses.'], 403);
            }

            // Redirect back to the user's own dashboard
            return $this->redirectToDashboard($user->role);
        }

        return $next($request);
    }

    /**
     * Redirect user to their role-specific dashboard.
     */
    protected function redirectToDashboard(string $role)
    {
        $dashboard = match ($role) {
            'super_admin' => '/dashboard',
            'hr_admin'    => '/hr/dashboard',
            'reviewer'    => '/reviewer/dashboard',
            default       => '/',
        };

        return redirect($dashboard);
    }
}
