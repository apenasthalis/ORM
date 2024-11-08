<?php 

namespace Pericao\Orm\Services;

use Pericao\Orm\Models\User;
use Pericao\Orm\Utils\Validator;

class UserService
{
    public static function create(array $data)  {
        try{
            $fields = Validator::validate([
                'name' => $data['name'] ?? '',
                'email' => $data['email'] ?? '',
                'password' => $data['password'] ?? '',
            ]);

            $fields['password'] = password_hash($fields['password'], PASSWORD_DEFAULT);

            $user = User::save($fields);
            if (!$user) return ['error' => 'Sorry, we could not create your account.'];

            return "User created successfully";
        }
        catch(\PDOException $e) {
            if ($e->errorInfo[0] === '08006') return ['error' => 'Sorry, we could not connect to the database.'];
            throw new \Exception($e->getMessage());
        }
        catch(\Exception $e){
            return ['error' => $e->getMessage()];
        }
    }
}