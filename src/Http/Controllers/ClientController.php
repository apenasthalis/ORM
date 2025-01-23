<?php

namespace Pericao\Orm\Http\Controllers;

use Pericao\Orm\Http\Request;
use Pericao\Orm\Http\Response;
use Pericao\Orm\Services\ClientService;
use Pericao\Orm\Services\UserService;

class ClientController
{
    //Request and Reponse...
    // private $model = new \Pericao\Orm\Models\Client();

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

    public function update(Request $request, Response $response)
    {
        $authorization = $request::authorization();

        $body = $request::body();
        $userService = ClientService::update($body);

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
