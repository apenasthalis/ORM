<?php 

namespace Pericao\Orm\Library\Crud;

use Pericao\Orm\Library\Crud\Crud;

class Select extends Crud
{

    public string $query = '';
    
    function select(string $table): self 
    {
       $this->query = "SELECT * FROM {$table}";
       return $this;
    }

    public function selectAll($table)
    {
        $sql = "SELECT * FROM {$table}";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function join($table, $condition)
    {
      return $this->query .= " INNER JOIN {$table} ON {$condition}";
    }

    public function columns()
    {
        
    }

    public function where($condition)
    {
        return $this->query .= " WHERE {$condition}";
    }

    public function orderBy(string $column, string $order): string
    {
        return $this->query .= " ORDER BY {$column} {$order}";
    }

    public function get(): array
    {
        $stmt = $this->pdo->prepare($this->query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getSelectRaw()
    {
        return $this->query;
    }
}