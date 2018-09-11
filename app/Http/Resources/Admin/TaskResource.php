<?php

namespace App\Http\Resources\Admin;


use App\Http\Resources\BaseResource;

class TaskResource extends BaseResource
{
    public function toArray($request)
    {
        return [
            'corp_id' => $this->corp_id,
            'app_id' => $this->app_id,
            'name' => $this->name,
            'matter_id' => $this->matter_id,
            'begin_at' => optional($this->begin_at)->toDateTimeString(),
            'end_at' => optional($this->end_at)->toDateTimeString(),
            'creator_name' => $this->creator_name,
            'creator_id' => $this->creator_id,
            'status' => $this->status,
            'matter' => $this->matter,
        ];
    }
}