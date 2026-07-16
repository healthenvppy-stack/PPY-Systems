@extends('layouts.app')

@section('content')
<div class="container-fluid ppy-dashboard">

    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <div>
            <h2 class="mb-1 fw-bold">PPY Executive Dashboard</h2>
            <div class="text-muted">
                เทศบาลตำบลโพธิ์พระยา / PPY Digital Platform
            </div>
        </div>

        <div class="text-end">
            <div class="fw-semibold">{{ now()->format('d/m/Y') }}</div>
            <small class="text-muted">ข้อมูลภาพรวมสำหรับผู้บริหาร</small>
        </div>
    </div>

    {{-- KPI หลัก --}}
    <div class="row g-3 mb-4">

        <div class="col-xl-3 col-md-6">
            <a href="{{ route('citizens.index') }}"
                    class="text-decoration-none">
            <div class="ppy-kpi ppy-kpi-blue">
                <div>
                    <div class="ppy-kpi-label">ประชากรทั้งหมด</div>
                    <div class="ppy-kpi-value">{{ number_format($totalCitizens) }}</div>
                    <div class="ppy-kpi-note">ข้อมูลประชาชนในระบบ</div>
                </div>
                <div class="ppy-kpi-icon">👥</div>
            </div>
            </a>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="ppy-kpi ppy-kpi-green">
                <div>
                    <div class="ppy-kpi-label">หลังคาเรือนทั้งหมด</div>
                    <div class="ppy-kpi-value">{{ number_format($totalHouseholds) }}</div>
                    <div class="ppy-kpi-note">ครัวเรือนในเขตเทศบาล</div>
                </div>
                <div class="ppy-kpi-icon">🏠</div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <a href="{{ route('citizens.index', ['gender' => 'ชาย']) }}"
                class="text-decoration-none">
            <div class="ppy-kpi ppy-kpi-cyan">
                <div>
                    <div class="ppy-kpi-label">ประชากรชาย</div>
                    <div class="ppy-kpi-value">{{ number_format($totalMale) }}</div>
                    <div class="ppy-kpi-note">
                        {{ $totalCitizens > 0
                            ? number_format(($totalMale / $totalCitizens) * 100, 2)
                            : '0.00' }}%
                    </div>
                </div>
                <div class="ppy-kpi-icon">♂</div>
            </div>
            </a>
        </div>

        <div class="col-xl-3 col-md-6">
            <a href="{{ route('citizens.index', ['gender' => 'หญิง']) }}"
                class="text-decoration-none">
            <div class="ppy-kpi ppy-kpi-pink">
                <div>
                    <div class="ppy-kpi-label">ประชากรหญิง</div>
                    <div class="ppy-kpi-value">{{ number_format($totalFemale) }}</div>
                    <div class="ppy-kpi-note">
                        {{ $totalCitizens > 0
                            ? number_format(($totalFemale / $totalCitizens) * 100, 2)
                            : '0.00' }}%
                    </div>
                </div>
                <div class="ppy-kpi-icon">♀</div>
            </div>
            </a>
        </div>

    </div>

    {{-- กลุ่มเป้าหมาย --}}
    <div class="mb-3">
        <div class="ppy-section-title">
            กลุ่มเป้าหมายด้านสุขภาพและสวัสดิการ
        </div>
    </div>

    <div class="row g-3 mb-4">

        <div class="col-xl-3 col-md-6">
            <a href="{{ route('citizens.index', ['age_group' => 'elderly']) }}"
                class="text-decoration-none text-reset">
            <div class="ppy-mini-card">
                <div class="ppy-mini-icon ppy-icon-orange">👴</div>
                <div>
                    <div class="ppy-mini-label">ผู้สูงอายุ</div>
                    <div class="ppy-mini-value">{{ number_format($elderly) }}</div>
                    <div class="ppy-mini-note">คน</div>
                </div>
            </div>
            </a>
        </div>

        <div class="col-xl-3 col-md-6">
            <a href="{{ route('citizens.index', ['benefit' => 'elderly']) }}"
                class="text-decoration-none text-reset">
            <div class="ppy-mini-card">
                <div class="ppy-mini-icon ppy-icon-green">💰</div>
                <div>
                    <div class="ppy-mini-label">รับเบี้ยผู้สูงอายุ</div>
                    <div class="ppy-mini-value">
                        {{ number_format($elderlyAllowanceRecipients) }}
                    </div>
                    <div class="ppy-mini-note">คน</div>
                </div>
            </div>
            </a>
        </div>

        <div class="col-xl-3 col-md-6">
            <a href="{{ route('citizens.index', ['health' => 'bedridden']) }}"
                class="text-decoration-none text-reset">
            <div class="ppy-mini-card">
                <div class="ppy-mini-icon ppy-icon-purple">🛏️</div>
                <div>
                    <div class="ppy-mini-label">ผู้ป่วยติดเตียง</div>
                    <div class="ppy-mini-value">
                        {{ number_format($welfareBedridden) }}
                    </div>
                    <div class="ppy-mini-note">คน</div>
                </div>
            </div>
            </a>
        </div>

        <div class="col-xl-3 col-md-6">
            <a href="{{ route('citizens.index', ['benefit' => 'disability_profile']) }}"
                class="text-decoration-none text-reset">
            <div class="ppy-mini-card">
                <div class="ppy-mini-icon ppy-icon-red">♿</div>
                <div>
                    <div class="ppy-mini-label">ผู้พิการ</div>
                    <div class="ppy-mini-value">{{ number_format($disabled) }}</div>
                    <div class="ppy-mini-note">คน</div>
                </div>
            </div>
            </a>
        </div>

    </div>

    {{-- Charts --}}
    <div class="row g-3 mb-4">

        <div class="col-xl-7">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 pt-3">
                    <strong>ประชากรแยกตามหมู่บ้าน</strong>
                    <div class="small text-muted">เปรียบเทียบประชากรชายและหญิง</div>
                </div>

                <div class="card-body">
                    <div style="height: 360px;">
                        <canvas id="villageGenderChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-5">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 pt-3">
                    <strong>สัดส่วนประชากรตามช่วงอายุ</strong>
                    <div class="small text-muted">จำแนกตามกลุ่มอายุ</div>
                </div>

                <div class="card-body">
                    <div style="height: 360px;">
                        <canvas id="ageDoughnutChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Insights --}}
    <div class="row g-3 mb-4">

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small mb-2">ผู้มีอายุมากที่สุด</div>

                    @if($oldestCitizen)
                        <h5 class="mb-1">
                            {{ $oldestCitizen->first_name }}
                            {{ $oldestCitizen->last_name }}
                        </h5>

                        <div class="display-6 fw-bold text-primary">
                            {{ number_format($oldestCitizenAge) }} ปี
                        </div>

                        <div class="small text-muted">
                            บ้านเลขที่ {{ $oldestCitizen->household?->house_no ?? '-' }}
                            หมู่ {{ $oldestCitizen->household?->moo ?? '-' }}
                        </div>

                        <a href="{{ route('citizens.show', $oldestCitizen) }}"
                           class="btn btn-sm btn-outline-primary mt-3">
                            เปิด Citizen 360
                        </a>
                    @else
                        <div class="text-muted">ยังไม่มีข้อมูล</div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small mb-2">โรคเรื้อรัง</div>
                    <div class="display-6 fw-bold text-danger">
                        {{ number_format($chronic) }}
                    </div>
                    <div class="small text-muted">
                        เบาหวาน {{ number_format($diabetes) }} คน<br>
                        ความดัน {{ number_format($hypertension) }} คน
                    </div>

                    <a href="{{ route('public-health.dashboard') }}"
                       class="btn btn-sm btn-outline-danger mt-3">
                        เปิดสาธารณสุข
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small mb-2">สิทธิ์ที่รอตรวจสอบ</div>
                    <div class="display-6 fw-bold text-warning">
                        {{ number_format($pendingBenefits) }}
                    </div>
                    <div class="small text-muted">
                        รับเบี้ยความพิการ
                        {{ number_format($disabledAllowanceRecipients) }} คน
                    </div>

                    <a href="{{ route('social-welfare.dashboard') }}"
                       class="btn btn-sm btn-outline-warning mt-3">
                        เปิดสวัสดิการ
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="text-muted small mb-2">เคสบริการ</div>

                    <div class="d-flex justify-content-between mb-2">
                        <span>เปิดใหม่</span>
                        <strong>{{ number_format($openCases) }}</strong>
                    </div>

                    <div class="d-flex justify-content-between mb-2">
                        <span>กำลังดำเนินการ</span>
                        <strong>{{ number_format($processingCases) }}</strong>
                    </div>

                    <div class="d-flex justify-content-between">
                        <span>ปิดแล้ว</span>
                        <strong>{{ number_format($closedCases) }}</strong>
                    </div>

                    <a href="{{ route('service-cases.index') }}"
                       class="btn btn-sm btn-outline-info mt-3">
                        เปิดรายการเคส
                    </a>
                </div>
            </div>
        </div>

    </div>

    {{-- Village table --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white border-0 pt-3">
            <strong>รายละเอียดประชากรแยกตามหมู่</strong>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>หมู่</th>
                            <th>หลังคาเรือน</th>
                            <th>ประชากรรวม</th>
                            <th>ชาย</th>
                            <th>หญิง</th>
                            <th>ร้อยละ</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($populationByVillage as $village)
                            <tr>
                                <td>
                                    <a href="{{ route('citizens.index', ['moo' => $village->moo]) }}"
                                    class="badge bg-primary text-decoration-none">
                                        หมู่ {{ $village->moo }}
                                    </a>
                                </td>
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
                                    ยังไม่มีข้อมูล
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                    <tfoot>
                        <tr class="fw-bold">
                            <td>รวม</td>
                            <td>{{ number_format($totalHouseholds) }}</td>
                            <td>{{ number_format($totalCitizens) }}</td>
                            <td>{{ number_format($totalMale) }}</td>
                            <td>{{ number_format($totalFemale) }}</td>
                            <td>100.00%</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

</div>

<style>
.ppy-dashboard {
    --ppy-radius: 14px;
}

.ppy-kpi,
.ppy-mini-card {
    transition: transform .18s ease, box-shadow .18s ease;
}

a:hover .ppy-kpi,
a:hover .ppy-mini-card {
    transform: translateY(-4px);
    box-shadow: 0 12px 28px rgba(33, 37, 41, 0.18);
}
.ppy-kpi {
    min-height: 130px;
    border-radius: var(--ppy-radius);
    padding: 22px;
    color: #fff;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 8px 22px rgba(33, 37, 41, 0.12);
}

.ppy-kpi-blue {
    background: linear-gradient(135deg, #3167f6, #2454d8);
}

.ppy-kpi-green {
    background: linear-gradient(135deg, #10b981, #0a9b6c);
}

.ppy-kpi-cyan {
    background: linear-gradient(135deg, #15aee5, #058fc8);
}

.ppy-kpi-pink {
    background: linear-gradient(135deg, #ff718a, #ef5b78);
}

.ppy-kpi-label {
    font-size: .88rem;
    opacity: .9;
}

.ppy-kpi-value {
    font-size: 2rem;
    line-height: 1.15;
    font-weight: 800;
}

.ppy-kpi-note {
    font-size: .78rem;
    opacity: .85;
}

.ppy-kpi-icon {
    font-size: 2.4rem;
    opacity: .45;
}

.ppy-section-title {
    border-left: 4px solid #ef4444;
    padding-left: 10px;
    font-weight: 700;
}

.ppy-mini-card {
    min-height: 102px;
    background: #fff;
    border-radius: 12px;
    border: 1px solid #edf0f5;
    box-shadow: 0 4px 14px rgba(33, 37, 41, 0.07);
    padding: 18px;
    display: flex;
    align-items: center;
    gap: 14px;
}

.ppy-mini-icon {
    width: 45px;
    height: 45px;
    border-radius: 11px;
    display: grid;
    place-items: center;
    font-size: 1.35rem;
}

.ppy-icon-orange {
    background: #fff4dc;
}

.ppy-icon-green {
    background: #dcf8ec;
}

.ppy-icon-purple {
    background: #f1e8ff;
}

.ppy-icon-red {
    background: #ffe4e7;
}

.ppy-mini-label {
    font-size: .82rem;
    color: #6c757d;
}

.ppy-mini-value {
    font-size: 1.55rem;
    font-weight: 800;
    line-height: 1.15;
}

.ppy-mini-note {
    font-size: .75rem;
    color: #8a9199;
}

.ppy-dashboard .card {
    border-radius: 14px;
}

@media (max-width: 576px) {
    .ppy-kpi {
        min-height: 112px;
        padding: 18px;
    }

    .ppy-kpi-value {
        font-size: 1.65rem;
    }
}
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const villageLabels = @json(
        $populationByVillage->map(
            fn ($item) => 'หมู่ '.$item->moo
        )->values()
    );

    const villageMaleData = @json(
        $populationByVillage->pluck('male_count')->map(fn ($value) => (int) $value)->values()
    );

    const villageFemaleData = @json(
        $populationByVillage->pluck('female_count')->map(fn ($value) => (int) $value)->values()
    );

    const villageCanvas = document.getElementById('villageGenderChart');

    if (villageCanvas) {
        new Chart(villageCanvas, {
            type: 'bar',
            data: {
                labels: villageLabels,
                datasets: [
                    {
                        label: 'ชาย',
                        data: villageMaleData,
                        backgroundColor: 'rgba(54, 183, 232, 0.88)',
                        borderRadius: 5
                    },
                    {
                        label: 'หญิง',
                        data: villageFemaleData,
                        backgroundColor: 'rgba(255, 105, 135, 0.88)',
                        borderRadius: 5
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top'
                    }
                }
            }
        });
    }

    const ageCanvas = document.getElementById('ageDoughnutChart');

    if (ageCanvas) {
        new Chart(ageCanvas, {
            type: 'doughnut',
            data: {
                labels: [
                    '0–2 ปี',
                    '3–5 ปี',
                    '6–12 ปี',
                    '13–18 ปี',
                    '19–35 ปี',
                    '36–59 ปี',
                    '60 ปีขึ้นไป'
                ],
                datasets: [{
                    data: [
                        {{ (int) ($ageGroups['age_0_2'] ?? 0) }},
                        {{ (int) ($ageGroups['age_3_5'] ?? 0) }},
                        {{ (int) ($ageGroups['age_6_12'] ?? 0) }},
                        {{ (int) ($ageGroups['age_13_18'] ?? 0) }},
                        {{ (int) ($ageGroups['age_19_35'] ?? 0) }},
                        {{ (int) ($ageGroups['age_36_59'] ?? 0) }},
                        {{ (int) ($ageGroups['age_60_plus'] ?? 0) }}
                    ],
                    backgroundColor: [
                        '#ef4444',
                        '#f59e0b',
                        '#10b981',
                        '#3b82f6',
                        '#6366f1',
                        '#8b5cf6',
                        '#ec4899'
                    ],
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '54%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            boxWidth: 8
                        }
                    }
                }
            }
        });
    }
});
</script>
@endsection