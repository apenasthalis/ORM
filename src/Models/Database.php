<?php

namespace Pericao\Orm\Models;

use PDO;

class Database
{
    const DBDRIVE = 'pgsql';
    const DBHOST = 'postgres';
    const DBPORT = '5432';
    const DBNAME = 'spotifaux';
    const DBUSER = 'pericao';
    const DBPASS = '123';
    public static function getConnection()
    {
        $pdo = new PDO("pgsql:host=localhost;port=5432;dbname=spotifaux", "pericao", "123");
        return $pdo;
    }
}