<?php

use App\Core\Session;

// dump
function dd(mixed $value, $typeHint = false): void
{
    echo "<pre style='background-color: #111; color: white; padding:1em; line-height: 1.8;'>";
    if($typeHint) {
        var_dump($value);
    }else {
        print_r($value);
    }
    echo "</pre>";
    die;
}

// unix timestamp to datetime
function mysqlTimestampToDateTime(string $timestamp): DateTime
{
    return new DateTime($timestamp);
}

function isActiveNav(string $uri): string
{
    return parse_url($_SERVER['REQUEST_URI'])['path'] === $uri ? 'active' : '';
}

function redirect(string $uri, int $responseCode = 302): void
{
    header("Location:{$uri}", response_code: $responseCode);
}

// show validation error
function error(string $key)
{
    return Session::error($key);
}

// repopulate old value from form request after validation
function old(string $key)
{
    return Session::oldValue($key);
}