<?php

use App\Models\Iklan;
use App\Models\Footer;
use App\Models\Katalog;
use App\Models\Dashboard;
use App\Models\FooterDosen;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LinkFooterController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\Dosen\ProfileController;
use App\Http\Controllers\Dosen\Proyek\IklanController;
use App\Http\Controllers\Dosen\Auth\PasswordController;
use App\Http\Controllers\Dosen\Proyek\ProjectController;
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
    Route::get('/dashboard', [DashboardController::class, 'indexDosen'])->middleware(['verified'])->name('dashboard');
    Route::prefix('katalog')->group(function () {
        Route::get('/search', [ProjectController::class, 'searchDosen'])->name('search');
    });
    Route::get('/katalog', [KatalogController::class, 'indexDosen'])->middleware(['verified'])->name('katalog');
    Route::get('/buatproyek', [ProjectController::class, 'create'])->middleware(['verified'])->name('buatproyek');
    Route::get('/proyek', function () {
        $footer = FooterDosen::getData();
        return view('dosen.proyek.proyek', compact('footer'));
    })->middleware(['verified'])->name('proyek');
    // Route::get('/buatproyek', function () {
    //     return view('dosen.proyek.buatproyek');
    // })->middleware(['verified'])->name('buatproyek');
    
    
    Route::get('/iklan', function () {
        $footer = FooterDosen::getData();
        return view('dosen.proyek.iklan', compact('footer'));
    })->middleware(['verified'])->name('iklan');
    Route::get('/detailproyek/{proyek}', [ProjectController::class, 'detailDosen'])->name('detailproyek');


    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/editprofile', [ProfileController::class, 'editprofile'])->name('profile.editprofile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::post('/buatproyek', [ProjectController::class, 'store'])->name('proyek.store');
    Route::post('/iklan', [IklanController::class, 'store'])->name('iklan.store');



    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');


    Route::get('/tentang', [LinkFooterController::class, 'aboutDosen'])->name('tentang');
    Route::get('/kontak', [LinkFooterController::class, 'contactDosen'])->name('kontak');
    Route::get('/kebijakan-privasi', [LinkFooterController::class, 'privacyDosen'])->name('privasi');

    Route::post('/detailproyek/{proyek}/pendaftaran', [PendaftaranController::class, 'daftar'])->name('pendaftaran');


});
