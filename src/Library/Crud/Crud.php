<?php 

namespace Pericao\Orm\Library\Crud;

use Pericao\Orm\Library\Crud\Insert;
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
        $libraryInsert = new Insert();
        $insertOrId = $libraryInsert->Insert($data, $table, $columns);

        return $insertOrId;
    }

    public function update($data, $table, $columns)
    {
        $libraryUpdate = new Update();
        $libraryUpdate->update($data);
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