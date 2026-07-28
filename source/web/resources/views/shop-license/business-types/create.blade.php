@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="mb-3">
        <h1 class="h3 mb-0">เพิ่มประเภทกิจการย่อย</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <form
                method="POST"
                action="{{ route('shop-license.business-types.store') }}"
            >
                @csrf
                <div class="card-body">
                    @include('shop-license.business-types.form')
                </div>

                
        </div>
    </div>
</div>
@endsection