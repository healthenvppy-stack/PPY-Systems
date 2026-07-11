<?php

namespace Database\Seeders;

use App\Models\BenefitType;
use Illuminate\Database\Seeder;

class BenefitTypeSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'code' => 'ELDERLY_ALLOWANCE',
                'name_th' => 'เบี้ยยังชีพผู้สูงอายุ',
                'name_en' => 'Elderly Allowance',
                'category' => 'allowance',
            ],
            [
                'code' => 'DISABILITY_ALLOWANCE',
                'name_th' => 'เบี้ยความพิการ',
                'name_en' => 'Disability Allowance',
                'category' => 'allowance',
            ],
            [
                'code' => 'AIDS_ALLOWANCE',
                'name_th' => 'เงินสงเคราะห์ผู้ป่วยเอดส์',
                'name_en' => 'AIDS Allowance',
                'category' => 'allowance',
            ],
            [
                'code' => 'NEWBORN_SUPPORT',
                'name_th' => 'เงินอุดหนุนเด็กแรกเกิด',
                'name_en' => 'Newborn Support',
                'category' => 'subsidy',
            ],
            [
                'code' => 'HOUSING_SUPPORT',
                'name_th' => 'เงินช่วยเหลือด้านที่อยู่อาศัย',
                'name_en' => 'Housing Support',
                'category' => 'assistance',
            ],
            [
                'code' => 'SCHOLARSHIP',
                'name_th' => 'ทุนการศึกษา',
                'name_en' => 'Scholarship',
                'category' => 'education',
            ],
            [
                'code' => 'FUNERAL_SUPPORT',
                'name_th' => 'เงินสงเคราะห์ค่าจัดการศพ',
                'name_en' => 'Funeral Support',
                'category' => 'assistance',
            ],
            [
                'code' => 'OTHER',
                'name_th' => 'สิทธิประโยชน์อื่น ๆ',
                'name_en' => 'Other Benefit',
                'category' => 'other',
            ],
        ];

        foreach ($items as $item) {
            BenefitType::updateOrCreate(
                ['code' => $item['code']],
                $item + ['is_active' => true]
            );
        }
    }
}