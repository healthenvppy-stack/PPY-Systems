@php
    $business = $business ?? null;
@endphp

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>ไม่สามารถบันทึกข้อมูลได้</strong>

        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card">

    
    <div class="card mb-3">
        <div class="card-header">
            <h5 class="mb-0">
                <i class="fas fa-user me-2"></i>
                ข้อมูลผู้ประกอบการ
            </h5>
        </div>
    </div>

        <div class="card-body">

            <input
                type="hidden"
                name="citizen_id"
                id="citizen_id"
                value="{{ old('citizen_id', $business?->citizen_id) }}"
            >

            <div class="row g-3">

                <div class="col-md-5">
                    <label class="form-label">
                        เลขประจำตัวประชาชน
                    </label>

                    <div class="input-group">
                        <input
                            type="text"
                            name="owner_citizen_id"
                            id="owner_citizen_id"
                            value="{{ old(
                                'owner_citizen_id',
                                $business?->owner_citizen_id
                            ) }}"
                            class="form-control"
                            maxlength="13"
                            inputmode="numeric"
                        >

                        <button
                            type="button"
                            class="btn btn-outline-primary"
                            id="lookupCitizenButton"
                        >
                            <i class="fas fa-search me-1"></i>
                            ค้นหา
                        </button>
                    </div>

                    <div
                        id="citizenLookupMessage"
                        class="form-text"
                    >
                        กรอกเลข 13 หลักเพื่อค้นหาจากทะเบียนประชากร
                    </div>
                </div>

                <div class="col-md-2">
                    <label class="form-label">
                        คำนำหน้า
                    </label>

                    <input
                        type="text"
                        name="owner_prefix"
                        id="owner_prefix"
                        value="{{ old(
                            'owner_prefix',
                            $business?->owner_prefix
                        ) }}"
                        class="form-control"
                    >
                </div>

                <div class="col-md-2">
                    <label class="form-label">
                        ชื่อ
                    </label>

                    <input
                        type="text"
                        name="owner_first_name"
                        id="owner_first_name"
                        value="{{ old(
                            'owner_first_name',
                            $business?->owner_first_name
                        ) }}"
                        class="form-control"
                        required
                    >
                </div>

                <div class="col-md-3">
                    <label class="form-label">
                        นามสกุล
                    </label>

                    <input
                        type="text"
                        name="owner_last_name"
                        id="owner_last_name"
                        value="{{ old(
                            'owner_last_name',
                            $business?->owner_last_name
                        ) }}"
                        class="form-control"
                        required
                    >
                </div>

                <div class="col-md-4">
                    <label class="form-label">
                        โทรศัพท์
                    </label>

                    <input
                        type="text"
                        name="phone"
                        id="phone"
                        value="{{ old('phone', $business?->phone) }}"
                        class="form-control"
                    >
                </div>

                <div class="col-md-4">
                    <label class="form-label">
                        อีเมล
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email', $business?->email) }}"
                        class="form-control"
                    >
                </div>

            <!--</div>
        </div>
    </div>

    <div class="card-body">-->

        <div class="row">

            <div class="col-md-4">

                <label class="form-label">
                    ประเภทกิจการ
                </label>

                <select
                    name="business_type_id"
                    class="form-select">

                    <option value="">
                        -- เลือก --
                    </option>

                    @foreach($businessTypes as $type)

                        <option
                            value="{{ $type->id }}"
                            @selected(old('business_type_id')==$type->id)>

                            {{ $type->name }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="col-md-4">

                <label class="form-label">

                    รหัสกิจการ

                </label>

                <input
                    type="text"
                    name="code"
                    value="{{ old('code') }}"
                    class="form-control">

            </div>

            <div class="col-md-4">

                <label class="form-label">

                    ชื่อสถานประกอบการ

                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    class="form-control">

            </div>

        </div>
        <div class="col-md-4">
            <label for="status" class="form-label">
                สถานะกิจการ
            </label>

            <select
                name="status"
                id="status"
                class="form-select @error('status') is-invalid @enderror"
                required
            >
                <option value="">-- เลือกสถานะ --</option>
                <option value="active"
                    @selected(old('status', $business?->status ?? 'active') === 'active')
                >
                    เปิดดำเนินการ
                </option>
                <option value="inactive"
                    @selected(old('status', $business?->status) === 'inactive')
                >
                    หยุดดำเนินการ
                </option>
                <option value="closed"
                    @selected(old('status', $business?->status) === 'closed')
                >
                    ปิดกิจการ
                </option>
            </select>

            @error('status')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

            <div class="mt-3">

                <button
                    class="btn btn-primary">

                    <i class="fas fa-save"></i>

                    บันทึกข้อมูล

                </button>

            </div>

        </div>

    </div>



@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const citizenIdInput =
        document.getElementById('owner_citizen_id');

    const lookupButton =
        document.getElementById('lookupCitizenButton');

    const message =
        document.getElementById('citizenLookupMessage');

    if (!citizenIdInput || !lookupButton) {
        return;
    }

    lookupButton.addEventListener('click', async function () {
        const citizenId = citizenIdInput.value.trim();

        if (!/^\d{13}$/.test(citizenId)) {
            message.className = 'form-text text-danger';
            message.textContent =
                'กรุณากรอกเลขประจำตัวประชาชนให้ครบ 13 หลัก';

            return;
        }

        lookupButton.disabled = true;
        message.className = 'form-text text-muted';
        message.textContent = 'กำลังค้นหาข้อมูล...';

        try {
            const url = new URL(
                '{{ route('citizens.lookup') }}',
                window.location.origin
            );

            url.searchParams.set('citizen_id', citizenId);

            const response = await fetch(url, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
            });

            const data = await response.json();

            if (!response.ok || !data.found) {
                message.className = 'form-text text-warning';
                message.textContent =
                    'ไม่พบข้อมูล สามารถกรอกข้อมูลเองได้';

                return;
            }

            const citizen = data.citizen;

            document.getElementById('citizen_id').value =
                citizen.id ?? '';

            document.getElementById('owner_prefix').value =
                citizen.prefix ?? '';

            document.getElementById('owner_first_name').value =
                citizen.first_name ?? '';

            document.getElementById('owner_last_name').value =
                citizen.last_name ?? '';

            document.getElementById('phone').value =
                citizen.phone ?? '';

            message.className = 'form-text text-success';
            message.textContent =
                'พบข้อมูลประชาชนและเติมข้อมูลแล้ว';
        } catch (error) {
            message.className = 'form-text text-danger';
            message.textContent =
                'เกิดข้อผิดพลาดระหว่างค้นหาข้อมูล';
        } finally {
            lookupButton.disabled = false;
        }
    });
});
</script>
@endpush