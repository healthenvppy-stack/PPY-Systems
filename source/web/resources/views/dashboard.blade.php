@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="mb-4">
        <h2 class="mb-0">ภาพรวมผู้บริหาร / Executive Dashboard</h2>
        <small class="text-muted">ภาพรวม PPY Digital Platform</small>
    </div>

    <div class="row">

        <div class="col-md-3 mb-3">
            <div class="card border-primary">
                <div class="card-body">
                    <h6 class="text-muted">ประชากร / Population</h6>
                    <h2>พร้อมใช้งาน</h2>
                    <a href="{{ route('population.dashboard') }}" class="btn btn-sm btn-primary">
                        เปิด Dashboard
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card border-success">
                <div class="card-body">
                    <h6 class="text-muted">ครัวเรือน / Households</h6>
                    <h2>พร้อมใช้งาน</h2>
                    <a href="{{ route('households.index') }}" class="btn btn-sm btn-success">
                        ดูครัวเรือน
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card border-warning">
                <div class="card-body">
                    <h6 class="text-muted">สวัสดิการ / Welfare</h6>
                    <h2>V1</h2>
                    <a href="{{ route('social-welfare.dashboard') }}" class="btn btn-sm btn-warning">
                        เปิด Welfare
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card border-info">
                <div class="card-body">
                    <h6 class="text-muted">เคสบริการ / Service Cases</h6>
                    <h2>Core</h2>
                    <a href="{{ route('service-cases.index') }}" class="btn btn-sm btn-info">
                        เปิดเคส
                    </a>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection