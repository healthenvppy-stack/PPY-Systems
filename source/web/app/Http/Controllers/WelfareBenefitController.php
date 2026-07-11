<?php

namespace App\Http\Controllers;

use App\Models\BenefitType;
use App\Models\Citizen;
use App\Models\WelfareBenefit;

class WelfareBenefitController extends Controller
{
    public function create(Citizen $citizen)
    {
        $benefitTypes = BenefitType::where('is_active', true)
            ->orderBy('name_th')
            ->get();

        return view(
            'welfare_benefits.create',
            compact('citizen', 'benefitTypes')
        );
    }

    public function store(Citizen $citizen)
    {
        $data = request()->validate([
            'benefit_type_id' => ['required', 'exists:benefit_types,id'],
            'status' => ['required', 'in:pending,approved,receiving,suspended,stopped,cancelled'],
            'amount' => ['nullable', 'numeric', 'min:0'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'agency' => ['nullable', 'max:150'],
            'reference_no' => ['nullable', 'max:100'],
            'remark' => ['nullable'],
        ]);

        $data['citizen_id'] = $citizen->id;
        $data['created_by'] = auth()->id();

        WelfareBenefit::create($data);

        return redirect()
            ->route('citizens.show', $citizen)
            ->with('success', 'เพิ่มสิทธิประโยชน์เรียบร้อยแล้ว');
    }

    public function edit(Citizen $citizen, WelfareBenefit $welfareBenefit)
    {
        abort_unless($welfareBenefit->citizen_id === $citizen->id, 404);

        $benefitTypes = BenefitType::where('is_active', true)
            ->orderBy('name_th')
            ->get();

        return view(
            'welfare_benefits.edit',
            compact('citizen', 'welfareBenefit', 'benefitTypes')
        );
    }

    public function update(Citizen $citizen, WelfareBenefit $welfareBenefit)
    {
        abort_unless($welfareBenefit->citizen_id === $citizen->id, 404);

        $data = request()->validate([
            'benefit_type_id' => ['required', 'exists:benefit_types,id'],
            'status' => ['required', 'in:pending,approved,receiving,suspended,stopped,cancelled'],
            'amount' => ['nullable', 'numeric', 'min:0'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'agency' => ['nullable', 'max:150'],
            'reference_no' => ['nullable', 'max:100'],
            'remark' => ['nullable'],
        ]);

        $welfareBenefit->update($data);

        return redirect()
            ->route('citizens.show', $citizen)
            ->with('success', 'แก้ไขสิทธิประโยชน์เรียบร้อยแล้ว');
    }

    public function destroy(Citizen $citizen, WelfareBenefit $welfareBenefit)
    {
        abort_unless($welfareBenefit->citizen_id === $citizen->id, 404);

        $welfareBenefit->delete();

        return redirect()
            ->route('citizens.show', $citizen)
            ->with('success', 'ลบสิทธิประโยชน์เรียบร้อยแล้ว');
    }
}