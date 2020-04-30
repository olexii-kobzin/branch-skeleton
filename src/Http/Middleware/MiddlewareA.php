<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;

class MiddlewareA implements MiddlewareInterface
{

    public function __construct(string $param1, string $param2)
    {
        // var_dump($param1, $param2);
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        // var_dump(__CLASS__);
        
        $response =  $handler->handle($request);

        return $response;
    }
}