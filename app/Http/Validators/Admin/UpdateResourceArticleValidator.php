<?php

namespace App\Http\Validators\Admin;

use App\Http\Validators\BaseValidator;

class UpdateResourceArticleValidator extends BaseValidator
{
    public function rules()
    {
        return [
            'title' => [
                'sometimes',
                'string',
            ],
            'content' => [
                'sometimes',
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
            'status' => [
                'sometimes',
                'integer',
                'in:0,1',
            ],
        ];
    }
}
