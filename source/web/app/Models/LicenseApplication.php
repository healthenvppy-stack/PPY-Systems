<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class LicenseApplication extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'business_id',
        'business_type_id',
        'license_template_id',
        'applicant_citizen_id',
        'application_no',
        'application_type',
        'application_date',
        'requested_start_date',
        'status',
        'contact_name',
        'contact_phone',
        'contact_email',
        'application_fee',
        'license_fee',
        'total_fee',
        'applicant_note',
        'officer_note',
        'rejection_reason',
        'submitted_by',
        'submitted_at',
        'reviewed_by',
        'reviewed_at',
        'approved_by',
        'approved_at',
    ];

    protected function casts(): array
    {
        return [
            'application_date' => 'date',
            'requested_start_date' => 'date',
            'application_fee' => 'decimal:2',
            'license_fee' => 'decimal:2',
            'total_fee' => 'decimal:2',
            'submitted_at' => 'datetime',
            'reviewed_at' => 'datetime',
            'approved_at' => 'datetime',
        ];
    }

    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }

    public function businessType(): BelongsTo
    {
        return $this->belongsTo(BusinessType::class);
    }

    public function licenseTemplate(): BelongsTo
    {
        return $this->belongsTo(LicenseTemplate::class);
    }

    public function applicantCitizen(): BelongsTo
    {
        return $this->belongsTo(
            Citizen::class,
            'applicant_citizen_id'
        );
    }

    public function documents(): HasMany
    {
        return $this->hasMany(
            LicenseApplicationDocument::class
        );
    }

    public function statusLogs(): HasMany
    {
        return $this->hasMany(
            LicenseApplicationStatusLog::class
        )->orderByDesc('changed_at');
    }

    public function submittedBy(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'submitted_by'
        );
    }

    public function reviewedBy(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'reviewed_by'
        );
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'approved_by'
        );
    }
}
