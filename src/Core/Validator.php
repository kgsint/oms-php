<?php

namespace App\Core;

use App\Core\Database\Database;

class Validator 
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public static function required(mixed $input, $min = 1, $max = INF): bool
    {
        // trim
        $input = trim($input);

        if(empty($input) || strlen($input) < $min || strlen($input) > $max) {
            return true;
        }

        return false;
    }

    public static function email(string $input): bool
    {
        return filter_var($input, FILTER_VALIDATE_EMAIL);
    }

    public static function confirm(string $password, string $confirm): bool
    {   
        if($password === $confirm) {
            return true;
        }

        return false;
    }

    public static function exists(string $table, string $field, string $value)
    {
        $instance = new self;
        
        $row = $instance->db->findByField($field, $value, $table);

        return (bool )$row ?? false;
    }
}