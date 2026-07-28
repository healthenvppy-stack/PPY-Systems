@php
    $businessType = $businessType ?? null;
@endphp

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="business_category_id" class="form-label">
            ประเภทกิจการหลัก <span class="text-danger">*</span>
        </label>

        <select
            name="business_category_id"
            id="business_category_id"
            class="form-select @error('business_category_id') is-invalid @enderror"
            required
        >
            <option value="">-- เลือกประเภทกิจการหลัก --</option>

            @foreach ($businessCategories as $category)
                <option
                    value="{{ $category->id }}"
                    @selected(
                        old(
                            'business_category_id',
                            $businessType?->business_category_id
                        ) == $category->id
                    )
                >
                    {{ $category->businessGroup?->name }}
                    /
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        @error('business_category_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-3 mb-3">
        <label for="code" class="form-label">
            รหัสกิจการย่อย <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            name="code"
            id="code"
            value="{{ old('code', $businessType?->code) }}"
            class="form-control @error('code') is-invalid @enderror"
            maxlength="30"
            required
        >

        @error('code')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-3 mb-3">
        <label for="sort_order" class="form-label">ลำดับแสดงผล</label>

        <input
            type="number"
            name="sort_order"
            id="sort_order"
            value="{{ old('sort_order', $businessType?->sort_order ?? 0) }}"
            class="form-control @error('sort_order') is-invalid @enderror"
            min="0"
        >

        @error('sort_order')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-8 mb-3">
        <label for="name" class="form-label">
            ชื่อกิจการย่อย <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            name="name"
            id="name"
            value="{{ old('name', $businessType?->name) }}"
            class="form-control @error('name') is-invalid @enderror"
            maxlength="255"
            required
        >

        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label for="risk_level" class="form-label">
            ระดับความเสี่ยง <span class="text-danger">*</span>
        </label>

        <select
            name="risk_level"
            id="risk_level"
            class="form-select @error('risk_level') is-invalid @enderror"
            required
        >
            @foreach (['ต่ำ', 'ปานกลาง', 'สูง'] as $riskLevel)
                <option
                    value="{{ $riskLevel }}"
                    @selected(
                        old(
                            'risk_level',
                            $businessType?->risk_level ?? 'ปานกลาง'
                        ) === $riskLevel
                    )
                >
                    {{ $riskLevel }}
                </option>
            @endforeach
        </select>

        @error('risk_level')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="mb-3">
    <label for="description" class="form-label">รายละเอียด</label>

    <textarea
        name="description"
        id="description"
        rows="3"
        class="form-control @error('description') is-invalid @enderror"
    >{{ old('description', $businessType?->description) }}</textarea>

    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="legal_reference" class="form-label">อ้างอิงข้อกฎหมาย</label>

    <textarea
        name="legal_reference"
        id="legal_reference"
        rows="2"
        class="form-control @error('legal_reference') is-invalid @enderror"
    >{{ old('legal_reference', $businessType?->legal_reference) }}</textarea>

    @error('legal_reference')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-3 mb-3">
        <label for="license_fee" class="form-label">ค่าธรรมเนียม</label>

        <div class="input-group">
            <input
                type="number"
                name="license_fee"
                id="license_fee"
                value="{{ old('license_fee', $businessType?->license_fee ?? 0) }}"
                class="form-control @error('license_fee') is-invalid @enderror"
                min="0"
                step="0.01"
            >
            <span class="input-group-text">บาท</span>

            @error('license_fee')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <label for="license_validity_months" class="form-label">
            อายุใบอนุญาต
        </label>

        <div class="input-group">
            <input
                type="number"
                name="license_validity_months"
                id="license_validity_months"
                value="{{ old(
                    'license_validity_months',
                    $businessType?->license_validity_months ?? 12
                ) }}"
                class="form-control @error('license_validity_months') is-invalid @enderror"
                min="1"
                max="120"
            >
            <span class="input-group-text">เดือน</span>

            @error('license_validity_months')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <label for="inspection_interval_months" class="form-label">
            รอบการตรวจ
        </label>

        <div class="input-group">
            <input
                type="number"
                name="inspection_interval_months"
                id="inspection_interval_months"
                value="{{ old(
                    'inspection_interval_months',
                    $businessType?->inspection_interval_months
                ) }}"
                class="form-control @error('inspection_interval_months') is-invalid @enderror"
                min="1"
                max="120"
            >
            <span class="input-group-text">เดือน</span>

            @error('inspection_interval_months')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <label for="application_form" class="form-label">แบบคำขอ</label>

        <input
            type="text"
            name="application_form"
            id="application_form"
            value="{{ old('application_form', $businessType?->application_form) }}"
            class="form-control @error('application_form') is-invalid @enderror"
            maxlength="255"
            placeholder="เช่น สอ.1"
        >

        @error('application_form')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <div class="form-check form-switch">
            <input
                type="hidden"
                name="requires_license"
                value="0"
            >

            <input
                type="checkbox"
                name="requires_license"
                id="requires_license"
                value="1"
                class="form-check-input"
                @checked(
                    old(
                        'requires_license',
                        $businessType?->requires_license ?? true
                    )
                )
            >

            <label for="requires_license" class="form-check-label">
                กิจการนี้ต้องขอใบอนุญาต
            </label>
        </div>
    </div>

    <div class="col-md-6 mb-3">
        <div class="form-check form-switch">
            <input
                type="hidden"
                name="is_active"
                value="0"
            >

            <input
                type="checkbox"
                name="is_active"
                id="is_active"
                value="1"
                class="form-check-input"
                @checked(
                    old(
                        'is_active',
                        $businessType?->is_active ?? true
                    )
                )
            >

            <label for="is_active" class="form-check-label">
                เปิดใช้งาน
            </label>
        </div>
    </div>
</div>

<div class="d-flex justify-content-end gap-2">
    <a
        href="{{ route('shop-license.business-types.index') }}"
        class="btn btn-secondary"
    >
        ยกเลิก
    </a>

    <button type="submit" class="btn btn-primary">
        บันทึกข้อมูล
    </button>
</div>