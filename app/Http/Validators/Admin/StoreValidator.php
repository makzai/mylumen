<?php
/**
 * Created by PhpStorm.
 * User: MIFFY
 * Date: 2018/9/7
 * Time: 14:20
 */

namespace App\Http\Validators\Admin;


use App\Http\Validators\BaseValidator;

class StoreValidator extends BaseValidator
{
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:8',
            ],
            'province' => [
                'required',
                'string',
            ],
            'city' => [
                'required',
                'string',
            ],
            'district' => [
                'required',
                'string',
            ],
            'detail' => [
                'required',
                'string',
                'max:20',
            ],
            'phone' => [
                'required',
                'string',
            ],
            'status' => [
                'required',
                'integer',
            ],
        ];
    }
}