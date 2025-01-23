<?php 

namespace Pericao\Orm\Models;

use Library\Crud\Crud;
use PDO;
use Pericao\Orm\Entity\Client as EntityClient;
use Pericao\Orm\Entity\ORM;

class Client
{
    //model ficará responsavel por chamar as coisas na entity, seja inserir, alterar e tudo mais 
    private $table = 'client'; 
    private $schema = 'public'; 

    public $columns = [];
    public $client;

    public function __construct() {
        $this->columns = $this->getColumns();
        $this->client = new EntityClient();
    }

    public function getColumns(): array 
    {
        $database = new Database();
        $pdo = $database->getConnection();
        $query = $pdo->prepare("
            SELECT column_name 
            FROM information_schema.columns 
            WHERE table_name = :table
        ");
        $query->execute(['table' => $this->table]);
        $this->columns = $query->fetchAll(PDO::FETCH_COLUMN);

        foreach ($this->columns as $key => $column) {
            $this->columns[$key] = $column;
        }
        return $this->columns;
    }

    public function getAll() 
    {
        return $this->client->getAllClients($this->table);
    }

    public function insert($data)
    {
        return $this->client->insert($data, $this->table, $this->columns);
    }

    public function update($data)
    {
        return $this->client->update($data, $this->table, $this->columns);
    }

    public function delete()
    {

    }
}