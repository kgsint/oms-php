<?php

use App\Core\App;
use Dotenv\Dotenv;

require __DIR__ . "/constants.php";

require BASE_PATH . 'vendor/autoload.php';

// load .env
$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

// routes
$router = require BASE_PATH . 'src/routes.php';

// app instance
$app = new App($router);

return $app;