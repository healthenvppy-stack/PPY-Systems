<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Citizen extends Model
{
    protected $fillable = [
        'household_id',
        'cid',
        'title_id',
        'first_name',
        'last_name',
        'gender',
        'birth_date',
        'religion_id',
        'nationality_id',
        'occupation_id',
        'education_level_id',
        'phone',
        'email',
        'status',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function household(): BelongsTo
    {
        return $this->belongsTo(Household::class);
    }

    public function welfareProfile(): HasOne
    {
        return $this->hasOne(WelfareProfile::class);
    }

    public function serviceCases(): HasMany
    {
        return $this->hasMany(ServiceCase::class);
    }

    public function healthProfile(): HasOne
    {
        return $this->hasOne(HealthProfile::class);
    }
}