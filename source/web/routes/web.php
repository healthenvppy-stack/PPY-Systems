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
use App\Http\Controllers\DataQualityController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\BusinessCategoryController;
use App\Http\Controllers\BusinessTypeController;
use App\Http\Controllers\ShopLicenseDashboardController;
use App\Http\Controllers\LicenseTemplateController;
use App\Http\Controllers\BusinessGroupController;
use App\Http\Controllers\ShopLicense\BusinessController;
use App\Http\Controllers\CitizenLookupController;


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

    Route::get(
        '/citizens/lookup',
        [CitizenLookupController::class, 'show']
    )->name('citizens.lookup');

    Route::resource('citizens', CitizenController::class)
        ->where(['citizen' => '[0-9]+']);

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

    Route::get('/data-quality', [DataQualityController::class, 'index'])
    ->name('data-quality.index');

    Route::get('/data-quality/duplicates', [DataQualityController::class, 'duplicateCitizens'])
    ->name('data-quality.duplicates');

    Route::get('/data-quality/invalid-cids', [DataQualityController::class, 'invalidCitizens'])
        ->name('data-quality.invalid-cids');

    Route::get('/data-quality/incomplete', [DataQualityController::class, 'incompleteCitizens'])
        ->name('data-quality.incomplete');

    

    Route::prefix('api/address')
    ->name('api.address.')
    ->group(function () {
        Route::get('/provinces', [AddressController::class, 'provinces'])
            ->name('provinces');

        Route::get('/provinces/{province}/districts', [
                AddressController::class,
                'districts',
            ])->name('districts');

        Route::get('/districts/{district}/subdistricts', [
                AddressController::class,
                'subdistricts',
            ])->name('subdistricts');
        });

    Route::middleware(['auth'])
    ->prefix('shop-license')
    ->name('shop-license.')
    ->group(function () {

        Route::get(
                '/',
                [ShopLicenseDashboardController::class, 'index']
            )->name('dashboard');

        Route::resource('business-groups', BusinessGroupController::class);

        Route::resource('business-categories', BusinessCategoryController::class);

        Route::resource('business-types', BusinessTypeController::class);

        Route::resource(
                'license-templates',
                LicenseTemplateController::class
            );
        Route::resource('businesses', BusinessController::class);
    });   
    
    
});

require __DIR__.'/auth.php';
