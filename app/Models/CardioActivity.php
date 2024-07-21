<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CardioActivity
 *
 * Represents a cardio activity performed by a user. Each row in the
 * cardio_activities table represents a single cardio activity,
 * which includes the type of the exercise, distance, time,
 * and the number of calories burned.
 *
 * A user can have many cardio activities, and each activity has
 * a unique identifier in the form of 'activity_id'.
 */
class CardioActivity extends Model
{
    use HasFactory;

    /**
     * Fillable attributes for a CardioActivity entry.
     * These attributes can be mass-assigned.
     *
     * @var string[]
     */
    protected $fillable = [
        'activity_id',     // Unique identifier for the activity
        'cardio_type',     // Type of cardio activity (e.g., running, cycling)
        'distance',        // Distance covered during the cardio activity
        'time',            // Duration of the cardio activity
        'calories_burned'  // Number of calories burned during the activity
    ];
}
