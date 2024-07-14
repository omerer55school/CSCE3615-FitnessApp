<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        $feet = $this->faker->numberBetween(4, 6); // Height in feet
        $inches = $this->faker->numberBetween(0, 11); // Height in inches

        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'), // Default password
            'gender' => $this->faker->randomElement(['male', 'female', 'other']),
            'dob' => $this->faker->date,
            'height' => "{$feet}'{$inches}''", // Height in the form (feet)'(inches)''
            'weight' => $this->faker->numberBetween(100, 250), // Weight in lbs
            'email_verified_at' => now(),
        ];
    }
}
