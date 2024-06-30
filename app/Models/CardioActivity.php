<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardioActivity extends Model
{
    use HasFactory;

    protected $fillable = ['activity_id', 'cardio_type', 'distance', 'time', 'calories_burned'];
}
