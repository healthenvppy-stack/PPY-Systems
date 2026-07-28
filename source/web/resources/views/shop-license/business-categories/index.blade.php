@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h1 class="h3 mb-0">ประเภทกิจการหลัก</h1>
            <small class="text-muted">ระบบทะเบียนร้านค้าและใบอนุญาต</small>
        </div>

        <a
            href="{{ route('shop-license.business-categories.create') }}"
            class="btn btn-primary"
        >
            เพิ่มประเภทกิจการหลัก
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
                            <th style="width: 160px;">รหัส</th>
                            <th>ชื่อประเภทกิจการหลัก</th>
                            <th>หมวดหลัก</th>
                            <th style="width: 110px;">สถานะ</th>
                            <th style="width: 170px;">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td>{{ $category->sort_order }}</td>
                                <td>{{ $category->code }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->businessGroup?->name ?? '-' }}</td>
                                <td>
                                    @if ($category->is_active)
                                        <span class="badge bg-success">ใช้งาน</span>
                                    @else
                                        <span class="badge bg-secondary">ปิดใช้งาน</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a
                                            href="{{ route('shop-license.business-categories.edit', $category) }}"
                                            class="btn btn-sm btn-warning"
                                        >
                                            แก้ไข
                                        </a>

                                        <form
                                            method="POST"
                                            action="{{ route('shop-license.business-categories.destroy', $category) }}"
                                            onsubmit="return confirm('ยืนยันการลบประเภทกิจการนี้?')"
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
                                <td colspan="6" class="text-center py-4">
                                    ไม่พบข้อมูลประเภทกิจการหลัก
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if ($categories->hasPages())
            <div class="card-footer">
                {{ $categories->links() }}
            </div>
        @endif
    </div>
</div>
@endsection