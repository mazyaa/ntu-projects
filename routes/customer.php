<?php

use App\Http\Controllers\Customer\CompanyController;
use App\Http\Controllers\Customer\ProfileController;
use App\Http\Controllers\Customer\RiksaUjiRequestController;
use App\Models\InspectionRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware(['locale', 'auth', 'customer.auth'])->prefix('dashboard')->name('customer.')->group(function () {

    // Dashboard
    Route::get('/', function () {
        $user = Auth::user();
        $userId = $user->id;

        $stats = [
            'total' => InspectionRequest::forUser($userId)->count(),
            'pending' => InspectionRequest::forUser($userId)->status('new')->count()
                + InspectionRequest::forUser($userId)->status('reviewing')->count(),
            'processing' => InspectionRequest::forUser($userId)->status('contacted')->count()
                + InspectionRequest::forUser($userId)->status('quotation_sent')->count()
                + InspectionRequest::forUser($userId)->status('approved')->count()
                + InspectionRequest::forUser($userId)->status('scheduled')->count(),
            'completed' => InspectionRequest::forUser($userId)->status('completed')->count(),
        ];

        $recentRequests = InspectionRequest::forUser($userId)
            ->with('objects')
            ->orderByDesc('submitted_at')
            ->limit(3)
            ->get();

        return view('customer.dashboard', compact('stats', 'recentRequests'));
    })->name('dashboard');

    // Profile
    Route::get('/profil', [ProfileController::class, 'edit'])->name('profile');
    Route::put('/profil', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profil/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    // Company
    Route::get('/perusahaan', [CompanyController::class, 'edit'])->name('company');
    Route::put('/perusahaan', [CompanyController::class, 'update'])->name('company.update');

    // Riksa Uji Requests
    Route::get('/permohonan', [RiksaUjiRequestController::class, 'index'])->name('requests');
    Route::get('/permohonan/{request}', [RiksaUjiRequestController::class, 'show'])->name('requests.show');

});

// Multi-step form (outside dashboard prefix for cleaner URLs)
Route::middleware(['locale', 'auth', 'customer.auth'])->prefix('riksa-uji/permohonan')->name('customer.')->group(function () {
    Route::get('/', [RiksaUjiRequestController::class, 'create'])->name('requests.create');
    Route::post('/step/{step}', [RiksaUjiRequestController::class, 'storeStep'])->name('requests.storeStep');
    Route::post('/previous/{step}', [RiksaUjiRequestController::class, 'previousStep'])->name('requests.previous');
    Route::get('/types', [RiksaUjiRequestController::class, 'getTypes'])->name('requests.types');
    Route::get('/companies', [RiksaUjiRequestController::class, 'getCustomerCompanies'])->name('requests.companies');
    Route::post('/add-object', [RiksaUjiRequestController::class, 'addObject'])->name('requests.addObject');
    Route::post('/remove-object/{index}', [RiksaUjiRequestController::class, 'removeObject'])->name('requests.removeObject');
    Route::get('/go-to-step/{step}', [RiksaUjiRequestController::class, 'goToStep'])->name('requests.goToStep');
});
