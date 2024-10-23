<?php
namespace App\Http\Controllers;

use App\Models\BreedingRecord;
use Illuminate\Http\Request;

class BreedingRecordController extends Controller
{
    public function index()
    {
        $breedingRecords = BreedingRecord::with(['sow', 'boar'])->get();
        return response()->json($breedingRecords);
    }

    public function store(Request $request)
    {
        $request->validate([
            'sow_id' => 'required|exists:pigs,id',
            'boar_id' => 'required|exists:pigs,id',
            'date_of_breeding' => 'required|date',
            'expected_farrowing_date' => 'required|date',
        ]);

        $breedingRecord = BreedingRecord::create($request->all());

        return response()->json($breedingRecord, 201);
    }

    public function show($id)
    {
        $breedingRecord = BreedingRecord::with(['sow', 'boar'])->findOrFail($id);
        return response()->json($breedingRecord);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'sow_id' => 'required|exists:pigs,id',
            'boar_id' => 'required|exists:pigs,id',
            'date_of_breeding' => 'required|date',
            'expected_farrowing_date' => 'required|date',
        ]);

        $breedingRecord = BreedingRecord::findOrFail($id);
        $breedingRecord->update($request->all());

        return response()->json($breedingRecord);
    }

    public function destroy($id)
    {
        BreedingRecord::destroy($id);
        return response()->json(null, 204);
    }
}