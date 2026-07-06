@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between mb-3">

        <div>

            <h3>{{ $serviceCase->case_no }}</h3>

            <small class="text-muted">
            รายละเอียดเคส / Case Detail
            </small>

        </div>

        <a href="{{ route('service-cases.index') }}"
        class="btn btn-secondary">

        ย้อนกลับ

        </a>

    </div>

        <div class="row">

            <div class="col-lg-5">

                <div class="card">

                    <div class="card-header">

                    ข้อมูลเคส

                    </div>

                    <div class="card-body">

                        <table class="table table-sm">

                            <tr>
                            <th width="40%">เลขเคส</th>
                            <td>{{ $serviceCase->case_no }}</td>
                            </tr>

                            <tr>
                            <th>ประชาชน</th>
                            <td>

                            @if($serviceCase->citizen)

                            {{ $serviceCase->citizen->first_name }}
                            {{ $serviceCase->citizen->last_name }}

                            @endif

                            </td>
                            </tr>

                            <tr>
                            <th>โมดูล</th>
                            <td>{{ $serviceCase->module }}</td>
                            </tr>

                            <tr>
                            <th>ประเภท</th>
                            <td>{{ $serviceCase->case_type }}</td>
                            </tr>

                            <tr>
                            <th>สถานะ</th>
                            <td>{{ $serviceCase->status }}</td>
                            </tr>

                            <tr>
                            <th>Priority</th>
                            <td>{{ $serviceCase->priority }}</td>
                            </tr>

                            <tr>
                            <th>Remark</th>
                            <td>{{ $serviceCase->remark }}</td>
                            </tr>

                        </table>

                    </div>

                </div>

            </div>

        <div class="col-lg-7">

            <div class="card">

                <div class="card-header">

                Timeline

                </div>

                <div class="card-body">

                    @forelse($serviceCase->timelines as $timeline)

                    <div class="border-start border-3 border-primary ps-3 mb-3">

                        <strong>

                        {{ $timeline->action }}

                        </strong>

                        <br>

                        {{ $timeline->description }}

                        <br>

                        <small class="text-muted">

                        {{ optional($timeline->action_at)->format('d/m/Y H:i') }}

                        </small>

                    </div>

                @empty

                ไม่มี Timeline

                @endforelse

                </div>

            </div>

        </div>

    </div>

</div>

@endsection