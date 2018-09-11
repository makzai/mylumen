<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Resource extends BaseModel
{
    use SoftDeletes;

    /* 类型 */
    const TYPE_ARTICLE = 1; // 文章
    const TYPE_POSTER = 2;  // 海报
    const TYPE_PRODUCT = 3; // 商品

    /* 状态 */
    const STA_DISABLE = 0;  // 禁用
    const STA_ENABLE = 1;   // 启用

    /**
     * 需要转换成日期的属性
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function matter()
    {
        return $this->belongsTo(Matter::class, 'matter_id');
    }
}
