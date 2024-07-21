<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

/**
 * Class VerifyEmailController
 *
 * Handles email verification for authenticated users.
 */
class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param EmailVerificationRequest $request The email verification request instance.
     * @return RedirectResponse Redirect to the dashboard with a verified status.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        // Check if the user's email is already verified
        if ($request->user()->hasVerifiedEmail()) {
            // If verified, redirect to the dashboard with a verified status
            return redirect()->intended(route('dashboard', absolute: false) . '?verified=1');
        }

        // Mark the user's email as verified
        if ($request->user()->markEmailAsVerified()) {
            // Fire the Verified event
            event(new Verified($request->user()));
        }

        // Redirect to the dashboard with a verified status
        return redirect()->intended(route('dashboard', absolute: false) . '?verified=1');
    }
}
