<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLicenseTemplateRequest;
use App\Http\Requests\UpdateLicenseTemplateRequest;
use App\Models\BusinessType;
use App\Models\LicenseTemplate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\Request;


class LicenseTemplateController extends Controller
{
    

    /** 
    public function index(): View
    {
        $licenseTemplates = LicenseTemplate::query()
            ->with([
                'businessType.businessCategory.businessGroup',
            ])
            ->withCount([
                'documents',
                'checklists',
            ])
            ->orderBy('sort_order')
            ->orderBy('code')
            ->paginate(20);

        return view(
            'shop-license.license-templates.index',
            compact('licenseTemplates')
        );
    }
    */

    public function index(Request $request): View
    {
        $search = trim((string) $request->input('search'));

        $licenseTemplates = LicenseTemplate::query()
            ->with([
                'businessType.businessCategory.businessGroup',
            ])
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery
                        ->where('code', 'like', "%{$search}%")
                        ->orWhere('name', 'like', "%{$search}%")
                        ->orWhere('template_type', 'like', "%{$search}%")
                        ->orWhereHas('businessType', function ($businessTypeQuery) use ($search) {
                            $businessTypeQuery->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        return view(
            'shop-license.license-templates.index',
            compact('licenseTemplates')
        );
    }

    public function create(): View
    {
        $businessTypes = $this->businessTypes();

        return view(
            'shop-license.license-templates.create',
            compact('businessTypes')
        );
    }

    public function store(
        StoreLicenseTemplateRequest $request
    ): RedirectResponse {
        DB::transaction(function () use ($request) {
            $data = $this->prepareData($request->validated());

            if ($data['is_default']) {
                $this->clearExistingDefault(
                    $data['business_type_id'],
                    $data['template_type']
                );
            }

            LicenseTemplate::create($data);
        });

        return redirect()
            ->route('shop-license.license-templates.index')
            ->with('success', 'เพิ่มแม่แบบใบอนุญาตเรียบร้อยแล้ว');
    }

    public function show(
        LicenseTemplate $licenseTemplate
    ): View {
        $licenseTemplate->load([
            'businessType.businessCategory.businessGroup',
            'documents' => fn ($query) => $query
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->orderBy('name'),
            'checklists' => fn ($query) => $query
                ->where('is_active', true)
                ->orderBy('sort_order')
                ->orderBy('name'),
        ]);

        return view(
            'shop-license.license-templates.show',
            compact('licenseTemplate')
        );
    }

    public function edit(
        LicenseTemplate $licenseTemplate
    ): View {
        $businessTypes = $this->businessTypes();

        return view(
            'shop-license.license-templates.edit',
            compact('licenseTemplate', 'businessTypes')
        );
    }

    public function update(
        UpdateLicenseTemplateRequest $request,
        LicenseTemplate $licenseTemplate
    ): RedirectResponse {
        DB::transaction(function () use (
            $request,
            $licenseTemplate
        ) {
            $data = $this->prepareData($request->validated());

            if ($data['is_default']) {
                $this->clearExistingDefault(
                    $data['business_type_id'],
                    $data['template_type'],
                    $licenseTemplate->id
                );
            }

            $licenseTemplate->update($data);
        });

        return redirect()
            ->route('shop-license.license-templates.index')
            ->with('success', 'แก้ไขแม่แบบใบอนุญาตเรียบร้อยแล้ว');
    }

    public function destroy(
        LicenseTemplate $licenseTemplate
    ): RedirectResponse {
        if (
            $licenseTemplate->documents()->exists()
            || $licenseTemplate->checklists()->exists()
        ) {
            return redirect()
                ->route('shop-license.license-templates.index')
                ->with(
                    'error',
                    'ไม่สามารถลบแม่แบบนี้ได้ เนื่องจากมีเอกสารหรือรายการตรวจใช้งานอยู่'
                );
        }

        $licenseTemplate->delete();

        return redirect()
            ->route('shop-license.license-templates.index')
            ->with('success', 'ลบแม่แบบใบอนุญาตเรียบร้อยแล้ว');
    }

    private function businessTypes()
    {
        return BusinessType::query()
            ->with([
                'businessCategory.businessGroup',
            ])
            ->where('is_active', true)
            ->orderBy('business_category_id')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
    }

    private function clearExistingDefault(
        int $businessTypeId,
        string $templateType,
        ?int $exceptId = null
    ): void {
        LicenseTemplate::query()
            ->where('business_type_id', $businessTypeId)
            ->where('template_type', $templateType)
            ->when(
                $exceptId,
                fn ($query) => $query->where('id', '!=', $exceptId)
            )
            ->update([
                'is_default' => false,
            ]);
    }

    private function prepareData(array $data): array
    {
        $data['is_default'] = (bool) (
            $data['is_default'] ?? false
        );

        $data['is_active'] = (bool) (
            $data['is_active'] ?? false
        );

        $data['fee_amount'] =
            $data['fee_amount'] ?? 0;

        $data['validity_months'] =
            $data['validity_months'] ?? 12;

        $data['inspection_interval_months'] =
            $data['inspection_interval_months'] ?: null;

        $data['application_form'] =
            $data['application_form'] ?: null;

        $data['approval_authority'] =
            $data['approval_authority'] ?: null;

        $data['legal_reference'] =
            $data['legal_reference'] ?: null;

        $data['description'] =
            $data['description'] ?: null;

        $data['effective_date'] =
            $data['effective_date'] ?: null;

        $data['expiry_date'] =
            $data['expiry_date'] ?: null;

        $data['version'] =
            $data['version'] ?? 1;

        $data['sort_order'] =
            $data['sort_order'] ?? 0;

        return $data;
    }
}