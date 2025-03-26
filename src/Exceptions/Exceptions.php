<?php

namespace Pericao\Orm\Exceptions;

class Exceptions extends \Exception
{
    protected $message = 'Unauthorized';
    protected $code = 401;

    public function __construct($message = null, $code = null)
    {
        parent::__construct(
            $message ?? $this->message, 
            $code ?? $this->code
        );
    }

    public static function jsonResponse($data, $statusCode = 200) {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}
