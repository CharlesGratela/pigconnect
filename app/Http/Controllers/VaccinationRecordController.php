<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pig;
use App\Models\VaccinationRecord;

class VaccinationRecordController extends Controller
{
    public function index($pigId)
    {
        $pig = Pig::findOrFail($pigId);
        $vaccinationRecords = $pig->vaccinationRecords;

        if ($vaccinationRecords->isEmpty()) {
            return response()->json(['message' => 'No vaccination records found'], 404);
        }

        return response()->json($vaccinationRecords);
    }

    public function store(Request $request, $pigId)
    {
        $pig = Pig::findOrFail($pigId);
        
        $vaccinationRecord = VaccinationRecord::create([
            'vaccineName' => $request->vaccineName,
            'pigId' => $pigId,
            'vaccineType' => $request->vaccineType,
            'dateAdministered' => $request->dateAdministered,
        ]);

        return response()->json($vaccinationRecord, 201);
    }

    public function show($pigId, $id)
    {
        $vaccinationRecord = VaccinationRecord::where('pig_id', $pigId)->findOrFail($id);
        return response()->json($vaccinationRecord);
    }

    public function update(Request $request, $pigId, $id)
    {
        $vaccinationRecord = VaccinationRecord::where('pig_id', $pigId)->findOrFail($id);
        $vaccinationRecord->update($request->all());
        return response()->json($vaccinationRecord);
    }

    public function destroy($pigId, $id)
    {
        $vaccinationRecord = VaccinationRecord::where('pig_id', $pigId)->findOrFail($id);
        $vaccinationRecord->delete();
        return response()->json(null, 204);
    }
}