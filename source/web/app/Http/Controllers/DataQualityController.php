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

    public function duplicateCitizens()
    {
        $duplicateCids = DB::connection('import_mysql')
            ->table('datapop')
            ->select('idcard')
            ->whereRaw(
                "CHAR_LENGTH(REPLACE(REPLACE(TRIM(idcard), '-', ''), ' ', '')) = 13"
            )
            ->groupBy('idcard')
            ->havingRaw('COUNT(*) > 1')
            ->pluck('idcard');

        $records = DB::connection('import_mysql')
            ->table('datapop')
            ->whereIn('idcard', $duplicateCids)
            ->orderBy('idcard')
            ->orderBy('id')
            ->get();

        return view('data_quality.duplicates', compact('records'));
    }

    public function invalidCitizens()
    {
        $records = DB::connection('import_mysql')
            ->table('datapop')
            ->whereRaw(
                "CHAR_LENGTH(REPLACE(REPLACE(TRIM(idcard), '-', ''), ' ', '')) <> 13"
            )
            ->orderBy('id')
            ->get();

        return view('data_quality.invalid_cids', compact('records'));
    }

    public function incompleteCitizens()
    {
        $citizens = Citizen::with('household')
            ->where(function ($query) {
                $query->whereNull('household_id')
                    ->orWhereNull('birth_date')
                    ->orWhereNull('phone')
                    ->orWhere('phone', '');
            })
            ->orderBy('first_name')
            ->paginate(30);

        return view('data_quality.incomplete', compact('citizens'));
    }
}