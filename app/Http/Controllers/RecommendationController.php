<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Pig;

class RecommendationController extends Controller
{
    public function recommend()
    {
        $user = Auth::user();
        $fastApiUrl = 'http://127.0.0.1:8001/recommendations'; // Update this URL to your FastAPI server address
        $response = Http::get($fastApiUrl, [
            'user_id' => $user->id,
        ]);

        // Log the raw response
        Log::info('Raw recommendation response', ['response' => $response->body()]);

        if ($response->failed()) {
            return response()->json([
                'message' => 'Failed to fetch recommendations',
                'status' => $response->status(),
                'error' => $response->body()
            ], 500);
        }

        // Decode the JSON response
        $recommendations = json_decode($response->body(), true);

        // Log the decoded JSON response
        Log::info('Decoded recommendation response', ['response' => $recommendations]);

        // Extract pig IDs from the recommendations
        $pigIds = $recommendations['recommendations'];

        // Log the extracted pig IDs
        Log::info('Extracted pig IDs', ['pigIds' => $pigIds]);

        // Convert pig IDs to integers
        $pigIds = array_map('intval', $pigIds);

        // Fetch detailed information of the recommended pigs from the database in the order specified by the AI
        $orderedPigs = Pig::whereIn('pigId', $pigIds)
            ->orderByRaw('FIELD(pigId, ' . implode(',', $pigIds) . ')')
            ->get();

        // Log the detailed information of the recommended pigs
        Log::info('Detailed recommended pigs', ['recommendedPigs' => $orderedPigs]);

        return response()->json(['recommendations' => $orderedPigs]);
    }

    public function trackInteraction(Request $request)
    {
        $user = Auth::user();
      
        $fastApiUrl = 'http://127.0.0.1:8001/api/track_interaction'; // Update this URL to your FastAPI server address
        $response = Http::post($fastApiUrl, [
            'user_id' => $user->id,
            'pig_id' => $request->pig_id,
        ]);

        // Log the response
        Log::info('Track interaction response', ['response' => $response->json()]);

        if ($response->failed()) {
            return response()->json([
                'message' => 'Failed to track interaction',
                'status' => $response->status(),
                'error' => $response->body()
            ], 500);
        }

        return response()->json(['message' => 'Interaction tracked successfully']);
    }
}