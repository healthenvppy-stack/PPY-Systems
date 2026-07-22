<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subdistrict extends Model
{
    protected $fillable = [
        'district_id',
        'code',
        'name_th',
        'name_en',
        'postal_code',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'district_id' => 'integer',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function province(): ?Province
    {
        return $this->district?->province;
    }
}