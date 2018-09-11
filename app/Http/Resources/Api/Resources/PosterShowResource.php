<?php

namespace App\Http\Resources\Api\Resources;

use App\Http\Resources\BaseResource;

class PosterShowResource extends BaseResource
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
            'title' => $this->when($this->matter, $this->matter->title),
            'capital_img' => null,
            'seller_share_count' => null,
            'created_at' => optional($this->created_at)->toDateTimeString(),
        ];
    }
}
