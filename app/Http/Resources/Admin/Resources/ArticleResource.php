<?php

namespace App\Http\Resources\Admin\Resources;

use App\Http\Resources\BaseResource;

class ArticleResource extends BaseResource
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
            'capital_img' => 'coming soon...',
            'seller_share_count' => null,
            'uv' => null,
            'status' => $this->status,
            'created_at' => optional($this->created_at)->toDateTimeString(),
        ];
    }
}
