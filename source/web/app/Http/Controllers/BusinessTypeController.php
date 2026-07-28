<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBusinessTypeRequest;
use App\Http\Requests\UpdateBusinessTypeRequest;
use App\Models\BusinessCategory;
use App\Models\BusinessType;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BusinessTypeController extends Controller
{
    public function index(): View
    {
        $businessTypes = BusinessType::query()
            ->with('businessCategory.businessGroup')
            ->orderBy('sort_order')
            ->orderBy('code')
            ->paginate(20);

        return view(
            'shop-license.business-types.index',
            compact('businessTypes')
        );
    }

    public function create(): View
    {
        $businessCategories = $this->businessCategories();

        return view(
            'shop-license.business-types.create',
            compact('businessCategories')
        );
    }

    public function store(
        StoreBusinessTypeRequest $request
    ): RedirectResponse {
        BusinessType::create($this->prepareData($request->validated()));

        return redirect()
            ->route('shop-license.business-types.index')
            ->with('success', 'เพิ่มกิจการย่อยเรียบร้อยแล้ว');
    }

    public function edit(BusinessType $businessType): View
    {
        $businessCategories = $this->businessCategories();

        return view(
            'shop-license.business-types.edit',
            compact('businessType', 'businessCategories')
        );
    }

    public function update(
        UpdateBusinessTypeRequest $request,
        BusinessType $businessType
    ): RedirectResponse {
        $businessType->update(
            $this->prepareData($request->validated())
        );

        return redirect()
            ->route('shop-license.business-types.index')
            ->with('success', 'แก้ไขกิจการย่อยเรียบร้อยแล้ว');
    }

    public function destroy(
        BusinessType $businessType
    ): RedirectResponse {
        if ($businessType->businesses()->exists()) {
            return redirect()
                ->route('shop-license.business-types.index')
                ->with(
                    'error',
                    'ไม่สามารถลบกิจการย่อยนี้ได้ เนื่องจากมีสถานประกอบการใช้งานอยู่'
                );
        }

        $businessType->delete();

        return redirect()
            ->route('shop-license.business-types.index')
            ->with('success', 'ลบกิจการย่อยเรียบร้อยแล้ว');
    }

    private function businessCategories()
    {
        return BusinessCategory::query()
            ->with('businessGroup')
            ->where('is_active', true)
            ->orderBy('business_group_id')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
    }

    private function prepareData(array $data): array
    {
        $data['requires_license'] = (bool) (
            $data['requires_license'] ?? false
        );

        $data['is_active'] = (bool) (
            $data['is_active'] ?? false
        );

        $data['license_fee'] = $data['license_fee'] ?? 0;
        $data['license_validity_months'] =
            $data['license_validity_months'] ?? 12;

        $data['inspection_interval_months'] =
            $data['inspection_interval_months'] ?: null;

        $data['application_form'] =
            $data['application_form'] ?: null;

        $data['legal_reference'] =
            $data['legal_reference'] ?: null;

        return $data;
    }
}