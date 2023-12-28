<?php

namespace App\Core;

class Session 
{
    public static function error(string $key): string
    {
        return $_SESSION['_flash']['errors'][$key] ?? '';
    }

    public static function oldValue(string $key): string|array
    {
        return $_SESSION['_flash']['old'][$key] ?? '';
    }

    public static function flush()
    {
        if(isset($_SESSION['_flash'])) {
            unset($_SESSION['_flash']);
        }
    }
}