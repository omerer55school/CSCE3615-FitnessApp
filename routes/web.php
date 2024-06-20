<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\WeightController;




Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/activity', function () {
    return view('activity');
})->middleware(['auth', 'verified'])->name('activity');

Route::get('/weight', function () {
    return view('weight');
})->middleware(['auth', 'verified'])->name('weight');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::middleware('auth')->group(function () {
    Route::post('/api/activities', [ActivityController::class, 'store']);
    Route::post('/api/weights', [WeightController::class, 'store']);
    Route::get('/api/user-activities', [ActivityController::class, 'getUserActivities']);

});


require __DIR__.'/auth.php';
