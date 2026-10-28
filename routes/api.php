<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\SystemSettingsController;
use App\Http\Controllers\ActivityHistoryController;
use App\Http\Controllers\KategoriSoalController;
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
        Route::post('/users/{id}/reset-password', [UserManagementController::class, 'sendResetPassword']);

        // ── Profil Perusahaan & Settings ─────────────────────
        Route::get('/settings/company', [SystemSettingsController::class, 'getCompany']);
        Route::post('/settings/company', [SystemSettingsController::class, 'updateCompany']);
        Route::get('/settings/security', [SystemSettingsController::class, 'getSecurity']);
        // ── Riwayat Aktivitas (Audit Logs) ──────────────────
        Route::get('/activity-logs', [ActivityHistoryController::class, 'data']);
        Route::get('/activity-logs/{id}', [ActivityHistoryController::class, 'show']);
    });

    // ── HR Admin: Kategori Soal
    Route::middleware('role:hr_admin,super_admin')->group(function () {
        Route::get('/question-categories', [KategoriSoalController::class, 'index'])->name('api.question-categories.index');
        Route::post('/question-categories', [KategoriSoalController::class, 'store'])->name('api.question-categories.store');
        Route::get('/question-categories/{id}', [KategoriSoalController::class, 'show'])->name('api.question-categories.show');
        Route::put('/question-categories/{id}', [KategoriSoalController::class, 'update'])->name('api.question-categories.update');
        Route::delete('/question-categories/{id}', [KategoriSoalController::class, 'destroy'])->name('api.question-categories.destroy');
    });
});
