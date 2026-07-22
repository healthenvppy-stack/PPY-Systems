<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LicenseType extends Model
{
    protected $fillable = [

        'code',
        'name',
        'business_category_id',
        'valid_month',
        'renew_before_day',
        'need_inspection',
        'need_payment',
        'description',
        'is_active'

    ];

    protected $casts=[

        'need_inspection'=>'boolean',
        'need_payment'=>'boolean',
        'is_active'=>'boolean',

    ];

    public function category()
    {
        return $this->belongsTo(BusinessCategory::class,'business_category_id');
    }

}