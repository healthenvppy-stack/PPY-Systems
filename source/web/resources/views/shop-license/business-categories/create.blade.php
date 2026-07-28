@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="mb-3">
        <h1 class="h3 mb-0">เพิ่มประเภทกิจการหลัก</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <form
                method="POST"
                action="{{ route('shop-license.business-categories.store') }}"
            >
                @include('shop-license.business-categories.form')
            </form>
        </div>
    </div>
</div>
@endsection