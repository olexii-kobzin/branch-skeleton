<?php

use Branch\Middleware\ErrorMiddleware;
use Branch\Middleware\MethodValidationMiddleware;

return fn(array $env, array $config): array =>
    [
        ErrorMiddleware::class,
        MethodValidationMiddleware::class,
    ];