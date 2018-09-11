<?php

namespace App\Http\Validators\Api;

use App\Http\Validators\BaseValidator;

class StoreSpreadValidator extends BaseValidator
{
    public function rules()
    {
        return [
            'title' => [
                'required',
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
            'image_ids' => [
                'sometimes',
                'array',
            ],
            'description' => [
                'sometimes',
                'string',
            ],
            'type' => [
                'required',
                'integer',
                'in:1,2,3',
            ],
            'mission_id' => [
                'required_if:type,2',
                'integer',
            ],
            'resource_id' => [
                'required_if:type,3',
                'integer',
            ],
        ];
    }
}
