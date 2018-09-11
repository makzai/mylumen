<?php

namespace App\Http\Validators\Admin;

use App\Http\Validators\BaseValidator;

class UpdateResourcePosterValidator extends BaseValidator
{
    public function rules()
    {
        return [
            'title' => [
                'sometimes',
                'string',
            ],
            'image_ids' => [
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
