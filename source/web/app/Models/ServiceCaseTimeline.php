<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ServiceCaseTimeline extends Model
{
    protected $fillable = [
        'service_case_id',
        'action',
        'description',
        'user_id',
        'action_at',
    ];

    protected $casts = [
        'action_at' => 'datetime',
    ];

    public function serviceCase(): BelongsTo
    {
        return $this->belongsTo(ServiceCase::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}