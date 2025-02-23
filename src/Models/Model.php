<?php

namespace Pericao\Orm\Models;

class Model
{
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
        $this->columns = $query->fetchAll(\PDO::FETCH_COLUMN);

        foreach ($this->columns as $key => $column) {
            $this->columns[$key] = $column;
        }
        return $this->columns;
    }
}
