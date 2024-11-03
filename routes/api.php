<?php
// routes/api.php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VaccinationRecordController;
use App\Http\Controllers\PigFarmInformationController;
use App\Http\Controllers\BreedingRecordController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\PigController;
use App\Http\Controllers\BuyerPreferenceController;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/buyer/preferences', [BuyerPreferenceController::class, 'store'])->name('buyer.preferences.store');
    Route::get('/buyer/preferences', [BuyerPreferenceController::class, 'show'])->name('buyer.preferences.show');
});
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/pigfarminformation', [PigFarmInformationController::class, 'show']);
    Route::post('/pigfarminformation', [PigFarmInformationController::class, 'store']);
});
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('breeding-records', BreedingRecordController::class);
});
Route::get('/pigs', [PigController::class, 'index']);
Route::post('/pigs', [PigController::class, 'store']);
Route::middleware('auth:sanctum')->get('/expenses', [ExpenseController::class, 'index']);
Route::middleware('auth:sanctum')->post('/expenses', [ExpenseController::class, 'store']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/chat/messages', [ChatController::class, 'index']);
    Route::post('/chat/messages', [ChatController::class, 'store']);
});



Route::middleware('auth:sanctum')->group(function () {
    Route::get('/pigs/{pig}/vaccination-records', [VaccinationRecordController::class, 'index']);
    Route::post('/pigs/{pig}/vaccination-records', [VaccinationRecordController::class, 'store']);
    Route::get('/pigs/{pig}/vaccination-records/{id}', [VaccinationRecordController::class, 'show']);
    Route::put('/pigs/{pig}/vaccination-records/{id}', [VaccinationRecordController::class, 'update']);
    Route::delete('/pigs/{pig}/vaccination-records/{id}', [VaccinationRecordController::class, 'destroy']);
});