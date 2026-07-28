<?php

namespace App\View\Components\Ppy;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatusBadge extends Component
{
    public function __construct(
        public string $type = 'secondary'
    ) {
    }

    public function render(): View|Closure|string
    {
        return view('components.ppy.status-badge');
    }
}