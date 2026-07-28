<div class="text-center py-5 px-3">
    <div class="mb-3">
        <i class="fas {{ $icon }} fa-3x text-muted opacity-50"></i>
    </div>

    <h5 class="fw-semibold mb-2">
        {{ $title }}
    </h5>

    @if($description)
        <p class="text-muted mb-3">
            {{ $description }}
        </p>
    @endif

    @if($actionUrl && $actionLabel)
        <a href="{{ $actionUrl }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i>
            {{ $actionLabel }}
        </a>
    @endif

    {{ $slot }}
</div>