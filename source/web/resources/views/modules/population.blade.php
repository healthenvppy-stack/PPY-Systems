@extends('layouts.app')

@section('content')

<div class="container-fluid">

<div class="mb-4">

<h2 class="fw-bold text-success">

👥 Population Module

</h2>

<p class="text-muted">

ศูนย์กลางข้อมูลประชากรและครัวเรือน

</p>

</div>

<div class="row">

<div class="col-lg-3 col-md-6 mb-4">

<div class="card shadow-sm border-success h-100">

<div class="card-body text-center">

<div style="font-size:55px">📈</div>

<h4 class="mt-3">

Dashboard

</h4>

<p class="text-muted">

ภาพรวมประชากร

</p>

<a href="{{ route('population.dashboard') }}"
class="btn btn-success">

เปิด

</a>

</div>

</div>

</div>

<div class="col-lg-3 col-md-6 mb-4">

<div class="card shadow-sm border-primary h-100">

<div class="card-body text-center">

<div style="font-size:55px">👥</div>

<h4 class="mt-3">

Citizens

</h4>

<p class="text-muted">

ทะเบียนประชาชน

</p>

<a href="{{ route('citizens.index') }}"
class="btn btn-primary">

เปิด

</a>

</div>

</div>

</div>

<div class="col-lg-3 col-md-6 mb-4">

<div class="card shadow-sm border-warning h-100">

<div class="card-body text-center">

<div style="font-size:55px">🏠</div>

<h4 class="mt-3">

Households

</h4>

<p class="text-muted">

ทะเบียนครัวเรือน

</p>

<a href="{{ route('households.index') }}"
class="btn btn-warning">

เปิด

</a>

</div>

</div>

</div>

<div class="col-lg-3 col-md-6 mb-4">

<div class="card shadow-sm border-info h-100">

<div class="card-body text-center">

<div style="font-size:55px">📊</div>

<h4 class="mt-3">

Reports

</h4>

<p class="text-muted">

รายงานและสถิติ

</p>

<button class="btn btn-info">

Coming Soon

</button>

</div>

</div>

</div>

</div>

<div class="row">

<div class="col-lg-3 col-md-6 mb-4">

<div class="card border-danger h-100">

<div class="card-body text-center">

<div style="font-size:55px">📥</div>

<h5>

Import

</h5>

<p class="text-muted">

นำเข้าข้อมูล

</p>

</div>

</div>

</div>

<div class="col-lg-3 col-md-6 mb-4">

<div class="card border-secondary h-100">

<div class="card-body text-center">

<div style="font-size:55px">📤</div>

<h5>

Export

</h5>

<p class="text-muted">

ส่งออกข้อมูล

</p>

</div>

</div>

</div>

<div class="col-lg-3 col-md-6 mb-4">

<div class="card border-success h-100">

<div class="card-body text-center">

<div style="font-size:55px">🗺️</div>

<h5>

GIS

</h5>

<p class="text-muted">

แผนที่ประชากร

</p>

</div>

</div>

</div>

<div class="col-lg-3 col-md-6 mb-4">

<div class="card border-dark h-100">

<div class="card-body text-center">

<div style="font-size:55px">⚙️</div>

<h5>

Settings

</h5>

<p class="text-muted">

ตั้งค่าโมดูล

</p>

</div>

</div>

</div>

</div>

</div>

@endsection