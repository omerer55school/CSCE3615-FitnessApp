<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Weight
 *
 * Represents a weight entry from a user. Each row in the
 * Weight table represents a weight record for a specific user on a specific day,
 * allowing for tracking of user's weight over time.
 */
class Weight extends Model
{
    use HasFactory;

    /**
     * Fillable attributes for a Weight entry.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',     // ID of the User to whom the weight record belongs
        'weight_date', // The date of the weight record
        'weight'       // The recorded weight on the given date
    ];
}
