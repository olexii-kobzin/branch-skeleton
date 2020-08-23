<?php

use Branch\App;
use Branch\Events\EventDispatcher;
use Branch\Events\ListenerProvider;
use Branch\Http\RequestFactory;
use Branch\Http\ResponseFactory;
use Branch\Interfaces\Events\ListenerProviderInterface;
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
use Psr\EventDispatcher\EventDispatcherInterface;

return [
    RequestFactoryInterface::class => [
        'definition' => RequestFactory::class,
        'singleton' => true,
        // 'args'=> [],
    ],
    ResponseFactoryInterface::class => [
        'definition' => ResponseFactory::class,
        'singleton' => true,
    ],
    RouteInvokerInterface::class => [
        'definition' => RouteInvoker::class,
        'singleton' => true,
    ],
    RouteConfigBuilderInterface::class => [
        'definition' => RouteConfigBuilder::class,
        'singleton' => true,
    ],
    RouterInterface::class => [
        'definition' => Router::class,
        'singleton' => true,
    ],
    ListenerProviderInterface::class => [
        'definition' => ListenerProvider::class,
        'singleton' => true,
    ],
    EventDispatcherInterface::class => [
        'definition' => EventDispatcher::class,
        'singleton' => true,
        'args' => [
            'provider' => ListenerProvider::class,
        ],
    ],
    ServerRequestInterface::class => function (App $app) {
        $factory = $app->get(RequestFactoryInterface::class);

        return $factory->create();
    },
    ResponseInterface::class => function (App $app) {
        $factory = $app->get(ResponseFactoryInterface::class);

        return $factory->create();
    },
    MiddlewarePipeInterface::class => MiddlewarePipe::class,
    MiddlewareHandlerInterface::class => MiddlewareHandler::class,
    EmitterInterface::class => SapiStreamEmitter::class,
    CallbackActionInterface::class => CallbackAction::class,
];