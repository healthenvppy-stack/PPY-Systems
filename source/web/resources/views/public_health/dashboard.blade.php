@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between mb-3">

        <div>

            <h3 class="mb-0">
                สาธารณสุข / Public Health
            </h3>

            <small class="text-muted">
                ภาพรวมข้อมูลสุขภาพประชาชน
            </small>

        </div>

        <a href="{{ route('service-cases.create') }}"
           class="btn btn-primary">

            + เปิดเคสสุขภาพ

        </a>

    </div>

    <div class="row">

        <div class="col-md-3 mb-3">
            <div class="card border-primary">
                <div class="card-body">
                    <h6>โรคเรื้อรัง</h6>
                    <h2>{{ number_format($chronic) }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card border-success">
                <div class="card-body">
                    <h6>เบาหวาน</h6>
                    <h2>{{ number_format($diabetes) }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card border-warning">
                <div class="card-body">
                    <h6>ความดัน</h6>
                    <h2>{{ number_format($hypertension) }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card border-danger">
                <div class="card-body">
                    <h6>ผู้ป่วยติดเตียง</h6>
                    <h2>{{ number_format($bedridden) }}</h2>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-md-3 mb-3">
            <div class="card border-info">
                <div class="card-body">
                    <h6>ผู้ป่วยติดบ้าน</h6>
                    <h2>{{ number_format($homebound) }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-2 mb-3">
            <div class="card border-success">
                <div class="card-body text-center">
                    <h6>เขียว</h6>
                    <h2>{{ $green }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-2 mb-3">
            <div class="card border-warning">
                <div class="card-body text-center">
                    <h6>เหลือง</h6>
                    <h2>{{ $yellow }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-2 mb-3">
            <div class="card border-orange">
                <div class="card-body text-center">
                    <h6>ส้ม</h6>
                    <h2>{{ $orange }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="card border-danger">
                <div class="card-body text-center">
                    <h6>แดง</h6>
                    <h2>{{ $red }}</h2>
                </div>
            </div>
        </div>

    </div>

    <div class="card">

        <div class="card-header">

            <strong>
                เคสสาธารณสุขล่าสุด
            </strong>

        </div>

        <div class="card-body">

            <table class="table table-bordered table-hover">

                <thead>

                <tr>

                    <th>เลขเคส</th>

                    <th>ประชาชน</th>

                    <th>ประเภท</th>

                    <th>สถานะ</th>

                    <th width="120">รายละเอียด</th>

                </tr>

                </thead>

                <tbody>

                @forelse($latestCases as $case)

                    <tr>

                        <td>{{ $case->case_no }}</td>

                        <td>

                            {{ optional($case->citizen)->first_name }}
                            {{ optional($case->citizen)->last_name }}

                        </td>

                        <td>{{ $case->case_type }}</td>

                        <td>{{ $case->status }}</td>

                        <td>

                            <a href="{{ route('service-cases.show',$case) }}"
                               class="btn btn-sm btn-info">

                                ดู

                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5"
                            class="text-center">

                            ยังไม่มีข้อมูล

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection