<?php

namespace Pericao\Orm\Http\Controllers;

use Pericao\Orm\Http\Request;
use Pericao\Orm\Http\Response;

class NotFoundController
{
    public function index(Request $request, Response $response)
    {
        $response::json([
            'error' => true, 
            'success' => false, 
            'message' => 'Sorry, route not found'
        ], 404);
        return;
    }
}