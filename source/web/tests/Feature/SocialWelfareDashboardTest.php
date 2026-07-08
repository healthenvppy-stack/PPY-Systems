<?php

namespace Tests\Feature;

use App\Models\Citizen;
use App\Models\Household;
use App\Models\ServiceCase;
use App\Models\User;
use App\Models\WelfareProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SocialWelfareDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_social_welfare_dashboard_displays_summary_and_latest_cases(): void
    {
        $user = User::factory()->create();

        $household = Household::create([
            'house_code' => 'H001',
            'house_no' => '1',
            'status' => true,
        ]);

        $citizen = Citizen::create([
            'household_id' => $household->id,
            'cid' => '1234567890123',
            'first_name' => 'สมชาย',
            'last_name' => 'ใจดี',
            'gender' => 'ชาย',
            'status' => true,
        ]);

        WelfareProfile::create([
            'citizen_id' => $citizen->id,
            'is_elderly' => true,
            'is_disabled' => true,
            'is_low_income' => true,
            'is_bedridden' => true,
            'is_homebound' => true,
        ]);

        ServiceCase::create([
            'case_no' => 'SW-001',
            'citizen_id' => $citizen->id,
            'module' => 'social_welfare',
            'case_type' => 'ช่วยเหลือพื้นฐาน',
            'status' => 'open',
            'priority' => 'urgent',
            'opened_at' => now()->toDateString(),
            'created_by' => $user->id,
            'assigned_to' => $user->id,
            'remark' => 'ทดสอบ',
        ]);

        $response = $this->actingAs($user)->get(route('social-welfare.dashboard'));

        $response->assertOk();
        $response->assertSee('Dashboard สวัสดิการ');
        $response->assertSee('ผู้สูงอายุ');
        $response->assertSee('เคสล่าสุด');
    }
}
