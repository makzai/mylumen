<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\BaseResource;

class SpreadResource extends BaseResource
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
            'capital_img' => 'http://xx/1.png',
            'pv' => null,
            'created_at' => optional($this->created_at)->toDateTimeString(),
        ];
    }
}
