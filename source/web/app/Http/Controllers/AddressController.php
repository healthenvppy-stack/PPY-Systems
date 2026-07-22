<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Province;
use Illuminate\Http\JsonResponse;

class AddressController extends Controller
{
    public function provinces(): JsonResponse
    {
        $provinces = Province::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name_th')
            ->get([
                'id',
                'code',
                'name_th',
                'name_en',
            ]);

        return response()->json([
            'success' => true,
            'data' => $provinces,
        ]);
    }

    public function districts(Province $province): JsonResponse
    {
        $districts = $province->districts()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name_th')
            ->get([
                'id',
                'province_id',
                'code',
                'name_th',
                'name_en',
            ]);

        return response()->json([
            'success' => true,
            'data' => $districts,
        ]);
    }

    public function subdistricts(District $district): JsonResponse
    {
        $subdistricts = $district->subdistricts()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name_th')
            ->get([
                'id',
                'district_id',
                'code',
                'name_th',
                'name_en',
                'postal_code',
            ]);

        return response()->json([
            'success' => true,
            'data' => $subdistricts,
        ]);
    }
}