<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Mission extends BaseModel
{
    use SoftDeletes;

    /**
     * 需要转换成日期的属性
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function Task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }
}
