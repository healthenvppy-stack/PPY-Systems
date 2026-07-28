<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LicenseApplicationDocument extends Model
{
    protected $fillable = [
        'license_application_id',
        'license_template_document_id',
        'document_name',
        'file_path',
        'original_name',
        'mime_type',
        'file_size',
        'is_required',
        'is_submitted',
        'is_verified',
        'verification_note',
        'verified_by',
        'verified_at',
    ];

    protected function casts(): array
    {
        return [
            'is_required' => 'boolean',
            'is_submitted' => 'boolean',
            'is_verified' => 'boolean',
            'verified_at' => 'datetime',
        ];
    }

    public function application(): BelongsTo
    {
        return $this->belongsTo(
            LicenseApplication::class,
            'license_application_id'
        );
    }

    public function templateDocument(): BelongsTo
    {
        return $this->belongsTo(
            LicenseTemplateDocument::class,
            'license_template_document_id'
        );
    }

    public function verifiedBy(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'verified_by'
        );
    }
}