<?php

namespace App\Http\Validators\Admin;

use App\Http\Validators\BaseValidator;

class StoreResourcePosterValidator extends BaseValidator
{
    public function rules()
    {
        return [
            'title' => [
                'required',
                'string',
                'min:1',
                'max:50',
            ],
            'image_ids' => [
                'required',
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
