<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

/**
 * Class ProfileController
 *
 * Handles the user's profile operations including displaying, updating, and deleting the profile.
 */
class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     *
     * @param Request $request The HTTP request instance.
     * @return View The view for editing the user's profile.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(), // Pass the authenticated user to the view
        ]);
    }

    /**
     * Update the user's profile information.
     *
     * @param ProfileUpdateRequest $request The HTTP request instance containing validated profile data.
     * @return RedirectResponse Redirect to the profile edit page with a status message.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Fill the user model with the validated data
        $request->user()->fill($request->validated());

        // If the email is changed, set email_verified_at to null
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Save the updated user model
        $request->user()->save();

        // Redirect to the profile edit page with a status message
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     *
     * @param Request $request The HTTP request instance.
     * @return RedirectResponse Redirect to the home page after account deletion.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Validate the user's password
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        // Get the authenticated user
        $user = $request->user();

        // Log out the user
        Auth::logout();

        // Delete the user account
        $user->delete();

        // Invalidate the session to prevent reuse
        $request->session()->invalidate();

        // Regenerate the CSRF token to prevent CSRF attacks
        $request->session()->regenerateToken();

        // Redirect to the home page
        return Redirect::to('/');
    }
}
