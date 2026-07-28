<?php

namespace App\View\Components\Ppy;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EmptyState extends Component
{
    public function __construct(
        public string $title = 'ยังไม่มีข้อมูล',
        public ?string $description = null,
        public string $icon = 'fa-folder-open',
        public ?string $actionUrl = null,
        public ?string $actionLabel = null,
    ) {
    }

    public function render(): View|Closure|string
    {
        return view('components.ppy.empty-state');
    }
}