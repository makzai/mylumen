<?php

namespace App\Http\Validators\Admin;

use App\Http\Validators\BaseValidator;

class StoreResourceArticleValidator extends BaseValidator
{
    public function rules()
    {
        return [
            'title' => [
                'required',
                'string',
            ],
            'content' => [
                'required',
                'string',
            ],
            'product_ids' => [
                'sometimes',
                'array',
            ],
            'sort' => [
                'sometimes',
                'integer',
            ],
            'creator_name' => [
                'required',
                'string',
            ],
            'creator_id' => [
                'required',
                'integer',
            ],
            'status' => [
                'required',
                'integer',
                'in:0,1',
            ],
        ];
    }
}
