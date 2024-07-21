<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class WorkoutActivity
 *
 * Represents an activity performed during a workout. Each row in the
 * WorkoutActivity table represents one type of activity done in a workout,
 * such as running, swimming, or a specific exercise in a gym workout.
 */
class WorkoutActivity extends Model
{
    use HasFactory;

    /**
     * Fillable attributes for a WorkoutActivity.
     *
     * @var array
     */
    protected $fillable = [
        'activity_id',     // The ID of the activity
        'workout_type',    // The type of the workout (e.g. "Cardio", "Strength Training")
        'sets',            // The number of sets performed
        'reps',            // The number of repetitions performed in each set
        'calories_burned'  // The estimated number of calories burned during the activity
    ];
}
