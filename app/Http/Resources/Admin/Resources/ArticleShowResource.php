<?php

namespace App\Http\Resources\Admin\Resources;

use App\Http\Resources\BaseResource;

class ArticleShowResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $content = isset($this->matter) ? optional($this->matter->article[0])->content : null;
        return [
            'id' => $this->id,
            'title' => $this->when($this->matter, $this->matter->title),
            'creator' => [
                'uid' => null,
                'name' => null,
            ],
            'product' => [],
            'content' => $content,
            'status' => $this->status,
            'created_at' => optional($this->created_at)->toDateTimeString(),
        ];
    }
}
