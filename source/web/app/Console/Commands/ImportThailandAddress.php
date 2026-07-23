<?php

namespace App\Console\Commands;

use App\Models\District;
use App\Models\Province;
use App\Models\Subdistrict;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportThailandAddress extends Command
{
    protected $signature = 'ppy:import-address';

    protected $description = 'Import Thailand province, district and subdistrict master data';

    public function handle(): int
    {
        $provinceFile = database_path('seed-data/address/province.json');
        $districtFile = database_path('seed-data/address/district.json');
        $subdistrictFile = database_path('seed-data/address/sub_district.json');

        foreach ([$provinceFile, $districtFile, $subdistrictFile] as $file) {
            if (! file_exists($file)) {
                $this->error("File not found: {$file}");

                return self::FAILURE;
            }
        }

        $provinces = json_decode(file_get_contents($provinceFile), true);
        $districts = json_decode(file_get_contents($districtFile), true);
        $subdistricts = json_decode(file_get_contents($subdistrictFile), true);

        if (! is_array($provinces) || ! is_array($districts) || ! is_array($subdistricts)) {
            $this->error('Invalid JSON data.');

            return self::FAILURE;
        }

        DB::transaction(function () use ($provinces, $districts, $subdistricts): void {
            foreach ($provinces as $item) {
                Province::updateOrCreate(
                    ['code' => str_pad((string) $item['id'], 2, '0', STR_PAD_LEFT)],
                    [
                        'name_th' => $item['name_th'],
                        'name_en' => $item['name_en'] ?? null,
                        'is_active' => true,
                        'sort_order' => (int) $item['id'],
                    ]
                );
            }

            foreach ($districts as $item) {
                $provinceCode = str_pad((string) $item['province_id'], 2, '0', STR_PAD_LEFT);

                $province = Province::where('code', $provinceCode)->first();

                if (! $province) {
                    continue;
                }

                District::updateOrCreate(
                    ['code' => (string) $item['id']],
                    [
                        'province_id' => $province->id,
                        'name_th' => $item['name_th'],
                        'name_en' => $item['name_en'] ?? null,
                        'is_active' => true,
                        'sort_order' => (int) $item['id'],
                    ]
                );
            }

            foreach ($subdistricts as $item) {
                $district = District::where('code', (string) $item['district_id'])->first();

                if (! $district) {
                    continue;
                }

                Subdistrict::updateOrCreate(
                    ['code' => (string) $item['id']],
                    [
                        'district_id' => $district->id,
                        'name_th' => $item['name_th'],
                        'name_en' => $item['name_en'] ?? null,
                        'postal_code' => isset($item['zip_code'])
                            ? (string) $item['zip_code']
                            : null,
                        'is_active' => true,
                        'sort_order' => (int) $item['id'],
                    ]
                );
            }
        });

        $this->info('Thailand address imported successfully.');
        $this->line('Provinces: '.Province::count());
        $this->line('Districts: '.District::count());
        $this->line('Subdistricts: '.Subdistrict::count());

        return self::SUCCESS;
    }
}