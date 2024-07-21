<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Activity
 *
 * Represents an activity entry for a user. Each row in the
 * activities table represents a single activity record, which
 * includes a user ID and the date of the activity.
 */
class Activity extends Model
{
    use HasFactory;

    /**
     * Fillable attributes for an Activity entry.
     * These attributes can be mass-assigned.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',        // The ID of the user who performed the activity
        'activity_date',  // The date when the activity was performed
    ];

    /**
     * Define a one-to-one relationship with CardioActivity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function cardioActivity()
    {
        return $this->hasOne(CardioActivity::class); // Each activity can have one cardio activity
    }

    /**
     * Define a one-to-many relationship with WorkoutActivity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function workoutActivities()
    {
        return $this->hasMany(WorkoutActivity::class); // Each activity can have many workout activities
    }
}
