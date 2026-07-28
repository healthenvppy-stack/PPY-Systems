@csrf

<div class="row">
    <div class="col-md-4 mb-3">
        <label for="code" class="form-label">รหัสประเภทกิจการ</label>
        <input
            type="text"
            name="code"
            id="code"
            class="form-control @error('code') is-invalid @enderror"
            value="{{ old('code', $businessCategory->code ?? '') }}"
            maxlength="30"
            required
        >

        @error('code')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-8 mb-3">
        <label for="name" class="form-label">ชื่อประเภทกิจการ</label>
        <input
            type="text"
            name="name"
            id="name"
            class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name', $businessCategory->name ?? '') }}"
            required
        >

        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-8 mb-3">
        <label for="business_group_id" class="form-label">หมวดหลัก</label>
        <select
            name="business_group_id"
            id="business_group_id"
            class="form-select @error('business_group _id') is-invalid @enderror"
        >
            <option value="">-- ไม่มีหมวดหลัก --</option>

            @foreach ($businessGroups as $businessGroup)
                <option
                    value="{{ $businessGroup->id }}"
                    @selected(
                        (string) old(
                            'business_group_id',
                            $businessCategory->business_group_id ?? ''
                        ) === (string) $businessGroup->id
                    )
                >
                    {{ $businessGroup->code }} - {{ $businessGroup->name }}
                </option>
            @endforeach
        </select>

        @error('business_group_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label for="sort_order" class="form-label">ลำดับแสดงผล</label>
        <input
            type="number"
            name="sort_order"
            id="sort_order"
            class="form-control @error('sort_order') is-invalid @enderror"
            value="{{ old('sort_order', $businessCategory->sort_order ?? 0) }}"
            min="0"
        >

        @error('sort_order')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="mb-3">
    <label for="description" class="form-label">รายละเอียด</label>
    <textarea
        name="description"
        id="description"
        rows="4"
        class="form-control @error('description') is-invalid @enderror"
    >{{ old('description', $businessCategory->description ?? '') }}</textarea>

    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-check mb-3">
    <input type="hidden" name="is_active" value="0">

    <input
        type="checkbox"
        name="is_active"
        id="is_active"
        class="form-check-input"
        value="1"
        @checked(
            old(
                'is_active',
                isset($businessCategory)
                    ? $businessCategory->is_active
                    : true
            )
        )
    >

    <label for="is_active" class="form-check-label">
        เปิดใช้งาน
    </label>
</div>

<div class="d-flex justify-content-between">
    <a
        href="{{ route('shop-license.business-categories.index') }}"
        class="btn btn-secondary"
    >
        กลับ
    </a>

    <button type="submit" class="btn btn-primary">
        บันทึก
    </button>
</div>