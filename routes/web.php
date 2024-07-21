<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\WeightController;

// Route for the welcome page
Route::get('/', function () {
    return view('welcome');
});

// Route for the dashboard, accessible only to authenticated and verified users
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route for the activity page, accessible only to authenticated and verified users
Route::get('/activity', function () {
    return view('activity');
})->middleware(['auth', 'verified'])->name('activity');

// Route for the weight page, accessible only to authenticated and verified users
Route::get('/weight', function () {
    return view('weight');
})->middleware(['auth', 'verified'])->name('weight');

// Routes for profile management, accessible only to authenticated users
Route::middleware('auth')->group(function () {
    // Route to display the profile edit form
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    // Route to handle profile update form submission
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Route to handle profile deletion
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes for activity and weight management, accessible only to authenticated users
Route::middleware('auth')->group(function () {
    // Route to store a new activity
    Route::post('/api/activities', [ActivityController::class, 'store']);

    // Route to store a new weight entry
    Route::post('/api/weights', [WeightController::class, 'store']);

    // Route to get user activities
    Route::get('/api/user-activities', [ActivityController::class, 'getUserActivities']);

    // Route to get user weight entries
    Route::get('/api/user-weights', [WeightController::class, 'index']);

    // Route to get user calorie data
    Route::get('/api/user-calories', [ActivityController::class, 'getCalorieData'])->name('user.calories');
});

// Include authentication routes
require __DIR__.'/auth.php';
