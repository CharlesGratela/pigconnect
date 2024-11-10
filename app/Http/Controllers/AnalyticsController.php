<?php

namespace App\Http\Controllers;

use App\Models\Pig;
use App\Models\PigWeight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnalyticsController extends Controller
{
    public function getAnalytics()
    {
        $userId = Auth::id();

        // Total number of pigs
        $totalPigs = Pig::where('user_id', $userId)->count();

        // Average weight of pigs
        $averageWeight = Pig::where('user_id', $userId)->avg('weight');

        // Weight trend over time
        $weightTrend = PigWeight::selectRaw('DATE(date) as date, AVG(weight) as average_weight')
            ->whereHas('pig', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return response()->json([
            'totalPigs' => $totalPigs,
            'averageWeight' => $averageWeight,
            'weightTrend' => $weightTrend,
        ]);
    }
}