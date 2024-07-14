<?php

namespace Database\Factories;

use App\Models\CardioActivity;
use App\Models\Activity;
use Illuminate\Database\Eloquent\Factories\Factory;

class CardioActivityFactory extends Factory
{
    protected $model = CardioActivity::class;

    public function definition()
    {
        return [
            'activity_id' => Activity::factory(),
            'cardio_type' => $this->faker->randomElement(['running', 'cycling', 'swimming']),
            'distance' => $this->faker->randomFloat(2, 1, 20),
            'time' => $this->faker->numberBetween(30, 120),
            'calories_burned' => $this->faker->randomFloat(2, 100, 1000),
        ];
    }
}
