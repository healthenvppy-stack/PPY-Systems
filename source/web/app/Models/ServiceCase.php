<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ServiceCase extends Model
{
    protected $fillable = [
        'case_no',
        'citizen_id',
        'module',
        'case_type',
        'status',
        'priority',
        'opened_at',
        'closed_at',
        'assigned_to',
        'created_by',
        'remark',
    ];

    protected $casts = [
        'opened_at' => 'date',
        'closed_at' => 'date',
    ];

    protected static function booted()
    {
        static::creating(function ($case) {

            if (empty($case->case_no)) {

                $case->case_no =
                    \App\Support\CaseNumber::generate();

            }

        });
    }
    
    public function citizen(): BelongsTo
    {
        return $this->belongsTo(Citizen::class);
    }

    public function timelines(): HasMany
    {
        return $this->hasMany(ServiceCaseTimeline::class);
    }

    public function assignedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}