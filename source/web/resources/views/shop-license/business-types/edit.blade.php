@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="mb-3">
        <h1 class="h3 mb-0">แก้ไขประเภทกิจการย่อย</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <form
                method="POST"
                action="{{ route('shop-license.business-types.update', $businessType) }}"
            >

                @csrf
                @method('PUT')

                @include('shop-license.business-types.form')
            </form>
        </div>
    </div>
</div>
@endsection