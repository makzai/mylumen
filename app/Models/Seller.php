<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Seller extends BaseModel
{
    use SoftDeletes;

    protected $fillable = [
        'corp_id',
        'app_id',
        'pin_uid',
        'store_id',
        'account',
        'name',
        'phone',
        'head_img',
        'wechat',
        'wechat_info',
        'role',
        'job_title',
        'status',
    ];
}
