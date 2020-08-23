<?php
declare(strict_types=1);

define('BRANCH_FRAMEWORK_START', microtime(true));
define('DS', DIRECTORY_SEPARATOR);

require __DIR__.'/../vendor/autoload.php';

$basePath = realpath(__DIR__ . '/../');

$app = \Branch\App::getInstance();
$app->init($basePath);

// var_dump(get_included_files());
// var_dump(memory_get_usage());
// var_dump(get_declared_classes());