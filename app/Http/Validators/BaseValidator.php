<?php

namespace App\Http\Validators;


use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class BaseValidator
{
    public function check(array $param)
    {
        $validator = Validator::make($param, $this->rules());

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return true;
    }
}
