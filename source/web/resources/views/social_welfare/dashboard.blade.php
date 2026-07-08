@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between mb-3">
        <div>
            <h3 class="mb-0">สวัสดิการสังคม / Social Welfare</h3>
            <small class="text-muted">ภาพรวมกลุ่มเปราะบางและเคสบริการด้านสวัสดิการ</small>
        </div>

        <a href="{{ route('service-cases.create') }}" class="btn btn-primary">
            + เปิดเคสใหม่
        </a>
    </div>

    <div class="row">
        <div class="col-md-3 mb-3"><div class="card border-primary"><div class="card-body"><h6 class="text-muted">ผู้สูงอายุ / Elderly</h6><h2>{{ number_format($elderly) }}</h2></div></div></div>
        <div class="col-md-3 mb-3"><div class="card border-warning"><div class="card-body"><h6 class="text-muted">ผู้พิการ / Disabled</h6><h2>{{ number_format($disabled) }}</h2></div></div></div>
        <div class="col-md-3 mb-3"><div class="card border-success"><div class="card-body"><h6 class="text-muted">ผู้มีรายได้น้อย / Low Income</h6><h2>{{ number_format($lowIncome) }}</h2></div></div></div>
        <div class="col-md-3 mb-3"><div class="card border-danger"><div class="card-body"><h6 class="text-muted">ผู้ป่วยติดเตียง / Bedridden</h6><h2>{{ number_format($bedridden) }}</h2></div></div></div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-3"><div class="card border-info"><div class="card-body"><h6 class="text-muted">ผู้ป่วยติดบ้าน / Homebound</h6><h2>{{ number_format($homebound) }}</h2></div></div></div>
        <div class="col-md-4 mb-3"><div class="card border-secondary"><div class="card-body"><h6 class="text-muted">เคสเปิดอยู่ / Open Cases</h6><h2>{{ number_format($openCases) }}</h2></div></div></div>
        <div class="col-md-4 mb-3"><div class="card border-danger"><div class="card-body"><h6 class="text-muted">เคสด่วน / Urgent Cases</h6><h2>{{ number_format($urgentCases) }}</h2></div></div></div>
    </div>

    <div class="card">
        <div class="card-header">
            <strong>เคสล่าสุด / Latest Cases</strong>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>เลขเคส</th>
                        <th>ประชาชน</th>
                        <th>ประเภท</th>
                        <th>สถานะ</th>
                        <th>ความสำคัญ</th>
                        <th width="120">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($latestCases as $case)
                        <tr>
                            <td>{{ $case->case_no }}</td>
                            <td>{{ $case->citizen ? $case->citizen->first_name.' '.$case->citizen->last_name : '-' }}</td>
                            <td>{{ $case->case_type }}</td>
                            <td>{{ $case->status }}</td>
                            <td>{{ $case->priority }}</td>
                            <td>
                                <a href="{{ route('service-cases.show', $case) }}" class="btn btn-sm btn-info">ดู</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">ยังไม่มีเคสสวัสดิการ</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection