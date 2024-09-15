<?php

namespace App\Http\Controllers;

use App\Models\PigFarmInformation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PigFarmInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'feedingType' => 'required|string',
            'frequencyOfFeeding' => 'required|string',
            'minPricePerKilo' => 'required|numeric',
            'maxPricePerKilo' => 'required|numeric',
            'location.lat' => 'required|numeric',
            'location.lng' => 'required|numeric',
        ]);

        PigFarmInformation::create([
            'feeding_type' => $request->feedingType,
            'frequency_of_feeding' => $request->frequencyOfFeeding,
            'min_price_per_kilo' => $request->minPricePerKilo,
            'max_price_per_kilo' => $request->maxPricePerKilo,
            'latitude' => $request->location['lat'],
            'longitude' => $request->location['lng'],
        ]);

        return response()->json(['message' => 'Pig farm information saved successfully']);
    }


    /**
     * Display the specified resource.
     */
    public function show(PigFarmInformation $pigFarmInformation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PigFarmInformation $pigFarmInformation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PigFarmInformation $pigFarmInformation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PigFarmInformation $pigFarmInformation)
    {
        //
    }
}
