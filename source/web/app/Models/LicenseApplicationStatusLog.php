<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LicenseApplicationStatusLog extends Model
{
    protected $fillable = [
        'license_application_id',
        'from_status',
        'to_status',
        'note',
        'changed_by',
        'changed_at',
    ];

    protected function casts(): array
    {
        return [
            'changed_at' => 'datetime',
        ];
    }

    public function application(): BelongsTo
    {
        return $this->belongsTo(
            LicenseApplication::class,
            'license_application_id'
        );
    }

    public function changedBy(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'changed_by'
        );
    }
}