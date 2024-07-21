<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserFactory
 *
 * Factory for creating User model instances.
 */
class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array The default values for the model's attributes.
     */
    public function definition()
    {
        $feet = $this->faker->numberBetween(4, 6); // Generate a random height in feet
        $inches = $this->faker->numberBetween(0, 11); // Generate a random height in inches

        return [
            'name' => $this->faker->name, // Generate a random name
            'email' => $this->faker->unique()->safeEmail, // Generate a unique and safe email
            'password' => Hash::make('password'), // Hash a default password
            'gender' => $this->faker->randomElement(['male', 'female', 'other']), // Randomly select a gender
            'dob' => $this->faker->date, // Generate a random date of birth
            'height' => "{$feet}'{$inches}''", // Combine feet and inches to form height in the format (feet)'(inches)''
            'weight' => $this->faker->numberBetween(100, 250), // Generate a random weight in lbs
            'email_verified_at' => now(), // Set the email verified at to the current time
        ];
    }
}
