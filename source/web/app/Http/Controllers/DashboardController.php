<?php

namespace App\Http\Controllers;

use App\Models\Citizen;
use App\Models\HealthProfile;
use App\Models\Household;
use App\Models\ServiceCase;
use App\Models\WelfareProfile;
use App\Models\BenefitType;
use App\Models\WelfareBenefit;
use Illuminate\Support\Facades\DB;


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

        $elderlyAllowanceTypeId = BenefitType::where(
            'code',
            'ELDERLY_ALLOWANCE'
        )->value('id');

        $disabilityAllowanceTypeId = BenefitType::where(
            'code',
            'DISABILITY_ALLOWANCE'
        )->value('id');

        $elderlyAllowanceRecipients = WelfareBenefit::where(
            'benefit_type_id',
            $elderlyAllowanceTypeId
        )
            ->where('status', 'receiving')
            ->distinct('citizen_id')
            ->count('citizen_id');

        $disabledAllowanceRecipients = WelfareBenefit::where(
            'benefit_type_id',
            $disabilityAllowanceTypeId
        )
            ->where('status', 'receiving')
            ->distinct('citizen_id')
            ->count('citizen_id');

        $elderlyWithoutAllowance = max(
            $elderly - $elderlyAllowanceRecipients,
            0
        );

        $pendingBenefits = WelfareBenefit::where('status', 'pending')->count();

        $totalCitizens = Citizen::count();

        $totalMale = Citizen::where('gender', 'ชาย')->count();

        $totalFemale = Citizen::where('gender', 'หญิง')->count();

        $totalHouseholds = Household::count();

        $populationByVillage = Citizen::query()
            ->join('households', 'citizens.household_id', '=', 'households.id')
            ->select(
                'households.moo',
                DB::raw('COUNT(DISTINCT households.id) as household_count'),
                DB::raw('COUNT(citizens.id) as population_count'),
                DB::raw("SUM(CASE WHEN citizens.gender = 'ชาย' THEN 1 ELSE 0 END) as male_count"),
                DB::raw("SUM(CASE WHEN citizens.gender = 'หญิง' THEN 1 ELSE 0 END) as female_count")
            )
            ->whereNotNull('households.moo')
            ->groupBy('households.moo')
            ->orderBy('households.moo')
            ->get();
        
        $today = now()->toDateString();

        $ageGroups = [
            'age_0_2' => Citizen::whereNotNull('birth_date')
                ->whereRaw('TIMESTAMPDIFF(YEAR, birth_date, ?) BETWEEN 0 AND 2', [$today])
                ->count(),

            'age_3_5' => Citizen::whereNotNull('birth_date')
                ->whereRaw('TIMESTAMPDIFF(YEAR, birth_date, ?) BETWEEN 3 AND 5', [$today])
                ->count(),

            'age_6_12' => Citizen::whereNotNull('birth_date')
                ->whereRaw('TIMESTAMPDIFF(YEAR, birth_date, ?) BETWEEN 6 AND 12', [$today])
                ->count(),

            'age_13_18' => Citizen::whereNotNull('birth_date')
                ->whereRaw('TIMESTAMPDIFF(YEAR, birth_date, ?) BETWEEN 13 AND 18', [$today])
                ->count(),

            'age_19_35' => Citizen::whereNotNull('birth_date')
                ->whereRaw('TIMESTAMPDIFF(YEAR, birth_date, ?) BETWEEN 19 AND 35', [$today])
                ->count(),

            'age_36_59' => Citizen::whereNotNull('birth_date')
                ->whereRaw('TIMESTAMPDIFF(YEAR, birth_date, ?) BETWEEN 36 AND 59', [$today])
                ->count(),

            'age_60_plus' => Citizen::whereNotNull('birth_date')
                ->whereRaw('TIMESTAMPDIFF(YEAR, birth_date, ?) >= 60', [$today])
                ->count(),
        ];

        $oldestCitizen = Citizen::with('household')
            ->whereNotNull('birth_date')
            ->orderBy('birth_date')
            ->first();

        $oldestCitizenAge = $oldestCitizen?->birth_date
            ? $oldestCitizen->birth_date->age
            : null;

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
            'closedCases',
            'elderlyAllowanceRecipients',
            'disabledAllowanceRecipients',
            'elderlyWithoutAllowance',
            'pendingBenefits',
            'totalMale',
            'totalFemale',
            'populationByVillage',
            'ageGroups',
            'oldestCitizen',
            'oldestCitizenAge'
        ));
    }
}