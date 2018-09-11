<?php

namespace App\Http\Resources\Admin;


use App\Http\Resources\BaseResource;

class StoreResource extends BaseResource
{
    public function toArray($request)
    {
        return [
            'corp_id' => $this->corp_id,
            'app_id' => $this->app_id,
            'name' => $this->name,
            'province' => $this->province,
            'city' => $this->city,
            'district' => $this->district,
            'detail' => $this->detail,
            'phone' => $this->phone,
            'status' => $this->status,
            'created_at' => optional($this->created_at)->toDateTimeString(),
        ];
    }
}