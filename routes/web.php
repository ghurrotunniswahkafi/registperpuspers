<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;


Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');

    Route::delete('/data-anggota/{member}', [AdminDashboardController::class, 'deleteDataAnggota'])->name('data-anggota.delete');
    Route::get('/verifikasi', [AdminDashboardController::class, 'verifikasi'])->name('verifikasi');
    Route::get('/verifikasi/{member}', [AdminDashboardController::class, 'showVerifikasi'])->name('verifikasi.show');
    Route::post('/verifikasi/{member}/setujui', [AdminDashboardController::class, 'setujui'])->name('verifikasi.setujui');
    Route::post('/verifikasi/{member}/tolak', [AdminDashboardController::class, 'tolak'])->name('verifikasi.tolak');
    Route::get('/data-anggota', [AdminDashboardController::class, 'dataAnggota'])->name('data-anggota');
    Route::get('/data-anggota/{member}', [AdminDashboardController::class, 'showDataAnggota'])->name('data-anggota.show');
    Route::post('/data-anggota/{member}', [AdminDashboardController::class, 'updateDataAnggota'])->name('data-anggota.update');
    Route::delete('/data-anggota/{member}', [AdminDashboardController::class, 'destroyDataAnggota'])->name('data-anggota.destroy');
    Route::get('/laporan', [AdminDashboardController::class, 'laporan'])->name('laporan');
    Route::get('/laporan', [AdminDashboardController::class, 'laporan'])->name('laporan');
    Route::get('/laporan/excel', [AdminDashboardController::class, 'exportExcel'])->name('laporan.excel');
    Route::get('/laporan/pdf', [AdminDashboardController::class, 'exportPdf'])->name('laporan.pdf');
});

// Member routes - only for calon_member role
Route::middleware(['auth', 'verified', 'calon.member'])->group(function () {
    Route::get('/member', function () {
        return view('member.dashboard');
    })->name('member.dashboard');
    
    Route::get('/member/form', [\App\Http\Controllers\MemberController::class, 'create'])->name('form');
    
    Route::post('/member/form', [\App\Http\Controllers\MemberController::class, 'store'])->name('store');
    
    Route::get('/member/success', [\App\Http\Controllers\MemberController::class, 'success'])->name('success');
    
    Route::get('/member/pdf/{id}', [\App\Http\Controllers\MemberController::class, 'pdf'])->name('pdf');
    
    Route::get('/member/status', [\App\Http\Controllers\MemberController::class, 'status'])->name('status');
    
    Route::get('/member/profile', [\App\Http\Controllers\MemberController::class, 'profile'])->name('profile');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
