<?php

use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\EquipmentController;
use App\Http\Controllers\Admin\MediaLibraryController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\RiksaUjiCategoryController;
use App\Http\Controllers\Admin\RiksaUjiTypeController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
| Protected by 'web', 'auth' and 'admin' middleware. The 'admin' middleware
| is registered in bootstrap/app.php. Individual route groups carry the
| relevant Spatie permission checks.
*/

$panelRoutes = function (): void {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Profile (all admin roles)
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');

    // Settings
    Route::get('settings', [SettingController::class, 'index'])->middleware('permission:settings.view')->name('settings.index');
    Route::patch('settings', [SettingController::class, 'update'])->middleware('permission:settings.edit')->name('settings.update');

    // Activity Logs
    Route::get('activity-logs', [ActivityLogController::class, 'index'])->middleware('permission:activity_logs.view')->name('activity-logs.index');
    Route::get('activity-logs/{activityLog}', [ActivityLogController::class, 'show'])->middleware('permission:activity_logs.view')->name('activity-logs.show');

    // Contacts (public form inbox)
    Route::get('contacts', [ContactController::class, 'index'])->middleware('permission:contacts.view')->name('contacts.index');
    Route::get('contacts/{contact}', [ContactController::class, 'show'])->middleware('permission:contacts.view')->name('contacts.show');
    Route::patch('contacts/{contact}/status', [ContactController::class, 'markStatus'])->middleware('permission:contacts.manage')->name('contacts.status');
    Route::delete('contacts/{contact}', [ContactController::class, 'destroy'])->middleware('permission:contacts.manage')->name('contacts.destroy');

    // Users (Super Admin)
    Route::get('users', [UserController::class, 'index'])->middleware('permission:users.view')->name('users.index');
    Route::get('users/create', [UserController::class, 'create'])->middleware('permission:users.create')->name('users.create');
    Route::post('users', [UserController::class, 'store'])->middleware('permission:users.create')->name('users.store');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->middleware('permission:users.edit')->name('users.edit');
    Route::put('users/{user}', [UserController::class, 'update'])->middleware('permission:users.edit')->name('users.update');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->middleware('permission:users.delete')->name('users.destroy');

    // Media (upload & delete only — no standalone library page)
    Route::post('media', [MediaLibraryController::class, 'store'])->middleware('permission:media.upload')->name('media.store');
    Route::delete('media/{media}', [MediaLibraryController::class, 'destroy'])->middleware('permission:media.delete')->name('media.destroy');

    // Articles
    Route::get('articles', [ArticleController::class, 'index'])->middleware('permission:articles.view')->name('articles.index');
    Route::get('articles/create', [ArticleController::class, 'create'])->middleware('permission:articles.create')->name('articles.create');
    Route::post('articles', [ArticleController::class, 'store'])->middleware('permission:articles.create')->name('articles.store');
    Route::get('articles/{article}/edit', [ArticleController::class, 'edit'])->middleware('permission:articles.edit')->name('articles.edit');
    Route::put('articles/{article}', [ArticleController::class, 'update'])->middleware('permission:articles.edit')->name('articles.update');
    Route::delete('articles/{article}', [ArticleController::class, 'destroy'])->middleware('permission:articles.delete')->name('articles.destroy');
    Route::post('articles/{article}/publish', [ArticleController::class, 'publish'])->middleware('permission:articles.publish')->name('articles.publish');
    Route::post('articles/{article}/archive', [ArticleController::class, 'archive'])->middleware('permission:articles.archive')->name('articles.archive');
    Route::post('articles/{article}/restore', [ArticleController::class, 'restore'])->name('articles.restore');
    Route::post('articles/upload-image', [ArticleController::class, 'uploadImage'])->middleware('permission:articles.edit')->name('articles.upload-image');
    Route::post('articles/upload-thumbnail', [ArticleController::class, 'uploadThumbnail'])->middleware('permission:articles.edit')->name('articles.upload-thumbnail');

    // Services
    Route::get('services', [ServiceController::class, 'index'])->middleware('permission:services.view')->name('services.index');
    Route::get('services/create', [ServiceController::class, 'create'])->middleware('permission:services.create')->name('services.create');
    Route::post('services', [ServiceController::class, 'store'])->middleware('permission:services.create')->name('services.store');
    Route::get('services/{service}/edit', [ServiceController::class, 'edit'])->middleware('permission:services.edit')->name('services.edit');
    Route::put('services/{service}', [ServiceController::class, 'update'])->middleware('permission:services.edit')->name('services.update');
    Route::delete('services/{service}', [ServiceController::class, 'destroy'])->middleware('permission:services.delete')->name('services.destroy');

    // Riksa Uji Categories
    Route::get('riksa-uji-categories', [RiksaUjiCategoryController::class, 'index'])->middleware('permission:riksa_uji.view')->name('riksa-uji-categories.index');
    Route::get('riksa-uji-categories/create', [RiksaUjiCategoryController::class, 'create'])->middleware('permission:riksa_uji.create')->name('riksa-uji-categories.create');
    Route::post('riksa-uji-categories', [RiksaUjiCategoryController::class, 'store'])->middleware('permission:riksa_uji.create')->name('riksa-uji-categories.store');
    Route::get('riksa-uji-categories/{riksaUjiCategory}/edit', [RiksaUjiCategoryController::class, 'edit'])->middleware('permission:riksa_uji.edit')->name('riksa-uji-categories.edit');
    Route::put('riksa-uji-categories/{riksaUjiCategory}', [RiksaUjiCategoryController::class, 'update'])->middleware('permission:riksa_uji.edit')->name('riksa-uji-categories.update');
    Route::delete('riksa-uji-categories/{riksaUjiCategory}', [RiksaUjiCategoryController::class, 'destroy'])->middleware('permission:riksa_uji.delete')->name('riksa-uji-categories.destroy');

    // Riksa Uji Types
    Route::get('riksa-uji-types', [RiksaUjiTypeController::class, 'index'])->middleware('permission:riksa_uji.view')->name('riksa-uji-types.index');
    Route::get('riksa-uji-types/create', [RiksaUjiTypeController::class, 'create'])->middleware('permission:riksa_uji.create')->name('riksa-uji-types.create');
    Route::post('riksa-uji-types', [RiksaUjiTypeController::class, 'store'])->middleware('permission:riksa_uji.create')->name('riksa-uji-types.store');
    Route::get('riksa-uji-types/{riksaUjiType}/edit', [RiksaUjiTypeController::class, 'edit'])->middleware('permission:riksa_uji.edit')->name('riksa-uji-types.edit');
    Route::put('riksa-uji-types/{riksaUjiType}', [RiksaUjiTypeController::class, 'update'])->middleware('permission:riksa_uji.edit')->name('riksa-uji-types.update');
    Route::delete('riksa-uji-types/{riksaUjiType}', [RiksaUjiTypeController::class, 'destroy'])->middleware('permission:riksa_uji.delete')->name('riksa-uji-types.destroy');

    // Equipment
    Route::get('equipment', [EquipmentController::class, 'index'])->middleware('permission:equipment.view')->name('equipment.index');
    Route::get('equipment/create', [EquipmentController::class, 'create'])->middleware('permission:equipment.create')->name('equipment.create');
    Route::post('equipment', [EquipmentController::class, 'store'])->middleware('permission:equipment.create')->name('equipment.store');
    Route::get('equipment/{equipment}/edit', [EquipmentController::class, 'edit'])->middleware('permission:equipment.edit')->name('equipment.edit');
    Route::put('equipment/{equipment}', [EquipmentController::class, 'update'])->middleware('permission:equipment.edit')->name('equipment.update');
    Route::delete('equipment/{equipment}', [EquipmentController::class, 'destroy'])->middleware('permission:equipment.delete')->name('equipment.destroy');
    Route::post('equipment/upload-image', [EquipmentController::class, 'uploadImage'])->middleware('permission:equipment.edit')->name('equipment.upload-image');

    // Projects
    Route::get('projects', [ProjectController::class, 'index'])->middleware('permission:projects.view')->name('projects.index');
    Route::get('projects/create', [ProjectController::class, 'create'])->middleware('permission:projects.create')->name('projects.create');
    Route::post('projects', [ProjectController::class, 'store'])->middleware('permission:projects.create')->name('projects.store');
    Route::get('projects/{project}/edit', [ProjectController::class, 'edit'])->middleware('permission:projects.edit')->name('projects.edit');
    Route::put('projects/{project}', [ProjectController::class, 'update'])->middleware('permission:projects.edit')->name('projects.update');
    Route::delete('projects/{project}', [ProjectController::class, 'destroy'])->middleware('permission:projects.delete')->name('projects.destroy');
    Route::post('projects/upload-image', [ProjectController::class, 'uploadImage'])->middleware('permission:projects.edit')->name('projects.upload-image');

    // Team Members
    Route::get('team', [TeamMemberController::class, 'index'])->middleware('permission:team.view')->name('team.index');
    Route::get('team/create', [TeamMemberController::class, 'create'])->middleware('permission:team.create')->name('team.create');
    Route::post('team', [TeamMemberController::class, 'store'])->middleware('permission:team.create')->name('team.store');
    Route::get('team/{teamMember}/edit', [TeamMemberController::class, 'edit'])->middleware('permission:team.edit')->name('team.edit');
    Route::put('team/{teamMember}', [TeamMemberController::class, 'update'])->middleware('permission:team.edit')->name('team.update');
    Route::delete('team/{teamMember}', [TeamMemberController::class, 'destroy'])->middleware('permission:team.delete')->name('team.destroy');
    Route::post('team/upload-photo', [TeamMemberController::class, 'uploadPhoto'])->middleware('permission:team.edit')->name('team.upload-photo');

    // Categories
    Route::get('categories', [CategoryController::class, 'index'])->middleware('permission:categories.view')->name('categories.index');
    Route::post('categories', [CategoryController::class, 'store'])->middleware('permission:categories.create')->name('categories.store');
    Route::put('categories/{category}', [CategoryController::class, 'update'])->middleware('permission:categories.edit')->name('categories.update');
    Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->middleware('permission:categories.delete')->name('categories.destroy');

    // Tags
    Route::get('tags', [TagController::class, 'index'])->middleware('permission:tags.view')->name('tags.index');
    Route::post('tags', [TagController::class, 'store'])->middleware('permission:tags.create')->name('tags.store');
    Route::delete('tags/{tag}', [TagController::class, 'destroy'])->middleware('permission:tags.delete')->name('tags.destroy');
};

Route::middleware(['auth', 'admin', 'panel.redirect'])->prefix('admin')->name('admin.')->group($panelRoutes);
Route::middleware(['auth', 'admin', 'panel.redirect'])->prefix('editor')->name('editor.')->group($panelRoutes);
