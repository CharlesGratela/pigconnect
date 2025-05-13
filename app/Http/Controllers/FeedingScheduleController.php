<?php
namespace App\Http\Controllers;
use App\Models\PigFarmInformation;
use App\Models\FeedingSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedingScheduleController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'feeding_times' => 'required|array',
            'feeding_times.*' => 'required|date_format:H:i',
        ]);

        FeedingSchedule::updateOrCreate(
            ['user_id' => Auth::id()],
            ['feeding_times' => json_encode($request->feeding_times)]
        );

        return response()->json(['message' => 'Feeding schedule updated successfully']);
    }

    public function show()
    {
        $feedingSchedule = FeedingSchedule::where('user_id', Auth::id())->first();

        if ($feedingSchedule) {
            return response()->json([
                'feeding_times' => json_decode($feedingSchedule->feeding_times, true),
                'frequency_of_feeding' => count(json_decode($feedingSchedule->feeding_times, true))
            ]);
        }
        $frequencyOfFeeding = PigFarmInformation::where('user_id', Auth::id())->first();
        return response()->json([
            'feeding_times' => [],
            'frequency_of_feeding' => $frequencyOfFeeding->frequency_of_feeding
        ]);
    }
}