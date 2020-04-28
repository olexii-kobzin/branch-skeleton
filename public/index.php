<?php
declare(strict_types=1);

use Branch\Env;
use Branch\App;
use App\Error\Handler;

define('BRANCH_FRAMEWORK_START', microtime(true));

require __DIR__.'/../vendor/autoload.php';

$env = new Env();

define('ENV', $env->get());
// Fallback handler in case of middleware not able to catch an error
set_exception_handler(new Handler());

$configFolder = realpath('../config');
$routesFolder = realpath('../routes');

$app = App::getInstance();
$app->init($configFolder, $routesFolder);

// var_dump(get_included_files());
// var_dump(memory_get_usage());
// var_dump(get_declared_classes());