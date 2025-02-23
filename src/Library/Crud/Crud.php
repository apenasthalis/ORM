<?php 

namespace Pericao\Orm\Library\Crud;

use Pericao\Orm\Library\Crud\Insert;
use Pericao\Orm\Models\Database;
use Pericao\Orm\Library\Crud\Select;

class Crud extends Database
{
    protected $pdo;
    protected $librarySelect; 

    public function __construct()
    {
        $this->pdo = $this->getConnection();
    }

    public function select(string $table): mixed
    {
        $librarySelect = new Select();
        $query = $librarySelect->select( $table)
        ->get();

        return $query;
    }

    public function insert($data, $table, $columns)
    {
        $libraryInsert = new Insert();
        $insertOrId = $libraryInsert->Insert($data, $table, $columns);

        return $insertOrId;
    }

    public function update($data, $table, $columns)
    {
        $libraryUpdate = new Update();
        $libraryUpdate->update($data, $table, $columns);

        return $data['id'];
    }

    public function delete()
    {
        
    }
    
    public function fetchRow()
    {

    }

    public function fetchAll()
    {
        
    }

    public function get()
    {
        
    }
}