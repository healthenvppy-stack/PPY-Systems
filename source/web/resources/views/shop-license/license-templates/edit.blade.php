@extends('layouts.app')

@section('title', 'แก้ไขแม่แบบใบอนุญาต')

@section('content')
<div class="container-fluid">

    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">
                แก้ไขแม่แบบใบอนุญาต
            </h3>
        </div>

        <form
            method="POST"
            action="{{ route('shop-license.license-templates.update',$licenseTemplate) }}"
        >
            @csrf
            @method('PUT')

            <div class="card-body">
                @include('shop-license.license-templates.form')
            </div>

        </form>

    </div>

</div>
@endsection