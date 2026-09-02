<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

// Public site — Indonesian (canonical, unprefixed URLs).
Route::middleware('locale')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    Route::get('/tentang-kami', [SiteController::class, 'about'])->name('about');
    Route::get('/kepemimpinan', [SiteController::class, 'leadership'])->name('leadership');
    Route::get('/kepemimpinan/{slug}', [SiteController::class, 'leadershipShow'])->name('leadership.show');
    Route::get('/layanan', [SiteController::class, 'services'])->name('services.index');
    Route::get('/layanan/{slug}', [SiteController::class, 'serviceShow'])->name('services.show');
    Route::get('/riksa-uji', [SiteController::class, 'riksaUji'])->name('riksa_uji');
    Route::get('/artikel', [SiteController::class, 'articles'])->name('articles');
    Route::get('/artikel/{slug}', [SiteController::class, 'articleShow'])->name('articles.show');

    Route::get('/kontak', [ContactController::class, 'index'])->name('contact');
    Route::post('/kontak', [ContactController::class, 'store'])->name('contact.store');
});

// Public site — English (en.* route names, /en prefix).
Route::prefix('en')->name('en.')->middleware('locale')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    Route::get('/tentang-kami', [SiteController::class, 'about'])->name('about');
    Route::get('/kepemimpinan', [SiteController::class, 'leadership'])->name('leadership');
    Route::get('/kepemimpinan/{slug}', [SiteController::class, 'leadershipShow'])->name('leadership.show');
    Route::get('/layanan', [SiteController::class, 'services'])->name('services.index');
    Route::get('/layanan/{slug}', [SiteController::class, 'serviceShow'])->name('services.show');
    Route::get('/riksa-uji', [SiteController::class, 'riksaUji'])->name('riksa_uji');
    Route::get('/artikel', [SiteController::class, 'articles'])->name('articles');
    Route::get('/artikel/{slug}', [SiteController::class, 'articleShow'])->name('articles.show');

    Route::get('/kontak', [ContactController::class, 'index'])->name('contact');
    Route::post('/kontak', [ContactController::class, 'store'])->name('contact.store');
});

// 301 Redirect: old research routes → about page (SEO preservation)
Route::get('/riset', fn () => redirect()->route('about', [], 301));
Route::get('/en/research', fn () => redirect()->route('en.about', [], 301));
Route::get('/equipment', fn () => redirect()->route('riksa_uji', [], 301));
Route::get('/en/equipment', fn () => redirect()->route('en.riksa_uji', [], 301));

Route::get('/dashboard', function () {
    return redirect(panel_route('dashboard'));
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
