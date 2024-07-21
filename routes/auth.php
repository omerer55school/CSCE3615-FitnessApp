<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

// Routes accessible to guests (non-logged in users)
Route::middleware('guest')->group(function () {
    // Route to display the registration form
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    // Route to handle the registration form submission
    Route::post('register', [RegisteredUserController::class, 'store']);

    // Route to display the login form
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    // Route to handle the login form submission
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    // Route to display the form for a password reset link
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    // Route to handle the request for a password reset link
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    // Route to display the form for password reset
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    // Route to handle password reset form submission
    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

// Routes accessible to authenticated users
Route::middleware('auth')->group(function () {
    // Route to display the prompt for email verification
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    // Route to handle the verification of user's email through ID and hash
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    // Route to send an email verification notification
    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    // Route to display confirm password form
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    // Route to handle confirm password form submission
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    // Route to handle password updates for authenticated users
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    // Route to handle user logout
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
