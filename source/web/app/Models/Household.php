<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Household extends Model
{
    protected $fillable = [
        'house_code',
        'house_no',
        'moo',
        'village_id',
        'road',
        'alley',
        'postcode',
        'latitude',
        'longitude',
        'flood_level',
        'status',
    ];

    public function citizens(): HasMany
    {
        return $this->hasMany(Citizen::class);
    }
}