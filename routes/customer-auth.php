<?php

use App\Http\Controllers\Customer\EmailVerificationController;
use App\Http\Controllers\Customer\ForgotPasswordController;
use App\Http\Controllers\Customer\OAuthController;
use App\Http\Controllers\Customer\ResetPasswordController;
use App\Http\Controllers\Customer\SignInController;
use App\Http\Controllers\Customer\SignUpController;
use Illuminate\Support\Facades\Route;

Route::middleware('locale')->group(function () {

    // Registration
    Route::get('/sign-up', [SignUpController::class, 'create'])
        ->name('customer.register');
    Route::post('/sign-up', [SignUpController::class, 'store']);

    // Login
    Route::get('/sign-in', [SignInController::class, 'create'])
        ->name('customer.login');
    Route::post('/sign-in', [SignInController::class, 'store']);

    // Logout
    Route::post('/sign-out', [SignInController::class, 'destroy'])
        ->name('customer.logout')
        ->middleware('auth');

    // Google OAuth
    Route::get('/auth/google/redirect', [OAuthController::class, 'redirect'])
        ->name('customer.google.redirect');
    Route::get('/auth/google/callback', [OAuthController::class, 'callback'])
        ->name('customer.google.callback');

    // Email Verification
    Route::middleware(['auth', 'customer.verified'])->prefix('email')->name('customer.verification.')->group(function () {
        Route::get('/verify', [EmailVerificationController::class, 'show'])
            ->name('notice');
        Route::get('/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
            ->name('verify')
            ->middleware('signed');
        Route::post('/verify/resend', [EmailVerificationController::class, 'resend'])
            ->name('resend');
    });

    // Alias route for Laravel's built-in sendEmailVerificationNotification()
    Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
        ->middleware(['signed', 'auth', 'customer.verified'])
        ->name('verification.verify');

    // Password Reset (guest)
    Route::middleware('guest')->prefix('customer')->name('customer.')->group(function () {
        Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])
            ->name('password.request');
        Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])
            ->name('password.email');
        Route::get('/reset-password/{token}', [ResetPasswordController::class, 'create'])
            ->name('password.reset');
        Route::post('/reset-password', [ResetPasswordController::class, 'store'])
            ->name('password.store');
    });

});
