<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}