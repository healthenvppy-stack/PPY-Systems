<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-bottom py-3">
        <div class="d-flex flex-column flex-lg-row justify-content-between gap-3">

            <div>
                <div class="d-flex align-items-center gap-2">
                    <h3 class="card-title fw-semibold mb-0">
                        {{ $title }}
                    </h3>

                    <span class="badge rounded-pill bg-primary">
                        {{ number_format($total) }}
                    </span>
                </div>

                @if($description)
                    <div class="text-muted small mt-1">
                        {{ $description }}
                    </div>
                @endif
            </div>

            <div class="d-flex flex-column flex-md-row align-items-md-center gap-2">

                @if($showSearch)
                    <form method="GET"
                          action="{{ url()->current() }}"
                          class="d-flex">

                        @foreach(request()->except(['search', 'page']) as $key => $value)
                            @if(is_scalar($value))
                                <input type="hidden"
                                       name="{{ $key }}"
                                       value="{{ $value }}">
                            @endif
                        @endforeach

                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>

                            <input
                                type="search"
                                name="search"
                                value="{{ $search ?? request('search') }}"
                                class="form-control border-start-0"
                                placeholder="{{ $searchPlaceholder }}"
                                autocomplete="off"
                            >

                            @if($search || request('search'))
                                <a href="{{ url()->current() }}"
                                   class="btn btn-outline-secondary"
                                   title="ล้างการค้นหา">
                                    <i class="fas fa-times"></i>
                                </a>
                            @endif

                            <button type="submit"
                                    class="btn btn-outline-primary">
                                ค้นหา
                            </button>
                        </div>
                    </form>
                @endif

                @isset($filters)
                    {{ $filters }}
                @endisset

                @if($createUrl)
                    <a href="{{ $createUrl }}"
                       class="btn btn-primary text-nowrap">
                        <i class="fas fa-plus me-1"></i>
                        {{ $createLabel }}
                    </a>
                @endif

                @isset($actions)
                    {{ $actions }}
                @endisset
            </div>
        </div>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table {{ $attributes->class([
                'table',
                'table-hover',
                'table-striped',
                'align-middle',
                'mb-0',
            ]) }}>
                {{ $slot }}
            </table>
        </div>
    </div>

    @isset($pagination)
        <div class="card-footer bg-white border-top">
            <div class="d-flex flex-column flex-md-row
                        justify-content-between align-items-md-center gap-2">

                @isset($paginationSummary)
                    <div class="text-muted small">
                        {{ $paginationSummary }}
                    </div>
                @endisset

                <div class="ms-md-auto">
                    {{ $pagination }}
                </div>
            </div>
        </div>
    @endisset
</div>