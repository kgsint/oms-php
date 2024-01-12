<?php 

namespace App\Core\Database;

use App\Contracts\DataOperationsInterface;
use App\Core\Database\Traits\WithMySqlOperations;

class MySQL extends Database implements DataOperationsInterface
{
    use WithMySqlOperations;
}