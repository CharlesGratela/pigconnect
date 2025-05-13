<?php
// routes/api.php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VaccinationRecordController;
use App\Http\Controllers\PigFarmInformationController;
use App\Http\Controllers\BreedingRecordController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\PigController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\BuyerPreferenceController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\FeedingScheduleController;
use App\Http\Controllers\BuyerInformationController;
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/analytics', [AnalyticsController::class, 'getAnalytics']);
    Route::get('/weather', [AnalyticsController::class, 'getWeather']);
});
Route::post('/feedingschedule', [FeedingScheduleController::class, 'store']);
Route::get('/feedingschedule', [FeedingScheduleController::class, 'show']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/buyerspreferencesstore', [BuyerPreferenceController::class, 'store']);
    Route::get('/buyerspreferencesget', [BuyerPreferenceController::class, 'show']);
});
Route::middleware('auth:sanctum')->get('/recommendations', [RecommendationController::class, 'recommend'])->name('recommendations');
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/pigfarminformation', [PigFarmInformationController::class, 'show']);
    Route::get('/pigfarminformation/buyer', [PigFarmInformationController::class, 'showBuyer']);
    Route::post('/pigfarminformation', [PigFarmInformationController::class, 'store']);
});
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('breeding-records', BreedingRecordController::class);
});

// Route to add feedback for a pig
Route::post('/pigs/{pigId}/feedback', [PigController::class, 'addFeedback'])->middleware('auth:sanctum');

// Route to get feedback for a pig
Route::get('/pigs/{pigId}/feedback', [PigController::class, 'getFeedback'])->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/pigs', [PigController::class, 'index']);
    Route::post('/pigs', [PigController::class, 'store']);
    Route::post('/pigs/update/{id}', [PigController::class, 'update']);
});
// Routes for Buyer Information
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/buyerinformation', [BuyerInformationController::class, 'getBuyerInformation']);
    Route::post('/buyerinformationstore', [BuyerInformationController::class, 'updateBuyerInformation']);
});
// Route to track user interaction
Route::post('/track_interaction', [RecommendationController::class, 'trackInteraction'])->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->get('/expenses', [ExpenseController::class, 'index']);
Route::middleware('auth:sanctum')->post('/expenses', [ExpenseController::class, 'store']);

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/chatlist', [ChatController::class, 'chatList'])->name('chat.list');
    Route::get('/chat/{userId}', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat', [ChatController::class, 'store'])->name('chat.store');
    Route::get('/chat/messages/{userId}', [ChatController::class, 'getMessages'])->name('chat.getMessages');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/pigs/{pig}/vaccination-records', [VaccinationRecordController::class, 'index']);
    Route::post('/pigs/{pig}/vaccination-records', [VaccinationRecordController::class, 'store']);
    Route::get('/pigs/{pig}/vaccination-records/{id}', [VaccinationRecordController::class, 'show']);
    Route::put('/pigs/{pig}/vaccination-records/{id}', [VaccinationRecordController::class, 'update']);
    Route::delete('/pigs/{pig}/vaccination-records/{id}', [VaccinationRecordController::class, 'destroy']);
});