<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

/**
 * Class ConfirmablePasswordController
 *
 * Handles the confirmation of the user's password.
 */
class ConfirmablePasswordController extends Controller
{
    /**
     * Show the confirm password view.
     *
     * @return View The view for confirming the user's password.
     */
    public function show(): View
    {
        return view('auth.confirm-password'); // Return the view for password confirmation
    }

    /**
     * Confirm the user's password.
     *
     * @param Request $request The HTTP request instance.
     * @return RedirectResponse Redirect to the intended route if the password is confirmed.
     * @throws ValidationException If the password is incorrect, throw a validation exception.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the user's email and password
        if (! Auth::guard('web')->validate([
            'email' => $request->user()->email,   // User's email
            'password' => $request->password,     // User's password
        ])) {
            // If the password is incorrect, throw a validation exception
            throw ValidationException::withMessages([
                'password' => __('auth.password'), // Error message for incorrect password
            ]);
        }

        // Store the password confirmation time in the session
        $request->session()->put('auth.password_confirmed_at', time());

        // Redirect to the intended route (dashboard)
        return redirect()->intended(route('dashboard', absolute: false));
    }
}
