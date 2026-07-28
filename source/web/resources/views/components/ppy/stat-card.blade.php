<div class="card shadow-sm border-0 h-100">

    <div class="card-body">

        <div class="d-flex justify-content-between">

            <div>

                <div class="text-muted small">
                    {{ $title }}
                </div>

                <div class="display-6 fw-bold mt-2">
                    {{ $value }}
                </div>

                @if($subtitle)
                    <div class="small text-muted mt-2">
                        {{ $subtitle }}
                    </div>
                @endif

            </div>

            <div>

                <div
                    class="rounded-circle bg-{{ $color }} bg-opacity-10
                           text-{{ $color }}
                           d-flex justify-content-center align-items-center"
                    style="width:60px;height:60px;">

                    <i class="fas {{ $icon }} fa-xl"></i>

                </div>

            </div>

        </div>

    </div>

</div>