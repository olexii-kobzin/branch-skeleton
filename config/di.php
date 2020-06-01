<?php

use Branch\Events\Repository;
use Branch\Interfaces\Container\ContainerInterface;
use Branch\Http\RequestFactory;
use Branch\Http\ResponseFactory;
use Branch\Interfaces\Events\RepositoryInterface;
use Branch\Interfaces\Middleware\MiddlewareHandlerInterface;
use Branch\Interfaces\Middleware\MiddlewarePipeInterface;
use Branch\Interfaces\Http\RequestFactoryInterface;
use Branch\Interfaces\Http\ResponseFactoryInterface;
use Branch\Interfaces\Middleware\CallbackActionInterface;
use Branch\Interfaces\Routing\RouteInvokerInterface;
use Branch\Interfaces\Routing\RouterInterface;
use Branch\Middleware\CallbackAction;
use Branch\Middleware\MiddlewareHandler;
use Branch\Middleware\MiddlewarePipe;
use Branch\Routing\RouteInvoker;
use Branch\Routing\Router;
use Laminas\HttpHandlerRunner\Emitter\EmitterInterface;
use Laminas\HttpHandlerRunner\Emitter\SapiStreamEmitter;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Branch\Interfaces\Routing\RouteConfigBuilderInterface;
use Branch\Routing\RouteConfigBuilder;

return [
    RepositoryInterface::class => [
        'class' => Repository::class,
        'singleton' => true,
    ],
    RequestFactoryInterface::class => [
        'class' => RequestFactory::class,
        'singleton' => true,
        // 'args'=> [],
    ],
    ResponseFactoryInterface::class => [
        'class' => ResponseFactory::class,
        'singleton' => true,
    ],
    ServerRequestInterface::class => function (ContainerInterface $container) {
        $factory = $container->get(RequestFactoryInterface::class);

        return $factory->create();
    },
    ResponseInterface::class => function (ContainerInterface $container) {
        $factory = $container->get(ResponseFactoryInterface::class);

        return $factory->create();
    },
    RouteInvokerInterface::class => [
        'class' => RouteInvoker::class,
        'singleton' => true,
    ],
    RouteConfigBuilderInterface::class => [
        'class' => RouteConfigBuilder::class,
        'singleton' => true,
    ],
    RouterInterface::class => [
        'class' => Router::class,
        'singleton' => true,
    ],
    MiddlewarePipeInterface::class => [
        'class' => MiddlewarePipe::class,
        'singleton' => false,
    ],
    MiddlewareHandlerInterface::class => [
        'class' => MiddlewareHandler::class,
        'singleton' => false,
    ],
    EmitterInterface::class => [
        'class' => SapiStreamEmitter::class,
        'singleton' => false,
    ],
    CallbackActionInterface::class => [
        'class' => CallbackAction::class,
        'singleton' => false,
    ],
];