<?php

namespace Pericao\Orm\Services;

use Pericao\Orm\Http\Jwt;
use Pericao\Orm\Models\User;
use Pericao\Orm\Utils\Validator;

class UserService
{

    public static function index()
    {
        $user = User::index();

        if (!$user) return ['error' => 'Sorry, we could not found your users.'];

        return $user;

    }
    public static function create(array $data)
    {
        try {
            $fields = Validator::validate([
                'name' => $data['name'] ?? '',
                'email' => $data['email'] ?? '',
                'password' => $data['password'] ?? '',
            ]);

            $fields['password'] = password_hash($fields['password'], PASSWORD_DEFAULT);

            $user = User::save($fields);
            if (!$user) return ['error' => 'Sorry, we could not create your account.'];

            return "User created successfully";
        } catch (\PDOException $e) {
            if ($e->errorInfo[0] === '08006') return ['error' => 'Sorry, we could not connect to the database.'];
            throw new \Exception($e->getMessage());
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public static function auth($data)
    {
        try {
            $fields = Validator::validate([
                'email' => $data['email'] ?? '',
                'password' => $data['password'] ?? ''

            ]);

            $user = User::authentication($fields);
            if (!$user) return ['error' => 'Sorry, we could not authenticate you.'];

            return Jwt::generate($user);
        } catch (\PDOException $e) {
            if ($e->errorInfo[0] === '08006') return ['error' => 'Sorry, we could not connect to the database.'];
            throw new \Exception($e->getMessage());
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public static function fetch(mixed $authorization)
    {
        try {
            if (isset($authorization['error'])) {
                return ['error' => $authorization['error']];
            }

            $userFromJwt = JWT::verify($authorization);

            if (!$userFromJwt) return ['error' => 'Please, login to access this resource.'];

            $user = User::find($userFromJwt['id']);

            if (!$user) return ["error" => "Sorry, we could not find your account"];

            return $user;

        } catch (\PDOException $e) {
            if ($e->errorInfo[0] === '08006') return ['error' => 'Sorry, we could not connect to the database.'];
            return ['error' => $e->errorInfo[0]];
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public static function update(mixed $authorization, array $data)
    {
        try {
            if (isset($authorization['error'])) {
                return ['error' => $authorization['error']];
            }

            $userFromJwt = JWT::verify($authorization);

            if (!$userFromJwt) return ['error' => 'Please, login to access this resource.'];

            $fields = Validator::validate([
                'name' => $data['name'] ?? ''
            ]);

            $user = User::update($userFromJwt['id'], $fields);

            if (!$user) return ["error" => "Sorry, we could not update your account"];

            return "User updated successfully";

        } catch (\PDOException $e) {
            if ($e->errorInfo[0] === '08006') return ['error' => 'Sorry, we could not connect to the database.'];
            return ['error' => $e->errorInfo[0]];
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public static function delete(mixed $authorization, $id)
    {
        try {
            if (isset($authorization['error'])) {
                return ['error' => $authorization['error']];
            }

            $userFromJwt = JWT::verify($authorization);

            if (!$userFromJwt) return ['error' => 'Please, login to access this resource.'];


            $user = User::delete($id);

            if (!$user) return ["error" => "Sorry, we could not update your account"];

            return "User updated successfully";

        } catch (\PDOException $e) {
            if ($e->errorInfo[0] === '08006') return ['error' => 'Sorry, we could not connect to the database.'];
            return ['error' => $e->errorInfo[0]];
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
