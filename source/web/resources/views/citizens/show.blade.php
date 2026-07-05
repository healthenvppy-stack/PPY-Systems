@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">Citizen 360°</h3>
            <small class="text-muted">แฟ้มข้อมูลประชาชนแบบรวมศูนย์</small>
        </div>

        <div>
            <a href="{{ route('citizens.edit', $citizen) }}" class="btn btn-warning">แก้ไขข้อมูล</a>
            <a href="{{ route('citizens.index') }}" class="btn btn-secondary">ย้อนกลับ</a>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body d-flex justify-content-between align-items-center">

            <div>
                <h3 class="mb-1">{{ $citizen->first_name }} {{ $citizen->last_name }}</h3>
                <div class="text-muted">
                    เลขบัตร: {{ substr($citizen->cid, 0, 5) }}XXXX{{ substr($citizen->cid, -4) }}
                </div>
                <div class="text-muted">
                    เพศ: {{ $citizen->gender }}
                    |
                    วันเกิด: {{ optional($citizen->birth_date)->format('d/m/Y') ?? '-' }}
                </div>
            </div>

            <div class="text-end">
                @if($citizen->status)
                    <span class="badge bg-success fs-6">ใช้งาน</span>
                @else
                    <span class="badge bg-secondary fs-6">ไม่ใช้งาน</span>
                @endif
            </div>

        </div>
    </div>

    <div class="row">

        <div class="col-md-3 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="text-muted">ครัวเรือน</h6>

                    @if($citizen->household)
                        <h5>{{ $citizen->household->house_code }}</h5>
                        <p class="mb-0">
                            บ้านเลขที่ {{ $citizen->household->house_no }}
                            หมู่ {{ $citizen->household->moo }}
                        </p>
                    @else
                        <p class="text-muted mb-0">ยังไม่เชื่อมครัวเรือน</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="text-muted">Welfare</h6>
                    <h5>รอเชื่อมข้อมูล</h5>
                    <p class="mb-0 text-muted">สวัสดิการ / กลุ่มเปราะบาง</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="text-muted">Public Health</h6>
                    <h5>รอเชื่อมข้อมูล</h5>
                    <p class="mb-0 text-muted">สุขภาพ / โรคเรื้อรัง / เยี่ยมบ้าน</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <h6 class="text-muted">GIS</h6>

                    @if($citizen->household)
                        <p class="mb-0">
                            Lat: {{ $citizen->household->latitude ?? '-' }}<br>
                            Lng: {{ $citizen->household->longitude ?? '-' }}
                        </p>
                    @else
                        <p class="text-muted mb-0">ยังไม่มีพิกัด</p>
                    @endif
                </div>
            </div>
        </div>

    </div>
<!---->
    @if($citizen->household)

        <hr>

        <strong>สมาชิกในบ้าน</strong>

        <ul class="mb-0">

        @foreach($citizen->household->citizens as $member)

        <li>

        {{ $member->first_name }}
        {{ $member->last_name }}

        </li>

        @endforeach

        </ul>

        @endif


    <div class="card mb-3">
        <div class="card-header">
            <strong>ข้อมูลทั่วไป</strong>
        </div>

        <div class="card-body">
            <div class="row">

                <div class="col-md-6 mb-2">
                    <strong>ชื่อ-สกุล:</strong>
                    {{ $citizen->first_name }} {{ $citizen->last_name }}
                </div>

                <div class="col-md-6 mb-2">
                    <strong>เลขบัตร:</strong>
                    {{ substr($citizen->cid, 0, 5) }}XXXX{{ substr($citizen->cid, -4) }}
                </div>

                <div class="col-md-6 mb-2">
                    <strong>เพศ:</strong>
                    {{ $citizen->gender }}
                </div>

                <div class="col-md-6 mb-2">
                    <strong>วันเกิด:</strong>
                    {{ optional($citizen->birth_date)->format('d/m/Y') ?? '-' }}
                </div>

                <div class="col-md-6 mb-2">
                    <strong>เบอร์โทร:</strong>
                    {{ $citizen->phone ?? '-' }}
                </div>

                <div class="col-md-6 mb-2">
                    <strong>Email:</strong>
                    {{ $citizen->email ?? '-' }}
                </div>

            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <strong>Timeline</strong>
        </div>

        <div class="card-body">
            <ul class="mb-0">
                <li>สร้างข้อมูลเมื่อ {{ optional($citizen->created_at)->format('d/m/Y H:i') }}</li>
                <li>แก้ไขล่าสุด {{ optional($citizen->updated_at)->format('d/m/Y H:i') }}</li>
                <li class="text-muted">รอเชื่อมประวัติ Welfare / Public Health / GIS</li>
            </ul>
        </div>
    </div>

</div>
@endsection