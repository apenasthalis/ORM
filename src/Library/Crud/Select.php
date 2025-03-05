<?php 

namespace Pericao\Orm\Library\Crud;

use Pericao\Orm\Library\Crud\Crud;

class Select extends Crud
{
    protected string $query = '';
    protected string $allColumns = '*';
    protected string $select;
    protected string $from;
    protected ?string $alias;
    protected array $columns;
    protected array $join = [];
    protected array $where = [];
    protected string $group  = '';
    protected array $having  = [];
    protected array $order   = [];
    protected string $offset = '';
    protected string $limit  = '';
    protected bool $distinct = false;
    
    public function select($columns = '*'): Select 
    {
        $this->columns[] = $columns;
        return $this;
    }

    public function from($schema, $table): self
    {
        foreach ($table as $alias => $name) {
            $this->alias = (string) $alias;
            $table = (string) $name;
        }
        $this->from = "{$schema}.{$table} AS $this->alias ";
        return $this;
    }

    public function join($schema, $table, $condition, $columns = '', $type = 'inner'): self
    {
        $columns = !empty($columns) ? $columns : '*';
        $alias = '';
        $type = strtoupper($type);
        foreach ($table as $alias => $name) {
            $alias = (string) $alias;
            $table = (string) $name;
        }
        $instancedColumns = $this->prepareColumnsJoin($alias,$columns);
        $this->columns[] = $instancedColumns;
        $this->join[] = "$type JOIN {$schema}.{$table} AS {$alias} ON {$condition} ";
        return $this;
    }

    public function where($condition): self
    {
        $this->where[] = " WHERE {$condition}";
        return $this;
    }

    public function orderBy(string $order): self
    {
        $this->order[] = "{$order}";
        return $this;
    }

    public function get()
    {
        return $this->prepareSql($this);
    }

    public function getSelectRaw()
    {
        return $this->query;
    }
}