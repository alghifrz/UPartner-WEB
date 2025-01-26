<?php

use App\Models\Iklan;
use App\Models\Proyek;
use App\Models\Katalog;
use App\Models\Dashboard;
use App\Models\FooterDosen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LinkFooterController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\Dosen\ProfileController;
use App\Http\Controllers\Dosen\Proyek\IklanController;
use App\Http\Controllers\Dosen\Auth\PasswordController;
use App\Http\Controllers\Dosen\Proyek\ProjectController;
use App\Http\Controllers\Dosen\Proyek\KegiatanController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
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
    Route::prefix('dashboard/katalog')->group(function () {
        Route::get('/search', [ProjectController::class, 'searchDosen'])->name('search');
    });
    Route::get('/dashboard/users', [PenggunaController::class, 'indexDosen'])->name('pengguna');
    Route::get('/dashboard/katalog', [KatalogController::class, 'indexDosen'])->middleware(['verified'])->name('katalog');
    Route::get('/dashboard/lihatprofilmahasiswa/{mahasiswa}', [DashboardController::class, 'dosenlihatProfil'])->middleware(['verified'])->name('lihatprofil');
    Route::get('/dashboard/lihatprofildosen/{dosen}', [DashboardController::class, 'dosenlihatProfilDosen'])->middleware(['verified'])->name('lihatprofildosen');
    Route::get('/dashboard/detailproyek/{proyek}', [ProjectController::class, 'detailDosen'])->name('detailproyek');
    Route::post('/dashboard/detailproyek/{proyek}/pendaftaran', [PendaftaranController::class, 'daftar'])->name('pendaftaran');
    
    Route::get('/buatproyek', [ProjectController::class, 'create'])->middleware(['verified'])->name('buatproyek');
    Route::get('/buatproyek/iklan', function () {
        $footer = FooterDosen::getData();
        return view('dosen.proyek.iklan', compact('footer'));
    })->middleware(['verified'])->name('iklan');

    Route::get('/proyek', function () {
        $user = Auth::user();
        $proyek = $user->pendaftaran;
        $footer = FooterDosen::getData();
        return view('dosen.proyek.proyek', compact('user', 'proyek', 'footer'));
    })->middleware(['auth', 'verified'])->name('proyek');
    Route::get('/proyek/proyek-saya', function () {
        $user = Auth::user();
        $proyek = $user->pendaftaran;
        $footer = FooterDosen::getData();
        return view('dosen.proyek.proyeksaya', compact('user', 'proyek', 'footer'));
    })->middleware(['auth', 'verified'])->name('proyeksaya');
    Route::get('/proyek/proyek-saya/{proyek}', function (Proyek $proyek) {
        $user = Auth::user();
        $pendaftaran = $user->pendaftaran;
        $footer = FooterDosen::getData();
        return view('dosen.proyek.proyekdetail', compact('user', 'pendaftaran', 'proyek', 'footer'));
    })->middleware(['auth', 'verified'])->name('proyekdetail');
    Route::patch('/proyek/proyek-saya/{proyek}/kegiatan/{id}', [KegiatanController::class, 'updateprogres'])->name('kegiatan.updateprogres');
    Route::patch('/proyek/proyek-saya/{proyek}/pendaftar/{pendaftar}/terima', [PendaftaranController::class, 'terimaPendaftar'])->name('pendaftar.terima');
    Route::patch('/proyek/proyek-saya/{proyek}/pendaftar/{pendaftar}/tolak', [PendaftaranController::class, 'tolakPendaftar'])->name('pendaftar.tolak');
    Route::patch('/proyek/proyek-saya/{proyek}/pendaftar/{pendaftar}/keluarkan', [PendaftaranController::class, 'keluarkanAnggota'])->name('pendaftar.keluarkan');
    Route::get('/proyek/pendaftaran-proyek', function () {
        $user = Auth::user();
        $proyek = $user->pendaftaran;
        $footer = FooterDosen::getData();
        return view('dosen.proyek.pendaftaranproyek', compact('user', 'proyek', 'footer'));
    })->middleware(['auth', 'verified'])->name('pendaftaranproyek');
    Route::get('/proyek/kelola-proyek', function () {
        $user = Auth::user();
        $proyek = $user->pendaftaran;
        $footer = FooterDosen::getData();
        return view('dosen.proyek.kelolaproyek', compact('user', 'proyek', 'footer'));
    })->middleware(['auth', 'verified'])->name('kelolaproyek');
    Route::get('/proyek/kelola-proyek/editproyek/{proyek}', [ProjectController::class, 'edit'])->middleware(['auth', 'verified'])->name('editproyek');
    Route::put('/proyek/kelola-proyek/updateproyek/{proyek}', [ProjectController::class, 'update'])->middleware(['auth', 'verified'])->name('updateproyek');




    Route::delete('/proyek/kelola-proyek/hapusproyek/{proyek}', [ProjectController::class, 'destroy'])->name('hapusproyek');
    // Route::get('/proyek/kelola-proyek/editproyek/{proyek}', [ProjectController::class, 'edit'])->name('editproyek');

    Route::get('/proyek/kelola-iklan', function () {
        $user = Auth::user();
        $proyek = $user->pendaftaran;
        $footer = FooterDosen::getData();
        return view('dosen.proyek.kelolaiklan', compact('user', 'proyek', 'footer'));
    })->middleware(['auth', 'verified'])->name('kelolaiklan');

    
        
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/editprofile', [ProfileController::class, 'editprofile'])->name('profile.editprofile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::post('/buatproyek', [ProjectController::class, 'store'])->name('proyek.store');

    Route::post('/iklan', [IklanController::class, 'store'])->name('iklan.store');
    Route::put('/iklan/update', [IklanController::class, 'update'])->name('iklan.update');
    Route::delete('/iklan/{id}', [IklanController::class, 'delete'])->name('iklan.delete');



    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');


    Route::get('/tentang', [LinkFooterController::class, 'aboutDosen'])->middleware(['auth:dosen', 'verified'])->name('tentang');
    Route::get('/kontak', [LinkFooterController::class, 'contactDosen'])->middleware(['auth:dosen', 'verified'])->name('kontak');
    Route::get('/kebijakan-privasi', [LinkFooterController::class, 'privacyDosen'])->middleware(['auth:dosen', 'verified'])->name('privasi');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
    ->name('password.email');
    Route::get('forgot-password', [PasswordResetLinkController::class, 'createDosen'])
    ->name('password.request');

});
