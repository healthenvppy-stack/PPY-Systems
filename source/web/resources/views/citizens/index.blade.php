@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between mb-3">
        <h3>ข้อมูลประชาชน</h3>
        <a href="{{ route('citizens.create') }}" class="btn btn-primary">
            + เพิ่มประชาชน
        </a>
    </div>

    <div class="row mb-3">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h6>จำนวนรายการที่พบ</h6>
                    <h3>{{ number_format($totalCitizens) }}</h3>
                </div>
            </div>
        </div>
    </div>

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

@endsection