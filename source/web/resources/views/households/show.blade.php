@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between mb-3">
        <h3>รายละเอียดครัวเรือน</h3>
        <a href="{{ route('households.index') }}" class="btn btn-secondary">ย้อนกลับ</a>
    </div>

    <div class="card">
        <div class="card-body">

            <table class="table table-bordered">
                <tr><th width="200">รหัสบ้าน</th><td>{{ $household->house_code }}</td></tr>
                <tr><th>บ้านเลขที่</th><td>{{ $household->house_no }}</td></tr>
                <tr><th>หมู่</th><td>{{ $household->moo }}</td></tr>
                <tr><th>ถนน</th><td>{{ $household->road }}</td></tr>
                <tr><th>ซอย</th><td>{{ $household->alley }}</td></tr>
                <tr><th>รหัสไปรษณีย์</th><td>{{ $household->postcode }}</td></tr>
                <tr><th>Latitude</th><td>{{ $household->latitude }}</td></tr>
                <tr><th>Longitude</th><td>{{ $household->longitude }}</td></tr>
                <tr><th>โซนน้ำท่วม</th><td>{{ $household->flood_level }}</td></tr>
            </table>

            <hr>

            <h5>สมาชิกในครัวเรือน</h5>

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>เลขบัตร</th>
                        <th>ชื่อ-สกุล</th>
                        <th>เพศ</th>
                        <th>จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($household->citizens as $citizen)
                        <tr>
                            <td>{{ substr($citizen->cid, 0, 5) }}XXXX{{ substr($citizen->cid, -4) }}</td>
                            <td>{{ $citizen->first_name }} {{ $citizen->last_name }}</td>
                            <td>{{ $citizen->gender }}</td>
                            <td>
                                <a href="{{ route('citizens.show', $citizen) }}" class="btn btn-sm btn-info">
                                    ดู Citizen 360
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                ยังไม่มีสมาชิกในครัวเรือน
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <a href="{{ route('households.edit', $household) }}" class="btn btn-warning">แก้ไขข้อมูล</a>

        </div>
    </div>

</div>
@endsection