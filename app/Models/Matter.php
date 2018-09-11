<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Matter extends BaseModel
{
    use SoftDeletes;

    /**
     * 需要转换成日期的属性
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * 应该被转换成原生类型的属性。
     *
     * @var array
     */
    protected $casts = [
        'product_ids' => 'array',
        'image_ids' => 'array',
        'content_ids' => 'array',
    ];
}
