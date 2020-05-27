<?php
declare(strict_types=1);

use Branch\Env;

define('BRANCH_FRAMEWORK_START', microtime(true));
define('DS', DIRECTORY_SEPARATOR);

require __DIR__.'/../vendor/autoload.php';

$env = new Env(realpath(__DIR__ . '/../.env'));
$env = $env->get();

// Fallback handler in case of middleware not able to catch an error
set_exception_handler(new \App\Error\Handler($env));

$config = require __DIR__ . '/../config/config.php';
$di = require __DIR__ . '/../config/di.php';
$middleware = require __DIR__ . '/../config/middleware.php';
$routes = require __DIR__ . '/../routes/index.php';

$app = \Branch\App::getInstance();
$app->init([
    'env' => $env,
    'config' => $config,
    'di' => $di,
    'middleware' => $middleware,
    'routes' => $routes,
]);

// var_dump(get_included_files());
// var_dump(memory_get_usage());
// var_dump(get_declared_classes());