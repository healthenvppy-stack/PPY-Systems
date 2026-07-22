<?php

namespace Database\Seeders;

use App\Models\BusinessCategory;
use Illuminate\Database\Seeder;

class BusinessCategorySeeder extends Seeder
{
    public function run(): void
    {
        $data = [

            ['FOOD','กิจการด้านอาหาร'],
            ['HAZARD','กิจการที่เป็นอันตรายต่อสุขภาพ'],
            ['MARKET','ตลาด'],
            ['PUBLIC','จำหน่ายสินค้าในที่หรือทางสาธารณะ'],
            ['ANIMAL','กิจการเกี่ยวกับสัตว์'],
            ['WASTE','กิจการเกี่ยวกับสิ่งปฏิกูล'],
            ['OTHER','กิจการอื่น'],

        ];

        foreach($data as $i=>$item){

            BusinessCategory::updateOrCreate(

                ['code'=>$item[0]],

                [

                    'name'=>$item[1],

                    'sort_order'=>$i+1,

                    'is_active'=>true

                ]

            );

        }
    }
}