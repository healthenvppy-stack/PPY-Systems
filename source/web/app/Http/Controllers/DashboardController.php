<?php

namespace App\Http\Controllers;

use App\Models\Citizen;
use App\Models\HealthProfile;
use App\Models\Household;
use App\Models\ServiceCase;
use App\Models\WelfareProfile;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCitizens = Citizen::count();
        $totalHouseholds = Household::count();

        $elderly = WelfareProfile::where('is_elderly', true)->count();
        $disabled = WelfareProfile::where('is_disabled', true)->count();
        $welfareBedridden = WelfareProfile::where('is_bedridden', true)->count();

        $chronic = HealthProfile::where('has_chronic_disease', true)->count();
        $diabetes = HealthProfile::where('has_diabetes', true)->count();
        $hypertension = HealthProfile::where('has_hypertension', true)->count();

        $openCases = ServiceCase::where('status', 'open')->count();

        $processingCases = ServiceCase::whereIn('status', [
            'assessing',
            'approved',
            'processing',
            'follow_up',
        ])->count();

        $closedCases = ServiceCase::where('status', 'closed')->count();

        return view('dashboard', compact(
            'totalCitizens',
            'totalHouseholds',
            'elderly',
            'disabled',
            'welfareBedridden',
            'chronic',
            'diabetes',
            'hypertension',
            'openCases',
            'processingCases',
            'closedCases'
        ));
    }
}