<?php

namespace Database\Seeders;

use App\Models\BusinessGroup;
use Illuminate\Database\Seeder;

class BusinessGroupSeeder extends Seeder
{
    public function run(): void
    {
        $groups = [
            [
                'code' => 'FOOD',
                'name' => 'กิจการด้านอาหาร',
                'sort_order' => 1,
            ],
            [
                'code' => 'HAZARDOUS',
                'name' => 'กิจการที่เป็นอันตรายต่อสุขภาพ',
                'sort_order' => 2,
            ],
            [
                'code' => 'MARKET',
                'name' => 'กิจการตลาด',
                'sort_order' => 3,
            ],
            [
                'code' => 'PUBLIC_PLACE',
                'name' => 'การจำหน่ายสินค้าในที่หรือทางสาธารณะ',
                'sort_order' => 4,
            ],
            [
                'code' => 'ANIMAL',
                'name' => 'กิจการเกี่ยวกับสัตว์',
                'sort_order' => 5,
            ],
            [
                'code' => 'WASTE',
                'name' => 'กิจการเกี่ยวกับสิ่งปฏิกูลหรือมูลฝอย',
                'sort_order' => 6,
            ],
            [
                'code' => 'OTHER',
                'name' => 'กิจการอื่น',
                'sort_order' => 99,
            ],
        ];

        foreach ($groups as $group) {
            BusinessGroup::updateOrCreate(
                ['code' => $group['code']],
                [
                    'name' => $group['name'],
                    'description' => null,
                    'is_active' => true,
                    'sort_order' => $group['sort_order'],
                ]
            );
        }
    }
}