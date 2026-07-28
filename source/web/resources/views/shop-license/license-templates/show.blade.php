@extends('layouts.app')

@section('title', 'รายละเอียดแม่แบบใบอนุญาต')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h1 class="h3 mb-1">รายละเอียดแม่แบบใบอนุญาต</h1>
            <p class="text-muted mb-0">
                {{ $licenseTemplate->code }} — {{ $licenseTemplate->name }}
            </p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('shop-license.license-templates.edit', $licenseTemplate) }}"
               class="btn btn-warning">
                <i class="fas fa-edit me-1"></i>
                แก้ไข
            </a>

            <a href="{{ route('shop-license.license-templates.index') }}"
               class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i>
                กลับ
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">

            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">ข้อมูลแม่แบบใบอนุญาต</h3>
                </div>

                <div class="card-body">
                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <strong>รหัสแม่แบบ</strong>
                            <div>{{ $licenseTemplate->code }}</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>ชื่อแม่แบบ</strong>
                            <div>{{ $licenseTemplate->name }}</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>ประเภทคำขอ</strong>
                            <div>{{ $licenseTemplate->template_type }}</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>เวอร์ชัน</strong>
                            <div>{{ $licenseTemplate->version }}</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>กลุ่มกิจการ</strong>
                            <div>
                                {{ $licenseTemplate->businessType?->businessCategory?->businessGroup?->name ?? '-' }}
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>หมวดกิจการ</strong>
                            <div>
                                {{ $licenseTemplate->businessType?->businessCategory?->name ?? '-' }}
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>ประเภทกิจการ</strong>
                            <div>
                                {{ $licenseTemplate->businessType?->name ?? '-' }}
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>แบบคำขอ</strong>
                            <div>{{ $licenseTemplate->application_form ?: '-' }}</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>ค่าธรรมเนียม</strong>
                            <div>
                                {{ number_format((float) $licenseTemplate->fee_amount, 2) }} บาท
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>อายุใบอนุญาต</strong>
                            <div>{{ $licenseTemplate->validity_months }} เดือน</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>รอบการตรวจ</strong>
                            <div>
                                {{ $licenseTemplate->inspection_interval_months }}
                                เดือน
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>ผู้มีอำนาจอนุมัติ</strong>
                            <div>
                                {{ $licenseTemplate->approval_authority ?: '-' }}
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>วันที่เริ่มใช้</strong>
                            <div>
                                {{ $licenseTemplate->effective_date?->format('d/m/Y') ?? '-' }}
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <strong>วันที่สิ้นสุด</strong>
                            <div>
                                {{ $licenseTemplate->expiry_date?->format('d/m/Y') ?? '-' }}
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <strong>กฎหมายอ้างอิง</strong>
                            <div>
                                {!! nl2br(e($licenseTemplate->legal_reference ?: '-')) !!}
                            </div>
                        </div>

                        <div class="col-12">
                            <strong>รายละเอียด</strong>
                            <div>
                                {!! nl2br(e($licenseTemplate->description ?: '-')) !!}
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="card card-info card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        เอกสารประกอบ
                        <span class="badge bg-info ms-1">
                            {{ $licenseTemplate->documents->count() }}
                        </span>
                    </h3>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 60px;">ลำดับ</th>
                                    <th>เอกสาร</th>
                                    <th style="width: 130px;">บังคับ</th>
                                    <th style="width: 130px;">ต้นฉบับ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($licenseTemplate->documents as $document)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <strong>{{ $document->name }}</strong>

                                            @if($document->description)
                                                <div class="text-muted small">
                                                    {{ $document->description }}
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            @if($document->is_required)
                                                <span class="badge bg-danger">จำเป็น</span>
                                            @else
                                                <span class="badge bg-secondary">ไม่บังคับ</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($document->requires_original)
                                                <span class="badge bg-warning text-dark">
                                                    ใช้ต้นฉบับ
                                                </span>
                                            @else
                                                <span class="badge bg-light text-dark">
                                                    สำเนาได้
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">
                                            ยังไม่มีรายการเอกสาร
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card card-success card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        Checklist การตรวจ
                        <span class="badge bg-success ms-1">
                            {{ $licenseTemplate->checklists->count() }}
                        </span>
                    </h3>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 60px;">ลำดับ</th>
                                    <th>รายการตรวจ</th>
                                    <th style="width: 130px;">ประเภทผล</th>
                                    <th style="width: 120px;">บังคับ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($licenseTemplate->checklists as $checklist)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <strong>{{ $checklist->name }}</strong>

                                            @if($checklist->description)
                                                <div class="text-muted small">
                                                    {{ $checklist->description }}
                                                </div>
                                            @endif
                                        </td>
                                        <td>{{ $checklist->result_type }}</td>
                                        <td>
                                            @if($checklist->is_required)
                                                <span class="badge bg-danger">จำเป็น</span>
                                            @else
                                                <span class="badge bg-secondary">ไม่บังคับ</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">
                                            ยังไม่มีรายการตรวจ
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-lg-4">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">สถานะ</h3>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        <strong>การใช้งาน</strong>
                        <div class="mt-1">
                            @if($licenseTemplate->is_active)
                                <span class="badge bg-success">เปิดใช้งาน</span>
                            @else
                                <span class="badge bg-secondary">ปิดใช้งาน</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <strong>แม่แบบเริ่มต้น</strong>
                        <div class="mt-1">
                            @if($licenseTemplate->is_default)
                                <span class="badge bg-primary">แม่แบบเริ่มต้น</span>
                            @else
                                <span class="badge bg-light text-dark">
                                    แม่แบบทั่วไป
                                </span>
                            @endif
                        </div>
                    </div>

                    <div>
                        <strong>ลำดับแสดงผล</strong>
                        <div>{{ $licenseTemplate->sort_order }}</div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">ข้อมูลระบบ</h3>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        <strong>สร้างเมื่อ</strong>
                        <div>
                            {{ $licenseTemplate->created_at?->format('d/m/Y H:i') ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <strong>แก้ไขล่าสุด</strong>
                        <div>
                            {{ $licenseTemplate->updated_at?->format('d/m/Y H:i') ?? '-' }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection