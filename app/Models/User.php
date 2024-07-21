<?php

namespace App\Models;

// Import necessary classes and traits
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    // Use the HasFactory and Notifiable traits
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     * These attributes can be set using mass assignment.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',         // User's name
        'email',        // User's email address
        'password',     // User's password
        'gender',       // User's gender
        'dob',          // User's date of birth
        'height',       // User's height
        'weight',       // User's weight
    ];

    /**
     * The attributes that should be hidden for serialization.
     * These attributes will not be included in arrays or JSON representations.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',         // User's password (hidden for security)
        'remember_token',   // Token used for "remember me" sessions (hidden for security)
    ];

    /**
     * Get the attributes that should be cast.
     * These attributes will be automatically cast to the specified types.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',  // Casts email_verified_at to a datetime object
            'password' => 'hashed',             // Casts password to a hashed string
        ];
    }
}
