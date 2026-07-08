@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="mb-3">
        <h3>ข้อมูลสวัสดิการ</h3>
        <p class="text-muted">
            {{ $citizen->first_name }} {{ $citizen->last_name }}
        </p>
    </div>

    <form method="POST"
          action="{{ route('citizens.welfare-profile.update',$citizen) }}">

        @csrf
        @method('PUT')

        <div class="card">

            <div class="card-body">

                <div class="row">

                    <div class="col-md-4">

                        <div class="form-check">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="is_elderly"
                                value="1"
                                {{ $profile->is_elderly ? 'checked' : '' }}>

                            <label class="form-check-label">
                                ผู้สูงอายุ
                            </label>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-check">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="is_disabled"
                                value="1"
                                {{ $profile->is_disabled ? 'checked' : '' }}>

                            <label class="form-check-label">
                                ผู้พิการ
                            </label>

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="form-check">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="is_low_income"
                                value="1"
                                {{ $profile->is_low_income ? 'checked' : '' }}>

                            <label class="form-check-label">
                                ผู้มีรายได้น้อย
                            </label>

                        </div>

                    </div>

                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input"
                                type="checkbox"
                                name="is_vulnerable"
                                value="1"
                                {{ $profile->is_vulnerable ? 'checked' : '' }}>

                            <label class="form-check-label">
                                กลุ่มเปราะบาง
                            </label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input"
                                type="checkbox"
                                name="is_homebound"
                                value="1"
                                {{ $profile->is_homebound ? 'checked' : '' }}>

                            <label class="form-check-label">
                                ผู้ป่วยติดบ้าน
                            </label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-check">
                            <input class="form-check-input"
                                type="checkbox"
                                name="is_bedridden"
                                value="1"
                                {{ $profile->is_bedridden ? 'checked' : '' }}>

                            <label class="form-check-label">
                                ผู้ป่วยติดเตียง
                            </label>
                        </div>
                    </div>

                    <div class="col-md-4 mt-4">
                        <label>ระดับการดูแล</label>
                        <select name="care_level" class="form-control">
                            <option value="normal" {{ $profile->care_level == 'normal' ? 'selected' : '' }}>ปกติ</option>
                            <option value="watch" {{ $profile->care_level == 'watch' ? 'selected' : '' }}>เฝ้าระวัง</option>
                            <option value="home_visit" {{ $profile->care_level == 'home_visit' ? 'selected' : '' }}>เยี่ยมบ้าน</option>
                            <option value="homebound" {{ $profile->care_level == 'homebound' ? 'selected' : '' }}>ติดบ้าน</option>
                            <option value="bedridden" {{ $profile->care_level == 'bedridden' ? 'selected' : '' }}>ติดเตียง</option>
                        </select>
                    </div>

                    <div class="col-md-4 mt-4">
                        <label>ระดับความเสี่ยง</label>
                        <select name="risk_level" class="form-control">
                            <option value="low" {{ $profile->risk_level == 'low' ? 'selected' : '' }}>ต่ำ</option>
                            <option value="medium" {{ $profile->risk_level == 'medium' ? 'selected' : '' }}>กลาง</option>
                            <option value="high" {{ $profile->risk_level == 'high' ? 'selected' : '' }}>สูง</option>
                            <option value="critical" {{ $profile->risk_level == 'critical' ? 'selected' : '' }}>วิกฤต</option>
                        </select>
                    </div>

                    <div class="col-md-4 mt-4">
                        <label>ความสำคัญ</label>
                        <select name="priority_level" class="form-control">
                            <option value="normal" {{ $profile->priority_level == 'normal' ? 'selected' : '' }}>ปกติ</option>
                            <option value="urgent" {{ $profile->priority_level == 'urgent' ? 'selected' : '' }}>ด่วน</option>
                            <option value="emergency" {{ $profile->priority_level == 'emergency' ? 'selected' : '' }}>ฉุกเฉิน</option>
                        </select>
                    </div>

                    <div class="col-md-12 mt-4">

                        <label>หมายเหตุ</label>

                        <textarea
                            class="form-control"
                            rows="4"
                            name="remark">{{ $profile->remark }}</textarea>

                    </div>

                </div>

            </div>

            <div class="card-footer">

                <button class="btn btn-primary">
                    บันทึกข้อมูล
                </button>

                <a href="{{ route('citizens.show',$citizen) }}"
                   class="btn btn-secondary">

                    ย้อนกลับ

                </a>

            </div>

        </div>

    </form>

</div>

@endsection