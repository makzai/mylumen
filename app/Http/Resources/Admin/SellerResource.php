<?php

namespace App\Http\Resources\Admin;


use App\Http\Resources\BaseResource;

class SellerResource extends BaseResource
{
    public function toArray($request)
    {
        return [
            'corp_id' => $this->corp_id,
            'app_id' => $this->app_id,
            'pin_uid' => $this->pin_uid,
            'store_id' => $this->store_id,
            'account' => $this->account,
            'name' => $this->name,
            'phone' => $this->phone,
            'head_img' => $this->head_img,
            'wechat' => $this->wechat,
            'wechat_info' => $this->wechat_info,
            'role' => $this->role,
            'job_title' => $this->job_title,
            'status' => $this->status,
            'created_at' => optional($this->created_at)->toDateTimeString(),
        ];
    }
}