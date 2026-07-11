@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between mb-3">
        <div>
            <h3 class="mb-0">เพิ่มสิทธิประโยชน์ / Add Benefit</h3>
            <small class="text-muted">
                {{ $citizen->first_name }} {{ $citizen->last_name }}
            </small>
        </div>

        <a href="{{ route('citizens.show', $citizen) }}"
           class="btn btn-secondary">
            ย้อนกลับ
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>บันทึกไม่สำเร็จ</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">

            <form method="POST"
                  action="{{ route('citizens.benefits.store', $citizen) }}">

                @csrf

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>ประเภทสิทธิประโยชน์</label>
                        <select name="benefit_type_id"
                                class="form-control"
                                required>
                            <option value="">-- เลือกสิทธิประโยชน์ --</option>

                            @foreach($benefitTypes as $type)
                                <option value="{{ $type->id }}"
                                    {{ old('benefit_type_id') == $type->id ? 'selected' : '' }}>
                                    {{ $type->name_th }}
                                    @if($type->name_en)
                                        / {{ $type->name_en }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>สถานะ</label>
                        <select name="status" class="form-control" required>
                            <option value="pending" {{ old('status') === 'pending' ? 'selected' : '' }}>
                                รอตรวจสอบ
                            </option>
                            <option value="approved" {{ old('status') === 'approved' ? 'selected' : '' }}>
                                อนุมัติแล้ว
                            </option>
                            <option value="receiving" {{ old('status') === 'receiving' ? 'selected' : '' }}>
                                กำลังได้รับสิทธิ์
                            </option>
                            <option value="suspended" {{ old('status') === 'suspended' ? 'selected' : '' }}>
                                ระงับชั่วคราว
                            </option>
                            <option value="stopped" {{ old('status') === 'stopped' ? 'selected' : '' }}>
                                สิ้นสุดสิทธิ์
                            </option>
                            <option value="cancelled" {{ old('status') === 'cancelled' ? 'selected' : '' }}>
                                ยกเลิก
                            </option>
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>จำนวนเงิน</label>
                        <input type="number"
                               step="0.01"
                               min="0"
                               name="amount"
                               class="form-control"
                               value="{{ old('amount') }}">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>วันที่เริ่มรับสิทธิ์</label>
                        <input type="date"
                               name="start_date"
                               class="form-control"
                               value="{{ old('start_date') }}">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>วันที่สิ้นสุด</label>
                        <input type="date"
                               name="end_date"
                               class="form-control"
                               value="{{ old('end_date') }}">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>หน่วยงาน</label>
                        <input type="text"
                               name="agency"
                               class="form-control"
                               value="{{ old('agency') }}">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>เลขอ้างอิง</label>
                        <input type="text"
                               name="reference_no"
                               class="form-control"
                               value="{{ old('reference_no') }}">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>หมายเหตุ</label>
                        <textarea name="remark"
                                  rows="3"
                                  class="form-control">{{ old('remark') }}</textarea>
                    </div>

                </div>

                <button class="btn btn-primary">
                    บันทึกสิทธิประโยชน์
                </button>

                <a href="{{ route('citizens.show', $citizen) }}"
                   class="btn btn-secondary">
                    ยกเลิก
                </a>

            </form>

        </div>
    </div>

</div>
@endsection