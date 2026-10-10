<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// ── Public Auth Routes
Route::post('/auth/login', [UserController::class, 'apiLogin']);

// ── Protected Routes (require Sanctum token)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [UserController::class, 'apiLogout']);
    Route::get('/auth/me', [UserController::class, 'me']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // ── Super Admin: Manajemen Pengguna
    Route::middleware('role:super_admin')->group(function () {
        Route::get('/users', [UserManagementController::class, 'index']);
        Route::post('/users', [UserManagementController::class, 'store']);
        Route::get('/users/{id}', [UserManagementController::class, 'show']);
        Route::put('/users/{id}', [UserManagementController::class, 'update']);
        Route::delete('/users/{id}', [UserManagementController::class, 'destroy']);

        // ── Profil Perusahaan & Settings ─────────────────────
        Route::get('/settings/company', [\App\Http\Controllers\SystemSettingsController::class, 'getCompany']);
        Route::post('/settings/company', [\App\Http\Controllers\SystemSettingsController::class, 'updateCompany']);
        Route::get('/settings/security', [\App\Http\Controllers\SystemSettingsController::class, 'getSecurity']);
        Route::post('/settings/security', [\App\Http\Controllers\SystemSettingsController::class, 'updateSecurity']);
    });
});
