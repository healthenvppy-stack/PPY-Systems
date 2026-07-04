@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between mb-3">
        <h3>ข้อมูลครัวเรือน</h3>
        <a href="{{ route('households.create') }}" class="btn btn-primary">+ เพิ่มครัวเรือน</a>
    </div>

    <div class="card">
        <div class="card-body">

            <form method="GET" action="{{ route('households.index') }}" class="mb-3">
                <div class="input-group">
                    <input type="text" name="q" class="form-control"
                           placeholder="ค้นหารหัสบ้าน บ้านเลขที่ หรือหมู่"
                           value="{{ request('q') }}">
                    <button class="btn btn-secondary">ค้นหา</button>
                    <a href="{{ route('households.index') }}" class="btn btn-outline-secondary">ล้างค่า</a>
                </div>
            </form>

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>รหัสบ้าน</th>
                        <th>บ้านเลขที่</th>
                        <th>หมู่</th>
                        <th>โซนน้ำท่วม</th>
                        <th width="180">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($households as $household)
                        <tr>
                            <td>{{ $household->house_code }}</td>
                            <td>{{ $household->house_no }}</td>
                            <td>{{ $household->moo }}</td>
                            <td>{{ $household->flood_level }}</td>
                            <td>
                                <a href="{{ route('households.show', $household) }}" class="btn btn-sm btn-info">ดู</a>
                                <a href="{{ route('households.edit', $household) }}" class="btn btn-sm btn-warning">แก้ไข</a>
                                <form action="{{ route('households.destroy', $household) }}" method="POST" style="display:inline-block" onsubmit="return confirm('ยืนยันการลบข้อมูลนี้?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">ลบ</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">ยังไม่มีข้อมูลครัวเรือน</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $households->links() }}

        </div>
    </div>

</div>
@endsection