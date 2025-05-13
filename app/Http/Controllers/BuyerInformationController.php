<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\BuyerInformation;

class BuyerInformationController extends Controller
{
    public function getBuyerInformation()
    {
        $user = Auth::user();
        $buyerInformation = BuyerInformation::where('user_id', $user->id)->first();

        if (!$buyerInformation) {
            return response()->json(['message' => 'Buyer information not found'], 404);
        }

        return response()->json($buyerInformation);
    }

    public function updateBuyerInformation(Request $request)
    {
        $user = Auth::user();
        Log::info('Updating buyer information', [
            'user_id' => $user->id,
            'address' => $request->input('address'),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude')
        ]);

        // Validate the request
        $request->validate([
            'address' => 'required|string',
        ]);

        // Geocode the address
        $apiKey = 'AIzaSyAPE3z_ByaGmKAwUDjUPFP6ZEZyyWmKvTY';
        $geocodeUrl = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($request->address) . "&key=" . $apiKey;

        $response = Http::get($geocodeUrl);
        if ($response->failed()) {
            return response()->json(['error' => 'Failed to geocode address'], 500);
        }

        $data = $response->json();
        if (empty($data['results'])) {
            return response()->json(['error' => 'No geocoding results found'], 404);
        }

        $position = $data['results'][0]['geometry']['location'];

        // Update or create the buyer information
        $buyerInformation = BuyerInformation::updateOrCreate(
            ['user_id' => $user->id],
            [
                'address' => $request->input('address'),
                'latitude' => $position['lat'],
                'longitude' => $position['lng'],
            ]
        );

        return response()->json($buyerInformation);
    }
}