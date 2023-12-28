<?php

define('BASE_PATH', __DIR__ . '/../');
define('APP_PATH', __DIR__ . '/');
define('VIEW_PATH', BASE_PATH . '/src/views/');

// roles / account type
define('USER', 1);
define('ADMIN', 2);
define('MANAGER', 3);

// order status 
define('STATUS_PENDING', 1);
define('STATUS_SHIPPED', 2);
define('STATUS_DELIVERED', 3);
define('STATUS_CANCELLED', 4);