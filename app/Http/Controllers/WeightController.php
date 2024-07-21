<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Weight;
use Illuminate\Support\Facades\Auth;

/**
 * Class WeightController
 *
 * Handles storing and retrieving user weight data.
 */
class WeightController extends Controller
{
    /**
     * Store a new weight entry for the authenticated user.
     *
     * @param Request $request The HTTP request instance.
     * @return \Illuminate\Http\JsonResponse JSON response with the status and weight ID.
     */
    public function store(Request $request)
    {
        // Create a new weight entry
        $weight = Weight::create([
            'user_id' => Auth::id(), // Get the authenticated user's ID
            'weight_date' => $request->weight_date, // Set the weight date
            'weight' => $request->weight, // Set the weight value
        ]);

        // Return a success response with the weight ID
        return response()->json(['status' => 'success', 'weight_id' => $weight->id]);
    }

    /**
     * Retrieve weight entries for the authenticated user.
     *
     * @param Request $request The HTTP request instance.
     * @return \Illuminate\Http\JsonResponse JSON response with the user's weight entries.
     */
    public function index(Request $request)
    {
        // Create a query to get the weight entries for the authenticated user
        $query = Weight::where('user_id', Auth::id());

        // If start_date and end_date are provided, filter the weight entries by date range
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('weight_date', [$request->start_date, $request->end_date]);
        }

        // Get the weight entries, ordered by weight_date in descending order, with pagination
        $weights = $query->orderBy('weight_date', 'desc')->paginate(5);

        // Return the weight entries as JSON response
        return response()->json($weights);
    }
}
