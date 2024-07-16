<?php

namespace Database\Factories;

use App\Models\WorkoutActivity;
use App\Models\Activity;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class WorkoutActivityFactory extends Factory
{
    protected $model = WorkoutActivity::class;

    public function definition()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        return [
            'activity_id' => Activity::factory(),
            'workout_type' => $this->faker->randomElement(['strength', 'cardio']),
            'sets' => $this->faker->numberBetween(1, 5),
            'reps' => $this->faker->numberBetween(5, 20),
            'calories_burned' => $this->faker->randomFloat(2, 100, 500),
            'created_at' => $this->faker->dateTimeBetween($startOfMonth, $endOfMonth),
            'updated_at' => $this->faker->dateTimeBetween($startOfMonth, $endOfMonth),
        ];
    }
}
