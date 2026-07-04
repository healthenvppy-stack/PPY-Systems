@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <h3 class="mb-3">เพิ่มข้อมูลครัวเรือน</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>บันทึกไม่สำเร็จ</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('households.store') }}">
                @csrf

                @include('households.form')

                <button class="btn btn-primary">บันทึก</button>
                <a href="{{ route('households.index') }}" class="btn btn-secondary">ย้อนกลับ</a>
            </form>
        </div>
    </div>

</div>
@endsection