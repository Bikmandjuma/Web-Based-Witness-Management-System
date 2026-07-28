<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ReportAssignmentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Investigator\DashboardController as InvestigatorDashboardController;
use App\Http\Controllers\Investigator\ReportController as InvestigatorReportController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Witness\EvidenceController;
use App\Http\Controllers\Witness\ReportController as WitnessReportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public / guest routes
|--------------------------------------------------------------------------
*/
Route::view('/', 'Guest.home')->name('guest.home');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('submit.login');

    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('forgot-password');
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('submit-forgot-password');

    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});

/*
|--------------------------------------------------------------------------
| Authenticated routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // shared: post a message on a report thread (the controller checks the user
    // is the witness, the assigned investigator, or an admin before allowing it)
    Route::post('/reports/{report}/messages', [MessageController::class, 'store'])->name('messages.store');

    Route::get('/evidence/{evidence}/download', [EvidenceController::class, 'download'])->name('evidence.download');

    // ---------------- Witness ----------------
    Route::middleware(['role:witness'])->prefix('witness')->name('witness.')->group(function () {
        Route::get('/dashboard', [WitnessReportController::class, 'index'])->name('dashboard');
        Route::get('/reports/create', [WitnessReportController::class, 'create'])->name('reports.create');
        Route::post('/reports', [WitnessReportController::class, 'store'])->name('reports.store');
        Route::get('/reports/{report}', [WitnessReportController::class, 'show'])->name('reports.show');
        Route::post('/reports/{report}/evidence', [EvidenceController::class, 'store'])->name('reports.evidence.store');
    });

    // ---------------- Investigator ----------------
    Route::middleware(['role:investigator'])->prefix('investigator')->name('investigator.')->group(function () {
        Route::get('/dashboard', [InvestigatorDashboardController::class, 'index'])->name('dashboard');
        Route::get('/reports/{report}', [InvestigatorReportController::class, 'show'])->name('reports.show');
        Route::patch('/reports/{report}/status', [InvestigatorReportController::class, 'updateStatus'])->name('reports.status');
    });

    // ---------------- Admin ----------------
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::patch('/users/{user}/toggle-active', [UserController::class, 'toggleActive'])->name('users.toggle-active');
        Route::patch('/users/{user}/role', [UserController::class, 'updateRole'])->name('users.update-role');

        Route::get('/reports/assign', [ReportAssignmentController::class, 'index'])->name('reports.assign');
        Route::patch('/reports/{report}/assign', [ReportAssignmentController::class, 'assign'])->name('reports.assign.store');
    });
});
