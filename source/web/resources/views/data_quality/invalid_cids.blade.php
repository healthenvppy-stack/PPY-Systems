@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">เลขบัตรประชาชนไม่ครบ / Invalid Citizen IDs</h3>
            <small class="text-muted">
                รายการจากฐานข้อมูลต้นทางที่เลขบัตรประชาชนไม่ครบ 13 หลัก
            </small>
        </div>

        <a href="{{ route('data-quality.index') }}" class="btn btn-secondary">
            ย้อนกลับ
        </a>
    </div>

    <div class="alert alert-danger">
        รายการเหล่านี้ยังไม่ถูกนำเข้าในตารางประชาชนหลัก
        ควรตรวจสอบกับเอกสารหรือฐานทะเบียนราษฎรก่อนแก้ไข
    </div>

    <div class="card">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead>
                        <tr>
                            <th>ID ต้นทาง</th>
                            <th>เลขบัตรเดิม</th>
                            <th>จำนวนหลัก</th>
                            <th>ชื่อ</th>
                            <th>เพศ</th>
                            <th>วันเกิด</th>
                            <th>บ้านเลขที่</th>
                            <th>หมู่</th>
                            <th>สถานะ</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($records as $record)
                            @php
                                $cleanCid = preg_replace('/\D+/', '', (string) $record->idcard);
                            @endphp

                            <tr>
                                <td>{{ $record->id }}</td>
                                <td>{{ $record->idcard ?: '-' }}</td>
                                <td>
                                    <span class="badge bg-danger">
                                        {{ strlen($cleanCid) }} หลัก
                                    </span>
                                </td>
                                <td>{{ $record->name }}</td>
                                <td>{{ $record->sex }}</td>
                                <td>{{ $record->birthday }}</td>
                                <td>{{ $record->homenumADD }}</td>
                                <td>{{ $record->homenumM }}</td>
                                <td>{{ $record->status }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center text-muted">
                                    ไม่พบเลขบัตรประชาชนที่ไม่ครบ
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