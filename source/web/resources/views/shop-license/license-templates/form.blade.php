@php
    $licenseTemplate = $licenseTemplate ?? null;

    $templateTypes = [
        'NEW' => 'ขอใบอนุญาตใหม่',
        'RENEW' => 'ต่ออายุใบอนุญาต',
        'CHANGE' => 'เปลี่ยนแปลงรายการ',
        'REPLACE' => 'ขอใบแทน',
        'CANCEL' => 'เลิกกิจการ',
    ];
@endphp

<div class="row">
    <div class="col-md-8 mb-3">
        <label for="business_type_id" class="form-label">
            กิจการย่อย <span class="text-danger">*</span>
        </label>

        <select
            name="business_type_id"
            id="business_type_id"
            class="form-select @error('business_type_id') is-invalid @enderror"
            required
        >
            <option value="">-- เลือกกิจการย่อย --</option>

            @foreach ($businessTypes as $businessType)
                <option
                    value="{{ $businessType->id }}"
                    @selected(
                        old(
                            'business_type_id',
                            $licenseTemplate?->business_type_id
                        ) == $businessType->id
                    )
                >
                    {{ $businessType->businessCategory?->businessGroup?->name }}
                    /
                    {{ $businessType->businessCategory?->name }}
                    /
                    {{ $businessType->name }}
                </option>
            @endforeach
        </select>

        @error('business_type_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label for="template_type" class="form-label">
            ประเภทคำขอ <span class="text-danger">*</span>
        </label>

        <select
            name="template_type"
            id="template_type"
            class="form-select @error('template_type') is-invalid @enderror"
            required
        >
            @foreach ($templateTypes as $value => $label)
                <option
                    value="{{ $value }}"
                    @selected(
                        old(
                            'template_type',
                            $licenseTemplate?->template_type ?? 'NEW'
                        ) === $value
                    )
                >
                    {{ $label }}
                </option>
            @endforeach
        </select>

        @error('template_type')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-3 mb-3">
        <label for="code" class="form-label">
            รหัสแม่แบบ <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            name="code"
            id="code"
            value="{{ old('code', $licenseTemplate?->code) }}"
            class="form-control @error('code') is-invalid @enderror"
            maxlength="50"
            required
        >

        @error('code')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-7 mb-3">
        <label for="name" class="form-label">
            ชื่อแม่แบบใบอนุญาต <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            name="name"
            id="name"
            value="{{ old('name', $licenseTemplate?->name) }}"
            class="form-control @error('name') is-invalid @enderror"
            maxlength="255"
            required
        >

        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-2 mb-3">
        <label for="version" class="form-label">เวอร์ชัน</label>

        <input
            type="number"
            name="version"
            id="version"
            value="{{ old('version', $licenseTemplate?->version ?? 1) }}"
            class="form-control @error('version') is-invalid @enderror"
            min="1"
        >

        @error('version')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-3 mb-3">
        <label for="application_form" class="form-label">แบบคำขอ</label>

        <input
            type="text"
            name="application_form"
            id="application_form"
            value="{{ old(
                'application_form',
                $licenseTemplate?->application_form
            ) }}"
            class="form-control @error('application_form') is-invalid @enderror"
            maxlength="255"
            placeholder="เช่น สอ.1"
        >

        @error('application_form')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-3 mb-3">
        <label for="fee_amount" class="form-label">ค่าธรรมเนียม</label>

        <div class="input-group">
            <input
                type="number"
                name="fee_amount"
                id="fee_amount"
                value="{{ old(
                    'fee_amount',
                    $licenseTemplate?->fee_amount ?? 0
                ) }}"
                class="form-control @error('fee_amount') is-invalid @enderror"
                min="0"
                step="0.01"
            >
            <span class="input-group-text">บาท</span>

            @error('fee_amount')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-md-3 mb-3">
        <label for="validity_months" class="form-label">อายุใบอนุญาต</label>

        <div class="input-group">
            <input
                type="number"
                name="validity_months"
                id="validity_months"
                value="{{ old(
                    'validity_months',
                    $licenseTemplate?->validity_months ?? 12
                ) }}"
                class="form-control @error('validity_months') is-invalid @enderror"
                min="1"
                max="120"
            >
            <span class="input-group-text">เดือน</span>

            @error('validity_months')
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
                    $licenseTemplate?->inspection_interval_months
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
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="approval_authority" class="form-label">
            ผู้มีอำนาจอนุมัติ
        </label>

        <input
            type="text"
            name="approval_authority"
            id="approval_authority"
            value="{{ old(
                'approval_authority',
                $licenseTemplate?->approval_authority
            ) }}"
            class="form-control @error('approval_authority') is-invalid @enderror"
            maxlength="255"
            placeholder="เช่น นายกเทศมนตรี"
        >

        @error('approval_authority')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-3 mb-3">
        <label for="effective_date" class="form-label">วันที่เริ่มใช้</label>

        <input
            type="date"
            name="effective_date"
            id="effective_date"
            value="{{ old(
                'effective_date',
                $licenseTemplate?->effective_date?->format('Y-m-d')
            ) }}"
            class="form-control @error('effective_date') is-invalid @enderror"
        >

        @error('effective_date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-3 mb-3">
        <label for="expiry_date" class="form-label">วันที่สิ้นสุดการใช้</label>

        <input
            type="date"
            name="expiry_date"
            id="expiry_date"
            value="{{ old(
                'expiry_date',
                $licenseTemplate?->expiry_date?->format('Y-m-d')
            ) }}"
            class="form-control @error('expiry_date') is-invalid @enderror"
        >

        @error('expiry_date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="mb-3">
    <label for="legal_reference" class="form-label">อ้างอิงข้อกฎหมาย</label>

    <textarea
        name="legal_reference"
        id="legal_reference"
        rows="3"
        class="form-control @error('legal_reference') is-invalid @enderror"
    >{{ old('legal_reference', $licenseTemplate?->legal_reference) }}</textarea>

    @error('legal_reference')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label">รายละเอียดเพิ่มเติม</label>

    <textarea
        name="description"
        id="description"
        rows="3"
        class="form-control @error('description') is-invalid @enderror"
    >{{ old('description', $licenseTemplate?->description) }}</textarea>

    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <label for="sort_order" class="form-label">ลำดับแสดงผล</label>

        <input
            type="number"
            name="sort_order"
            id="sort_order"
            value="{{ old(
                'sort_order',
                $licenseTemplate?->sort_order ?? 0
            ) }}"
            class="form-control @error('sort_order') is-invalid @enderror"
            min="0"
        >

        @error('sort_order')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4 mb-3 d-flex align-items-end">
        <div class="form-check form-switch mb-2">
            <input type="hidden" name="is_default" value="0">

            <input
                type="checkbox"
                name="is_default"
                id="is_default"
                value="1"
                class="form-check-input"
                @checked(
                    old(
                        'is_default',
                        $licenseTemplate?->is_default ?? false
                    )
                )
            >

            <label for="is_default" class="form-check-label">
                ใช้เป็นแม่แบบเริ่มต้น
            </label>
        </div>
    </div>

    <div class="col-md-4 mb-3 d-flex align-items-end">
        <div class="form-check form-switch mb-2">
            <input type="hidden" name="is_active" value="0">

            <input
                type="checkbox"
                name="is_active"
                id="is_active"
                value="1"
                class="form-check-input"
                @checked(
                    old(
                        'is_active',
                        $licenseTemplate?->is_active ?? true
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
        href="{{ route('shop-license.license-templates.index') }}"
        class="btn btn-secondary"
    >
        ยกเลิก
    </a>

    <button type="submit" class="btn btn-primary">
        บันทึกข้อมูล
    </button>
</div>