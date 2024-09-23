<?php
namespace App\Http\Controllers;

use App\Models\Pig;
use Illuminate\Http\Request;

class PigController extends Controller
{
    public function index()
    {
        return response()->json(Pig::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'pigfarmID' => 'required|integer',
            'weight' => 'required|numeric',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female',
            'status' => 'required|string',
        ]);

        $pig = Pig::create($request->all());

        return response()->json($pig, 201);
    }
}