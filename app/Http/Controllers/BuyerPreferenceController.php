<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BuyerPreference;

class BuyerPreferenceController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $preferences = BuyerPreference::where('user_id', $user->id)->first();

        if (!$preferences) {
            return response()->json(['message' => 'Preferences not found'], 404);
        }

        return response()->json($preferences);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'age_of_pigs' => 'required|string',
            'price_range' => 'required|string',
            'preferred_weight' => 'required|string',
            'breed' => 'nullable|string', // Add validation for breed
        ]);

        // Handle the prefer_nearby field
        $prefer_nearby = filter_var($request->prefer_nearby, FILTER_VALIDATE_BOOLEAN) ? 1 : 0;

        $preferences = BuyerPreference::updateOrCreate(
            ['user_id' => $user->id],
            [
                'age_of_pigs' => $request->age_of_pigs,
                'price_range' => $request->price_range,
                'preferred_weight' => $request->preferred_weight,
                'prefer_nearby' => $prefer_nearby,
                'breed' => $request->breed, // Add breed to the preferences
            ]
        );

        return response()->json($preferences);
    }
}