<?php

use App\Models\Footer;
use App\Models\Proyek;
use App\Models\Katalog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LinkFooterController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\Dosen\Proyek\ProjectController;
use App\Http\Controllers\PenggunaController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LandingPageController::class, 'index']);
Route::get('/tentang', [LandingPageController::class, 'about']);
Route::get('/kontak', [LandingPageController::class, 'contact']);
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
Route::get('/guest/dashboard', [DashboardController::class, 'indexguest'])->name('dashboardguest');
Route::get('/guest/dashboard/katalog', [KatalogController::class, 'indexGuest'])->name('katalogguest');
Route::get('/guest/search', [ProjectController::class, 'searchGuest'])->name('searchguest');
Route::get('/guest/dashboard/users', [PenggunaController::class, 'indexGuest'])->name('penggunaguest');
Route::get('/guest/dashboard/detailproyek/{proyek}', [ProjectController::class, 'detailGuest'])->name('detailproyekguest');
Route::get('/guest/dashboard/lihatprofilmahasiswa/{mahasiswa}', [DashboardController::class, 'lihatProfilGuest'])->name('lihatprofilguest');
Route::get('/guest/dashboard/lihatprofildosen/{dosen}', [DashboardController::class, 'lihatProfilDosenGuest'])->name('lihatprofildosenguest');
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/kebijakan-privasi', [LandingPageController::class, 'privacy']);






Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['verified'])->name('dashboard');
    Route::get('/dashboard/katalog', [KatalogController::class, 'index'])->middleware(['verified'])->name('katalog');
    Route::get('/dashboard/lihatprofilmahasiswa/{mahasiswa}', [DashboardController::class, 'lihatProfil'])->middleware(['verified'])->name('lihatprofil');
    Route::get('/dashboard/lihatprofildosen/{dosen}', [DashboardController::class, 'lihatProfilDosen'])->middleware(['verified'])->name('lihatprofildosen');
    Route::middleware('auth')->prefix('dashboard/katalog')->group(function () {
        Route::get('/search', [ProjectController::class, 'search'])->name('search');
    });

    Route::get('/dashboard/users', [PenggunaController::class, 'index'])->name('pengguna');
    Route::get('/dashboard/detailproyek/{proyek}', [ProjectController::class, 'detail'])->name('detailproyek');
    Route::post('/dashboard/detailproyek/{proyek}/pendaftaran', [PendaftaranController::class, 'daftar'])->name('pendaftaran');
    
    Route::get('/proyek', function () {
        $user = Auth::user();
        $proyek = $user->pendaftaran;
        $footer = Footer::getData();
        return view('proyek.proyek', compact('user', 'proyek', 'footer'));
    })->middleware(['auth', 'verified'])->name('proyek');
    Route::get('/proyek/proyek-saya', function () {
        $user = Auth::user();
        $proyek = $user->pendaftaran;
        $footer = Footer::getData();
        return view('proyek.proyeksaya', compact('user', 'proyek', 'footer'));
    })->middleware(['auth', 'verified'])->name('proyeksaya');
    Route::get('/proyek/proyek-saya/{proyek}', function (Proyek $proyek) {
        $user = Auth::user();
        $pendaftaran = $user->pendaftaran;
        $footer = Footer::getData();
        return view('proyek.proyekdetail', compact('user', 'pendaftaran', 'proyek', 'footer'));
    })->middleware(['auth', 'verified'])->name('proyekdetail');
    Route::get('/proyek/pendaftaran-proyek', function () {
        $user = Auth::user();
        $proyek = $user->pendaftaran;
        $footer = Footer::getData();
        return view('proyek.pendaftaranproyek', compact('user', 'proyek', 'footer'));
    })->middleware(['auth', 'verified'])->name('pendaftaranproyek');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/editprofile', [ProfileController::class, 'editprofile'])->name('profile.editprofile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
    Route::prefix('mahasiswa')->group(function () {
        Route::get('/tentang', [LinkFooterController::class, 'about'])->middleware(['auth', 'verified'])->name('tentang');
        Route::get('/kontak', [LinkFooterController::class, 'contact'])->middleware(['auth', 'verified'])->name('kontak');
        Route::get('/kebijakan-privasi', [LinkFooterController::class, 'privacy'])->middleware(['auth', 'verified'])->name('privasi');
    });

});

require __DIR__.'/auth.php';
require __DIR__.'/dosen-auth.php';
