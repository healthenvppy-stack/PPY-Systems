@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between mb-3">
        <div>
            <h3 class="mb-0">ข้อมูลสุขภาพ / Health Profile</h3>
            <small class="text-muted">
                {{ $citizen->first_name }} {{ $citizen->last_name }}
            </small>
        </div>

        <a href="{{ route('citizens.show', $citizen) }}" class="btn btn-secondary">
            ย้อนกลับ
        </a>
    </div>

    <div class="card">
        <div class="card-body">

            <form method="POST" action="{{ route('citizens.health-profile.update', $citizen) }}">
                @csrf
                @method('PUT')

                <div class="row">

                    <div class="col-md-4 mb-3">
                        <label><input type="checkbox" name="has_chronic_disease" value="1" {{ $profile->has_chronic_disease ? 'checked' : '' }}> โรคเรื้อรัง</label>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label><input type="checkbox" name="has_diabetes" value="1" {{ $profile->has_diabetes ? 'checked' : '' }}> เบาหวาน</label>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label><input type="checkbox" name="has_hypertension" value="1" {{ $profile->has_hypertension ? 'checked' : '' }}> ความดันโลหิตสูง</label>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label><input type="checkbox" name="has_heart_disease" value="1" {{ $profile->has_heart_disease ? 'checked' : '' }}> โรคหัวใจ</label>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label><input type="checkbox" name="has_kidney_disease" value="1" {{ $profile->has_kidney_disease ? 'checked' : '' }}> โรคไต</label>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label><input type="checkbox" name="is_bedridden" value="1" {{ $profile->is_bedridden ? 'checked' : '' }}> ผู้ป่วยติดเตียง</label>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label><input type="checkbox" name="is_homebound" value="1" {{ $profile->is_homebound ? 'checked' : '' }}> ผู้ป่วยติดบ้าน</label>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label><input type="checkbox" name="is_disabled" value="1" {{ $profile->is_disabled ? 'checked' : '' }}> ผู้พิการ</label>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label><input type="checkbox" name="is_elderly" value="1" {{ $profile->is_elderly ? 'checked' : '' }}> ผู้สูงอายุ</label>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>ระดับสุขภาพ</label>
                        <select name="health_level" class="form-control">
                            <option value="green" {{ $profile->health_level == 'green' ? 'selected' : '' }}>เขียว / ปกติ</option>
                            <option value="yellow" {{ $profile->health_level == 'yellow' ? 'selected' : '' }}>เหลือง / เฝ้าระวัง</option>
                            <option value="orange" {{ $profile->health_level == 'orange' ? 'selected' : '' }}>ส้ม / เสี่ยงสูง</option>
                            <option value="red" {{ $profile->health_level == 'red' ? 'selected' : '' }}>แดง / วิกฤต</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>วันที่เยี่ยมบ้านล่าสุด</label>
                        <input type="date" name="last_home_visit_at" class="form-control"
                               value="{{ optional($profile->last_home_visit_at)->format('Y-m-d') }}">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>หมายเหตุ</label>
                        <textarea name="remark" rows="3" class="form-control">{{ $profile->remark }}</textarea>
                    </div>

                </div>

                <button class="btn btn-primary">บันทึก</button>
                <a href="{{ route('citizens.show', $citizen) }}" class="btn btn-secondary">ยกเลิก</a>

            </form>

        </div>
    </div>

</div>
@endsection