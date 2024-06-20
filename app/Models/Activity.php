<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'activity_date',
    ];

    public function cardioActivity()
    {
        return $this->hasOne(CardioActivity::class);
    }

    public function workoutActivities()
    {
        return $this->hasMany(WorkoutActivity::class);
    }
}
