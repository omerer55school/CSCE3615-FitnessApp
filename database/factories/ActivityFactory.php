<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class ActivityFactory extends Factory
{
    protected $model = Activity::class;

    public function definition()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        return [
            'user_id' => User::factory(),
            'activity_date' => $this->faker->dateTimeBetween($startOfMonth, $endOfMonth)->format('Y-m-d'),
        ];
    }
}
