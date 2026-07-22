<?php

namespace Database\Seeders;

use App\Models\BusinessCategory;
use App\Models\LicenseType;
use Illuminate\Database\Seeder;

class LicenseTypeSeeder extends Seeder
{
    public function run(): void
    {
        $food = BusinessCategory::where('code','FOOD')->first();

        LicenseType::updateOrCreate(

            ['code'=>'FOOD_LICENSE'],

            [

                'name'=>'ใบอนุญาตจัดตั้งสถานที่จำหน่ายอาหาร',

                'business_category_id'=>$food->id,

                'valid_month'=>12,

                'renew_before_day'=>30,

                'need_inspection'=>true,

                'need_payment'=>true,

                'is_active'=>true

            ]

        );

        LicenseType::updateOrCreate(

            ['code'=>'FOOD_NOTICE'],

            [

                'name'=>'หนังสือรับรองการแจ้งสถานที่สะสมอาหาร',

                'business_category_id'=>$food->id,

                'valid_month'=>12,

                'renew_before_day'=>30,

                'need_inspection'=>true,

                'need_payment'=>true,

                'is_active'=>true

            ]

        );

    }
}