<?php 

namespace Library\Crud;

use Pericao\Orm\Models\Database;

class Crud extends Database
{
    //crud ficará responsavel por chamar outros metodos e classes que ficam na mesma pasta, por exemplo: Select, Insert, Delete. Dentro de cada classe
    //dessa, terá seus codigos sql para que funcione, relembrando que a entity chamará os arquivos dessa classe!!
}