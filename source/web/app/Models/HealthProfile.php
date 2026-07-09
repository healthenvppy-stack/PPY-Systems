<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HealthProfile extends Model
{
    protected $fillable = [
        'citizen_id',
        'has_chronic_disease',
        'has_diabetes',
        'has_hypertension',
        'has_heart_disease',
        'has_kidney_disease',
        'is_bedridden',
        'is_homebound',
        'is_disabled',
        'is_elderly',
        'health_level',
        'last_home_visit_at',
        'remark',
    ];

    protected $casts = [
        'has_chronic_disease' => 'boolean',
        'has_diabetes' => 'boolean',
        'has_hypertension' => 'boolean',
        'has_heart_disease' => 'boolean',
        'has_kidney_disease' => 'boolean',
        'is_bedridden' => 'boolean',
        'is_homebound' => 'boolean',
        'is_disabled' => 'boolean',
        'is_elderly' => 'boolean',
        'last_home_visit_at' => 'date',
    ];

    public function citizen(): BelongsTo
    {
        return $this->belongsTo(Citizen::class);
    }
}