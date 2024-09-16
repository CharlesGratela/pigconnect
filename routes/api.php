<?php
// routes/api.php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PigFarmInformationController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/pigfarminformation', [PigFarmInformationController::class, 'show']);
    Route::post('/pigfarminformation', [PigFarmInformationController::class, 'store']);
});