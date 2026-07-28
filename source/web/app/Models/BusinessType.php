<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BusinessType extends Model
{
    protected $fillable = [
        'business_category_id',
        'code',
        'name',
        'description',
        'legal_reference',
        'requires_license',
        'license_fee',
        'license_validity_months',
        'inspection_interval_months',
        'risk_level',
        'application_form',
        'is_active',
        'sort_order',

    ];

    protected $casts = [
        'requires_license' => 'boolean',
        'license_fee' => 'decimal:2',
        'license_validity_months' => 'integer',
        'inspection_interval_months' => 'integer',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function businessCategory(): BelongsTo
    {
        return $this->belongsTo(BusinessCategory::class);
    }
}