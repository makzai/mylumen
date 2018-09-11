<?php

namespace App\Http\Validators\Admin;


use App\Http\Validators\BaseValidator;

class SellerValidator extends BaseValidator
{
    public function rules()
    {
        return [
            'store_id' => [
                'required',
                'string',
            ],
            'account' => [
                'required',
                'string',
            ],
            'name' => [
                'required',
                'string',
                'max:5',
            ],
            'phone' => [
                'required',
                'string',
            ],
            'wechat' => [
                'required',
                'string',
            ],
            'role' => [
                'required',
                'integer',
            ],
            'job_title' => [
                'sometimes',
                'string',
            ],
        ];
    }
}