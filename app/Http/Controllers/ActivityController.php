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

        $cardioData = $request->cardio_activity;
        if ($cardioData['cardio_type'] || $cardioData['distance'] || $cardioData['time']) {
            CardioActivity::create([
                'activity_id' => $activity->id,
                'cardio_type' => $cardioData['cardio_type'],
                'distance' => $cardioData['distance'],
                'time' => $cardioData['time'],
            ]);
        }

        foreach ($request->workouts as $workout) {
            WorkoutActivity::create([
                'activity_id' => $activity->id,
                'workout_type' => $workout['workout_type'],
                'sets' => $workout['sets'],
                'reps' => $workout['reps'],
            ]);
        }

        return response()->json(['status' => 'success', 'activity_id' => $activity->id]);
    }

    public function getUserActivities()
    {
        $activities = Activity::where('user_id', Auth::id())
            ->with(['cardioActivity', 'workoutActivities'])
            ->where(function ($query) {
                $query->whereHas('cardioActivity', function($subQuery) {
                    $subQuery->whereNotNull('cardio_type')->orWhereNotNull('distance')->orWhereNotNull('time');
                })
                ->orWhereHas('workoutActivities', function($subQuery) {
                    $subQuery->whereNotNull('workout_type')->orWhereNotNull('sets')->orWhereNotNull('reps');
                });
            })
            ->orderBy('activity_date', 'desc')
            ->get();
    
        return response()->json($activities);
    }
    
    
}
