<?php

namespace Pericao\Orm\Entity;

use PDO;
use Pericao\Orm\Models\Database;

abstract class ORM {

    abstract public function getColumns():array;
}
