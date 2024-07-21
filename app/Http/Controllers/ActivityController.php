<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\CardioActivity;
use App\Models\WorkoutActivity;
use Illuminate\Support\Facades\Auth;

/**
 * Class ActivityController
 *
 * Handles storing and retrieving user activities including cardio and workout activities.
 */
class ActivityController extends Controller
{
    /**
     * Store a new activity along with cardio and workout details.
     *
     * @param Request $request The HTTP request instance.
     * @return \Illuminate\Http\JsonResponse JSON response with the status and activity ID.
     */
    public function store(Request $request)
    {
        \Log::info($request->all()); // Log the request data for debugging purposes

        // Create a new activity
        $activity = Activity::create([
            'user_id' => Auth::id(), // Get the authenticated user's ID
            'activity_date' => $request->activity_date, // Set the activity date
        ]);

        // Convert user weight from lbs to kg
        $userWeightLbs = Auth::user()->weight; // Assuming weight is stored in lbs
        $userWeightKg = $userWeightLbs / 2.20462;

        // Handle cardio activity data
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

        // Handle workout activities data
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

        // Return a success response with the activity ID
        return response()->json(['status' => 'success', 'activity_id' => $activity->id]);
    }

    /**
     * Calculate the calories burned for a cardio activity.
     *
     * @param string $type The type of cardio activity.
     * @param float $weight The user's weight in kilograms.
     * @param int $timeMinutes The duration of the activity in minutes.
     * @return float The calculated calories burned.
     */
    private function calculateCalories($type, $weight, $timeMinutes) {
        $mets = $this->getMetsForActivity($type); // Get the METs for the activity type
        $timeHours = $timeMinutes / 60; // Convert minutes to hours
        \Log::info("Calculating Calories: METs = $mets, Weight = $weight kg, Time = $timeHours hours");
        return $mets * $weight * $timeHours;
    }

    /**
     * Calculate the calories burned for weight lifting activities.
     *
     * @param string $type The type of workout activity.
     * @param float $weight The user's weight in kilograms.
     * @param int $timeMinutes The duration of the activity in minutes.
     * @return float The calculated calories burned.
     */
    private function calculateCaloriesWeightLifting($type, $weight, $timeMinutes) {
        $mets = 5.0; // A general MET for standard gym workouts
        $timeHours = $timeMinutes / 60; // Convert minutes to hours
        \Log::info("Calculating Calories: METs = $mets, Weight = $weight kg, Time = $timeHours hours");
        return $mets * $weight * $timeHours;
    }

    /**
     * Get the METs value for a given activity type.
     *
     * @param string $type The type of activity.
     * @return float The METs value for the activity.
     */
    private function getMetsForActivity($type) {
        // MET values for different activities
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

    /**
     * Get user activities including cardio and workout activities.
     *
     * @param Request $request The HTTP request instance.
     * @return \Illuminate\Http\JsonResponse JSON response with the user's activities.
     */
    public function getUserActivities(Request $request)
    {
        // Query for user activities with cardio and workout activities
        $activities = Activity::where('user_id', Auth::id())
            ->where(function ($query) {
                $query->whereHas('cardioActivity', function ($query) {
                    $query->whereNotNull('cardio_type')
                        ->orWhereNotNull('distance')
                        ->orWhereNotNull('time');
                })
                    ->orWhereHas('workoutActivities', function ($query) {
                        $query->whereNotNull('workout_type')
                            ->orWhereNotNull('sets')
                            ->orWhereNotNull('reps');
                    });
            })
            ->with('cardioActivity', 'workoutActivities')
            ->orderBy('activity_date', 'desc')
            ->paginate(5);

        return response()->json($activities); // Return the activities as JSON response
    }

    /**
     * Get calorie data for user activities within a date range.
     *
     * @param Request $request The HTTP request instance.
     * @return \Illuminate\Http\JsonResponse JSON response with the user's calorie data.
     */
    public function getCalorieData(Request $request)
    {
        \Log::info($request->all()); // Log the request data for debugging purposes
        \Log::info("Received dates: StartDate - {$request->start_date}, EndDate - {$request->end_date}");

        $userId = Auth::id(); // Get the authenticated user's ID
        $startDate = $request->start_date; // Get the start date from the request
        $endDate = $request->end_date; // Get the end date from the request

        // Query for user activities within the date range
        $activities = Activity::where('user_id', $userId)
            ->whereBetween('activity_date', [$startDate, $endDate])
            ->withSum(['cardioActivity', 'workoutActivities'], 'calories_burned')
            ->get();

        \Log::info("Fetched activities: " . $activities->toJson()); // Log the fetched activities
        return response()->json($activities); // Return the activities as JSON response
    }
}
