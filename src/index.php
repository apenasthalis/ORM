<?php 
header('Acess-Control-Allow-Origin: *');
header('Content-Type: application/json');

// phpinfo();
require './Router.php';

// const DBDRIVE = 'psql';
// const DBHOST = 'localhost';
// const DBNAME = 'spotifaux';
// const DBUSER = 'pericao';
// const DBPASS = '123';

// $connPdo = new \PDO(DBDRIVE . ':host=' . DBHOST . ';dbname=' . DBNAME, DBUSER, DBPASS);

// var_dump($connPdo);
if ($_GET['url']) {
$url = explode('/', $_GET['url']);
}


$router = new Router();

$dados = $router->getRouter($url,'pqp' );
var_dump($dados);
print "licença";
