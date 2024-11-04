<?php
header('Acess-Control-Allow-Origin: *');
header('Content-Type: application/json');

require '../vendor/autoload.php';

const DBDRIVE = 'pgsql';
const DBHOST = 'postgres';
const DBPORT = '5432';
const DBNAME = 'spotifaux';
const DBUSER = 'pericao';
const DBPASS = '123';

try {
    $connPdo = new \PDO(DBDRIVE . ':host=' . DBHOST . ';port=' . DBPORT . ';dbname=' . DBNAME, DBUSER, DBPASS);
    $connPdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    echo "Conexão estabelecida com sucesso!";
} catch (\PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
}


var_dump($connPdo);

if ($_GET['url']) {
    $url = explode('/', $_GET['url']);
}
