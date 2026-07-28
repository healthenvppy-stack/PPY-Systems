@extends('layouts.app')

@section('title', 'เพิ่มแม่แบบใบอนุญาต')

@section('content')
<div class="container-fluid">

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">
                เพิ่มแม่แบบใบอนุญาต
            </h3>
        </div>

        <form
            method="POST"
            action="{{ route('shop-license.license-templates.store') }}"
        >
            @csrf

            <div class="card-body">
                @include('shop-license.license-templates.form')
            </div>
        </form>

    </div>

</div>
@endsection