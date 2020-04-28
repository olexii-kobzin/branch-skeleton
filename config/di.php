<?php
use Branch\App;
use Branch\Http\RequestFactory;
use Branch\Http\ResponseFactory;
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

return [
    RequestFactoryInterface::class => [
        'class' => RequestFactory::class,
        'type' => App::DI_TYPE_SINGLETON,
        // 'args'=> [],
    ],
    ResponseFactoryInterface::class => [
        'class' => ResponseFactory::class,
        'type' => App::DI_TYPE_SINGLETON,
    ],
    ServerRequestInterface::class => function (App $app) {
        $factory = $app->get(RequestFactoryInterface::class);

        return $factory->create();
    },
    ResponseInterface::class => function (App $app) {
        $factory = $app->get(ResponseFactoryInterface::class);

        return $factory->create();
    },
    RouteInvokerInterface::class => [
        'class' => RouteInvoker::class,
        'type' => App::DI_TYPE_SINGLETON,
    ],
    RouterInterface::class => [
        'class' => Router::class,
        'type' => App::DI_TYPE_SINGLETON,
    ],
    MiddlewarePipeInterface::class => [
        'class' => MiddlewarePipe::class,
        'type' => App::DI_TYPE_TRANSIENT,
    ],
    MiddlewareHandlerInterface::class => [
        'class' => MiddlewareHandler::class,
        'type' => App::DI_TYPE_TRANSIENT,
    ],
    EmitterInterface::class => [
        'class' => SapiStreamEmitter::class,
        'type' => App::DI_TYPE_TRANSIENT,
    ],
    CallbackActionInterface::class => [
        'class' => CallbackAction::class,
        'type' => App::DI_TYPE_TRANSIENT,
    ],
];