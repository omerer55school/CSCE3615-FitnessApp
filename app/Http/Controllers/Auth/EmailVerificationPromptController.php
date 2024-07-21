<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class EmailVerificationPromptController
 *
 * Handles the display of the email verification prompt.
 */
class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     *
     * @param Request $request The HTTP request instance.
     * @return RedirectResponse|View If the user's email is verified, redirect to the dashboard. Otherwise, show the email verification view.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        // Check if the user's email is verified
        return $request->user()->hasVerifiedEmail()
            // If verified, redirect to the dashboard
            ? redirect()->intended(route('dashboard', absolute: false))
            // If not verified, show the email verification view
            : view('auth.verify-email');
    }
}
