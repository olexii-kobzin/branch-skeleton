<?php
declare(strict_types=1);

use App\Http\Actions\TestAction;
use App\Http\Middleware\MiddlewareA;
use App\Http\Middleware\MiddlewareB;
use App\Http\Middleware\MiddlewareC;
use Branch\Interfaces\Routing\RouterInterface as Router;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

return function (Router $router) {
    $router->get(['path' => ''], function (Request $request, Response $response) {
        echo 'Root path';
    });

    $router->post(['path' => 'action/:id/test'], TestAction::class);

    $router->group([
        'path' => 'info',
        'middleware' => [
            MiddlewareC::class,
            MiddlewareB::class,
        ]
    ], function (Router $router) {
        $router->group(['path' => 'about'], function (Router $router) {
            $router->get([
                'path' => 'author',
                'middleware' => [
                    [
                        'class' => MiddlewareA::class,
                        'args' => [
                            'param1' => 'hello',
                            'param2' => 'world',
                        ],
                    ], 
                ],
            ], function (Request $requst, Response $response) {
                echo "My name is Olexii Kobzin\n";
            });
            $router->get(['path' => 'framework'], function (Request $request, Response $response) {
                echo "This is a Branch framework\n";
            });
        });

        $router->get(['path' => 'contacts2/test'], function (Request $request, Response $response) {
            echo "Email: tasmanangel@gmail.com\n";
        });
    });

    $router->get([
        'path' => 'contacts/:id/name/:name',
        'middleware' => [
            MiddlewareC::class,
            MiddlewareB::class,
        ]
    ], function (Request $request, Response $response, array $args) {
        var_dump($args);
        echo "Email: tasmanangel@gmail.com\n";
    });
};