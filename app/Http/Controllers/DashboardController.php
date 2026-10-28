<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman Super Admin Dashboard dengan metrik real dari database.
     */
    public function index(Request $request): View
    {
        $totalUsers = User::count();
        $activeUsers = User::where('is_active', true)->count();
        $activePercentage = $totalUsers > 0 ? (int) round(($activeUsers / $totalUsers) * 100) : 0;

        $newUsersThisMonth = User::where('created_at', '>=', now()->startOfMonth())->count();

        $recentActivities = AuditLog::with('user')
            ->latest('created_at')
            ->latest('id')
            ->take(5)
            ->get();

        return view('SuperAdmin.Dashboard', compact(
            'totalUsers',
            'activeUsers',
            'activePercentage',
            'newUsersThisMonth',
            'recentActivities'
        ));
    }
}
