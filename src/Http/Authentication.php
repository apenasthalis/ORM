<?php 

namespace Pericao\Orm\Http;

class Authentication
{
    const AUTH = ["jwt"];

    public function authentication($methodAuth)
    {
        $request = new Request();
        $tokenJwt = $request::authorization();
        Jwt::verify($tokenJwt);
    }
}