<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

/**
 * Class PasswordController
 *
 * Handles updating the user's password.
 */
class PasswordController extends Controller
{
    /**
     * Update the user's password.
     *
     * @param Request $request The HTTP request instance.
     * @return RedirectResponse Redirect back with a status message after updating the password.
     */
    public function update(Request $request): RedirectResponse
    {
        // Validate the request data
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],       // Current password validation
            'password' => ['required', Password::defaults(), 'confirmed'], // New password validation (confirmed)
        ]);

        // Update the user's password in the database
        $request->user()->update([
            'password' => Hash::make($validated['password']), // Hash and store the new password
        ]);

        // Redirect back with a status message indicating the password has been updated
        return back()->with('status', 'password-updated');
    }
}
