<?php 

namespace Pericao\Orm\Models;

use PDO;
use Pericao\Orm\Entity\Crud;
use Pericao\Orm\Models\Database;

class User extends Database
{
    public static function index()
    {
        $crudSelect = new Crud();
        return $crudSelect->select("public", "users");
    }
    
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

    public static function authentication($data)
    {
        $pdo = self::getConnection();

        $stmt = $pdo->prepare("
            SELECT 
                *
            FROM
                users
            WHERE
                email = ?
        ");

        $stmt->execute([$data['email']]);

        if ($stmt->rowCount() < 1) return false;
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!password_verify($data['password'], $user['password'])) return false;
        
        return [
            'id'    => $user['id'],
            'name'  => $user['name'],
            'email' => $user['email']
        ];
    }

    public static function find($id)
    {
        $pdo = self::getConnection();

        $stmt = $pdo->prepare("
            SELECT
                id, name, email
            FROM    
                users
            WHERE 
                id = ?
        ");

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function update($id, $data)
    {
        $pdo = self::getConnection();

        $stmt = $pdo->prepare('
            UPDATE
                users
            SET
                name = ?
            where 
                id = ?
        ');

        $stmt->execute([$data['name'], $id]);

        return $stmt->rowCount() > 0 ? true : false;
    }

    public static function delete($id)
    {
        $pdo = self::getConnection();

        $stmt = $pdo->prepare('
            DELETE
            FROM
                users
            where 
                id = ?
        ');

        $stmt->execute([$id]);

        return $stmt->rowCount() > 0 ? true : false;
    }
}