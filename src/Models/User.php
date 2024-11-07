<?php 

namespace Pericao\Orm\Models;

use Pericao\Orm\Models\Database;

class User extends Database
{
    public static function save($data)
    {
        $pdo = self::getConnection();

        $stmt = $pdo->prepare("
            INSERT
            INTO 
                users (name, email, password)
            values
            (?,?,?)
        ");

        $stmt->execute([
            $data['name'],
            $data['email'],
            $data['password']
        ]);

        return $pdo->lastInsertId() > 0 ? true : false;
    }
}