@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between mb-3">

        <div>

            <h3>{{ $serviceCase->case_no }}</h3>

            <small class="text-muted">
            รายละเอียดเคส / Case Detail
            </small>

        </div>

        <a href="{{ route('service-cases.index') }}"
        class="btn btn-secondary">

        ย้อนกลับ

        </a>

    </div>

        <div class="row">

            <div class="col-lg-5">

                <div class="card">

                    <div class="card-header">

                    ข้อมูลเคส

                    </div>

                    <div class="card-body">

                        <table class="table table-sm">

                            <tr>
                            <th width="40%">เลขเคส</th>
                            <td>{{ $serviceCase->case_no }}</td>
                            </tr>

                            <tr>
                            <th>ประชาชน</th>
                            <td>

                            @if($serviceCase->citizen)

                            {{ $serviceCase->citizen->first_name }}
                            {{ $serviceCase->citizen->last_name }}

                            @endif

                            </td>
                            </tr>

                            <tr>
                            <th>โมดูล</th>
                            <td>{{ $serviceCase->module }}</td>
                            </tr>

                            <tr>
                            <th>ประเภท</th>
                            <td>{{ $serviceCase->case_type }}</td>
                            </tr>

                            <tr>
                            <th>สถานะ</th>
                            <td>{{ $serviceCase->status }}</td>
                            </tr>

                            <tr>
                            <th>Priority</th>
                            <td>{{ $serviceCase->priority }}</td>
                            </tr>

                            <tr>
                            <th>Remark</th>
                            <td>{{ $serviceCase->remark }}</td>
                            </tr>

                        </table>
                        <hr>

                        <form method="POST" action="{{ route('service-cases.update-status', $serviceCase) }}">
                            @csrf
                            @method('PATCH')

                            <div class="mb-3">
                                <label>เปลี่ยนสถานะเคส</label>
                                <select name="status" class="form-control">
                                    <option value="open" {{ $serviceCase->status == 'open' ? 'selected' : '' }}>เปิดเคส</option>
                                    <option value="assessing" {{ $serviceCase->status == 'assessing' ? 'selected' : '' }}>ประเมิน</option>
                                    <option value="approved" {{ $serviceCase->status == 'approved' ? 'selected' : '' }}>อนุมัติ</option>
                                    <option value="processing" {{ $serviceCase->status == 'processing' ? 'selected' : '' }}>ดำเนินการ</option>
                                    <option value="follow_up" {{ $serviceCase->status == 'follow_up' ? 'selected' : '' }}>ติดตามผล</option>
                                    <option value="closed" {{ $serviceCase->status == 'closed' ? 'selected' : '' }}>ปิดเคส</option>
                                    <option value="cancelled" {{ $serviceCase->status == 'cancelled' ? 'selected' : '' }}>ยกเลิก</option>
                                </select>
                            </div>

                            <button class="btn btn-primary">
                                อัปเดตสถานะ
                            </button>
                        </form>

                    </div>

                </div>

            </div>

        <div class="col-lg-7">

            <div class="card">

                <div class="card-header">

                Timeline

                </div>

                <div class="card-body">
                    <form method="POST"
                        action="{{ route('service-cases.timeline.store', $serviceCase) }}"
                        class="mb-4">

                        @csrf

                        <div class="row">

                            <div class="col-md-4 mb-2">
                                <label>กิจกรรม</label>
                                <select name="action" class="form-control">
                                    <option value="field_visit">ลงพื้นที่</option>
                                    <option value="home_visit">เยี่ยมบ้าน</option>
                                    <option value="phone_followup">โทรติดตาม</option>
                                    <option value="assistance_given">มอบความช่วยเหลือ</option>
                                    <option value="referred">ส่งต่อหน่วยงาน</option>
                                    <option value="follow_up">นัดติดตามผล</option>
                                    <option value="note">บันทึกทั่วไป</option>
                                </select>
                            </div>

                            <div class="col-md-4 mb-2">
                                <label>วันที่กิจกรรม</label>
                                <input type="datetime-local"
                                    name="action_at"
                                    class="form-control"
                                    value="{{ now()->format('Y-m-d\TH:i') }}">
                            </div>

                            <div class="col-md-12 mb-2">
                                <label>รายละเอียด</label>
                                <textarea name="description"
                                        rows="3"
                                        class="form-control"></textarea>
                            </div>

                        </div>

                        <button class="btn btn-primary btn-sm">
                            + บันทึกกิจกรรม
                        </button>

                    </form>

                    <hr>

                    @forelse($serviceCase->timelines as $timeline)

                    <div class="border-start border-3 border-primary ps-3 mb-3">

                        <strong>

                        {{ $timeline->action }}

                        </strong>

                        <br>

                        {{ $timeline->description }}

                        <br>

                        <small class="text-muted">

                        {{ optional($timeline->action_at)->format('d/m/Y H:i') }}

                        </small>

                    </div>

                @empty

                ไม่มี Timeline

                @endforelse

                </div>

            </div>

        </div>

    </div>

</div>

@endsection