<?php

use Branch\App;
use Branch\Middleware\ErrorMiddleware;
use Branch\Middleware\MethodValidationMiddleware;
 
return fn(array  $env, array $settings): array =>
    [
        ErrorMiddleware::class,
        MethodValidationMiddleware::class,
    ];