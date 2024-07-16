<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Weight;
use Illuminate\Support\Facades\Auth;

class WeightController extends Controller
{
    public function store(Request $request)
    {
        $weight = Weight::create([
            'user_id' => Auth::id(),
            'weight_date' => $request->weight_date,
            'weight' => $request->weight,
        ]);

        return response()->json(['status' => 'success', 'weight_id' => $weight->id]);
    }


    public function index(Request $request)
    {
        $query = Weight::where('user_id', Auth::id());

        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('weight_date', [$request->start_date, $request->end_date]);
        }

        $weights = $query->orderBy('weight_date', 'desc')->paginate(5);

        return response()->json($weights);
    }
    
    
}
