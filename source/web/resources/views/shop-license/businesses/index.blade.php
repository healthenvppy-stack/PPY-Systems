@extends('layouts.app')

@section('title', 'ทะเบียนสถานประกอบการ')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">ทะเบียนสถานประกอบการ</h1>
            <div class="text-muted">
                จัดการข้อมูลร้านค้าและสถานประกอบการ
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>
        </div>
    @endif

    <x-ppy.data-table
        title="รายการสถานประกอบการ"
        description="ค้นหาและจัดการทะเบียนสถานประกอบการทั้งหมด"
        :total="$businesses->total()"
        :search="request('search')"
        :create-url="route('shop-license.businesses.create')"
        create-label="เพิ่มสถานประกอบการ"
    >
        <thead class="table-light">
            <tr>
                <th style="width: 70px;">ลำดับ</th>
                <th style="width: 130px;">รหัส</th>
                <th>ชื่อสถานประกอบการ</th>
                <th>ประเภทกิจการ</th>
                <th>ผู้ประกอบการ</th>
                <th style="width: 130px;">โทรศัพท์</th>
                <th style="width: 120px;">สถานะ</th>
                <th style="width: 130px;" class="text-end">
                    การดำเนินการ
                </th>
            </tr>
        </thead>

        <tbody>
            @forelse($businesses as $business)
                <tr>
                    <td>
                        {{ ($businesses->firstItem() ?? 0) + $loop->index }}
                    </td>

                    <td>
                        <span class="fw-semibold">
                            {{ $business->code }}
                        </span>
                    </td>

                    <td>
                        <a
                            href="{{ route('shop-license.businesses.show', $business) }}"
                            class="text-decoration-none fw-semibold"
                        >
                            {{ $business->name }}
                        </a>

                        @if($business->moo || $business->house_no)
                            <div class="small text-muted mt-1">
                                {{ $business->house_no ? 'เลขที่ '.$business->house_no : '' }}

                                {{ $business->moo ? ' หมู่ '.$business->moo : '' }}
                            </div>
                        @endif
                    </td>

                    <td>
                        <div>
                            {{ $business->businessType?->name ?? '-' }}
                        </div>

                        <div class="small text-muted">
                            {{ $business->businessType?->businessCategory?->name ?? '-' }}
                        </div>
                    </td>

                    <td>
                        {{ $business->owner_full_name }}
                    </td>

                    <td>
                        {{ $business->phone ?: '-' }}
                    </td>

                    <td>
                        @php
                            $statusType = match($business->status) {
                                'active' => 'success',
                                'inactive' => 'warning',
                                'closed' => 'danger',
                                default => 'secondary',
                            };

                            $statusLabel = match($business->status) {
                                'active' => 'เปิดดำเนินการ',
                                'inactive' => 'พักดำเนินการ',
                                'closed' => 'ปิดกิจการ',
                                default => 'ไม่ระบุ',
                            };
                        @endphp

                        <x-ppy.status-badge :type="$statusType">
                            {{ $statusLabel }}
                        </x-ppy.status-badge>
                    </td>

                    <td class="text-end">
                        <x-ppy.action-dropdown>
                            <li>
                                <a
                                    href="{{ route('shop-license.businesses.show', $business) }}"
                                    class="dropdown-item"
                                >
                                    <i class="fas fa-eye text-info me-2"></i>
                                    ดูรายละเอียด
                                </a>
                            </li>

                            <li>
                                <a
                                    href="{{ route('shop-license.businesses.edit', $business) }}"
                                    class="dropdown-item"
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
                                    action="{{ route('shop-license.businesses.destroy', $business) }}"
                                    method="POST"
                                    onsubmit="return confirm('ยืนยันการลบสถานประกอบการนี้หรือไม่?')"
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
                <tr>
                    <td colspan="8">
                        <x-ppy.empty-state
                            title="ยังไม่มีข้อมูลสถานประกอบการ"
                            description="เริ่มต้นโดยเพิ่มสถานประกอบการรายการแรก"
                            icon="fa-store"
                            :action-url="route('shop-license.businesses.create')"
                            action-label="เพิ่มสถานประกอบการ"
                        />
                    </td>
                </tr>
            @endforelse
        </tbody>

        <x-slot:paginationSummary>
            แสดง {{ $businesses->firstItem() ?? 0 }}
            ถึง {{ $businesses->lastItem() ?? 0 }}
            จากทั้งหมด {{ number_format($businesses->total()) }} รายการ
        </x-slot:paginationSummary>

        <x-slot:pagination>
            {{ $businesses->withQueryString()->links() }}
        </x-slot:pagination>
    </x-ppy.data-table>

</div>
@endsection