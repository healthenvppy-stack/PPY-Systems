@extends('layouts.app')

@section('title','เพิ่มสถานประกอบการ')

@section('content')

<div class="container-fluid">

    <div class="row mb-3">
        <div class="col-md-12">

            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <h3 class="mb-1">
                        เพิ่มสถานประกอบการ
                    </h3>

                    <small class="text-muted">
                        ลงทะเบียนร้านค้าและสถานประกอบการ
                    </small>
                </div>

                <a href="{{ route('shop-license.businesses.index') }}"
                   class="btn btn-secondary">

                    <i class="fas fa-arrow-left"></i>

                    กลับ

                </a>

            </div>

        </div>
    </div>

    <form method="POST"
          action="{{ route('shop-license.businesses.store') }}">

        @csrf

        @include('shop-license.businesses.form', [
            'business' => null,
        ])

    </form>

</div>

@endsection