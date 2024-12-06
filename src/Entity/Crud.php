<?php 

namespace Pericao\Orm\Entity;
use Pericao\Orm\Models\Database;

final class Crud extends Database
{
    private $pdo;
    private $schema;
    private $table;

    public function __construct()
    {
        $this->pdo = self::getConnection();
    }

    public function select(string $schema = "", string $table = "", array $where = [])
    {
        $sql = "SELECT * FROM {$schema}.{$table}";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function insert(string $schema, $table, array $colunas, array $data) 
    {
        $sql = "INSERT {$schema}.{$table}
        (, ,)
            values
        (?,?,?)";        
    }
}