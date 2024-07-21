<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Weight;  // Import the Weight model
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

/**
 * Class RegisteredUserController
 *
 * Handles user registration and associated tasks.
 */
class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return View The view for user registration.
     */
    public function create(): View
    {
        return view('auth.register'); // Return the view for user registration
    }

    /**
     * Handle an incoming registration request.
     *
     * @param Request $request The HTTP request instance.
     * @return RedirectResponse Redirect to the dashboard after successful registration.
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        \Log::info($request->all()); // Log the request data for debugging purposes

        // Validate the request data
        $request->validate([
            'name' => ['required', 'string', 'max:255'], // Validate the name
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'], // Validate the email
            'password' => ['required', 'confirmed', Rules\Password::defaults()], // Validate the password
            'gender' => ['required', 'string', 'in:male,female,other'], // Validate the gender
            'dob_day' => ['required', 'integer', 'min:1', 'max:31'], // Validate the day of birth
            'dob_month' => ['required', 'integer', 'min:1', 'max:12'], // Validate the month of birth
            'dob_year' => ['required', 'integer', 'min:1900', 'max:' . date('Y')], // Validate the year of birth
            'heightFeet' => ['required', 'numeric'], // Validate the height in feet
            'heightInches' => ['required', 'numeric'], // Validate the height in inches
            'weight' => ['required', 'numeric'], // Validate the weight
        ]);

        // Combine date of birth parts into a single date string
        $dob = sprintf('%04d-%02d-%02d', $request->dob_year, $request->dob_month, $request->dob_day);

        // Format height as feet'inches"
        $height = $request->heightFeet . "'" . $request->heightInches . '"';

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash the password
            'gender' => $request->gender,
            'dob' => $dob,
            'height' => $height,
            'weight' => $request->weight,
        ]);

        event(new Registered($user)); // Fire the Registered event

        Auth::login($user); // Log in the newly registered user

        // Log the weight after registration
        Weight::create([
            'user_id' => $user->id,
            'weight_date' => now(), // Use the current date for weight logging
            'weight' => $request->weight,
        ]);

        // Redirect to the dashboard
        return redirect(route('dashboard', false));
    }
}
