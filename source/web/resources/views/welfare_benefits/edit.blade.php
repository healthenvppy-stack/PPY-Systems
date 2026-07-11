@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between mb-3">
        <div>
            <h3 class="mb-0">แก้ไขสิทธิประโยชน์ / Edit Benefit</h3>
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
                  action="{{ route('citizens.benefits.update', [$citizen, $welfareBenefit]) }}">

                @csrf
                @method('PUT')

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>ประเภทสิทธิประโยชน์</label>
                        <select name="benefit_type_id"
                                class="form-control"
                                required>
                            @foreach($benefitTypes as $type)
                                <option value="{{ $type->id }}"
                                    {{ old('benefit_type_id', $welfareBenefit->benefit_type_id) == $type->id ? 'selected' : '' }}>
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
                            @php
                                $statuses = [
                                    'pending' => 'รอตรวจสอบ',
                                    'approved' => 'อนุมัติแล้ว',
                                    'receiving' => 'กำลังได้รับสิทธิ์',
                                    'suspended' => 'ระงับชั่วคราว',
                                    'stopped' => 'สิ้นสุดสิทธิ์',
                                    'cancelled' => 'ยกเลิก',
                                ];
                            @endphp

                            @foreach($statuses as $value => $label)
                                <option value="{{ $value }}"
                                    {{ old('status', $welfareBenefit->status) === $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>จำนวนเงิน</label>
                        <input type="number"
                               step="0.01"
                               min="0"
                               name="amount"
                               class="form-control"
                               value="{{ old('amount', $welfareBenefit->amount) }}">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>วันที่เริ่มรับสิทธิ์</label>
                        <input type="date"
                               name="start_date"
                               class="form-control"
                               value="{{ old('start_date', optional($welfareBenefit->start_date)->format('Y-m-d')) }}">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>วันที่สิ้นสุด</label>
                        <input type="date"
                               name="end_date"
                               class="form-control"
                               value="{{ old('end_date', optional($welfareBenefit->end_date)->format('Y-m-d')) }}">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>หน่วยงาน</label>
                        <input type="text"
                               name="agency"
                               class="form-control"
                               value="{{ old('agency', $welfareBenefit->agency) }}">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>เลขอ้างอิง</label>
                        <input type="text"
                               name="reference_no"
                               class="form-control"
                               value="{{ old('reference_no', $welfareBenefit->reference_no) }}">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>หมายเหตุ</label>
                        <textarea name="remark"
                                  rows="3"
                                  class="form-control">{{ old('remark', $welfareBenefit->remark) }}</textarea>
                    </div>

                </div>

                <button class="btn btn-primary">
                    บันทึกการแก้ไข
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