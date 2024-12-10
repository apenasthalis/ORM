<?php 

namespace Pericao\Orm\Models;

use Library\Crud\Crud;
use PDO;
use Pericao\Orm\Entity\ORM;

class Client extends Crud
{
    //model ficará responsavel por chamar as coisas na entity, seja inserir, alterar e tudo mais 
    private $table = 'client'; 
    private $columns = [];

    public function __construct() {
        $this->columns = $this->getColumns();
    }

    public function getColumns(): array 
    {
        $pdo = Database::getConnection();
        $query = $pdo->prepare("
            SELECT column_name 
            FROM information_schema.columns 
            WHERE table_name = :table
        ");
        $query->execute(['table' => $this->table]);
        $this->columns = $query->fetchAll(PDO::FETCH_COLUMN);

        foreach ($this->columns as $column) {
            $this->columns[0] = $column;
        }
        return $this->columns;
    }
}