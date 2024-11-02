<?php
namespace App\Http\Controllers;

use App\Models\Pig;
use App\Models\PigFarmInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PigController extends Controller
{
    public function index()
    {
        // Get the authenticated user's ID
        $userId = Auth::id();

        // Fetch the pigs based on the pigfarmID
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

        return response()->json($pig, 201);
    }
}