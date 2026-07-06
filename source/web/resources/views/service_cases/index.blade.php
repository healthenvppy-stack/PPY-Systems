@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between mb-3">
        <div>
            <h3 class="mb-0">Service Cases</h3>
            <small class="text-muted">รายการเคสบริการกลางของเทศบาล</small>
        </div>
        <a href="{{ route('service-cases.create') }}" class="btn btn-primary">+ เปิดเคสใหม่</a>
        
    </div>

    <div class="card">
        <div class="card-body">

            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>เลขเคส</th>
                        <th>ประชาชน</th>
                        <th>โมดูล</th>
                        <th>ประเภทเคส</th>
                        <th>สถานะ</th>
                        <th>ความสำคัญ</th>
                        <th width="120">จัดการ</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($cases as $case)
                        <tr>
                            <td>{{ $case->case_no }}</td>
                            <td>
                                @if($case->citizen)
                                    {{ $case->citizen->first_name }} {{ $case->citizen->last_name }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ $case->module }}</td>
                            <td>{{ $case->case_type }}</td>
                            <td>{{ $case->status }}</td>
                            <td>{{ $case->priority }}</td>
                            <td>
                                <a href="{{ route('service-cases.show', $case) }}" class="btn btn-sm btn-info">
                                    ดู
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">
                                ยังไม่มีข้อมูลเคส
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $cases->links() }}

        </div>
    </div>

</div>
@endsection