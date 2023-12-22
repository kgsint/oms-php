<?php

use App\Core\Test;
use App\Hello;

define('BASE_PATH', __DIR__ . '/../');

require BASE_PATH . 'vendor/autoload.php';


$test = new Test;
$hello = new Hello;

$test->test();
echo "<br />";
$hello->sayHello();