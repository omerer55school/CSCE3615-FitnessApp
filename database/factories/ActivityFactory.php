<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * Class ActivityFactory
 *
 * Factory for creating Activity model instances.
 */
class ActivityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Activity::class;

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
            'user_id' => User::factory(), // Create a new user and associate with this activity
            'activity_date' => $this->faker->dateTimeBetween($startOfMonth, $endOfMonth)->format('Y-m-d'), // Generate a random date within the current month
        ];
    }
}
