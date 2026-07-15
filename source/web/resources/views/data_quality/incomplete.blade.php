@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h3 class="mb-0">ข้อมูลประชาชนไม่ครบ / Incomplete Records</h3>
            <small class="text-muted">
                รายการในระบบหลักที่ยังขาดข้อมูลสำคัญ
            </small>
        </div>

        <a href="{{ route('data-quality.index') }}" class="btn btn-secondary">
            ย้อนกลับ
        </a>
    </div>

    <div class="card">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead>
                        <tr>
                            <th>ชื่อ-สกุล</th>
                            <th>เลขบัตร</th>
                            <th>ครัวเรือน</th>
                            <th>วันเกิด</th>
                            <th>โทรศัพท์</th>
                            <th width="170">จัดการ</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($citizens as $citizen)
                            <tr>
                                <td>
                                    {{ $citizen->first_name }}
                                    {{ $citizen->last_name }}
                                </td>

                                <td>
                                    {{ substr($citizen->cid, 0, 5) }}
                                    XXXX
                                    {{ substr($citizen->cid, -4) }}
                                </td>

                                <td>
                                    @if($citizen->household)
                                        บ้านเลขที่ {{ $citizen->household->house_no }}
                                        หมู่ {{ $citizen->household->moo }}
                                    @else
                                        <span class="badge bg-danger">
                                            ไม่มีครัวเรือน
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    @if($citizen->birth_date)
                                        {{ $citizen->birth_date->format('d/m/Y') }}
                                    @else
                                        <span class="badge bg-danger">
                                            ไม่มีวันเกิด
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    @if($citizen->phone)
                                        {{ $citizen->phone }}
                                    @else
                                        <span class="badge bg-warning text-dark">
                                            ไม่มีเบอร์โทร
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('citizens.show', $citizen) }}"
                                       class="btn btn-sm btn-info">
                                        Citizen 360
                                    </a>

                                    <a href="{{ route('citizens.edit', $citizen) }}"
                                       class="btn btn-sm btn-warning">
                                        แก้ไข
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">
                                    ไม่พบข้อมูลประชาชนที่ไม่ครบ
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $citizens->links() }}
            </div>

        </div>
    </div>

</div>
@endsection