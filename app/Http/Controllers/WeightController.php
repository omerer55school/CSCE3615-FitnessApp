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
}
