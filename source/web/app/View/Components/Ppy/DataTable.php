<?php

namespace App\View\Components\Ppy;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DataTable extends Component
{
    public function __construct(
        public string $title = 'รายการข้อมูล',
        public ?string $description = null,
        public ?string $search = null,
        public string $searchPlaceholder = 'ค้นหาข้อมูล...',
        public ?string $createUrl = null,
        public string $createLabel = 'เพิ่มข้อมูล',
        public int $total = 0,
        public bool $showSearch = true,
    ) {
    }

    public function render(): View|Closure|string
    {
        return view('components.ppy.data-table');
    }
}