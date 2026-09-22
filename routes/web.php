<?php

use Illuminate\Support\Facades\Route;

// Login
Route::get('/', function () {
    return view('Login');
});

// Super Admin
Route::get('/dashboard', function () {
    return view('SuperAdmin.Dashboard');
});
Route::get('/usermanagement', function () {
    return view('SuperAdmin.ManagementUser.UserManagement');
});
Route::get('/settings', function () {
    return view('SuperAdmin.Settings.SystemSettings');
});
Route::get('/activity', function () {
    return view('SuperAdmin.History.ActivityHistory');
});
Route::get('/usermanagement/add', function () {
    return view('SuperAdmin.ManagementUser.AddUser');
});

// HR Admin
Route::get('/hr/dashboard', function () {
    return view('HRAdmin.Dashboard');
});
Route::get('/hr/question-categories', function () {
    return view('HRAdmin.QuestionCategory.KategoriSoal');
});
Route::get('/hr/question-bank', function () {
    return view('HRAdmin.QuestionBank.BankSoal');
});
Route::get('/hr/test-packages', function () {
    return view('HRAdmin.TestPackage.PaketTes');
});
Route::get('/hr/test-sessions', function () {
    return view('HRAdmin.TestSession.SesiTes');
});
Route::get('/hr/candidates', function () {
    return view('HRAdmin.Candidates.Kandidat');
});
Route::get('/hr/reports', function () {
    return view('HRAdmin.Reports.Laporan');
});
Route::get('/hr/question-categories/create', function () {
    return view('HRAdmin.QuestionCategory.AddKategori');
});
Route::get('/hr/question-bank/create', function () {
    return view('HRAdmin.QuestionBank.AddSoal');
});
Route::get('/hr/test-packages/create', function () {
    return view('HRAdmin.TestPackage.AddPaketTes');
});
Route::get('/hr/test-sessions/create', function () {
    return view('HRAdmin.TestSession.AddSesiTes');
});
Route::get('/hr/candidates/create', function () {
    return view('HRAdmin.Candidates.AddKandidat');
});
Route::get('/hr/candidates/import', function () {
    return view('HRAdmin.Candidates.ImportKandidat');
});

// Reviewer
Route::get('/reviewer/dashboard', function () {
    return view('Reviewer.Dashboard');
});
Route::get('/reviewer/review-essay', function () {
    return view('Reviewer.ReviewEssay.ReviewEssay');
});
Route::get('/reviewer/history', function () {
    return view('Reviewer.RiwayatPenilaian.RiwayatPenilaian');
});




