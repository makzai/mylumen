<?php

namespace App\Exceptions;

use Exception;

class BizException extends Exception
{
    protected $message = '业务异常';

    protected $code = 50001;

    public function __construct($message='', $code=null)
    {
        $this->message = $message ?: $this->message;
        $this->code = $code ?: $this->code;
        parent::__construct($this->message, $this->code);
    }
}
