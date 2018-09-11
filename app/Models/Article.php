<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends BaseModel
{
    use SoftDeletes;

    /**
     * 需要转换成日期的属性
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
}
