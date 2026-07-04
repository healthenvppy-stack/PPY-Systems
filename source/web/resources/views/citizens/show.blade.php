@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between mb-3">
        <h3>รายละเอียดประชาชน</h3>
        <a href="{{ route('citizens.index') }}" class="btn btn-secondary">ย้อนกลับ</a>
    </div>

    <div class="card">
        <div class="card-body">

            <table class="table table-bordered">
                <tr>
                    <th width="200">เลขบัตรประชาชน</th>
                    <td>{{ substr($citizen->cid, 0, 5) }}XXXX{{ substr($citizen->cid, -4) }}</td>
                </tr>
                <tr>
                    <th>ชื่อ-สกุล</th>
                    <td>{{ $citizen->first_name }} {{ $citizen->last_name }}</td>
                </tr>
                <tr>
                    <th>เพศ</th>
                    <td>{{ $citizen->gender }}</td>
                </tr>
                <tr>
                    <th>วันเกิด</th>
                    <td>{{ optional($citizen->birth_date)->format('d/m/Y') }}</td>
                </tr>
                <tr>
                    <th>สถานะ</th>
                    <td>
                        @if($citizen->status)
                            <span class="badge bg-success">ใช้งาน</span>
                        @else
                            <span class="badge bg-secondary">ไม่ใช้งาน</span>
                        @endif
                    </td>
                </tr>
            </table>

            <a href="{{ route('citizens.edit', $citizen) }}" class="btn btn-warning">
                แก้ไขข้อมูล
            </a>

        </div>
    </div>

</div>

@endsection