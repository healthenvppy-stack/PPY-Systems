@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="mb-3">
        <h3>เปิดเคสสวัสดิการ</h3>
        <small class="text-muted">
            {{ $citizen->first_name }} {{ $citizen->last_name }}
        </small>
    </div>

    <div class="card">

        <div class="card-body">

            <form method="POST" action="{{ route('service-cases.store') }}">

                @csrf

                <input type="hidden"
                       name="citizen_id"
                       value="{{ $citizen->id }}">

                <input type="hidden"
                       name="module"
                       value="social_welfare">

                <div class="mb-3">

                    <label>ประเภทเคส</label>

                    <select
                        name="case_type"
                        class="form-control">

                        <option value="elderly_assistance">ผู้สูงอายุ</option>
                        <option value="disability_assistance">ผู้พิการ</option>
                        <option value="low_income">ผู้มีรายได้น้อย</option>
                        <option value="homebound">ผู้ป่วยติดบ้าน</option>
                        <option value="bedridden">ผู้ป่วยติดเตียง</option>
                        <option value="general">อื่น ๆ</option>

                    </select>

                </div>

                <div class="mb-3">

                    <label>ความสำคัญ</label>

                    <select
                        name="priority"
                        class="form-control">

                        <option value="normal">ปกติ</option>
                        <option value="urgent">ด่วน</option>
                        <option value="emergency">ฉุกเฉิน</option>

                    </select>

                </div>

                <div class="mb-3">

                    <label>รายละเอียด</label>

                    <textarea
                        name="remark"
                        rows="4"
                        class="form-control"></textarea>

                </div>

                <button class="btn btn-primary">

                    เปิดเคส

                </button>

                <a href="{{ route('citizens.show',$citizen) }}"
                   class="btn btn-secondary">

                    ย้อนกลับ

                </a>

            </form>

        </div>

    </div>

</div>

@endsection