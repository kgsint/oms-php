<?php

use Dotenv\Dotenv;
use App\Core\Database\MySQL;

beforeEach(function() {
    $dotenv = Dotenv::createImmutable(__DIR__ . "/../../");
    $dotenv->load();
});

it('connects MySQL database', function() {
    $db = new MySQL;

    expect($db->connect())
                            ->toBeInstanceOf(PDO::class);
});