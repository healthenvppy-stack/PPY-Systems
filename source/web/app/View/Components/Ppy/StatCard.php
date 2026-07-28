<?php

namespace App\View\Components\Ppy;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatCard extends Component
{
    public function __construct(
        public string $title,
        public string $value,
        public string $icon = 'fa-chart-bar',
        public string $color = 'primary',
        public ?string $subtitle = null,
    ) {
    }

    public function render(): View|Closure|string
    {
        return view('components.ppy.stat-card');
    }
}