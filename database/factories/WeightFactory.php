<?php

namespace Database\Factories;

use App\Models\Weight;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class WeightFactory extends Factory
{
    protected $model = Weight::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'weight_date' => $this->faker->date,
            'weight' => $this->faker->randomFloat(2, 50, 100),
            'calories_burned' => $this->faker->randomFloat(2, 100, 500),
        ];
    }
}
