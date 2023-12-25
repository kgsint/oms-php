<?php

use App\Core\Auth;
use App\Core\Session;
use App\Models\User;

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
    echo "</pre>";
}

// string to slug 
function convertToSlug(string $string, string $seperator = "-")
{
    // Convert string to lowercase
    $slug = strtolower($string);

    // Replace non-alphanumeric characters with $seperator
    $slug = preg_replace('/[^a-z0-9-]/', $seperator, $slug);

    // Remove multiple consecutive $seperator
    $slug = preg_replace('/-+/', $seperator, $slug);

    // Trim $seperator from start and end
    $slug = trim($slug, $seperator);

    return $slug;
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
    exit;
}

// show validation error
function error(string $key)
{
    return Session::error($key);
}

// repopulate old value from form request after validation
function old(string $key, mixed $value = '')
{
    return !Session::oldValue($key) ? $value : Session::oldValue($key);
}

// Auth class
function auth(): Auth
{
    return new Auth;
}

function check(): bool
{
    return auth()->check();
}

function user(): ?User
{
    return auth()->user();
}
// end Auth class