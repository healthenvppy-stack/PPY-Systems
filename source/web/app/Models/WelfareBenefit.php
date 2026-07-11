<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WelfareBenefit extends Model
{
    protected $fillable = [
        'citizen_id',
        'benefit_type_id',
        'status',
        'amount',
        'start_date',
        'end_date',
        'agency',
        'reference_no',
        'remark',
        'created_by',
        'approved_by',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function citizen(): BelongsTo
    {
        return $this->belongsTo(Citizen::class);
    }

    public function benefitType(): BelongsTo
    {
        return $this->belongsTo(BenefitType::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}