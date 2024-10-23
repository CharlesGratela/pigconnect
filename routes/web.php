<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FarmInformationController;
use App\Http\Controllers\PigFarmInformationController;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/expenses',function () {
    
    return Inertia::render('FarmerView/Expenses');
} )->middleware(['auth', 'verified'])->name('farmer.expenses');
Route::post('/pigfarminformation', [PigFarmInformationController::class, 'store'])->middleware(['auth', 'verified']);
Route::get('/pigfarminformation', function () {
    
    return Inertia::render('FarmerView/FarmInformation');
    
})->middleware(['auth', 'verified'])->name('farmer.pigfarminformation');
Route::get('/breedingrecord', function () {
    
    return Inertia::render('FarmerView/BreedingRecord');
    
})->middleware(['auth', 'verified'])->name('farmer.breedingrecord');
Route::get('/farmerdashboard', function () {
    return Inertia::render('FarmerDashboard');
})->middleware(['auth', 'verified'])->name('farmer.dashboard');
Route::get('/piginformation', function () {
    return Inertia::render('FarmerView/PigInformation');
})->middleware(['auth', 'verified'])->name('pig.information');
Route::get('/buyerdashboard', function () {
    return Inertia::render('BuyerDashboard');
})->middleware(['auth', 'verified'])->name('buyer.dashboard');
Route::get('/admin', function () {
    return Inertia::render('AdminDashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');

Route::get('/chat', function () {
    return Inertia::render('Chat');
})->name('chat');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
 
});


require __DIR__.'/auth.php';
