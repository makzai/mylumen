<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends BaseModel
{
    use SoftDeletes;

    protected $fillable = [
        'corp_id',
        'app_id',
        'name',
        'province',
        'city',
        'district',
        'detail',
        'phone',
        'status',
    ];

    protected $dates = ['deleted_at'];
}
