<?php

use App\Http\Controllers\TenantAuth\TenantAuthenticatedSessionController;
use App\Http\Controllers\TenantAuth\TenantConfirmablePasswordController;
use App\Http\Controllers\TenantAuth\TenantEmailVerificationNotificationController;
use App\Http\Controllers\TenantAuth\TenantEmailVerificationPromptController;
use App\Http\Controllers\TenantAuth\TenantNewPasswordController;
use App\Http\Controllers\TenantAuth\TenantPasswordController;
use App\Http\Controllers\TenantAuth\TenantPasswordResetLinkController;
use App\Http\Controllers\TenantAuth\TenantRegisteredUserController;
use App\Http\Controllers\TenantAuth\TenantVerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [TenantRegisteredUserController::class, 'create'])
                ->name('tenant.register');

    Route::post('register', [TenantRegisteredUserController::class, 'store']);

    Route::get('login', [TenantAuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [TenantAuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [TenantPasswordResetLinkController::class, 'create'])
                ->name('tenant.password.request');

    Route::post('forgot-password', [TenantPasswordResetLinkController::class, 'store'])
                ->name('tenant.password.email');

    Route::get('reset-password/{token}', [TenantNewPasswordController::class, 'create'])
                ->name('tenant.password.reset');

    Route::post('reset-password', [TenantNewPasswordController::class, 'store'])
                ->name('tenant.password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [TenantEmailVerificationPromptController::class, '__invoke'])
                ->name('tenant.verification.notice');

    Route::get('verify-email/{id}/{hash}', [TenantVerifyEmailController::class, '__invoke'])
                ->middleware(['signed', 'throttle:6,1'])
                ->name('tenant.verification.verify');

    Route::post('email/verification-notification', [TenantEmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('tenant.verification.send');

    Route::get('confirm-password', [TenantConfirmablePasswordController::class, 'show'])
                ->name('tenant.password.confirm');

    Route::post('confirm-password', [TenantConfirmablePasswordController::class, 'store']);

    Route::put('password', [TenantPasswordController::class, 'update'])->name('tenant.password.update');

    Route::post('logout', [TenantAuthenticatedSessionController::class, 'destroy'])
                ->name('tenant.logout');
});
