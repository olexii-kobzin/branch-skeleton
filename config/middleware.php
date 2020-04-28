<?php

use Branch\App;
use Branch\Middleware\ErrorMiddleware;
use Branch\Middleware\MethodValidationMiddleware;
use Psr\Http\Message\ResponseInterface;

return [
    ErrorMiddleware::class,
    MethodValidationMiddleware::class,
];