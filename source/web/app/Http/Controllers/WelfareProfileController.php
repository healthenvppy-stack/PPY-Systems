<?php

namespace App\Http\Controllers;

use App\Models\Citizen;
use App\Models\WelfareProfile;

class WelfareProfileController extends Controller
{
    public function edit(Citizen $citizen)
    {
        $profile = WelfareProfile::firstOrCreate([
            'citizen_id' => $citizen->id,
        ]);

        return view('welfare_profiles.edit', compact('citizen', 'profile'));
    }

    public function update(Citizen $citizen)
    {
        $profile = WelfareProfile::firstOrCreate([
            'citizen_id' => $citizen->id,
        ]);

        $profile->update([
            'is_elderly' => request()->boolean('is_elderly'),
            'is_disabled' => request()->boolean('is_disabled'),
            'is_low_income' => request()->boolean('is_low_income'),
            'is_vulnerable' => request()->boolean('is_vulnerable'),
            'is_homebound' => request()->boolean('is_homebound'),
            'is_bedridden' => request()->boolean('is_bedridden'),
            'care_level' => request('care_level', 'normal'),
            'risk_level' => request('risk_level', 'low'),
            'priority_level' => request('priority_level', 'normal'),
            'remark' => request('remark'),
        ]);

        return redirect()
            ->route('citizens.show', $citizen)
            ->with('success', 'บันทึกข้อมูลสวัสดิการเรียบร้อยแล้ว');
    }
}