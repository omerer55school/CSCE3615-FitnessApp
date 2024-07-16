<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Activity;
use App\Models\CardioActivity;
use App\Models\WorkoutActivity;
use App\Models\Weight;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create 10 users
        User::factory()->count(10)->create()->each(function ($user) {
            // Create 5 activities for each user
            Activity::factory()->count(100)->create(['user_id' => $user->id])->each(function ($activity) {
                // Create cardio and workout activities
                if (rand(0, 1)) {
                    CardioActivity::factory()->create(['activity_id' => $activity->id]);
                } else {
                    WorkoutActivity::factory()->create(['activity_id' => $activity->id]);
                }
            });

            // Create weight logs for each user
            Weight::factory()->count(100)->create(['user_id' => $user->id]);
        });
    }
}
