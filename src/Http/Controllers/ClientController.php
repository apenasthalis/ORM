<?php

namespace Pericao\Orm\Http\Controllers;

use Pericao\Orm\Http\Request;
use Pericao\Orm\Http\Response;
use Pericao\Orm\Services\ClientService;
use Pericao\Orm\Services\UserService;

class ClientController
{
    public function index(){
        $response = new Response();
        $userService = ClientService::index();

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
        ], 200);
        
        return;
    }

    public function show(){
        $response = new Response();
        $url = $_SERVER['REQUEST_URI'];
        $url = strtok($url, '?');
        $parts = explode('/', trim($url, '/'));
        $id = $parts[1];
        $userService = ClientService::show($id);

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
        ], 200);
        
        return;
    }

    public function update(Request $request, Response $response)
    {
        $authorization = $request::authorization();
        
        $url = $_SERVER['REQUEST_URI'];
        $url = strtok($url, '?');
        $parts = explode('/', trim($url, '/'));
        $body = $request::body();
        if (!empty($parts[1])) {
            $body['id'] = $parts[1];   
        }
        $userService = ClientService::update($body);

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
        ], 200);
        
        return;

    }

    public function store(Request $request, Response $response){
        $body = $request->body();
        $userService = ClientService::create($body);

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
        ], 200);
        
        return;
    }

    public function delete(){}
}
