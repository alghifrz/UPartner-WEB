<?php

use App\Models\Footer;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dosen\Auth\PasswordController;
use App\Http\Controllers\Dosen\ProfileController;
use App\Http\Controllers\Dosen\Auth\RegisteredUserController;
use App\Http\Controllers\Dosen\Auth\AuthenticatedSessionController;

Route::middleware('guest:dosen')->prefix('dosen')->name('dosen.')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    
});

Route::middleware('auth:dosen')->prefix('dosen')->name('dosen.')->group(function () {
    Route::get('/dashboard', function () {
        $footer = Footer::getData();
        return view('dosen.dashboard', compact('footer'));
    })->middleware(['verified'])->name('dashboard');
    Route::get('/proyek', function () {
        $footer = Footer::getData();
        return view('dosen.proyek', compact('footer'));
    })->middleware(['verified'])->name('proyek');
    Route::get('/buatproyek', function () {
        $footer = Footer::getData();
        return view('dosen.buatproyek', compact('footer'));
    })->middleware(['verified'])->name('buatproyek');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/editprofile', [ProfileController::class, 'editprofile'])->name('profile.editprofile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
