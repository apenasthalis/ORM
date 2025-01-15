<?php 

namespace Pericao\Orm\Library\Crud;

use Pericao\Orm\Models\Database;
use Pericao\Orm\Library\Crud\Select;

class Crud extends Database
{
    //crud ficará responsavel por chamar outros metodos e classes que ficam na mesma pasta, por exemplo: Select, Insert, Delete. Dentro de cada classe
    //dessa, terá seus codigos sql para que funcione, relembrando que a entity chamará os arquivos dessa classe!!
    protected $pdo;
    protected $librarySelect; 

    public function __construct()
    {
        $this->pdo = $this->getConnection();
    }

    public function select(string $table): mixed
    {
        $librarySelect = new Select();
        $query = $librarySelect->select( $table)
        ->get();

        return $query;
    }

    public function insert($data, $table, $columns)
    {
        $pdo = self::getConnection();
        $i = 0;
        foreach ($data as $key => $colunas) {
            
            if (in_array($key, $columns)) {
                $i++;
               $finalData[$i] = $key;
            }
        }

        $stmt = $pdo->prepare("
            INSERT 
            INTO 
                {$table} ()
            VALUES
                (?, ?, ?)
        ");

        $stmt->execute([
            $data['name'],
            $data['email'],
            $data['password'],
        ]);

        return $pdo->lastInsertId() > 0 ? true : false;
    }
    public function update()
    {
        $librarySelect = new Select();
        $librarySelect->select(table:'table');
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

    public function get()
    {
        
    }
}