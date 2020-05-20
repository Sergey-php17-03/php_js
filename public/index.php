<?php

require_once dirname(__DIR__) .  '/vendor/autoload.php';

use App\components\Router;

$router = new Router();
$router->run();
