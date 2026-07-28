@extends('layouts.app')

@section('title', 'แม่แบบใบอนุญาต')

@section('content')
<div class="container-fluid">

    <!--<div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h1 class="h3 mb-0">แม่แบบใบอนุญาต</h1>
            <small class="text-muted">
                จัดการแม่แบบ เอกสารประกอบ และรายการตรวจ
            </small>
        </div>

        <a
            href="{{ route('shop-license.license-templates.create') }}"
            class="btn btn-primary"
        >
            <i class="bi bi-plus-circle me-1"></i>
            เพิ่มแม่แบบ
        </a>
    </div>-->

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>
        </div>
    @endif

    <!--<div class="card">
        <div class="card-header">
            <h3 class="card-title mb-0">
                รายการแม่แบบใบอนุญาต
            </h3>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead>
                        <tr>
                            <th style="width: 70px;">ลำดับ</th>
                            <th style="width: 120px;">รหัส</th>
                            <th>ชื่อแม่แบบ</th>
                            <th>กิจการ</th>
                            <th style="width: 140px;">ประเภทคำขอ</th>
                            <th class="text-center" style="width: 100px;">
                                เอกสาร
                            </th>
                            <th class="text-center" style="width: 100px;">
                                รายการตรวจ
                            </th>
                            <th class="text-end" style="width: 130px;">
                                ค่าธรรมเนียม
                            </th>
                            <th class="text-center" style="width: 100px;">
                                สถานะ
                            </th>
                            <th class="text-center" style="width: 150px;">
                                การจัดการ
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($licenseTemplates as $licenseTemplate)
                            @php
                                $templateTypeLabels = [
                                    'NEW' => 'ขอใหม่',
                                    'RENEW' => 'ต่ออายุ',
                                    'CHANGE' => 'เปลี่ยนแปลง',
                                    'REPLACE' => 'ใบแทน',
                                    'CANCEL' => 'เลิกกิจการ',
                                ];
                            @endphp

                            <tr>
                                <td>
                                    {{
                                        $licenseTemplates->firstItem()
                                        + $loop->index
                                    }}
                                </td>

                                <td>
                                    <span class="fw-semibold">
                                        {{ $licenseTemplate->code }}
                                    </span>

                                    @if ($licenseTemplate->is_default)
                                        <span class="badge text-bg-primary">
                                            ค่าเริ่มต้น
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <div class="fw-semibold">
                                        {{ $licenseTemplate->name }}
                                    </div>

                                    <small class="text-muted">
                                        เวอร์ชัน
                                        {{ $licenseTemplate->version }}
                                    </small>
                                </td>

                                <td>
                                    <div>
                                        {{
                                            $licenseTemplate
                                                ->businessType
                                                ?->name
                                            ?? '-'
                                        }}
                                    </div>

                                    <small class="text-muted">
                                        {{
                                            $licenseTemplate
                                                ->businessType
                                                ?->businessCategory
                                                ?->name
                                            ?? '-'
                                        }}
                                    </small>
                                </td>

                                <td>
                                    <span class="badge text-bg-info">
                                        {{
                                            $templateTypeLabels[
                                                $licenseTemplate->template_type
                                            ] ?? $licenseTemplate->template_type
                                        }}
                                    </span>
                                </td>

                                <td class="text-center">
                                    <span class="badge text-bg-secondary">
                                        {{ $licenseTemplate->documents_count }}
                                    </span>
                                </td>

                                <td class="text-center">
                                    <span class="badge text-bg-secondary">
                                        {{ $licenseTemplate->checklists_count }}
                                    </span>
                                </td>

                                <td class="text-end">
                                    {{
                                        number_format(
                                            (float) $licenseTemplate->fee_amount,
                                            2
                                        )
                                    }}
                                    บาท
                                </td>

                                <td class="text-center">
                                    @if ($licenseTemplate->is_active)
                                        <span class="badge text-bg-success">
                                            ใช้งาน
                                        </span>
                                    @else
                                        <span class="badge text-bg-secondary">
                                            ปิดใช้งาน
                                        </span>
                                    @endif
                                </td>

                                <td class="text-end text-nowrap">
                                    <div class="dropdown">
                                        <button
                                            class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                            type="button"
                                            data-bs-toggle="dropdown"
                                            aria-expanded="false"
                                        >
                                            <i class="fas fa-ellipsis-v me-1"></i>
                                            จัดการ
                                        </button>

                                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                            <li>
                                                <a
                                                    class="dropdown-item"
                                                    href="{{ route('shop-license.license-templates.show', $licenseTemplate) }}"
                                                >
                                                    <i class="fas fa-eye text-info me-2"></i>
                                                    ดูรายละเอียด
                                                </a>
                                            </li>

                                            <li>
                                                <a
                                                    class="dropdown-item"
                                                    href="{{ route('shop-license.license-templates.edit', $licenseTemplate) }}"
                                                >
                                                    <i class="fas fa-pen-to-square text-warning me-2"></i>
                                                    แก้ไขข้อมูล
                                                </a>
                                            </li>

                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>

                                            <li>
                                                <form
                                                    action="{{ route('shop-license.license-templates.destroy', $licenseTemplate) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('ยืนยันการลบแม่แบบใบอนุญาตนี้หรือไม่?')"
                                                >
                                                    @csrf
                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        class="dropdown-item text-danger"
                                                    >
                                                        <i class="fas fa-trash me-2"></i>
                                                        ลบรายการ
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td
                                    colspan="10"
                                    class="text-center text-muted py-5"
                                >
                                    ยังไม่มีข้อมูลแม่แบบใบอนุญาต
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if ($licenseTemplates->hasPages())
            <div class="card-footer">
                {{ $licenseTemplates->links() }}
            </div>
        @endif
    </div>-->

    <x-ppy.data-table
        title="แม่แบบใบอนุญาต"
        description="จัดการแม่แบบใบอนุญาต เอกสารประกอบ และรายการตรวจ"
        :total="$licenseTemplates->total()"
        :search="request('search')"
        :create-url="route('shop-license.license-templates.create')"
        create-label="เพิ่มแม่แบบใบอนุญาต"
    >
        <thead class="table-light">
            <tr>
                <th style="width: 60px;">ลำดับ</th>
                <th style="width: 130px;">รหัส</th>
                <th>ชื่อแม่แบบ</th>
                <th>ประเภทกิจการ</th>
                <th style="width: 140px;">ประเภทคำขอ</th>
                <th style="width: 120px;" class="text-end">ค่าธรรมเนียม</th>
                <th style="width: 120px;">สถานะ</th>
                <th style="width: 130px;" class="text-end">การดำเนินการ</th>
            </tr>
        </thead>

        <tbody>
            @forelse($licenseTemplates as $licenseTemplate)
                <tr>
                    <td>
                        {{ ($licenseTemplates->firstItem() ?? 0) + $loop->index }}
                    </td>

                    <td>
                        <span class="fw-semibold">
                            {{ $licenseTemplate->code }}
                        </span>
                    </td>

                    <td>
                        <a
                            href="{{ route('shop-license.license-templates.show', $licenseTemplate) }}"
                            class="text-decoration-none fw-semibold"
                        >
                            {{ $licenseTemplate->name }}
                        </a>

                        <div class="text-muted small">
                            เวอร์ชัน {{ $licenseTemplate->version }}
                        </div>
                    </td>

                    <td>
                        <div>
                            {{ $licenseTemplate->businessType?->name ?? '-' }}
                        </div>

                        <div class="text-muted small">
                            {{ $licenseTemplate->businessType?->businessCategory?->name ?? '-' }}
                        </div>
                    </td>

                    <td>
                        {{ $licenseTemplate->template_type }}
                    </td>

                    <td class="text-end">
                        {{ number_format((float) $licenseTemplate->fee_amount, 2) }}
                        บาท
                    </td>

                    <td>
                        <x-ppy.status-badge
                            :type="$licenseTemplate->is_active ? 'success' : 'secondary'"
                        >
                            {{ $licenseTemplate->is_active
                                ? 'เปิดใช้งาน'
                                : 'ปิดใช้งาน' }}
                        </x-ppy.status-badge>

                        @if($licenseTemplate->is_default)
                            <div class="mt-1">
                                <x-ppy.status-badge type="primary">
                                    ค่าเริ่มต้น
                                </x-ppy.status-badge>
                            </div>
                        @endif
                    </td>

                    <td class="text-end">
                        <x-ppy.action-dropdown>
                            <li>
                                <a
                                    class="dropdown-item"
                                    href="{{ route('shop-license.license-templates.show', $licenseTemplate) }}"
                                >
                                    <i class="fas fa-eye text-info me-2"></i>
                                    ดูรายละเอียด
                                </a>
                            </li>

                            <li>
                                <a
                                    class="dropdown-item"
                                    href="{{ route('shop-license.license-templates.edit', $licenseTemplate) }}"
                                >
                                    <i class="fas fa-edit text-warning me-2"></i>
                                    แก้ไขข้อมูล
                                </a>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <form
                                    action="{{ route('shop-license.license-templates.destroy', $licenseTemplate) }}"
                                    method="POST"
                                    onsubmit="return confirm('ยืนยันการลบแม่แบบใบอนุญาตนี้หรือไม่?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="dropdown-item text-danger"
                                    >
                                        <i class="fas fa-trash me-2"></i>
                                        ลบรายการ
                                    </button>
                                </form>
                            </li>
                        </x-ppy.action-dropdown>
                    </td>
                </tr>
            @empty
                <!--<tr>
                    <td colspan="8" class="text-center py-5">
                        <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>

                        <div class="fw-semibold">
                            ยังไม่มีแม่แบบใบอนุญาต
                        </div>

                        <div class="text-muted small mb-3">
                            เริ่มต้นโดยเพิ่มแม่แบบใบอนุญาตรายการแรก
                        </div>

                        <a
                            href="{{ route('shop-license.license-templates.create') }}"
                            class="btn btn-primary btn-sm"
                        >
                            <i class="fas fa-plus me-1"></i>
                            เพิ่มแม่แบบใบอนุญาต
                        </a>
                    </td>
                </tr>-->

                
                <tr>
                    <td colspan="8">
                        <x-ppy.empty-state
                            title="ยังไม่มีแม่แบบใบอนุญาต"
                            description="เริ่มต้นโดยเพิ่มแม่แบบใบอนุญาตรายการแรก"
                            icon="fa-file-circle-plus"
                            :action-url="route('shop-license.license-templates.create')"
                            action-label="เพิ่มแม่แบบใบอนุญาต"
                        />
                    </td>
                </tr>
               
            @endforelse
        </tbody>

        <x-slot:paginationSummary>
            แสดง {{ $licenseTemplates->firstItem() ?? 0 }}
            ถึง {{ $licenseTemplates->lastItem() ?? 0 }}
            จากทั้งหมด
            {{ number_format($licenseTemplates->total()) }}
            รายการ
        </x-slot:paginationSummary>

        <x-slot:pagination>
            {{ $licenseTemplates->withQueryString()->links() }}
        </x-slot:pagination>
    </x-ppy.data-table>

</div>
@endsection