<div class="dropdown">
    <button
        class="btn btn-sm btn-outline-secondary dropdown-toggle"
        type="button"
        data-bs-toggle="dropdown"
        aria-expanded="false"
    >
        <i class="fas fa-ellipsis-v me-1"></i>
        {{ $label ?? 'จัดการ' }}
    </button>

    <ul class="dropdown-menu dropdown-menu-end shadow-sm">
        {{ $slot }}
    </ul>
</div>