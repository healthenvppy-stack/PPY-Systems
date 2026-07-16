<?php

namespace App\Console\Commands;

use App\Models\BenefitType;
use App\Models\Citizen;
use App\Models\HealthProfile;
use App\Models\Household;
use App\Models\WelfareBenefit;
use App\Models\WelfareProfile;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Throwable;

class ImportDatapop extends Command
{
    protected $signature = 'datapop:import
                            {--dry-run : ตรวจสอบข้อมูลโดยไม่บันทึก}
                            {--limit=0 : จำกัดจำนวนรายการที่นำเข้า}';

    protected $description = 'Import population data from import_mysql.datapop';

    public function handle(): int
    {
        $dryRun = (bool) $this->option('dry-run');
        $limit = (int) $this->option('limit');

        $query = DB::connection('import_mysql')
            ->table('datapop')
            ->orderBy('id');

        if ($limit > 0) {
            $query->limit($limit);
        }

        $rows = $query->get();

        $stats = [
            'source' => $rows->count(),
            'households_created' => 0,
            'citizens_created' => 0,
            'citizens_updated' => 0,
            'duplicates' => 0,
            'invalid_cid' => 0,
            'errors' => 0,
        ];

        $elderlyBenefitTypeId = BenefitType::where(
            'code',
            'ELDERLY_ALLOWANCE'
        )->value('id');

        $this->info('เริ่มตรวจข้อมูล datapop จำนวน '.$rows->count().' รายการ');

        foreach ($rows as $row) {
            try {
                $cid = preg_replace('/\D+/', '', (string) $row->idcard);

                if (strlen($cid) !== 13) {
                    $stats['invalid_cid']++;
                    $this->warn("ข้าม ID {$row->id}: เลขบัตรไม่ครบ 13 หลัก");
                    continue;
                }

                [$title, $firstName, $lastName] = $this->splitFullName(
                    trim((string) $row->name)
                );

                $birthDate = $this->parseThaiDate($row->birthday);

                $houseNo = trim((string) $row->homenumADD);
                $moo = (int) $row->homenumM;

                // เก็บ house_no ตามต้นฉบับ เช่น 123/1
                // สร้างรหัสภายในโดยแปลง / เป็น - เช่น M03-123-1
                $houseCodePart = preg_replace('/[^0-9A-Za-zก-๙]+/u', '-', $houseNo);
                $houseCodePart = trim($houseCodePart, '-');

                $houseCode = sprintf(
                    'M%02d-%s',
                    $moo,
                    $houseCodePart
                );

                if ($dryRun) {
                    continue;
                }

                DB::transaction(function () use (
                    $row,
                    $cid,
                    $title,
                    $firstName,
                    $lastName,
                    $birthDate,
                    $houseNo,
                    $moo,
                    $houseCode,
                    $elderlyBenefitTypeId,
                    &$stats
                ) {
                    $household = Household::where('house_no', $houseNo)
                        ->where('moo', $moo)
                        ->first();

                    if (!$household) {
                        $finalHouseCode = $houseCode;

                        // ป้องกันกรณีรหัสเดิมในฐานข้อมูลชนกับบ้านอื่น
                        if (Household::where('house_code', $finalHouseCode)->exists()) {
                            $finalHouseCode = sprintf(
                                '%s-%s',
                                $houseCode,
                                substr(md5($moo.'|'.$houseNo), 0, 6)
                            );
                        }

                        $household = Household::create([
                            'house_no' => $houseNo,
                            'moo' => $moo,
                            'house_code' => $finalHouseCode,
                            'status' => true,
                        ]);

                        $stats['households_created']++;
                    }

                    if ($household->wasRecentlyCreated) {
                        $stats['households_created']++;
                    }

                    $citizen = Citizen::where('cid', $cid)->first();

                    $citizenData = [
                        'household_id' => $household->id,
                        'first_name' => $firstName,
                        'last_name' => $lastName,
                        'gender' => $row->sex,
                        'birth_date' => $birthDate,
                        'phone' => $row->contact ?: null,
                        //'status' => $row->status === 'เสียชีวิต' ? false : true,
                        'status' => match (trim((string) $row->status)) {
                                'ย้ายออก' => 'moved_out',
                                'เสียชีวิต' => 'deceased',
                                default => 'active',
                            },
                        ];

                    if ($citizen) {
                        $citizen->update($citizenData);
                        $stats['citizens_updated']++;
                    } else {
                        $citizen = Citizen::create(
                            ['cid' => $cid] + $citizenData
                        );

                        $stats['citizens_created']++;
                    }

                    $age = $birthDate
                        ? Carbon::parse($birthDate)->age
                        : null;

                    $isElderly = $age !== null && $age >= 60;

                    //$receivesElderlyAllowance =
                    //    trim((string) $row->welfare) === 'รับสวัสดิการ';

                    $receivesElderlyAllowance =
                        $isElderly &&
                        trim((string) $row->welfare) === 'รับสวัสดิการ';

                    WelfareProfile::updateOrCreate(
                        ['citizen_id' => $citizen->id],
                        [
                            'is_elderly' => $isElderly,
                            'receives_elderly_allowance' => $receivesElderlyAllowance,
                            'elderly_allowance_status' => $receivesElderlyAllowance
                                ? 'receiving'
                                : 'not_registered',
                            'is_disabled' => $row->healthy_state === 'พิการ',
                            'is_low_income' => false,
                            'is_vulnerable' => $row->healthy_state === 'ผู้มีภาวะพึ่งพิง',
                            'is_bedridden' => false,
                            'is_homebound' => false,
                            'care_level' => $row->healthy_state === 'ผู้มีภาวะพึ่งพิง'
                                ? 'watch'
                                : 'normal',
                            'risk_level' => $row->healthy_state === 'ผู้มีภาวะพึ่งพิง'
                                ? 'medium'
                                : 'low',
                            'priority_level' => 'normal',
                            'remark' => $row->remark ?: null,
                        ]
                    );

                    HealthProfile::updateOrCreate(
                        ['citizen_id' => $citizen->id],
                        [
                            'has_chronic_disease' => false,
                            'has_diabetes' => false,
                            'has_hypertension' => false,
                            'has_heart_disease' => false,
                            'has_kidney_disease' => false,
                            'is_bedridden' => false,
                            'is_homebound' => $row->healthy_state === 'ผู้มีภาวะพึ่งพิง',
                            'is_disabled' => $row->healthy_state === 'พิการ',
                            'is_elderly' => $isElderly,
                            'health_level' => match ($row->healthy_state) {
                                'ผู้มีภาวะพึ่งพิง' => 'orange',
                                'พิการ' => 'yellow',
                                default => 'green',
                            },
                            'remark' => $row->remark ?: null,
                        ]
                    );

                    if (
                        $receivesElderlyAllowance &&
                        $elderlyBenefitTypeId
                    ) {
                        WelfareBenefit::updateOrCreate(
                            [
                                'citizen_id' => $citizen->id,
                                'benefit_type_id' => $elderlyBenefitTypeId,
                            ],
                            [
                                'status' => 'receiving',
                                'agency' => 'เทศบาลตำบลโพธิ์พระยา',
                                'remark' => 'นำเข้าจากข้อมูล datapop',
                            ]
                        );
                    }
                });
            } catch (Throwable $e) {
                $stats['errors']++;
                $this->error(
                    "ID {$row->id}: {$e->getMessage()}"
                );
            }
        }

        $this->newLine();
        $this->table(
            ['รายการ', 'จำนวน'],
            [
                ['ข้อมูลต้นทาง', $stats['source']],
                ['สร้างครัวเรือน', $stats['households_created']],
                ['สร้างประชาชน', $stats['citizens_created']],
                ['อัปเดตประชาชน', $stats['citizens_updated']],
                ['เลขบัตรไม่ครบ 13 หลัก', $stats['invalid_cid']],
                ['ข้อผิดพลาด', $stats['errors']],
            ]
        );

        if ($dryRun) {
            $this->warn('DRY RUN: ยังไม่มีการบันทึกข้อมูล');
        }

        return self::SUCCESS;
    }

