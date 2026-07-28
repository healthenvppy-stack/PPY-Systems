<?php

namespace Database\Seeders;

use App\Models\BusinessCategory;
use App\Models\BusinessGroup;
use Illuminate\Database\Seeder;

class BusinessCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'group_code' => 'FOOD',
                'code' => 'FOOD_RESTAURANT',
                'name' => 'สถานที่จำหน่ายอาหาร',
                'sort_order' => 1,
            ],
            [
                'group_code' => 'FOOD',
                'code' => 'FOOD_STORAGE',
                'name' => 'สถานที่สะสมอาหาร',
                'sort_order' => 2,
            ],
            [
                'group_code' => 'HAZARDOUS',
                'code' => 'HAZ_GENERAL',
                'name' => 'กิจการที่เป็นอันตรายต่อสุขภาพ',
                'sort_order' => 1,
            ],
            [
                'group_code' => 'MARKET',
                'code' => 'MARKET_GENERAL',
                'name' => 'ตลาด',
                'sort_order' => 1,
            ],
            [
                'group_code' => 'PUBLIC_PLACE',
                'code' => 'PUBLIC_SELLING',
                'name' => 'การจำหน่ายสินค้าในที่หรือทางสาธารณะ',
                'sort_order' => 1,
            ],
            [
                'group_code' => 'ANIMAL',
                'code' => 'ANIMAL_CONTROL',
                'name' => 'การควบคุมการเลี้ยงหรือปล่อยสัตว์',
                'sort_order' => 1,
            ],
            [
                'group_code' => 'WASTE',
                'code' => 'WASTE_COLLECTION',
                'name' => 'การเก็บ ขน หรือกำจัดสิ่งปฏิกูลและมูลฝอย',
                'sort_order' => 1,
            ],
            [
                'group_code' => 'OTHER',
                'code' => 'OTHER_GENERAL',
                'name' => 'กิจการอื่น',
                'sort_order' => 99,
            ],
        ];

        foreach ($categories as $category) {
            $group = BusinessGroup::where('code', $category['group_code'])->firstOrFail();

            BusinessCategory::updateOrCreate(
                ['code' => $category['code']],
                [
                    'business_group_id' => $group->id,
                    'name' => $category['name'],
                    'description' => null,
                    'is_active' => true,
                    'sort_order' => $category['sort_order'],
                ]
            );
        }
    }
}