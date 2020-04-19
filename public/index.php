<?php
declare(strict_types=1);

use Branch\Env;
use Branch\App;
use Branch\Error\Handler;

define('BRANCH_FRAMEWORK_START', microtime(true));

require __DIR__.'/../vendor/autoload.php';

$env = new Env();

define('ENV', $env->get());

// Fallback handler in case of middleware not able to catch an error
set_exception_handler(new Handler());

$app = App::getInstance();
$app->init();