<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

/**
 * Class LoginRequest
 *
 * Handles validation and authentication for login requests.
 */
class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool Always true for login requests.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string> The validation rules.
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'], // Validate email: required, must be a string, and in email format
            'password' => ['required', 'string'], // Validate password: required and must be a string
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException If authentication fails.
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited(); // Ensure the request is not rate limited

        // Attempt to authenticate the user
        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey()); // Increment the rate limiter

            // Throw validation exception with error message
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey()); // Clear the rate limiter on successful authentication
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException If the request is rate limited.
     */
    public function ensureIsNotRateLimited(): void
    {
        // Check if too many attempts have been made
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this)); // Trigger lockout event

        $seconds = RateLimiter::availableIn($this->throttleKey()); // Get the time remaining until next attempt

        // Throw validation exception with throttle error message
        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string The throttle key.
     */
    public function throttleKey(): string
    {
        // Generate a throttle key based on the user's email and IP address
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}
