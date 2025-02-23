<?php 

namespace Pericao\Orm\Library\Crud;

use Pericao\Orm\Library\Crud\Crud;

class Update extends Crud
{
    public function update($data, $table, $columns) 
    {
        $prepare = new Prepare();
        $prepareUpdate = $prepare->prepareUpdate($data, $columns);        
        $stmt = $this->pdo->prepare("
            UPDATE 
                {$table}
            SET 
                {$prepareUpdate['placeHolders']}
            WHERE 
               id = {$data['id']}
        ");

        $stmt->execute($prepareUpdate['filteredData']);

        return $stmt->rowCount() > 0 ? true : false;
    }
}