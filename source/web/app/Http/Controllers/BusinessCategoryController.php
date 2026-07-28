<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBusinessCategoryRequest;
use App\Http\Requests\UpdateBusinessCategoryRequest;
use App\Models\BusinessCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\BusinessGroup;

class BusinessCategoryController extends Controller
{
    public function index(): View
    {
        $categories = BusinessCategory::query()
            ->with('businessGroup')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(20);

        return view('shop-license.business-categories.index', compact('categories'));
    }

    public function create(): View
    {
        $businessGroups = BusinessCategory::query()
            //->whereNull('business_group_id')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('shop-license.business-categories.create', compact('businessGroups'));
    }

    public function store(StoreBusinessCategoryRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');

        BusinessCategory::create($data);

        return redirect()
            ->route('shop-license.business-categories.index')
            ->with('success', 'เพิ่มประเภทกิจการเรียบร้อยแล้ว');
    }

    public function edit(BusinessCategory $businessCategory): View
    {
        $businessGroups = BusinessCategory::query()
            //->whereNull('business_group_id')
            ->whereKeyNot($businessCategory->id)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view(
            'shop-license.business-categories.edit',
            compact('businessCategory', 'businessGroups')
        );
    }

    public function update(
        UpdateBusinessCategoryRequest $request,
        BusinessCategory $businessCategory
    ): RedirectResponse {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active');

        $businessCategory->update($data);

        return redirect()
            ->route('shop-license.business-categories.index')
            ->with('success', 'แก้ไขประเภทกิจการเรียบร้อยแล้ว');
    }

    public function destroy(
        BusinessCategory $businessCategory
    ): RedirectResponse {
        if ($businessCategory->businessTypes()->exists()) {
            return redirect()
                ->route('shop-license.business-categories.index')
                ->with(
                    'error',
                    'ไม่สามารถลบประเภทกิจการนี้ได้ เนื่องจากมีกิจการย่อยใช้งานอยู่'
                );
        }

        $businessCategory->delete();

        return redirect()
            ->route('shop-license.business-categories.index')
            ->with('success', 'ลบประเภทกิจการเรียบร้อยแล้ว');
    }
}