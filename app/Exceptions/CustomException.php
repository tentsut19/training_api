<?php

namespace App\Exceptions;

use Exception;

class CustomException extends Exception
{
    private $errorCode;

    public function __construct($message, $code = 0, $errorCode = 'general_error') {
        $this->errorCode = $errorCode;
        parent::__construct($message, $code);
    }

    // custom string representation of object
    public function __toString() {
        $class = str_replace("\\","\\\\",__CLASS__);
        return "{\"class\":\"{$class}\", \"code\":\"{$this->code}\", \"message\":\"{$this->message}\", \"error_code\":\"{$this->errorCode}\"}";
    }

    public function getErrorCode() {
        return $this->errorCode;
    }
}
