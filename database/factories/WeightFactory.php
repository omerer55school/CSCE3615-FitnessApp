<?php

namespace Database\Factories;

use App\Models\Weight;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * Class WeightFactory
 *
 * Factory for creating Weight model instances.
 */
class WeightFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Weight::class;

    /**
     * Define the model's default state.
     *
     * @return array The default values for the model's attributes.
     */
    public function definition()
    {
        // Define the start and end of the current month
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        return [
            'user_id' => User::factory(), // Create a new user and associate with this weight entry
            'weight_date' => $this->faker->dateTimeBetween($startOfMonth, $endOfMonth)->format('Y-m-d'), // Generate a random date within the current month
            'weight' => $this->faker->randomFloat(2, 50, 100), // Generate a random weight between 50 and 100
            'calories_burned' => $this->faker->randomFloat(2, 100, 500), // Generate a random number of calories burned between 100 and 500
        ];
    }
}
