<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WelfareProfile extends Model
{
    protected $fillable = [
        'citizen_id',
        'is_elderly',
        'is_disabled',
        'is_low_income',
        'is_vulnerable',
        'is_bedridden',
        'is_homebound',
        'care_level',
        'risk_level',
        'priority_level',
        'remark',
    ];

    protected $casts = [
        'is_elderly' => 'boolean',
        'is_disabled' => 'boolean',
        'is_low_income' => 'boolean',
        'is_vulnerable' => 'boolean',
        'is_bedridden' => 'boolean',
        'is_homebound' => 'boolean',
    ];

    public function citizen(): BelongsTo
    {
        return $this->belongsTo(Citizen::class);
    }
}