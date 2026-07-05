<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CitizenController;
use App\Http\Controllers\HouseholdController;
use App\Http\Controllers\PopulationDashboardController;
use App\Http\Controllers\ModuleController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('citizens', CitizenController::class);

    Route::resource('households', HouseholdController::class);

    Route::get('/population/dashboard',
    [PopulationDashboardController::class,'index'])
    ->name('population.dashboard');

    Route::get('/modules/population', [ModuleController::class, 'population'])
    ->name('modules.population');

    
});

require __DIR__.'/auth.php';
