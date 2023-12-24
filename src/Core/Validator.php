<?php

namespace App\Core;

class Validator 
{
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
}