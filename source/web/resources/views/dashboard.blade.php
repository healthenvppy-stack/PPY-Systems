@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="mb-4">
        <h2 class="mb-0">ภาพรวมผู้บริหาร / Executive Dashboard</h2>
        <small class="text-muted">สรุปข้อมูลหลักของ PPY Digital Platform</small>
    </div>

    <div class="row">

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-primary h-100">
                <div class="card-body">
                    <h6 class="text-muted">ประชากรทั้งหมด / Citizens</h6>
                    <h2>{{ number_format($totalCitizens) }}</h2>
                    <a href="{{ route('population.dashboard') }}" class="btn btn-sm btn-primary">
                        เปิดข้อมูลประชากร
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-success h-100">
                <div class="card-body">
                    <h6 class="text-muted">ครัวเรือนทั้งหมด / Households</h6>
                    <h2>{{ number_format($totalHouseholds) }}</h2>
                    <a href="{{ route('households.index') }}" class="btn btn-sm btn-success">
                        เปิดข้อมูลครัวเรือน
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-warning h-100">
                <div class="card-body">
                    <h6 class="text-muted">ผู้สูงอายุ / Elderly</h6>
                    <h2>{{ number_format($elderly) }}</h2>
                    <a href="{{ route('social-welfare.dashboard') }}" class="btn btn-sm btn-warning">
                        เปิดสวัสดิการ
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-danger h-100">
                <div class="card-body">
                    <h6 class="text-muted">โรคเรื้อรัง / Chronic Disease</h6>
                    <h2>{{ number_format($chronic) }}</h2>
                    <a href="{{ route('public-health.dashboard') }}" class="btn btn-sm btn-danger">
                        เปิดสาธารณสุข
                    </a>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-lg-4 mb-3">
            <div class="card h-100">
                <div class="card-header">
                    <strong>สวัสดิการสังคม / Social Welfare</strong>
                </div>
                <div class="card-body">
                    <p class="mb-2">
                        ผู้สูงอายุทั้งหมด:
                        <strong>{{ number_format($elderly) }}</strong>
                    </p>

                    <p class="mb-2">
                        รับเบี้ยผู้สูงอายุ:
                        <strong>{{ number_format($elderlyAllowanceRecipients) }}</strong>
                    </p>

                    <p class="mb-2">
                        ผู้สูงอายุที่ยังไม่ได้รับเบี้ย:
                        <strong>{{ number_format($elderlyWithoutAllowance) }}</strong>
                    </p>

                    <p class="mb-2">
                        ผู้พิการ:
                        <strong>{{ number_format($disabled) }}</strong>
                    </p>

                    <p class="mb-2">
                        รับเบี้ยความพิการ:
                        <strong>{{ number_format($disabledAllowanceRecipients) }}</strong>
                    </p>

                    <p class="mb-0">
                        สิทธิ์ที่รอตรวจสอบ:
                        <strong>{{ number_format($pendingBenefits) }}</strong>
                    </p>

                    <a href="{{ route('social-welfare.dashboard') }}"
                    class="btn btn-sm btn-warning mt-3">
                        เปิดข้อมูลสวัสดิการ
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-3">
            <div class="card h-100">
                <div class="card-header">
                    <strong>สาธารณสุข / Public Health</strong>
                </div>
                <div class="card-body">
                    <p class="mb-2">โรคเรื้อรัง: <strong>{{ number_format($chronic) }}</strong></p>
                    <p class="mb-2">เบาหวาน: <strong>{{ number_format($diabetes) }}</strong></p>
                    <p class="mb-0">ความดันโลหิตสูง: <strong>{{ number_format($hypertension) }}</strong></p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-3">
            <div class="card h-100">
                <div class="card-header">
                    <strong>เคสบริการ / Service Cases</strong>
                </div>
                <div class="card-body">
                    <p class="mb-2">เปิดใหม่: <strong>{{ number_format($openCases) }}</strong></p>
                    <p class="mb-2">กำลังดำเนินการ: <strong>{{ number_format($processingCases) }}</strong></p>
                    <p class="mb-0">ปิดแล้ว: <strong>{{ number_format($closedCases) }}</strong></p>

                    <a href="{{ route('service-cases.index') }}" class="btn btn-sm btn-info mt-3">
                        เปิดรายการเคส
                    </a>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection