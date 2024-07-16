<?php

namespace Database\Factories;

use App\Models\Weight;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class WeightFactory extends Factory
{
    protected $model = Weight::class;

    public function definition()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        return [
            'user_id' => User::factory(),
            'weight_date' => $this->faker->dateTimeBetween($startOfMonth, $endOfMonth)->format('Y-m-d'),
            'weight' => $this->faker->randomFloat(2, 50, 100),
            'calories_burned' => $this->faker->randomFloat(2, 100, 500),
        ];
    }
}
