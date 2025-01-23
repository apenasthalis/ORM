<?php 

namespace Pericao\Orm\Library\Crud;

use Pericao\Orm\Library\Crud\Crud;

class Update extends Crud
{
    public function update($data) 
    {
        $pdo = self::getConnection();
        
        $stmt = $this->pdo->prepare('
            UPDATE 
                users
            SET 
                name = ?
            WHERE 
                id = ?
        ');

        $stmt->execute([$data['name'], $id]);

        return $stmt->rowCount() > 0 ? true : false;
    }
}