@php
    $class = match($type) {
        'success' => 'bg-success',
        'danger'  => 'bg-danger',
        'warning' => 'bg-warning text-dark',
        'info'    => 'bg-info',
        'primary' => 'bg-primary',
        default   => 'bg-secondary',
    };
@endphp

<span class="badge {{ $class }}">
    {{ $slot }}
</span>