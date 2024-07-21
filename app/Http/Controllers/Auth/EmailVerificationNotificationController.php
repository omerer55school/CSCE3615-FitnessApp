<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Class EmailVerificationNotificationController
 *
 * Handles sending new email verification notifications.
 */
class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     *
     * @param Request $request The HTTP request instance.
     * @return RedirectResponse If the user's email is verified, redirect to the dashboard.
     *                          Otherwise, send the email verification notification and return back with status.
     */
    public function store(Request $request): RedirectResponse
    {
        // Check if the user's email is already verified
        if ($request->user()->hasVerifiedEmail()) {
            // If verified, redirect to the dashboard
            return redirect()->intended(route('dashboard', absolute: false));
        }

        // Send the email verification notification
        $request->user()->sendEmailVerificationNotification();

        // Redirect back with a status message indicating that the verification link was sent
        return back()->with('status', 'verification-link-sent');
    }
}
