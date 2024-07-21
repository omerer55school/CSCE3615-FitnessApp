<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

/**
 * Class PasswordResetLinkController
 *
 * Handles the password reset link requests.
 */
class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     *
     * @return View The view for requesting a password reset link.
     */
    public function create(): View
    {
        return view('auth.forgot-password'); // Return the view for forgot password
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @param Request $request The HTTP request instance.
     * @return RedirectResponse Redirect back with status or error message.
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the request data
        $request->validate([
            'email' => ['required', 'email'], // Email field is required and must be a valid email address
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // Check the status and return the appropriate response
        return $status == Password::RESET_LINK_SENT
            ? back()->with('status', __($status)) // If the link was sent, return with status message
            : back()->withInput($request->only('email')) // If there was an error, return with input and error message
            ->withErrors(['email' => __($status)]);
    }
}
