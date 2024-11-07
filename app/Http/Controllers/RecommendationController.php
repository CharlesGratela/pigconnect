<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class RecommendationController extends Controller
{
    public function recommend()
    {
        $user = Auth::user();
        $fastApiUrl = 'http://127.0.0.1:8001/recommendations'; // Update this URL to your FastAPI server address
        $response = Http::get($fastApiUrl, [
            'user_id' => $user->id,
        ]);

        if ($response->failed()) {
            return response()->json([
                'message' => 'Failed to fetch recommendations',
                'status' => $response->status(),
                'error' => $response->body()
            ], 500);
        }

        return $response->json();
    }
}