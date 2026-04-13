<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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
