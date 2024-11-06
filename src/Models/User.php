<?php 

namespace Pericao\Orm\Models;

use Pericao\Orm\Utils\Validator;

class User
{
    public static function create(array $data)  {
        try{
            $fields = Validator::validate([
                'name' => $data['name'] ?? '',
                'email' => $data['email'] ?? '',
                'password' => $data['password'] ?? '',
            ]);

            return $fields;
        }
        catch(\Exception $e){
            return ['error' => $e->getMessage()];
        }
    }
}