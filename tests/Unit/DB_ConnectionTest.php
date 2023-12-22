<?php

use App\Core\Database\Database;
use Dotenv\Dotenv;

beforeEach(function() {
    $dotenv = Dotenv::createImmutable(__DIR__ . "/../../");
    $dotenv->load();
});

it('connects MySQL database', function() {
    $db = new Database;

    expect($db->connect())
                            ->toBeInstanceOf(PDO::class);
});