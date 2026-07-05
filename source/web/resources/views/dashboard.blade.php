@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="mb-4">
        <h2 class="mb-0">Executive Dashboard</h2>
        <small class="text-muted">ภาพรวม PPY Digital Platform</small>
    </div>

    <div class="row">

        <div class="col-md-3 mb-3">
            <div class="card border-primary">
                <div class="card-body">
                    <h6 class="text-muted">Population</h6>
                    <h2>4,000</h2>
                    <a href="{{ route('population.dashboard') }}" class="btn btn-sm btn-primary">
                        เปิด Dashboard
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card border-success">
                <div class="card-body">
                    <h6 class="text-muted">Households</h6>
                    <h2>1,500</h2>
                    <a href="{{ route('households.index') }}" class="btn btn-sm btn-success">
                        ดูครัวเรือน
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card border-warning">
                <div class="card-body">
                    <h6 class="text-muted">Welfare</h6>
                    <h2>Coming</h2>
                    <span class="badge bg-warning text-dark">CP-0.30</span>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card border-danger">
                <div class="card-body">
                    <h6 class="text-muted">GIS / Flood Zone</h6>
                    <h2>Ready</h2>
                    <span class="badge bg-danger">CP-0.50</span>
                </div>
            </div>
        </div>

    </div>

    <div class="card">
        <div class="card-header">
            <strong>Roadmap Status</strong>
        </div>
        <div class="card-body">
            <ul class="mb-0">
                <li>✅ Core Platform</li>
                <li>✅ Population CRUD</li>
                <li>✅ Citizen 360 / Household 360</li>
                <li>✅ Population Dashboard</li>
                <li>🔄 Welfare Module</li>
                <li>🔄 Public Health Module</li>
                <li>🔄 GIS Platform</li>
            </ul>
        </div>
    </div>

</div>
@endsection
