<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
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

Route::get('/pigfarminformation', function () {
    return Inertia::render('FarmerView/FarmInformation');
})->middleware(['auth', 'verified'])->name('farmer.pigfarminformation');
Route::get('/farmerdashboard', function () {
    return Inertia::render('FarmerDashboard');
})->middleware(['auth', 'verified'])->name('farmer.dashboard');
Route::get('/buyerdashboard', function () {
    return Inertia::render('BuyerDashboard');
})->middleware(['auth', 'verified'])->name('buyer.dashboard');
Route::get('/admin', function () {
    return Inertia::render('AdminDashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
