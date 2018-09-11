<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends BaseModel
{
    use SoftDeletes;

    protected $fillable = [
        'corp_id',
        'app_id',
        'name',
        'title',
        'matter_id',
        'begin_at',
        'end_at',
        'creator_name',
        'creator_id',
        'status',
    ];

    protected $dates = ['deleted_at', 'begin_at', 'end_at'];

    public function matter()
    {
        return $this->belongsTo(Matter::class);
    }
}
