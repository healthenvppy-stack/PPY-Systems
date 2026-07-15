@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="mb-4">
        <h2 class="mb-0">คุณภาพข้อมูล / Data Quality</h2>
        <small class="text-muted">
            ตรวจสอบความครบถ้วนและความซ้ำซ้อนของข้อมูลประชากร
        </small>
    </div>

    <div class="row">

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card text-white bg-primary border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="small opacity-75">ข้อมูลต้นทาง</div>
                    <div class="display-6 fw-bold">
                        {{ number_format($sourceTotal) }}
                    </div>
                    <div class="small">รายการ</div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card text-white bg-success border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="small opacity-75">นำเข้าสำเร็จ</div>
                    <div class="display-6 fw-bold">
                        {{ number_format($importedCitizens) }}
                    </div>
                    <div class="small">ประชาชนไม่ซ้ำ</div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card text-dark bg-warning border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="small opacity-75">ข้อมูลซ้ำ</div>
                    <div class="display-6 fw-bold">
                        {{ number_format($duplicateRowsCount) }}
                    </div>
                    <div class="small">แถวซ้ำในต้นทาง</div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card text-white bg-danger border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="small opacity-75">เลขบัตรไม่ครบ</div>
                    <div class="display-6 fw-bold">
                        {{ number_format($invalidCidCount) }}
                    </div>
                    <div class="small">รายการ</div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-lg-4 mb-3">
            <div class="card h-100 shadow-sm">
                <div class="card-header">
                    <strong>ความครบถ้วนของข้อมูล</strong>
                </div>

                <div class="card-body">
                    <p class="mb-2">
                        ไม่มีครัวเรือน:
                        <strong>{{ number_format($missingHousehold) }}</strong>
                    </p>

                    <p class="mb-2">
                        ไม่มีวันเกิด:
                        <strong>{{ number_format($missingBirthDate) }}</strong>
                    </p>

                    <p class="mb-0">
                        ไม่มีเบอร์โทร:
                        <strong>{{ number_format($missingPhone) }}</strong>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-3">
            <div class="card h-100 shadow-sm">
                <div class="card-header">
                    <strong>สรุปการนำเข้า</strong>
                </div>

                <div class="card-body">
                    <p class="mb-2">
                        ข้อมูลถูกต้องทั้งหมด:
                        <strong>{{ number_format($validSourceCount) }}</strong>
                    </p>

                    <p class="mb-2">
                        เลขบัตรถูกต้องและไม่ซ้ำ:
                        <strong>{{ number_format($uniqueValidCidCount) }}</strong>
                    </p>

                    <p class="mb-0">
                        อัตรานำเข้าสำเร็จ:
                        <strong>
                            {{ $uniqueValidCidCount > 0
                                ? number_format(($importedCitizens / $uniqueValidCidCount) * 100, 2)
                                : '0.00' }}%
                        </strong>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-3">
            <div class="card h-100 shadow-sm">
                <div class="card-header">
                    <strong>ประชากรแยกตามเพศ</strong>
                </div>

                <div class="card-body">
                    @forelse($genderSummary as $item)
                        <p class="mb-2">
                            {{ $item->gender ?: 'ไม่ระบุ' }}:
                            <strong>{{ number_format($item->total) }}</strong>
                        </p>
                    @empty
                        <div class="text-muted">
                            ยังไม่มีข้อมูล
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>

    <div class="alert alert-info">
        <strong>หมายเหตุ:</strong>
        ข้อมูลเลขบัตรไม่ครบ 13 หลักและข้อมูลซ้ำจะเก็บไว้แก้ไขภายหลัง
        โดยไม่กระทบข้อมูลประชาชนที่นำเข้าสำเร็จแล้ว
    </div>

</div>
@endsection