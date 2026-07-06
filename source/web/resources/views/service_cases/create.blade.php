@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <h3 class="mb-3">เปิดเคสใหม่ / New Service Case</h3>

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

            <form method="POST" action="{{ route('service-cases.store') }}">
                @csrf

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>ประชาชน / Citizen</label>
                        <select name="citizen_id" class="form-control">
                            <option value="">-- เลือกประชาชน --</option>
                            @foreach($citizens as $citizen)
                                <option value="{{ $citizen->id }}" {{ old('citizen_id') == $citizen->id ? 'selected' : '' }}>
                                    {{ $citizen->first_name }} {{ $citizen->last_name }}
                                    ({{ substr($citizen->cid, 0, 5) }}XXXX{{ substr($citizen->cid, -4) }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>โมดูล / Module</label>
                        <select name="module" class="form-control">
                            <option value="social_welfare" {{ old('module') == 'social_welfare' ? 'selected' : '' }}>สวัสดิการ / Social Welfare</option>
                            <option value="public_health" {{ old('module') == 'public_health' ? 'selected' : '' }}>สาธารณสุข / Public Health</option>
                            <option value="disaster" {{ old('module') == 'disaster' ? 'selected' : '' }}>ป้องกันภัย / Disaster</option>
                            <option value="engineering" {{ old('module') == 'engineering' ? 'selected' : '' }}>กองช่าง / Engineering</option>
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>ประเภทเคส / Case Type</label>
                        <input type="text" name="case_type" class="form-control"
                               value="{{ old('case_type') }}"
                               placeholder="เช่น elderly_assistance">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>ความสำคัญ / Priority</label>
                        <select name="priority" class="form-control">
                            <option value="normal">ปกติ / Normal</option>
                            <option value="urgent">ด่วน / Urgent</option>
                            <option value="emergency">ฉุกเฉิน / Emergency</option>
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label>วันที่เปิดเคส / Opened At</label>
                        <input type="date" name="opened_at" class="form-control"
                               value="{{ old('opened_at', now()->format('Y-m-d')) }}">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>รายละเอียด / Remark</label>
                        <textarea name="remark" class="form-control" rows="3">{{ old('remark') }}</textarea>
                    </div>

                </div>

                <button class="btn btn-primary">บันทึกเคส</button>
                <a href="{{ route('service-cases.index') }}" class="btn btn-secondary">ย้อนกลับ</a>

            </form>

        </div>
    </div>

</div>
@endsection