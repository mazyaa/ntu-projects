<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/tentang-kami', [SiteController::class, 'about'])->name('about');
Route::get('/kepemimpinan', [SiteController::class, 'leadership'])->name('leadership');
Route::get('/kepemimpinan/{slug}', [SiteController::class, 'leadershipShow'])->name('leadership.show');
Route::get('/layanan', [SiteController::class, 'services'])->name('services.index');
Route::get('/layanan/{slug}', [SiteController::class, 'serviceShow'])->name('services.show');
Route::get('/riset', [SiteController::class, 'research'])->name('research');
Route::get('/artikel', [SiteController::class, 'articles'])->name('articles');
Route::get('/artikel/{slug}', [SiteController::class, 'articleShow'])->name('articles.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
