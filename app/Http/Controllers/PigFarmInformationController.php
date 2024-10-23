<?php
// app/Http/Controllers/PigFarmInformationController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PigFarmInformation;
use Illuminate\Support\Facades\Auth;

class PigFarmInformationController extends Controller
{
    public function show()
    {
        $userId = Auth::id();
        $farmInformation = PigFarmInformation::where('user_id', $userId)->first();

        if ($farmInformation) {
            return response()->json($farmInformation);
        } else {
            return response()->json(['message' => 'Pig farm information not found for user ID: ' . $userId], 404);
        }
    }

    public function store(Request $request)
    {
        $userId = Auth::id();

        $request->validate([
            'feedingType' => 'required|string',
            'frequencyOfFeeding' => 'required|string',
            'minPricePerKilo' => 'required|numeric',
            'maxPricePerKilo' => 'required|numeric',
            'location.lat' => 'required|numeric',
            'location.lng' => 'required|numeric',
        ]);

        $data = [
            'user_id' => $userId,
            'feeding_type' => $request->feedingType,
            'frequency_of_feeding' => $request->frequencyOfFeeding,
            'min_price_per_kilo' => $request->minPricePerKilo,
            'max_price_per_kilo' => $request->maxPricePerKilo,
            'latitude' => $request->location['lat'],
            'longitude' => $request->location['lng'],
        ];

        PigFarmInformation::updateOrCreate(
            ['user_id' => $userId],
            $data
        );

        return response()->json(['message' => 'Pig farm information saved successfully']);
    }
}