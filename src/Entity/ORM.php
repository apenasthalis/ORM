<?php

namespace Pericao\Orm\Entity;

use PDO;
use Pericao\Orm\Models\Database;

class ORM {
    protected $table;
    protected $columns = [];

    public function __construct() {
        $this->table = strtolower(get_class($this));
        $this->loadColumns();
    }

    private function loadColumns() {
        $pdo = Database::getConnection();
        $query = $pdo->prepare("
            SELECT column_name 
            FROM information_schema.columns 
            WHERE table_name = :table
        ");
        $query->execute(['table' => $this->table]);
        $this->columns = $query->fetchAll(PDO::FETCH_COLUMN);

        foreach ($this->columns as $column) {
            $this->{$column} = null;
        }
    }

    public function find($id) {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            foreach ($data as $key => $value) {
                $this->{$key} = $value;
            }
        }
        return $this;
    }

    public function save() {
        $pdo = Database::getConnection();
        $columns = implode(", ", $this->columns);
        $placeholders = implode(", ", array_map(fn($col) => ":$col", $this->columns));
        $stmt = $pdo->prepare("INSERT INTO {$this->table} ($columns) VALUES ($placeholders)");

        $data = [];
        foreach ($this->columns as $column) {
            $data[":$column"] = $this->{$column};
        }

        return $stmt->execute($data);
    }
}
