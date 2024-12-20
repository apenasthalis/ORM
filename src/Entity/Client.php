<?php

namespace Pericao\Orm\Entity;
use Pericao\Orm\Library\Crud\Crud;
use Pericao\Orm\Library\Crud\Select;

class Client extends Crud
{
    public function getAllClients($table)
    {
        $crud = new Crud();
        return $crud->select($table);
    }
}