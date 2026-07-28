<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LicenseTemplateChecklist extends Model
{
    protected $fillable = [
        'license_template_id',
        'code',
        'name',
        'description',
        'inspection_criteria',
        'result_type',
        'maximum_score',
        'passing_score',
        'is_required',
        'requires_photo',
        'requires_note',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'maximum_score' => 'decimal:2',
        'passing_score' => 'decimal:2',
        'is_required' => 'boolean',
        'requires_photo' => 'boolean',
        'requires_note' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function licenseTemplate(): BelongsTo
    {
        return $this->belongsTo(LicenseTemplate::class);
    }
}