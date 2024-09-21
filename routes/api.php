<?php
// routes/api.php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PigFarmInformationController;
use App\Http\Controllers\ExpenseController;
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/pigfarminformation', [PigFarmInformationController::class, 'show']);
    Route::post('/pigfarminformation', [PigFarmInformationController::class, 'store']);
});
Route::middleware('auth:sanctum')->get('/expenses', [ExpenseController::class, 'index']);
Route::middleware('auth:sanctum')->post('/expenses', [ExpenseController::class, 'store']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/chat/messages', [ChatController::class, 'index']);
    Route::post('/chat/messages', [ChatController::class, 'store']);
});