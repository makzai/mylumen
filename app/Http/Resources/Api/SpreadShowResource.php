<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\BaseResource;

class SpreadShowResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'creator' => [
                'uid' => null,
                'name' => null,
            ],
            'product' => [],
            'description' => $this->description,
            'content' => $this->content,
            'images' => [],
            'created_at' => optional($this->created_at)->toDateTimeString(),
        ];
    }
}
