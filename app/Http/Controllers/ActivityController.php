<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\CardioActivity;
use App\Models\WorkoutActivity;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function store(Request $request)
    {   
        \Log::info($request->all());
        $activity = Activity::create([
            'user_id' => Auth::id(),
            'activity_date' => $request->activity_date,
        ]);

        // Convert weight from lbs to kg
        $userWeightLbs = Auth::user()->weight; // Assuming weight is stored in lbs
        $userWeightKg = $userWeightLbs / 2.20462;

        $cardioData = $request->cardio_activity;
        if ($cardioData['cardio_type'] || $cardioData['distance'] || $cardioData['time']) {
            $caloriesBurned = $this->calculateCalories($cardioData['cardio_type'], $userWeightKg, $cardioData['time']);
            CardioActivity::create([
                'activity_id' => $activity->id,
                'cardio_type' => $cardioData['cardio_type'],
                'distance' => $cardioData['distance'],
                'time' => $cardioData['time'],
                'calories_burned' => $caloriesBurned,
            ]);
        }

        foreach ($request->workouts as $workout) {
            $averageTime = 30; // Assuming 30 minutes average time per workout session
            $caloriesBurned = $this->calculateCaloriesWeightLifting($workout['workout_type'], $userWeightKg, $averageTime);
            WorkoutActivity::create([
                'activity_id' => $activity->id,
                'workout_type' => $workout['workout_type'],
                'sets' => $workout['sets'],
                'reps' => $workout['reps'],
                'calories_burned' => $caloriesBurned,
            ]);
        }

        return response()->json(['status' => 'success', 'activity_id' => $activity->id]);
    }

    private function calculateCalories($type, $weight, $timeMinutes) {
        $mets = $this->getMetsForActivity($type);
        $timeHours = $timeMinutes / 60; // Convert minutes to hours
        \Log::info("Calculating Calories: METs = $mets, Weight = $weight kg, Time = $timeHours hours");
        return $mets * $weight * $timeHours;
    }
    

    private function calculateCaloriesWeightLifting($type, $weight, $timeMinutes) {
        // Default to a typical MET for general weightlifting/workout activities
        $mets = 5.0; // A general MET for standard gym workouts
        $timeHours = $timeMinutes / 60; // Convert minutes to hours
        \Log::info("Calculating Calories: METs = $mets, Weight = $weight kg, Time = $timeHours hours");
        return $mets * $weight * $timeHours;
    }
    
    

    private function getMetsForActivity($type) {
        $metValues = [
            'Running' => 10,
            'Walking' => 3.3,
            'Biking' => 6.8,
            'Swimming' => 8,
            'Rowing' => 7,
            'Elliptical' => 5.5,
            'Jump Rope' => 12,
            'Stair Climbing' => 9,
            'HIIT' => 12.5,
            'Light Weightlifting' => 3.5, // Example for light sessions
            'Intense Weightlifting' => 6, // Example for more intense sessions
            'Workout' => 5 // General placeholder for unspecified workouts
        ];
    
        return $metValues[$type] ?? 3.5; // Use a fallback MET value if activity type is not listed
    }


    public function getUserActivities()
    {
        $activities = Activity::where('user_id', Auth::id())
            ->where(function($query) {
                $query->whereHas('cardioActivity', function($query) {
                    $query->whereNotNull('cardio_type')
                          ->orWhereNotNull('distance')
                          ->orWhereNotNull('time');
                })
                ->orWhereHas('workoutActivities', function($query) {
                    $query->whereNotNull('workout_type')
                          ->orWhereNotNull('sets')
                          ->orWhereNotNull('reps');
                });
            })
            ->with('cardioActivity', 'workoutActivities')
            ->orderBy('activity_date', 'desc')
            ->get();
    
        return response()->json($activities);
    }
    


    public function getCalorieData(Request $request)
    {
        \Log::info($request->all());
        \Log::info("Received dates: StartDate - {$request->start_date}, EndDate - {$request->end_date}");
        $userId = Auth::id();
        $startDate = $request->start_date;
        $endDate = $request->end_date;
    
        $activities = Activity::where('user_id', $userId)
            ->whereBetween('activity_date', [$startDate, $endDate])
            ->withSum(['cardioActivity', 'workoutActivities'], 'calories_burned')
            ->get();
    
        \Log::info("Fetched activities: " . $activities->toJson()); // This will log the JSON representation of activities
        return response()->json($activities);
    }
    


}
