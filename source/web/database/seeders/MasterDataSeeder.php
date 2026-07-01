<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterDataSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('titles')->insert([
            ['code'=>'MR','name_th'=>'นาย'],
            ['code'=>'MRS','name_th'=>'นาง'],
            ['code'=>'MS','name_th'=>'นางสาว'],
            ['code'=>'CH','name_th'=>'เด็กชาย'],
            ['code'=>'CG','name_th'=>'เด็กหญิง'],
        ]);

        DB::table('religions')->insert([
            ['code'=>'BUD','name_th'=>'พุทธ'],
            ['code'=>'CHR','name_th'=>'คริสต์'],
            ['code'=>'ISL','name_th'=>'อิสลาม'],
            ['code'=>'OTH','name_th'=>'อื่น ๆ'],
        ]);

        DB::table('nationalities')->insert([
            ['code'=>'TH','name_th'=>'ไทย'],
        ]);
    }
}