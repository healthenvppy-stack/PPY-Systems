<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CitizenController;
use App\Http\Controllers\HouseholdController;
use App\Http\Controllers\PopulationDashboardController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ServiceCaseController;
use App\Http\Controllers\SocialWelfareController;
use App\Http\Controllers\WelfareProfileController;
use App\Http\Controllers\HealthProfileController;
use App\Http\Controllers\PublicHealthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WelfareBenefitController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

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

    Route::resource('service-cases', ServiceCaseController::class);

    Route::get('/social-welfare/dashboard', [SocialWelfareController::class, 'dashboard'])
    ->name('social-welfare.dashboard');
    
    Route::get('/citizens/{citizen}/welfare-profile/edit', [WelfareProfileController::class, 'edit'])
    ->name('citizens.welfare-profile.edit');

    Route::put('/citizens/{citizen}/welfare-profile', [WelfareProfileController::class, 'update'])
        ->name('citizens.welfare-profile.update');

    Route::get('/citizens/{citizen}/service-cases/create',
    [ServiceCaseController::class, 'createForCitizen'])
    ->name('citizens.service-cases.create');

    Route::patch('/service-cases/{serviceCase}/status',
    [ServiceCaseController::class, 'updateStatus'])
    ->name('service-cases.update-status');

    Route::post('/service-cases/{serviceCase}/timeline',
    [ServiceCaseController::class,'storeTimeline'])
    ->name('service-cases.timeline.store');

    Route::get('/citizens/{citizen}/health-profile/edit',
    [HealthProfileController::class, 'edit'])
    ->name('citizens.health-profile.edit');

    Route::put('/citizens/{citizen}/health-profile',
    [HealthProfileController::class, 'update'])
    ->name('citizens.health-profile.update');

    Route::get('/public-health/dashboard',
    [PublicHealthController::class, 'dashboard'])
    ->name('public-health.dashboard');

    Route::get('/citizens/{citizen}/health-cases/create',
    [ServiceCaseController::class, 'createHealthForCitizen'])
    ->name('citizens.health-cases.create');

    Route::get('/citizens/{citizen}/benefits/create',
    [WelfareBenefitController::class, 'create'])
    ->name('citizens.benefits.create');

    Route::post('/citizens/{citizen}/benefits',
        [WelfareBenefitController::class, 'store'])
        ->name('citizens.benefits.store');

    Route::get('/citizens/{citizen}/benefits/{welfareBenefit}/edit',
    [WelfareBenefitController::class, 'edit']
        )->name('citizens.benefits.edit');

    Route::put('/citizens/{citizen}/benefits/{welfareBenefit}',
    [WelfareBenefitController::class, 'update']
        )->name('citizens.benefits.update');

    Route::delete('/citizens/{citizen}/benefits/{welfareBenefit}',
    [WelfareBenefitController::class, 'destroy']
        )->name('citizens.benefits.destroy');
});

require __DIR__.'/auth.php';
