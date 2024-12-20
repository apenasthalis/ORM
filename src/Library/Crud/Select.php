<?php 

namespace Pericao\Orm\Library\Crud;

use Pericao\Orm\Library\Crud\Crud;

class Select extends Crud
{
    public function selectAll($table)
    {
        $sql = "SELECT * FROM {$table}";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function where()
    {

    }

    public function join()
    {

    }

    public function getSelectRaw()
    {

    }
}