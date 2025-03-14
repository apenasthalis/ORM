<?php 

namespace Pericao\Orm\Models;

use PDO;
use Pericao\Orm\Entity\Client as EntityClient;
use Pericao\Orm\Entity\ORM;
use Pericao\Orm\Library\Crud\Crud;

class Client extends Model
{
    protected $table = 'client'; 
    protected $schema = 'public'; 
    protected $columns = [];
    public $client;
    public $crud;

    public function __construct() {
        $this->columns = $this->getColumns();
        $this->client = new EntityClient();
        $this->crud = new Crud();
    }

    public function getAll() 
    {
        return $this->client->getAllClients($this->schema,$this->table);
    }

    public function getClientById($id)
    {
        return $this->client->getClientById($id, $this->table);
    }

    public function Show($table, $data)
    {
        return $this->client->getClientById($table, $data);
    }

    public function insert($data)
    {
        return $this->crud->insert($data, $this->table, $this->columns);
    }

    public function update($data)
    {
        return $this->crud->update($data, $this->table, $this->columns);
    }

    public function delete()
    {

    }
}