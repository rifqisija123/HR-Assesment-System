<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Support\Facades\Route;

// ── Auth (Guest)
Route::get('/', [UserController::class, 'showLogin'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.submit');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

// ── Undangan Akses: Buat Password
Route::get('/set-password/{token}', [UserManagementController::class, 'showSetPassword'])->name('password.setup');
Route::post('/set-password', [UserManagementController::class, 'setPassword'])->name('password.setup.submit');

// ── Super Admin
Route::middleware(['role:super_admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('SuperAdmin.Dashboard');
    });
    Route::get('/usermanagement', function () {
        return view('SuperAdmin.ManagementUser.UserManagement');
    });
    Route::get('/settings', [\App\Http\Controllers\SystemSettingsController::class, 'index']);
    Route::get('/activity', function () {
        return view('SuperAdmin.History.ActivityHistory');
    });
    Route::get('/usermanagement/add', function () {
        return view('SuperAdmin.ManagementUser.AddUser');
    });
    Route::get('/usermanagement/edit/{id}', [UserManagementController::class, 'showEditPage']);
});

// ── HR Admin
Route::middleware(['role:hr_admin'])->prefix('hr')->group(function () {
    Route::get('/dashboard', function () {
        return view('HRAdmin.Dashboard');
    });
    Route::get('/question-categories', function () {
        return view('HRAdmin.QuestionCategory.KategoriSoal');
    });
    Route::get('/question-bank', function () {
        return view('HRAdmin.QuestionBank.BankSoal');
    });
    Route::get('/test-packages', function () {
        return view('HRAdmin.TestPackage.PaketTes');
    });
    Route::get('/test-sessions', function () {
        return view('HRAdmin.TestSession.SesiTes');
    });
    Route::get('/candidates', function () {
        return view('HRAdmin.Candidates.Kandidat');
    });
    Route::get('/reports', function () {
        return view('HRAdmin.Reports.Laporan');
    });
    Route::get('/question-categories/create', function () {
        return view('HRAdmin.QuestionCategory.AddKategori');
    });
    Route::get('/question-bank/create', function () {
        return view('HRAdmin.QuestionBank.AddSoal');
    });
    Route::get('/test-packages/create', function () {
        return view('HRAdmin.TestPackage.AddPaketTes');
    });
    Route::get('/test-sessions/create', function () {
        return view('HRAdmin.TestSession.AddSesiTes');
    });
    Route::get('/candidates/create', function () {
        return view('HRAdmin.Candidates.AddKandidat');
    });
    Route::get('/candidates/import', function () {
        return view('HRAdmin.Candidates.ImportKandidat');
    });
});

// ── Reviewer
Route::middleware(['role:reviewer'])->prefix('reviewer')->group(function () {
    Route::get('/dashboard', function () {
        return view('Reviewer.Dashboard');
    });
    Route::get('/review-essay', function () {
        return view('Reviewer.ReviewEssay.ReviewEssay');
    });
    Route::get('/history', function () {
        return view('Reviewer.RiwayatPenilaian.RiwayatPenilaian');
    });
});

// ── Candidate
Route::get('/candidate', function () {
    return view('Candidate.VerifToken');
});
Route::get('/candidate/information', function () {
    return view('Candidate.InformationTes');
});
Route::get('/candidate/exam', function () {
    return view('Candidate.ExamPage');
});
Route::get('/candidate/completion', function () {
    return view('Candidate.ExamCompletionPage');
});