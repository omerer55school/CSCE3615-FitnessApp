<?php

namespace Database\Factories;

use App\Models\CardioActivity;
use App\Models\Activity;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * Class CardioActivityFactory
 *
 * Factory for creating CardioActivity model instances.
 */
class CardioActivityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CardioActivity::class;

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
            'activity_id' => Activity::factory(), // Create a new activity and associate with this cardio activity
            'cardio_type' => $this->faker->randomElement(['running', 'cycling', 'swimming']), // Randomly select a cardio type
            'distance' => $this->faker->randomFloat(2, 1, 20), // Generate a random distance between 1 and 20
            'time' => $this->faker->numberBetween(30, 120), // Generate a random time between 30 and 120 minutes
            'calories_burned' => $this->faker->randomFloat(2, 100, 1000), // Generate a random number of calories burned between 100 and 1000
            'created_at' => $this->faker->dateTimeBetween($startOfMonth, $endOfMonth), // Generate a random created_at date within the current month
            'updated_at' => $this->faker->dateTimeBetween($startOfMonth, $endOfMonth), // Generate a random updated_at date within the current month
        ];
    }
}
