<?php 

namespace Pericao\Orm\Http\Middlewares;

use Pericao\Orm\Exceptions\Exceptions;
use Pericao\Orm\Http\Request;
use Pericao\Orm\Library\Crud\Select;

class Jwt
{
    private static string $secret = "LOBISOMEN";

    public function handle()
    {
        $request = new Request();
        $authorization = $request::authorization();
        $dataFromJwt = self::verify($authorization);
        if (!$dataFromJwt) {
            throw new Exceptions("Sorry, we could not authenticate you.", 401);
        }
        $arrayDataJwt = json_decode($dataFromJwt, true);
        $userFromJwt =$this->userFromJwt($arrayDataJwt['id']);
        return $userFromJwt;
    }

    public static function generate(array $data = [])
    {
        $data['exp'] = time() + (60 * 60);
        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
        $payload = json_encode($data);
        $base64UrlHeader = self::base64url_encode($header);
        $base64UrlPayload = self::base64url_encode($payload);
        $signature = self::signature($base64UrlHeader, $base64UrlPayload);
        $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $signature;
        return $jwt;
    }

    public static function signature(string $header, string $payload)
    {
        $signature = hash_hmac('sha256', $header . "." . $payload, self::$secret, true);
        return self::base64url_encode($signature);
    }

    public static function verify($jwt)
    {
        $tokenPartials = explode('.', $jwt);
        if (count($tokenPartials) != 3) return false;
        [$header, $payload, $signature] = $tokenPartials;
        if (!hash_equals($signature, self::signature($header, $payload))) {
            return false;
        }
        $decodedPayload = self::base64url_decode($payload);
        if (isset($decodedPayload['exp']) && $decodedPayload['exp'] < time()) {
            return false;
        }
        return self::base64url_decode($payload);
    }

    public static function base64url_encode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    public static function base64url_decode($data)
    {
        $padding = strlen($data) % 4;
        $padding !== 0 && $data .= str_repeat('=', 4 - $padding);
        $data = strtr($data, '-_', '+/');
        return base64_decode($data);
    }

    public function userFromJwt($idJwt)
    {
        $select = new Select();
        $query = $select->select(['id','name','password'])
        ->from('public', ['c' => 'client'])
        ->where("id = {$idJwt}")
        ->get();
        return $query;
    }
}