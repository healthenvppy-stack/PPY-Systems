@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <h3 class="mb-3">
        เปิดเคสสาธารณสุข
    </h3>

    <div class="card">

        <div class="card-body">

            <form method="POST"
                  action="{{ route('service-cases.store') }}">

                @csrf
                
                <input type="hidden"
                       name="citizen_id"
                       value="{{ $citizen->id }}">

                <input type="hidden"
                       name="module"
                       value="public_health">
                <input type="hidden" name="priority" value="normal">
                <div class="mb-3">

                    <label>ประเภทเคส</label>

                    <select
                        class="form-control"
                        name="case_type">

                        <option value="home_visit">เยี่ยมบ้าน</option>

                        <option value="chronic_disease">
                            ผู้ป่วยโรคเรื้อรัง
                        </option>

                        <option value="diabetes">
                            เบาหวาน
                        </option>

                        <option value="hypertension">
                            ความดันโลหิตสูง
                        </option>

                        <option value="bedridden">
                            ผู้ป่วยติดเตียง
                        </option>

                        <option value="homebound">
                            ผู้ป่วยติดบ้าน
                        </option>

                        <option value="other">
                            อื่น ๆ
                        </option>

                    </select>

                </div>

                <div class="mb-3">

                    <label>รายละเอียด</label>

                    <textarea
                        name="remark"
                        rows="4"
                        class="form-control"></textarea>

                </div>

                <button class="btn btn-success">

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