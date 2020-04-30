<?php
declare(strict_types=1);

use App\Http\Actions\TestAction;
use App\Http\Middleware\MiddlewareA;
use App\Http\Middleware\MiddlewareB;
use App\Http\Middleware\MiddlewareC;
use Branch\Interfaces\Routing\RouterInterface as Router;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Nyholm\Psr7\Stream;

return function (Router $router) {
    $router->get(['path' => ''], function (Request $request, Response $response, array $args) {
        return $response->withBody(Stream::create('Root path'));
    });

    $router->post(['path' => 'action/:id/test'], TestAction::class);

    $router->group([
        // 'path' => '',
        'middleware' => [
            MiddlewareC::class,
            MiddlewareB::class,
        ]
    ], function (Router $router) {
        $router->group(['path' => 'about'], function (Router $router) {
            $router->get([
                'path' => 'author',
                'middleware' => [
                    MiddlewareA::class => [
                        'param1' => 'hello',
                        'param2' => 'world',
                    ],
                ],
            ], function (Request $requst, Response $response, array $args) {
                return $response->withBody(Stream::create("My name is Olexii Kobzin\n"));
            });
            $router->get(['path' => 'framework'], function (Request $request, Response $response, array $args) {
                return $response->withBody(Stream::create("This is a Branch framework\n"));
            });
        });

        $router->get(['path' => 'contacts2/test'], function (Request $request, Response $response, array $args) {
            return $response->withBody(Stream::create("Email: tasmanangel@gmail.com\n"));
        });
    });

    $router->get([
        'path' => 'contacts/:id/name/:name',
        'name' => 'contactsName',
        'middleware' => [
            MiddlewareC::class,
            MiddlewareB::class,
        ]
    ], function (Request $request, Response $response, array $args) {
        return $response->withBody(Stream::create("Email: tasmanangel@gmail.com\n"));
    });
};