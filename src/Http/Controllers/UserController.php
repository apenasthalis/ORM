<?php 

namespace Pericao\Orm\Http\Controllers;

use Pericao\Orm\Http\Request;
use Pericao\Orm\Http\Response;
use Pericao\Orm\Services\UserService;

class UserController
{
    public function store(Request $request, Response $response)
    {
        $body = $request->body();

        $userService = UserService::create($body);

        if (isset($userService['error'])) {
            return $response::json([
                    'error' => true,
                    'success' => false, 
                    'message' => $userService['error']
                ], 400);
        }

        $response::json([
            'error' => false,
            'success' => true, 
            'data' => $userService
        ], 201);
        return;
    }

    public function login(Request $request, Response $response)
    {
        $body = $request->body();
        
        $auth = UserService::auth($body);
        
        if (isset($auth['error'])) {
            return $response::json([
                    'error' => true,
                    'success' => false, 
                    'message' => $auth['error']
                ], 400);
        }

        $response::json([
            'error' => false,
            'success' => true, 
            'jwt' => $auth
        ], 200);
        return;
    }

    public function fetch(Request $request, Response $response)
    {
        $authorization = $request::authorization();

        $auth = UserService::fetch($authorization);
        
        if (isset($auth['error'])) {
            return $response::json([
                    'error' => true,
                    'success' => false, 
                    'message' => $auth['error']
                ], 400);
        }

        $response::json([
            'error' => false,
            'success' => true, 
            'jwt' => $auth
        ], 200);
        return;
    }

    public function update(Request $request, Response $response)
    {
        $authorization = $request::authorization();

        $body = $request->body();


        $update = UserService::update($authorization, $body);
        
        if (isset($update['error'])) {
            return $response::json([
                    'error' => true,
                    'success' => false, 
                    'message' => $update['error']
                ], 400);
        }

        $response::json([
            'error' => false,
            'success' => true, 
            'message' => $update
        ], 200);
        return;
    }

    public function remove(Request $request, Response $response, array $id)
    {
        $authorization = $request::authorization();

        $body = $request->body();


        $update = UserService::delete($authorization, $id[0]);
        
        if (isset($update['error'])) {
            return $response::json([
                    'error' => true,
                    'success' => false, 
                    'message' => $update['error']
                ], 400);
        }

        $response::json([
            'error' => false,
            'success' => true, 
            'message' => $update
        ], 200);
        return;
    }
}