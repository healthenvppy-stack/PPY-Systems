@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h1 class="h3 mb-0">ประเภทกิจการย่อย</h1>
            <small class="text-muted">
                ระบบทะเบียนร้านค้าและใบอนุญาต
            </small>
        </div>

        <a
            href="{{ route('shop-license.business-types.create') }}"
            class="btn btn-primary"
        >
            เพิ่มกิจการย่อย
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead>
                        <tr>
                            <th style="width: 90px;">ลำดับ</th>
                            <th style="width: 150px;">รหัส</th>
                            <th>หมวดกิจการ</th>
                            <th>ประเภทกิจการหลัก</th>
                            <th>ประเภทกิจการย่อย</th>
                            <th style="width: 130px;">ใบอนุญาต</th>
                            <th style="width: 110px;">สถานะ</th>
                            <th style="width: 170px;">จัดการ</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($businessTypes as $businessType)
                            <tr>
                                <td>{{ $businessType->sort_order }}</td>

                                <td>{{ $businessType->code }}</td>

                                <td>
                                    {{ $businessType->businessCategory?->businessGroup?->name ?? '-' }}
                                </td>

                                <td>
                                    {{ $businessType->businessCategory?->name ?? '-' }}
                                </td>

                                <td>{{ $businessType->name }}</td>

                                <td>
                                    @if ($businessType->requires_license)
                                        <span class="badge bg-primary">
                                            ต้องขอ
                                        </span>
                                    @else
                                        <span class="badge bg-light text-dark">
                                            ไม่ต้องขอ
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    @if ($businessType->is_active)
                                        <span class="badge bg-success">
                                            ใช้งาน
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">
                                            ปิดใช้งาน
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <div class="d-flex gap-2">
                                        <a
                                            href="{{ route('shop-license.business-types.edit', $businessType) }}"
                                            class="btn btn-sm btn-warning"
                                        >
                                            แก้ไข
                                        </a>

                                        <form
                                            method="POST"
                                            action="{{ route('shop-license.business-types.destroy', $businessType) }}"
                                            onsubmit="return confirm('ยืนยันการลบประเภทย่อยกิจการนี้?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-danger"
                                            >
                                                ลบ
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    ไม่พบข้อมูลประเภทกิจการย่อย
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if ($businessTypes->hasPages())
            <div class="card-footer">
                {{ $businessTypes->links() }}
            </div>
        @endif
    </div>
</div>
@endsection