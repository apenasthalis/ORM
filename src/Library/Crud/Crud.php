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
        $columnsString = $this->prepareColumns($data->columns);
        $columns = $columnsString ?? $data->allColumns;
        $select = "SELECT {$columns} " . $data->from;
        $select .= $this->prepareJoin($data->join);
        $this->prepareWhere($data->where);
        $this->getRegisters($select);
    }

    public function prepareColumns($columns)
    {
        if (empty($columns)) return false;
        return implode(',',$columns);
    }

    public function prepareJoin($join)
    {
        $select = '';
        if (empty($join)) return false;
        foreach ($join as $value) {
            $select .= $value;
        }
        return $select;
    }

    public function prepareWhere($where)
    {
        $select = '';
        if (empty($where)) return false;
        foreach ($where as $value) {
            $select .= $value;
        }
        return $select;
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