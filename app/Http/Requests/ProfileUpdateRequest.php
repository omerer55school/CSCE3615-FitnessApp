<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class ProfileUpdateRequest
 *
 * Handles validation for profile update requests.
 */
class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string> The validation rules.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'], // Validate the name: required, must be a string, and max length of 255 characters
            'email' => [
                'required', // Email is required
                'string', // Must be a string
                'lowercase', // Must be in lowercase
                'email', // Must be a valid email format
                'max:255', // Max length of 255 characters
                Rule::unique(User::class)->ignore($this->user()->id), // Must be unique in the users table, ignoring the current user's email
            ],
        ];
    }
}
