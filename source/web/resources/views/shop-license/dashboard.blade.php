@extends('layouts.app')

@section('title', 'ระบบใบอนุญาตสถานประกอบการ')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">ระบบใบอนุญาตสถานประกอบการ</h1>
            <p class="text-muted mb-0">
                ศูนย์ควบคุมข้อมูลหลักสำหรับหมวดกิจการ ประเภทกิจการหลัก และกิจการย่อย
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="small-box text-bg-primary">
                <div class="inner">
                    <h3>{{ number_format($stats['groups']) }}</h3>
                    <p>หมวดกิจการ</p>
                </div>

                <div class="icon">
                    <i class="bi bi-folder"></i>
                </div>

                <a
                    href="{{ route('shop-license.business-groups.index') }}"
                    class="small-box-footer"
                >
                    จัดการข้อมูล
                    <i class="bi bi-arrow-right-circle"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="small-box text-bg-success">
                <div class="inner">
                    <h3>{{ number_format($stats['categories']) }}</h3>
                    <p>ประเภทกิจการหลัก</p>
                </div>

                <div class="icon">
                    <i class="bi bi-diagram-3"></i>
                </div>

                <a
                    href="{{ route('shop-license.business-categories.index') }}"
                    class="small-box-footer"
                >
                    จัดการข้อมูล
                    <i class="bi bi-arrow-right-circle"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="small-box text-bg-warning">
                <div class="inner">
                    <h3>{{ number_format($stats['types']) }}</h3>
                    <p>กิจการย่อย</p>
                </div>

                <div class="icon">
                    <i class="bi bi-list-check"></i>
                </div>

                <a
                    href="{{ route('shop-license.business-types.index') }}"
                    class="small-box-footer"
                >
                    จัดการข้อมูล
                    <i class="bi bi-arrow-right-circle"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">หมวดกิจการที่เปิดใช้งาน</p>
                            <h3 class="mb-0">
                                {{ number_format($stats['active_groups']) }}
                            </h3>
                        </div>

                        <div class="fs-1 text-primary">
                            <i class="bi bi-check-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">ประเภทกิจการหลักที่เปิดใช้งาน</p>
                            <h3 class="mb-0">
                                {{ number_format($stats['active_categories']) }}
                            </h3>
                        </div>

                        <div class="fs-1 text-success">
                            <i class="bi bi-check-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">กิจการย่อยที่เปิดใช้งาน</p>
                            <h3 class="mb-0">
                                {{ number_format($stats['active_types']) }}
                            </h3>
                        </div>

                        <div class="fs-1 text-warning">
                            <i class="bi bi-check-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">เมนูจัดการข้อมูลหลัก</h5>
                </div>

                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <a
                            href="{{ route('shop-license.business-groups.index') }}"
                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                        >
                            <div>
                                <strong>หมวดกิจการ</strong>
                                <div class="text-muted small">
                                    จัดการหมวดกิจการระดับบนสุด
                                </div>
                            </div>

                            <i class="bi bi-chevron-right"></i>
                        </a>

                        <a
                            href="{{ route('shop-license.business-categories.index') }}"
                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                        >
                            <div>
                                <strong>ประเภทกิจการหลัก</strong>
                                <div class="text-muted small">
                                    จัดการประเภทกิจการภายใต้แต่ละหมวด
                                </div>
                            </div>

                            <i class="bi bi-chevron-right"></i>
                        </a>

                        <a
                            href="{{ route('shop-license.business-types.index') }}"
                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                        >
                            <div>
                                <strong>กิจการย่อย</strong>
                                <div class="text-muted small">
                                    จัดการค่าธรรมเนียม อายุใบอนุญาต และระดับความเสี่ยง
                                </div>
                            </div>

                            <i class="bi bi-chevron-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">สถานะข้อมูล</h5>
                </div>

                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <span>กิจการย่อยทั้งหมด</span>
                        <strong>{{ number_format($stats['types']) }}</strong>
                    </div>

                    <div class="d-flex justify-content-between mb-3">
                        <span>เปิดใช้งาน</span>
                        <strong class="text-success">
                            {{ number_format($stats['active_types']) }}
                        </strong>
                    </div>

                    <div class="d-flex justify-content-between">
                        <span>ปิดใช้งาน</span>
                        <strong class="text-danger">
                            {{ number_format($stats['inactive_types']) }}
                        </strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection