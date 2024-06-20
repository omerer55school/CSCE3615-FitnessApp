<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkoutActivity extends Model
{
    use HasFactory;

    protected $fillable = ['activity_id', 'workout_type', 'sets', 'reps'];
}
