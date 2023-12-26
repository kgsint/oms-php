<?php

use App\Core\App;

session_start();

/** @var App $app */
$app = require __DIR__ . "/../src/bootstrap.php";

$app->run();