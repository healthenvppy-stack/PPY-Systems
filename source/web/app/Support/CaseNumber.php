<?php

namespace App\Support;

use App\Models\ServiceCase;

class CaseNumber
{
    public static function generate(): string
    {
        $year = now()->year + 543;

        $last = ServiceCase::whereYear('created_at', now()->year)
            ->orderByDesc('id')
            ->first();

        $running = $last ? ($last->id + 1) : 1;

        return sprintf(
            'PPY-%s-%06d',
            $year,
            $running
        );
    }
}