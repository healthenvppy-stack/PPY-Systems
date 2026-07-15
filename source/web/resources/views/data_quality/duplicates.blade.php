@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">ข้อมูลประชาชนซ้ำ / Duplicate Records</h3>
            <small class="text-muted">
                รายการจากฐานข้อมูลต้นทางที่มีเลขบัตรประชาชนซ้ำ
            </small>
        </div>

        <a href="{{ route('data-quality.index') }}" class="btn btn-secondary">
            ย้อนกลับ
        </a>
    </div>

    <div class="alert alert-warning">
        หน้านี้เป็นข้อมูลจากฐานพัก <strong>datapop</strong> ยังไม่ควรลบข้อมูลทันที
        ให้ตรวจสอบว่ารายการใดเป็นข้อมูลล่าสุดและถูกต้องก่อน
    </div>

    <div class="card">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead>
                        <tr>
                            <th>ID ต้นทาง</th>
                            <th>เลขบัตร</th>
                            <th>ชื่อ</th>
                            <th>เพศ</th>
                            <th>วันเกิด</th>
                            <th>บ้านเลขที่</th>
                            <th>หมู่</th>
                            <th>สถานะ</th>
                            <th>สุขภาพ</th>
                            <th>สวัสดิการ</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($records as $record)
                            <tr>
                                <td>{{ $record->id }}</td>

                                <td>
                                    {{ substr($record->idcard, 0, 5) }}
                                    XXXX
                                    {{ substr($record->idcard, -4) }}
                                </td>

                                <td>{{ $record->name }}</td>
                                <td>{{ $record->sex }}</td>
                                <td>{{ $record->birthday }}</td>
                                <td>{{ $record->homenumADD }}</td>
                                <td>{{ $record->homenumM }}</td>
                                <td>{{ $record->status }}</td>
                                <td>{{ $record->healthy_state }}</td>
                                <td>{{ $record->welfare }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center text-muted">
                                    ไม่พบข้อมูลซ้ำ
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
@endsection