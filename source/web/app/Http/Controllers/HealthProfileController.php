<?php

namespace App\Http\Controllers;

use App\Models\Citizen;
use App\Models\HealthProfile;

class HealthProfileController extends Controller
{
    public function edit(Citizen $citizen)
    {
        $profile = HealthProfile::firstOrCreate([
            'citizen_id' => $citizen->id,
        ]);

        return view('health_profiles.edit', compact('citizen', 'profile'));
    }

    public function update(Citizen $citizen)
    {
        $profile = HealthProfile::firstOrCreate([
            'citizen_id' => $citizen->id,
        ]);

        $profile->update([
            'has_chronic_disease' => request()->boolean('has_chronic_disease'),
            'has_diabetes' => request()->boolean('has_diabetes'),
            'has_hypertension' => request()->boolean('has_hypertension'),
            'has_heart_disease' => request()->boolean('has_heart_disease'),
            'has_kidney_disease' => request()->boolean('has_kidney_disease'),
            'is_bedridden' => request()->boolean('is_bedridden'),
            'is_homebound' => request()->boolean('is_homebound'),
            'is_disabled' => request()->boolean('is_disabled'),
            'is_elderly' => request()->boolean('is_elderly'),
            'health_level' => request('health_level', 'green'),
            'last_home_visit_at' => request('last_home_visit_at'),
            'remark' => request('remark'),
        ]);

        return redirect()
            ->route('citizens.show', $citizen)
            ->with('success', 'บันทึกข้อมูลสุขภาพเรียบร้อยแล้ว');
    }
}