<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Class AuthenticatedSessionController
 *
 * Handles user authentication sessions including login, logout, and session management.
 */
class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return View The login view.
     */
    public function create(): View
    {
        return view('auth.login'); // Return the view for login
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param LoginRequest $request The HTTP request instance with authentication credentials.
     * @return RedirectResponse Redirect to the intended route (dashboard) if authentication is successful.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Authenticate the user using the provided credentials
        $request->authenticate();

        // Regenerate the session to prevent session fixation
        $request->session()->regenerate();

        // Redirect to the intended route (dashboard)
        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     *
     * @param Request $request The HTTP request instance.
     * @return RedirectResponse Redirect to the home page after logging out.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Log out the user
        Auth::guard('web')->logout();

        // Invalidate the session to prevent reuse
        $request->session()->invalidate();

        // Regenerate the CSRF token to prevent CSRF attacks
        $request->session()->regenerateToken();

        // Redirect to the home page
        return redirect('/');
    }
}
