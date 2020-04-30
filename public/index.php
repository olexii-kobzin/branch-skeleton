<?php
declare(strict_types=1);

define('BRANCH_FRAMEWORK_START', microtime(true));
define('DS', DIRECTORY_SEPARATOR);

require __DIR__.'/../vendor/autoload.php';

$env = new \Branch\Env();
define('ENV', $env->get());
// Fallback handler in case of middleware not able to catch an error
set_exception_handler(new \App\Error\Handler());

$configFolder = realpath('../config');
$routesFolder = realpath('../routes');

$app = \Branch\App::getInstance();
$app->init($configFolder, $routesFolder);

// var_dump(get_included_files());
// var_dump(memory_get_usage());
// var_dump(get_declared_classes());