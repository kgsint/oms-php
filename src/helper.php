<?php 

function dd(mixed $value)
{
    echo "<pre style='background-color: #111; color: white; padding:1em;'>";
    var_dump($value);
    echo "</pre>";
    die;
}

function mysqlTimestampToDateTime(string $timestamp): DateTime
{
    return new DateTime($timestamp);
}