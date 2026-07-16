@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between mb-3">
        <h3>ข้อมูลประชาชน</h3>
        <a href="{{ route('citizens.create') }}" class="btn btn-primary">
            + เพิ่มประชาชน
        </a>
    </div>

    <!--<div class="row mb-3">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h6>จำนวนรายการที่พบ</h6>
                    <h3>{{ number_format($totalCitizens) }}</h3>
                </div>
            </div>
        </div>
    </div>-->

    <div class="mb-3">
        <h3 class="mb-1">{{ $pageTitle }}</h3>
        <small class="text-muted">
            สรุปข้อมูลตามตัวกรองที่เลือก
        </small>
    </div>

    <div class="row g-3 mb-4">

        <div class="col-xl-3 col-md-6">
            <div class="card text-white bg-primary border-0 shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="small opacity-75">ประชากรทั้งหมด</div>
                        <div class="display-6 fw-bold">
                            {{ number_format($totalCitizens) }}
                        </div>
                        <div class="small">คน</div>
                    </div>

                    <div class="display-5 opacity-50">👥</div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card text-white bg-success border-0 shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="small opacity-75">ครัวเรือน</div>
                        <div class="display-6 fw-bold">
                            {{ number_format($totalHouseholds) }}
                        </div>
                        <div class="small">หลัง</div>
                    </div>

                    <div class="display-5 opacity-50">🏠</div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card text-white bg-info border-0 shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="small opacity-75">ชาย</div>
                        <div class="display-6 fw-bold">
                            {{ number_format($totalMale) }}
                        </div>
                        <div class="small">
                            {{ $totalCitizens > 0
                                ? number_format(($totalMale / $totalCitizens) * 100, 2)
                                : '0.00' }}%
                        </div>
                    </div>

                    <div class="display-5 opacity-50">♂</div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card text-white border-0 shadow-sm h-100"
                style="background: linear-gradient(135deg, #ff718a, #ef5b78);">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="small opacity-75">หญิง</div>
                        <div class="display-6 fw-bold">
                            {{ number_format($totalFemale) }}
                        </div>
                        <div class="small">
                            {{ $totalCitizens > 0
                                ? number_format(($totalFemale / $totalCitizens) * 100, 2)
                                : '0.00' }}%
                        </div>
                    </div>

                    <div class="display-5 opacity-50">♀</div>
                </div>
            </div>
        </div>

    </div>
<!-- Add gragh show data by type your selected
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-header bg-white border-0 pt-3">
            <strong>สัดส่วนประชากรชาย–หญิง</strong>

            <div class="small text-muted">
                แสดงตามชุดข้อมูลที่กำลังกรองอยู่
            </div>
        </div>

        <div class="card-body">
            <div style="height: 280px;">
                <canvas id="citizenGenderChart"></canvas>
            </div>
        </div>

    </div>
***End show graph-->

    <div class="card">
        <div class="card-body">

            <form method="GET" action="{{ route('citizens.index') }}" class="mb-3">

                <div class="row g-2">

                    <div class="col-md-5">
                        <input type="text"
                            name="q"
                            class="form-control"
                            placeholder="ค้นหาเลขบัตร ชื่อ นามสกุล หรือเบอร์โทร"
                            value="{{ request('q') }}">
                    </div>

                    <div class="col-md-2">
                        <select name="gender" class="form-control">
                            <option value="">ทุกเพศ</option>
                            <option value="ชาย" {{ request('gender') == 'ชาย' ? 'selected' : '' }}>ชาย</option>
                            <option value="หญิง" {{ request('gender') == 'หญิง' ? 'selected' : '' }}>หญิง</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <select name="status" class="form-control">
                            <option value="">ทุกสถานะ</option>
                            <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>ใช้งาน</option>
                            <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>ไม่ใช้งาน</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <button class="btn btn-primary">ค้นหา</button>
                        <a href="{{ route('citizens.index') }}" class="btn btn-secondary">ล้างค่า</a>
                    </div>

                </div>

            </form>

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>เลขบัตร</th>
                        <th>ชื่อ-สกุล</th>
                        <th>เพศ</th>
                        <th>วันเกิด</th>
                        <th>สถานะ</th>
                        <th width="160">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($citizens as $citizen)
                        <tr>
                            <td>{{ substr($citizen->cid, 0, 5) }}XXXX{{ substr($citizen->cid, -4) }}</td>
                            <td>{{ $citizen->first_name }} {{ $citizen->last_name }}</td>
                            <td>{{ $citizen->gender }}</td>
                            <td>{{ optional($citizen->birth_date)->format('d/m/Y') }}</td>
                            <td>
                                @if($citizen->status)
                                    <span class="badge bg-success">ใช้งาน</span>
                                @else
                                    <span class="badge bg-secondary">ไม่ใช้งาน</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('citizens.show', $citizen) }}" class="btn btn-sm btn-info">ดู</a>
                                <a href="{{ route('citizens.edit', $citizen) }}" class="btn btn-sm btn-warning">แก้ไข</a>

                                <form action="{{ route('citizens.destroy', $citizen) }}"
                                    method="POST"
                                    style="display:inline-block"
                                    onsubmit="return confirm('ยืนยันการลบข้อมูลนี้?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">ลบ</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                ยังไม่มีข้อมูลประชาชน
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $citizens->links() }}

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const chartCanvas = document.getElementById('citizenGenderChart');

    if (!chartCanvas) {
        return;
    }

    new Chart(chartCanvas, {
        type: 'bar',

        data: {
            labels: ['ชาย', 'หญิง'],

            datasets: [{
                label: 'จำนวนประชากร',

                data: [
                    {{ (int) $totalMale }},
                    {{ (int) $totalFemale }}
                ],

                backgroundColor: [
                    'rgba(21, 174, 229, 0.85)',
                    'rgba(239, 91, 120, 0.85)'
                ],

                borderRadius: 8,
                borderWidth: 0
            }]
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
                    display: false
                }
            }
        }
    });
});
</script>

@endsection