<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Spread extends BaseModel
{
    use SoftDeletes;

    /* 类型 */
    const TYPE_MATTER = 1;   // 直接创建
    const TYPE_MISSION = 2;  // 做任务
    const TYPE_RESOURCE = 3; // 引用转发

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
        'image_ids' => 'array',
    ];

    public function matter()
    {
        return $this->belongsTo(Matter::class, 'matter_id');
    }
}
