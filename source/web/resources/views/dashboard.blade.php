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
                    <h6 class="text-muted">ประชากรทั้งหมด</h6>
                    <h2>{{ number_format($totalCitizens) }}</h2>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-info h-100">
                <div class="card-body">
                    <h6 class="text-muted">ชาย</h6>
                    <h2>{{ number_format($totalMale) }}</h2>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-danger h-100">
                <div class="card-body">
                    <h6 class="text-muted">หญิง</h6>
                    <h2>{{ number_format($totalFemale) }}</h2>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-success h-100">
                <div class="card-body">
                    <h6 class="text-muted">หลังคาเรือนทั้งหมด</h6>
                    <h2>{{ number_format($totalHouseholds) }}</h2>
                </div>
            </div>
        </div>

    </div>

    <div class="card mb-3">
        <div class="card-header">
            <strong>ประชากรตามช่วงอายุ</strong>
        </div>

        <div class="card-body">
            <div class="row">

                @php
                    $ageLabels = [
                        'age_0_2' => '0–2 ปี',
                        'age_3_5' => '3–5 ปี',
                        'age_6_12' => '6–12 ปี',
                        'age_13_18' => '13–18 ปี',
                        'age_19_35' => '19–35 ปี',
                        'age_36_59' => '36–59 ปี',
                        'age_60_plus' => '60 ปีขึ้นไป',
                    ];
                @endphp

                @foreach($ageLabels as $key => $label)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                        <div class="card h-100 border-secondary">
                            <div class="card-body text-center">
                                <h6 class="text-muted">{{ $label }}</h6>
                                <h3>{{ number_format($ageGroups[$key] ?? 0) }}</h3>
                                <small class="text-muted">คน</small>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            <strong>ผู้มีอายุมากที่สุด</strong>
        </div>

        <div class="card-body">
            @if($oldestCitizen)
                <h4>
                    {{ $oldestCitizen->first_name }}
                    {{ $oldestCitizen->last_name }}
                </h4>

                <p class="mb-1">
                    อายุ:
                    <strong>{{ number_format($oldestCitizenAge) }} ปี</strong>
                </p>

                <p class="mb-1">
                    วันเกิด:
                    {{ optional($oldestCitizen->birth_date)->format('d/m/Y') ?? '-' }}
                </p>

                <p class="mb-0">
                    บ้านเลขที่:
                    {{ $oldestCitizen->household?->house_no ?? '-' }}
                    หมู่
                    {{ $oldestCitizen->household?->moo ?? '-' }}
                </p>

                <a href="{{ route('citizens.show', $oldestCitizen) }}"
                class="btn btn-sm btn-primary mt-3">
                    เปิด Citizen 360
                </a>
            @else
                <div class="text-muted">
                    ยังไม่มีข้อมูลวันเกิด
                </div>
            @endif
        </div>
    </div>

    <div class="card mb-3">

        <div class="card-header">
            <strong>ประชากรแยกตามหมู่</strong>
        </div>

        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-hover">

                    <thead>
                        <tr>
                            <th>หมู่</th>
                            <th>หลังคาเรือน</th>
                            <th>ประชากรรวม</th>
                            <th>ชาย</th>
                            <th>หญิง</th>
                            <th>ร้อยละของประชากร</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($populationByVillage as $village)
                            <tr>
                                <td>{{ $village->moo }}</td>
                                <td>{{ number_format($village->household_count) }}</td>
                                <td>{{ number_format($village->population_count) }}</td>
                                <td>{{ number_format($village->male_count) }}</td>
                                <td>{{ number_format($village->female_count) }}</td>
                                <td>
                                    {{ $totalCitizens > 0
                                        ? number_format(($village->population_count / $totalCitizens) * 100, 2)
                                        : '0.00' }}%
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">
                                    ยังไม่มีข้อมูลประชากรแยกตามหมู่
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                    <tfoot>
                        <tr>
                            <th>รวม</th>
                            <th>{{ number_format($totalHouseholds) }}</th>
                            <th>{{ number_format($totalCitizens) }}</th>
                            <th>{{ number_format($totalMale) }}</th>
                            <th>{{ number_format($totalFemale) }}</th>
                            <th>100.00%</th>
                        </tr>
                    </tfoot>

                </table>
            </div>

        </div>
    </div>

    <!--<div class="row">

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

    </div>-->

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