<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BenefitType extends Model
{
    protected $fillable = [
        'code',
        'name_th',
        'name_en',
        'category',
        'is_active',
        'remark',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function welfareBenefits(): HasMany
    {
        return $this->hasMany(WelfareBenefit::class);
    }
}