<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LicenseTemplate extends Model
{
    protected $fillable = [
        'business_type_id',
        'code',
        'name',
        'template_type',
        'is_default',
        'application_form',
        'fee_amount',
        'validity_months',
        'inspection_interval_months',
        'approval_authority',
        'legal_reference',
        'description',
        'effective_date',
        'expiry_date',
        'is_active',
        'version',
        'sort_order',
    ];

    protected $casts = [
        'is_default' => 'boolean',
        'fee_amount' => 'decimal:2',
        'validity_months' => 'integer',
        'inspection_interval_months' => 'integer',
        'effective_date' => 'date',
        'expiry_date' => 'date',
        'is_active' => 'boolean',
        'version' => 'integer',
        'sort_order' => 'integer',
    ];

    public function businessType(): BelongsTo
    {
        return $this->belongsTo(BusinessType::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(LicenseTemplateDocument::class)
            ->orderBy('sort_order')
            ->orderBy('name');
    }

    public function checklists(): HasMany
    {
        return $this->hasMany(LicenseTemplateChecklist::class)
            ->orderBy('sort_order')
            ->orderBy('name');
    }
}