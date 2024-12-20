<?php

namespace Pericao\Orm\Http\Controllers;

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

        // if (isset($userService['error'])) {
        //     return $response::json([
        //             'error' => true,
        //             'success' => false, 
        //             'message' => $userService['error']
        //         ], 400);
        // }

        $response::json([
            'error' => false,
            'success' => true, 
            'data' => $userService
        ], 201);
        
        return;
    }
    public function show(){}
    public function store(){}
    public function delete(){}
}
