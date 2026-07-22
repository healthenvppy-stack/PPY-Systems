<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessCategory extends Model
{
    protected $fillable = [
        'code',
        'name',
        'parent_id',
        'description',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active'=>'boolean',
    ];

    public function parent()
    {
        return $this->belongsTo(self::class,'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class,'parent_id');
    }
}