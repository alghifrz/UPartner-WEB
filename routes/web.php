<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LandingPageController;
use App\Models\Footer;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LandingPageController::class, 'index']);
Route::get('/tentang', [LandingPageController::class, 'about']);


Route::get('/dashboard', function () {
    $footer = Footer::getData();
    return view('dashboard', compact('footer'));
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/proyek', function () {
    $footer = Footer::getData();
    return view('proyek.proyek', compact('footer'));
})->middleware(['auth', 'verified'])->name('proyek');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/editprofile', [ProfileController::class, 'editprofile'])->name('profile.editprofile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/dosen-auth.php';
