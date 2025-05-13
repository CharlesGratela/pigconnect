<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pig;
use App\Models\VaccinationRecord;
use Illuminate\Support\Facades\Storage;

class VaccinationRecordController extends Controller
{
    public function index($pigId)
    {
        $pig = Pig::findOrFail($pigId);
        $vaccinationRecords = VaccinationRecord::where('pigId', $pigId)->get();

        if ($vaccinationRecords->isEmpty()) {
            return response()->json(['message' => 'No vaccination records found'], 404);
        }

        return response()->json($vaccinationRecords);
    }

    public function store(Request $request, $pigId)
    {
        $pig = Pig::findOrFail($pigId);

        $request->validate([
            'vaccineName' => 'required|string|max:255',
            'vaccineType' => 'required|string|max:255',
            'dateAdministered' => 'required|date',
            'vaccineImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $vaccineImagePath = null;
        if ($request->hasFile('vaccineImage')) {
            $vaccineImagePath = $request->file('vaccineImage')->store('images', 'public');
        }

        $vaccinationRecord = VaccinationRecord::create([
            'pigId' => $pigId,
            'vaccineName' => $request->vaccineName,
            'vaccineType' => $request->vaccineType,
            'dateAdministered' => $request->dateAdministered,
            'vaccine_image' => $vaccineImagePath,
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
        $vaccinationRecord = VaccinationRecord::where('pigId', $pigId)->findOrFail($id);
        $vaccinationRecord->delete();
        return response()->json(null, 204);
    }
}