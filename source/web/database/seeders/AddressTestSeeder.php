<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Province;
use App\Models\Subdistrict;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressTestSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function (): void {
            $province = Province::updateOrCreate(
                ['code' => '72'],
                [
                    'name_th' => 'สุพรรณบุรี',
                    'name_en' => 'Suphan Buri',
                    'is_active' => true,
                    'sort_order' => 72,
                ]
            );

            $district = District::updateOrCreate(
                ['code' => '7201'],
                [
                    'province_id' => $province->id,
                    'name_th' => 'เมืองสุพรรณบุรี',
                    'name_en' => 'Mueang Suphan Buri',
                    'is_active' => true,
                    'sort_order' => 1,
                ]
            );

            Subdistrict::updateOrCreate(
                ['code' => '720110'],
                [
                    'district_id' => $district->id,
                    'name_th' => 'โพธิ์พระยา',
                    'name_en' => 'Pho Phraya',
                    'postal_code' => '72000',
                    'is_active' => true,
                    'sort_order' => 10,
                ]
            );
        });
    }
}