    private function splitFullName(string $fullName): array
    {
        $titles = ['นาย', 'นางสาว', 'นาง', 'เด็กชาย', 'เด็กหญิง' , 'ด.ช.' , 'ด.ญ.'];

        $title = null;

        foreach ($titles as $candidate) {
            if (Str::startsWith($fullName, $candidate)) {
                $title = $candidate;
                $fullName = trim(Str::after($fullName, $candidate));
                break;
            }
        }

        $parts = preg_split('/\s+/', $fullName, -1, PREG_SPLIT_NO_EMPTY);

        $firstName = $parts[0] ?? '-';
        $lastName = count($parts) > 1
            ? implode(' ', array_slice($parts, 1))
            : '-';

        return [$title, $firstName, $lastName];
    }

    private function parseThaiDate(?string $value): ?string
    {
        if (!$value) {
            return null;
        }

        $value = trim($value);

        try {
            if (preg_match('/^(\d{4})-(\d{2})-(\d{2})$/', $value, $match)) {
                $year = (int) $match[1];

                if ($year > 2400) {
                    $year -= 543;
                }

                return sprintf(
                    '%04d-%02d-%02d',
                    $year,
                    (int) $match[2],
                    (int) $match[3]
                );
            }

            if (preg_match('/^(\d{2})[\/-](\d{2})[\/-](\d{4})$/', $value, $match)) {
                $year = (int) $match[3];

                if ($year > 2400) {
                    $year -= 543;
                }

                return sprintf(
                    '%04d-%02d-%02d',
                    $year,
                    (int) $match[2],
                    (int) $match[1]
                );
            }
        } catch (Throwable) {
            return null;
        }

        return null;
    }
}
