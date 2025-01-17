<?php

use App\Models\Footer;
use App\Models\Katalog;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Dosen\Proyek\ProjectController;
use App\Http\Controllers\LinkFooterController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LandingPageController::class, 'index']);
Route::get('/tentang', [LandingPageController::class, 'about']);
Route::get('/kontak', [LandingPageController::class, 'contact']);
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
Route::get('/contact', function () {
    return view('contact');
});
Route::get('kebijakan-privasi', [LandingPageController::class, 'privacy']);






Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
    Route::get('/katalog', [KatalogController::class, 'index'])->middleware(['auth', 'verified'])->name('katalog');
    Route::middleware('auth')->prefix('katalog')->group(function () {
        Route::get('/search', [ProjectController::class, 'search'])->name('search');
    });
    Route::get('/proyek', function () {
        $footer = Footer::getData();
        return view('proyek.proyek', compact('footer'));
    })->middleware(['auth', 'verified'])->name('proyek');

    Route::get('/detailproyek/{proyek}', [ProjectController::class, 'detail'])->name('detailproyek');
    
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
