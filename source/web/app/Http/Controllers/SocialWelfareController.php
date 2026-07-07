<?php

namespace App\Http\Controllers;

use App\Models\ServiceCase;
use App\Models\WelfareProfile;

class SocialWelfareController extends Controller
{
    public function dashboard()
    {
        $elderly = WelfareProfile::where('is_elderly', true)->count();
        $disabled = WelfareProfile::where('is_disabled', true)->count();
        $lowIncome = WelfareProfile::where('is_low_income', true)->count();
        $bedridden = WelfareProfile::where('is_bedridden', true)->count();
        $homebound = WelfareProfile::where('is_homebound', true)->count();

        $openCases = ServiceCase::where('module', 'social_welfare')
            ->where('status', 'open')
            ->count();

        $urgentCases = ServiceCase::where('module', 'social_welfare')
            ->whereIn('priority', ['urgent', 'emergency'])
            ->count();

        $latestCases = ServiceCase::with('citizen')
            ->where('module', 'social_welfare')
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();

        return view('social_welfare.dashboard', compact(
            'elderly',
            'disabled',
            'lowIncome',
            'bedridden',
            'homebound',
            'openCases',
            'urgentCases',
            'latestCases'
        ));
    }
}