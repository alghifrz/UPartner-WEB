<?php

use App\Models\Footer;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\Dosen\Proyek\ProjectController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LandingPageController::class, 'index']);
Route::get('/tentang', [LandingPageController::class, 'about']);
Route::get('/kontak', [LandingPageController::class, 'contact']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/proyek', function () {
    $footer = Footer::getData();
    return view('proyek.proyek', compact('footer'));
})->middleware(['auth', 'verified'])->name('proyek');
Route::get('/detailproyek/{proyek}', [ProjectController::class, 'detail'])->name('detailproyek');


Route::get('/contact', function () {
    return view('contact');
});

Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/editprofile', [ProfileController::class, 'editprofile'])->name('profile.editprofile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/dosen-auth.php';
