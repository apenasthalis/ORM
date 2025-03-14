<?php

namespace Pericao\Orm\Exceptions;

class Exceptions extends \Exception
{
    protected $message = 'Unauthorized';

    public function __construct($message = null, $code = 404)
    {
        parent::__construct($message ?? $this->message, $code);
    }
}