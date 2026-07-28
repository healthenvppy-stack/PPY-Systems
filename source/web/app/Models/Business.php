<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Citizen;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Business extends Model
{
    use HasFactory;
    use SoftDeletes;

    
    protected $fillable = [
        'business_type_id',
        'citizen_id',
        'code',
        'name',
        'owner_prefix',
        'owner_first_name',
        'owner_last_name',
        'owner_citizen_id',
        'phone',
        'email',
        'house_no',
        'moo',
        'soi',
        'road',
        'subdistrict',
        'district',
        'province',
        'postal_code',
        'latitude',
        'longitude',
        'description',
        'remark',
        'status',
        'is_active',

    ];

    protected function casts(): array
    {
        return [
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
            'is_active' => 'boolean',
        ];
    }

    public function businessType(): BelongsTo
    {
        return $this->belongsTo(BusinessType::class);
    }

    public function getOwnerFullNameAttribute(): string
    {
        return trim(implode(' ', array_filter([
            $this->owner_prefix,
            $this->owner_first_name,
            $this->owner_last_name,
        ])));
    }

    public function getFullAddressAttribute(): string
    {
        return trim(implode(' ', array_filter([
            $this->house_no ? 'เลขที่ '.$this->house_no : null,
            $this->moo ? 'หมู่ '.$this->moo : null,
            $this->soi ? 'ซอย '.$this->soi : null,
            $this->road ? 'ถนน '.$this->road : null,
            $this->subdistrict ? 'ตำบล'.$this->subdistrict : null,
            $this->district ? 'อำเภอ'.$this->district : null,
            $this->province ? 'จังหวัด'.$this->province : null,
            $this->postal_code,
        ])));
    }

    public function citizen()
    {
        return $this->belongsTo(Citizen::class);
    }

    public function licenseApplications(): HasMany
    {
        return $this->hasMany(LicenseApplication::class);
    }
}