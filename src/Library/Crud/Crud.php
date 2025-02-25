<?php 

namespace Pericao\Orm\Library\Crud;

use Pericao\Orm\Library\Crud\Insert;
use Pericao\Orm\Models\Database;
use Pericao\Orm\Library\Crud\Select;

class Crud extends Database
{
    protected $pdo;
    protected $librarySelect; 
    private $select;

    public function __construct()
    {
        $this->pdo = $this->getConnection();
    }

    public function prepareSql($data)
    {
        if (!empty($data->columns)) {
            $columnsString = $this->prepareColumns($data->columns);
        }
        $columns = $columnsString ?? $data->allColumns; 
        $select = "SELECT {$columns} " . $data->from;
        if (!empty($data->join)) {
            $select .= "";
        }
        $this->getRegisters($select);
    }

    public function prepareColumns($columns)
    {
        if (empty($columns)) return;
        return implode(',',$columns);
       
    }
    public function getRegisters($query): array
    {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
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
}