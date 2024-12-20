<?php 

namespace Pericao\Orm\Library\Crud;

use Pericao\Orm\Models\Database;

class Crud extends Database
{
    //crud ficará responsavel por chamar outros metodos e classes que ficam na mesma pasta, por exemplo: Select, Insert, Delete. Dentro de cada classe
    //dessa, terá seus codigos sql para que funcione, relembrando que a entity chamará os arquivos dessa classe!!
    protected $pdo;
    protected $librarySelect; 

    public function __construct()
    {
        $this->pdo = $this->getConnection();
        // $this->librarySelect = new Select();
    }

    public function select($table)
    {
        $librarySelect = new Select();
        return $librarySelect->selectAll($table);
    }

    public function insert()
    {
        
    }
    public function update()
    {
        
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