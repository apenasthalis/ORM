<?php
header('Acess-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once '../vendor/autoload.php';
$connPdo = new \PDO(DBDRIVE . ':host=' . DBHOST . ';dbname=' . DBNAME, DBUSER, DBPASS);

var_dump($connPdo);

if ($_GET['url']) {
    $url = explode('/', $_GET['url']);
}
