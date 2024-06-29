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

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        \Log::info($request->all());
    
        // Validate the request
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'gender' => ['required', 'string', 'in:male,female,other'],
            'dob' => ['required', 'date'],
            'heightFeet' => ['required', 'numeric'],
            'heightInches' => ['required', 'numeric'],
            'weight' => ['required', 'numeric'],
        ]);
    
        // Format height as feet'inches"
        $height = $request->heightFeet . "'" . $request->heightInches . '"';
    
        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'dob' => $request->dob,
            'height' => $height,
            'weight' => $request->weight,
        ]);
    
        event(new Registered($user));
    
        Auth::login($user);

        // Log the weight after registration
        $weightLog = Weight::create([
            'user_id' => $user->id,
            'weight_date' => now(),  // Use the current date or another date if needed
            'weight' => $request->weight,
        ]);

        return redirect(route('dashboard', absolute: false));
    }
}
