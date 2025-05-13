<?php

namespace App\Http\Controllers;
use App\Models\Pig;
use App\Models\PigWeight;
use App\Models\PigFarmInformation;
use App\Models\Expense;
use App\Models\VaccinationRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

        if($averageWeight == null){
            $averageWeight = 0;
        }

        // Pig statuses
        $pigStatuses = Pig::selectRaw('status, COUNT(*) as count')
            ->where('user_id', $userId)
            ->groupBy('status')
            ->get();

        // Expenses over the past 3 months
        $threeMonthsAgo = Carbon::now()->subMonths(3);
        $expenses = Expense::selectRaw('DATE(date_of_purchase) as date, SUM(cost) as total_amount')
            ->where('user_id', $userId)
            ->where('date_of_purchase', '>=', $threeMonthsAgo)
            ->groupBy('date')
            ->orderBy('date')
            ->get();

            $averageRating = DB::table('feedback')
            ->join('pigs', 'feedback.pig_id', '=', 'pigs.pigId') // Adjust column name if necessary
            ->where('pigs.user_id', $userId)
            ->avg('feedback.rating') ?? 0; // Default to 0 if no ratings found
            $totalVaccinatedPigs = VaccinationRecord::whereIn('pigId', function($query) use ($userId) {
                $query->select('id')
                      ->from('pigs')
                      ->where('user_id', $userId);
            })
            ->distinct('pigId')
            ->count('pigId');
            $percentageVaccinated = $totalPigs > 0 ? ($totalVaccinatedPigs / $totalPigs) * 100 : 0;

        return response()->json([
            'totalPigs' => $totalPigs,
            'averageWeight' => $averageWeight,
            'weightTrend' => $weightTrend,
            'pigStatuses' => $pigStatuses,
            'expenses' => $expenses,
            'averageRating' => $averageRating,
            'percentageVaccinated' => $percentageVaccinated,
 
      
        ]);
    }

    public function getWeather(Request $request)
    {
        $userId = Auth::id();
        $farmInfo = PigFarmInformation::where('user_id', $userId)->first();

        if (!$farmInfo) {
            return response()->json(['error' => 'Farm information not found'], 404);
        }

        $lat = $farmInfo->latitude;
        $lon = $farmInfo->longitude;

        try {
            $response = Http::get("http://api.weatherapi.com/v1/current.json?key=58bc032bc09b45d38ac05217241111&q={$lat},{$lon}");

            if ($response->failed()) {
                return response()->json(['error' => 'Failed to fetch weather data'], 500);
            }

            $weatherData = $response->json();

            return response()->json([
                'temperature' => $weatherData['current']['temp_c'],
                'weather' => $weatherData['current']['condition']['text'],
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while fetching weather data'], 500);
        }
    }
}