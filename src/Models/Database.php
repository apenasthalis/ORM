<?php

namespace Pericao\Orm\Models;

use PDO;

class Database
{
    const DBDRIVE = 'pgsql';
    const DBHOST = 'localhost';
    const DBPORT = '5432';
    const DBNAME = 'spotifaux';
    const DBUSER = 'pericao';
    const DBPASS = '123';

    public static function getConnection()
    {
        $connPdo = new PDO("pgsql:host=postgres_db;port=5432;dbname=spotifaux", "pericao", "123");
        return $connPdo;
    }
}
