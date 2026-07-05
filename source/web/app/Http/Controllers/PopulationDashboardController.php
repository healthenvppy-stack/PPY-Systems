<?php

namespace App\Http\Controllers;

use App\Models\Citizen;
use App\Models\Household;

class PopulationDashboardController extends Controller
{
    public function index()
    {
        $totalCitizens = Citizen::count();

        $male = Citizen::where('gender', 'ชาย')->count();

        $female = Citizen::where('gender', 'หญิง')->count();

        $totalHouseholds = Household::count();

        $green = Household::where('flood_level',0)->count();

        $yellow = Household::where('flood_level',2)->count();

        $orange = Household::where('flood_level',3)->count();

        $red = Household::where('flood_level',4)->count();

        return view(
            'population.dashboard',
            compact(
                'totalCitizens',
                'male',
                'female',
                'totalHouseholds',
                'green',
                'yellow',
                'orange',
                'red'
            )
        );
    }
}