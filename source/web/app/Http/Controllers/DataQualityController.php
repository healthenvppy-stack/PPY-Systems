<?php

namespace App\Http\Controllers;

use App\Models\Citizen;
use Illuminate\Support\Facades\DB;

class DataQualityController extends Controller
{
    public function index()
    {
        $sourceTotal = DB::connection('import_mysql')
            ->table('datapop')
            ->count();

        $invalidCidCount = DB::connection('import_mysql')
            ->table('datapop')
            ->whereRaw(
                "CHAR_LENGTH(REPLACE(REPLACE(TRIM(idcard), '-', ''), ' ', '')) <> 13"
            )
            ->count();

        $validSourceCount = DB::connection('import_mysql')
            ->table('datapop')
            ->whereRaw(
                "CHAR_LENGTH(REPLACE(REPLACE(TRIM(idcard), '-', ''), ' ', '')) = 13"
            )
            ->count();

        $uniqueValidCidCount = DB::connection('import_mysql')
            ->table('datapop')
            ->whereRaw(
                "CHAR_LENGTH(REPLACE(REPLACE(TRIM(idcard), '-', ''), ' ', '')) = 13"
            )
            ->distinct()
            ->count('idcard');

        $duplicateRowsCount = $validSourceCount - $uniqueValidCidCount;

        $importedCitizens = Citizen::count();

        $missingHousehold = Citizen::whereNull('household_id')->count();
        $missingBirthDate = Citizen::whereNull('birth_date')->count();
        $missingPhone = Citizen::whereNull('phone')
            ->orWhere('phone', '')
            ->count();

        $genderSummary = Citizen::query()
            ->select('gender', DB::raw('COUNT(*) as total'))
            ->groupBy('gender')
            ->orderBy('gender')
            ->get();

        return view('data_quality.index', compact(
            'sourceTotal',
            'invalidCidCount',
            'validSourceCount',
            'uniqueValidCidCount',
            'duplicateRowsCount',
            'importedCitizens',
            'missingHousehold',
            'missingBirthDate',
            'missingPhone',
            'genderSummary'
        ));
    }
}