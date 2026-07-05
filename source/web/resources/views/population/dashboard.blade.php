@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">Population Dashboard</h3>
            <small class="text-muted">ภาพรวมข้อมูลประชากรและครัวเรือน</small>
        </div>
    </div>

    <div class="row">

        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-muted">ประชากรทั้งหมด</h6>
                    <h2>{{ number_format($totalCitizens) }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-muted">ครัวเรือนทั้งหมด</h6>
                    <h2>{{ number_format($totalHouseholds) }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-muted">ชาย</h6>
                    <h2>{{ number_format($male) }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-muted">หญิง</h6>
                    <h2>{{ number_format($female) }}</h2>
                </div>
            </div>
        </div>

    </div>

    <div class="card mb-3">
        <div class="card-header">
            <strong>โซนน้ำท่วมของครัวเรือน</strong>
        </div>

        <div class="card-body">
            <div class="row text-center">

                <div class="col-md-3 mb-2">
                    <div class="p-3 rounded" style="background:#198754;color:white;">
                        <h5>เขียว / ไม่ท่วม</h5>
                        <h2>{{ number_format($green) }}</h2>
                    </div>
                </div>

                <div class="col-md-3 mb-2">
                    <div class="p-3 rounded" style="background:#ffc107;color:#000;">
                        <h5>เหลือง / เล็กน้อย</h5>
                        <h2>{{ number_format($yellow) }}</h2>
                    </div>
                </div>

                <div class="col-md-3 mb-2">
                    <div class="p-3 rounded" style="background:#fd7e14;color:white;">
                        <h5>ส้ม / ปานกลาง</h5>
                        <h2>{{ number_format($orange) }}</h2>
                    </div>
                </div>

                <div class="col-md-3 mb-2">
                    <div class="p-3 rounded" style="background:#dc3545;color:white;">
                        <h5>แดง / ท่วมหนัก</h5>
                        <h2>{{ number_format($red) }}</h2>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <strong>เมนูลัด</strong>
        </div>

        <div class="card-body">
            <a href="{{ route('citizens.index') }}" class="btn btn-primary">
                ข้อมูลประชาชน
            </a>

            <a href="{{ route('households.index') }}" class="btn btn-success">
                ข้อมูลครัวเรือน
            </a>
        </div>
    </div>

</div>
@endsection