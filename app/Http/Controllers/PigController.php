<?php

namespace App\Http\Controllers;

use App\Models\Pig;

use App\Models\PigWeight;

use App\Models\Feedback;
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
            'breed' => 'required|string',
            'gender' => 'required|in:male,female',
            'status' => 'required|string',
            'price_per_kilo' => 'required|numeric',
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
        if ($request->hasFile('mark')) {
            $mark = $request->file('mark')->store('images', 'public');
        } else {
            $mark = null;
        }


        // Create the pig record
        $pig = Pig::create([
            'user_id' => $userId,
            'weight' => $request->weight,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'breed' => $request->breed,
            'price_per_kilo' => $request->price_per_kilo,
            'status' => $request->status,
            'image' => $imagePath,
            'mark' => $mark,
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
            'price_per_kilo' => 'required|numeric',
            'status' => 'required|string',
            'breed' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Log the request data
        Log::info('Update Request Data:', $request->all());
    
        $updateData = [
            'weight' => $request->weight,
            'price_per_kilo' => $request->price_per_kilo,
            'status' => $request->status,
            'breed' => $request->breed,
            'updated_at' => now(), // Ensure the updated_at timestamp is updated
        ];
    
        // Handle the image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $updateData['image'] = $imagePath;
        }
    
        // Update the pig record using the query builder
        DB::table('pigs')
            ->where('pigId', $id)
            ->update($updateData);
    
        // Retrieve the updated pig record
        $pig = DB::table('pigs')->where('pigId', $id)->first();
    
        // Log the updated state of the pig
        Log::info('Updated Pig Data:', (array) $pig);
    
        return response()->json(['message' => 'Pig updated successfully', 'pig' => $pig]);
    }
public function getPigDetails($id)
{
    $pig = Pig::with('owner')->findOrFail($id);

    return response()->json([
        'pigId' => $pig->id,
        'date_of_birth' => $pig->date_of_birth,
        'breed' => $pig->breed,
        'weight' => $pig->weight,
        'min_price_per_kilo' => $pig->min_price_per_kilo,
        'max_price_per_kilo' => $pig->max_price_per_kilo,
        'location' => $pig->location,
        'owner_name' => $pig->owner->name, // Include owner's name
    ]);
}

public function addFeedback(Request $request, $pigId)
{
    $request->validate([
        'comment' => 'nullable|string',
        'rating' => 'required|integer|min:1|max:5',
    ]);

    $feedback = Feedback::create([
        'pig_id' => $pigId,
        'user_id' => Auth::id(),
        'comment' => $request->comment,
        'rating' => $request->rating,
    ]);

    return response()->json($feedback, 201);
}

public function getFeedback($pigId)
{
    $feedback = Feedback::where('pig_id', $pigId)->with('user')->get();
    return response()->json($feedback);
}
}