<?php

namespace Database\Factories;

use App\Models\WorkoutActivity;
use App\Models\Activity;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * Class WorkoutActivityFactory
 *
 * Factory for creating WorkoutActivity model instances.
 */
class WorkoutActivityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WorkoutActivity::class;

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
            'activity_id' => Activity::factory(), // Create a new activity and associate with this workout activity
            'workout_type' => $this->faker->randomElement(['strength', 'cardio']), // Randomly select a workout type
            'sets' => $this->faker->numberBetween(1, 5), // Generate a random number of sets between 1 and 5
            'reps' => $this->faker->numberBetween(5, 20), // Generate a random number of reps between 5 and 20
            'calories_burned' => $this->faker->randomFloat(2, 100, 500), // Generate a random number of calories burned between 100 and 500
            'created_at' => $this->faker->dateTimeBetween($startOfMonth, $endOfMonth), // Generate a random created_at date within the current month
            'updated_at' => $this->faker->dateTimeBetween($startOfMonth, $endOfMonth), // Generate a random updated_at date within the current month
        ];
    }
}
