<?php

namespace Pericao\Orm\Entity;
use Pericao\Orm\Library\Crud\Crud;
use Pericao\Orm\Library\Crud\Select;

class Client
{
    // public function __construct(){}
    public function getAllClients($schema ,$table)
    {
        $librarySelect = new Select();
        $query = $librarySelect->select(['id', 'name'])
        ->from($schema, ['c' => $table])
        ->join('public', ['d' => 'docs'], '')
        ->get();

        return $query;
    }

    public function getClientById($id ,$table)
    {
        $librarySelect = new Select();
        $query = $librarySelect->select($table)
        ->where("id = $id")
        ->get();
        
        return $query;
    }

    public function getClientAndCpf($id ,$table)
    {
        $librarySelect = new Select();
        $query = $librarySelect->select( $table)
        ->where("id = $id")
        ->get();
        
        return $query;
    }
}