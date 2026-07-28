<?php

namespace App\Http\Controllers\ShopLicense;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\BusinessType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BusinessController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->input('search'));

        $businesses = Business::query()
            ->with([
                'businessType.businessCategory.businessGroup',
            ])
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery
                        ->where('code', 'like', "%{$search}%")
                        ->orWhere('name', 'like', "%{$search}%")
                        ->orWhere('owner_first_name', 'like', "%{$search}%")
                        ->orWhere('owner_last_name', 'like', "%{$search}%")
                        ->orWhere('owner_citizen_id', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhereHas('businessType', function ($typeQuery) use ($search) {
                            $typeQuery->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->latest('id')
            ->paginate(15)
            ->withQueryString();

        return view(
            'shop-license.businesses.index',
            compact('businesses')
        );
    }

    public function create(): View
    {
        $businessTypes = BusinessType::query()
            ->with('businessCategory.businessGroup')
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view(
            'shop-license.businesses.create',
            compact('businessTypes')
        );
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateBusiness($request);

        Business::create($validated);

        return redirect()
            ->route('shop-license.businesses.index')
            ->with('success', 'เพิ่มสถานประกอบการเรียบร้อยแล้ว');
    }

    public function show(Business $business): View
    {
        $business->load([
            'businessType.businessCategory.businessGroup',
        ]);

        return view(
            'shop-license.businesses.show',
            compact('business')
        );
    }

    public function edit(Business $business): View
    {
        $businessTypes = BusinessType::query()
            ->with('businessCategory.businessGroup')
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view(
            'shop-license.businesses.edit',
            compact('business', 'businessTypes')
        );
    }

    public function update(
        Request $request,
        Business $business
    ): RedirectResponse {
        $validated = $this->validateBusiness(
            $request,
            $business
        );

        $business->update($validated);

        return redirect()
            ->route('shop-license.businesses.show', $business)
            ->with('success', 'แก้ไขสถานประกอบการเรียบร้อยแล้ว');
    }

    public function destroy(Business $business): RedirectResponse
    {
        $business->delete();

        return redirect()
            ->route('shop-license.businesses.index')
            ->with('success', 'ลบสถานประกอบการเรียบร้อยแล้ว');
    }

    private function validateBusiness(
        Request $request,
        ?Business $business = null
    ): array {
        $businessId = $business?->id;

        return $request->validate([
            'business_type_id' => [
                'required',
                'exists:business_types,id',
            ],

            'code' => [
                'required',
                'string',
                'max:30',
                'unique:businesses,code,'.$businessId,
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'owner_prefix' => [
                'nullable',
                'string',
                'max:50',
            ],

            'owner_first_name' => [
                'required',
                'string',
                'max:150',
            ],

            'owner_last_name' => [
                'required',
                'string',
                'max:150',
            ],

            'owner_citizen_id' => [
                'nullable',
                'digits:13',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:20',
            ],

            'email' => [
                'nullable',
                'email',
                'max:150',
            ],

            'house_no' => ['nullable', 'string', 'max:50'],
            'moo' => ['nullable', 'string', 'max:20'],
            'soi' => ['nullable', 'string', 'max:100'],
            'road' => ['nullable', 'string', 'max:100'],

            'subdistrict' => ['nullable', 'string', 'max:150'],
            'district' => ['nullable', 'string', 'max:150'],
            'province' => ['nullable', 'string', 'max:150'],
            'postal_code' => ['nullable', 'string', 'max:10'],

            'latitude' => [
                'nullable',
                'numeric',
                'between:-90,90',
            ],

            'longitude' => [
                'nullable',
                'numeric',
                'between:-180,180',
            ],

            'description' => ['nullable', 'string'],
            'remark' => ['nullable', 'string'],

            'status' => [
                'required',
                'in:active,inactive,closed',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);
    }
}