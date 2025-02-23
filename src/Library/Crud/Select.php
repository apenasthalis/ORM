<?php 

namespace Pericao\Orm\Library\Crud;

use Pericao\Orm\Library\Crud\Crud;

class Select extends Crud
{
    private string $query = '';
    private string $from;
    private ?string $alias;
    private array $columns = [];
    private array $joins   = [];
    private string $group  = '';
    private array $having  = [];
    private array $order   = [];
    private string $offset = '';
    private string $limit  = '';
    private bool $distinct = false;
    
    public function select($table):self 
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

    public function join($table, $condition):self
    {
      $this->query .= " INNER JOIN {$table} ON {$condition}";
      return $this;
    }

    public function columns()
    {
        
    }

    public function where($condition):self
    {
        $this->query .= " WHERE {$condition}";
        return $this;
    }

    public function orderBy(string $column, string $order): self
    {
        $this->query .= " ORDER BY {$column} {$order}";
        return $this;
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