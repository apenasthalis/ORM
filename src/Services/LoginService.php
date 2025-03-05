<?php

namespace Pericao\Orm\Services;

use Pericao\Orm\Models\Client;
use Pericao\Orm\Utils\Validator;

class LoginService
{
    public static function auth($data)
    {
        try {
            $fields = Validator::validate([
                'email' => $data['email'] ?? '',
                'password' => $data['password'] ?? ''

            ]);

            $user = Client::authentication($fields);
            if (!$user) return ['error' => 'Sorry, we could not authenticate you.'];

            return Jwt::generate($user);
        } catch (\PDOException $e) {
            if ($e->errorInfo[0] === '08006') return ['error' => 'Sorry, we could not connect to the database.'];
            throw new \Exception($e->getMessage());
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}