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
        $query = $librarySelect->select()
        ->from($schema, ['c' => $table])
        ->join('public', ['d' => 'docs'], 'c.ic = d.id_client')
        ->join('public', ['v' => 'vehicle'], 'c.id = v.id_client')
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