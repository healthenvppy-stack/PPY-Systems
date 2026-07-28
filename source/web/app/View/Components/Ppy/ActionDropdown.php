<?php

namespace App\View\Components\Ppy;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActionDropdown extends Component
{
    public function __construct(
        public string $label = 'จัดการ'
    ) {
    }

    public function render(): View|Closure|string
    {
        return view('components.ppy.action-dropdown');
    }
}
