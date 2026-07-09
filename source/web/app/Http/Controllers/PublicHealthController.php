<?php

namespace App\Http\Controllers;

use App\Models\HealthProfile;
use App\Models\ServiceCase;

class PublicHealthController extends Controller
{
    public function dashboard()
    {
        $chronic = HealthProfile::where('has_chronic_disease', true)->count();
        $diabetes = HealthProfile::where('has_diabetes', true)->count();
        $hypertension = HealthProfile::where('has_hypertension', true)->count();
        $bedridden = HealthProfile::where('is_bedridden', true)->count();
        $homebound = HealthProfile::where('is_homebound', true)->count();

        $green = HealthProfile::where('health_level', 'green')->count();
        $yellow = HealthProfile::where('health_level', 'yellow')->count();
        $orange = HealthProfile::where('health_level', 'orange')->count();
        $red = HealthProfile::where('health_level', 'red')->count();

        $latestCases = ServiceCase::with('citizen')
            ->where('module', 'public_health')
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();

        return view('public_health.dashboard', compact(
            'chronic',
            'diabetes',
            'hypertension',
            'bedridden',
            'homebound',
            'green',
            'yellow',
            'orange',
            'red',
            'latestCases'
        ));
    }
}