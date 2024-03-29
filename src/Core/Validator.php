<?php

namespace App\Core;

use App\Core\Database\Database;

class Validator 
{
    /**
     * $db object might change according to database connection|driver (pgsql, sqlite)
     * doc block to autocomple methods
     * @var MySQL $db
    */
    private Database $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }
    public static function required(mixed $input, $min = 1, $max = INF): bool
    {
        // string
        if(is_string($input)) {
            // string
            $input = trim($input);

            if(empty($input) || strlen($input) < $min || strlen($input) > $max) {
                return true;
            }
        }

        // array
        if(is_array($input)) {
            if(count($input) === 0 || count($input) < $min || count($input) > $max) {
                return true;
            }
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

    public static function exists(string $table, string $field, string $value, ?int $except = null): bool
    {
        $instance = new self;

        $row = $instance->db->findByField($field, $value, $table);

        // if there is id to exclude for updating record
        if($except && $row->id === (int) $except) {
            return false;
        }

        return (bool)$row ?? false;
    }
}