<?php
declare(strict_types=1);

use App\Http\Middleware\MiddlewareA;
use App\Http\Middleware\MiddlewareB;
use App\Http\Middleware\MiddlewareC;
use Branch\Interfaces\Routing\RouterInterface as Router;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

return function (Router $router) {
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
                    MiddlewareA::class => [
                        'parameters' => [
                            'param1' => 'hello',
                            'param2' => 'world',
                        ],
                    ], 
                ],
            ], function (Request $requst) {
                echo "My name is Olexii Kobzin\n";
            });
            $router->get(['path' => 'framework'], function (Request $request) {
                echo "This is a Branch framework\n";
            });
        });

        $router->get(['path' => 'contacts2/test'], function (Request $request) {
            echo "Email: tasmanangel@gmail.com\n";
        });
    });

    $router->get([
        'path' => 'contacts',
        'middleware' => [
            MiddlewareC::class,
        ]
    ], function (Request $request) {
        echo "Email: tasmanangel@gmail.com\n";
    });
};