<?php

namespace App\Http\Controllers;

use App\Models\Pig;

use App\Models\PigWeight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
class PigController extends Controller
{
    public function index()
    {
        // Get the authenticated user's ID
        $userId = Auth::id();

        // Fetch the pigs based on the user ID
        $pigs = Pig::where('user_id', $userId)->get();

        return response()->json($pigs);
    }

    public function store(Request $request)
    {
        $request->validate([
            'weight' => 'required|numeric',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female',
            'status' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Get the authenticated user's ID
        $userId = Auth::id();

        // Handle the image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            return response()->json(['message' => 'Image is required'], 400);
        }

        // Create the pig record
        $pig = Pig::create([
            'user_id' => $userId,
            'weight' => $request->weight,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'status' => $request->status,
            'image' => $imagePath,
        ]);
      
        // Store the initial weight in the pig_weights table
        PigWeight::create([
            'pig_id' => $pig->PigId,
            'date' => now(),
            'weight' => $request->weight,
        ]);

        return response()->json($pig, 201);
    }
 
public function update(Request $request, $id)
{
    // Validate the request
    $request->validate([
        'weight' => 'required|numeric',
        'status' => 'required|string',
    ]);

    // Log the request data
    Log::info('Update Request Data:', $request->all());

    // Update the pig record using the query builder
    DB::table('pigs')
        ->where('pigId', $id)
        ->update([
            'weight' => $request->weight,
            'status' => $request->status,
            'updated_at' => now(), // Ensure the updated_at timestamp is updated
        ]);

    // Retrieve the updated pig record
    $pig = DB::table('pigs')->where('pigId', $id)->first();

    // Log the updated state of the pig
    Log::info('Updated Pig Data:', (array) $pig);

    return response()->json(['message' => 'Pig updated successfully', 'pig' => $pig]);
}
}