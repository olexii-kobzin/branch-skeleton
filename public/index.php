<?php
declare(strict_types=1);

use Branch\Env;
use Branch\App;
use App\Http\Middleware\MiddlewareA;
use App\Http\Middleware\MiddlewareB;
use App\Http\Middleware\MiddlewareC;
use Branch\Interfaces\MiddlewarePipeInterface;
use Branch\Interfaces\RequestFactoryInterface;
use Branch\Interfaces\ResponseFactoryInterface;
use Psr\Http\Server\RequestHandlerInterface;

define('BRANCH_FRAMEWORK_START', microtime(true));

require __DIR__.'/../vendor/autoload.php';

$env = new Env();

define('ENV', $env->get());

$app = App::getInstance();
$app->init();

// TODO: remove after testing
// $pipe = container()->get(MiddlewarePipeInterface::class);
// $pipe->pipe(new MiddlewareA());
// $pipe->pipe(new MiddlewareC());
// $pipe->pipe(new MiddlewareB());

// $requestCreator = container()->get(RequestFactoryInterface::class);

// $pipe->process($requestCreator->create(), new class implements RequestHandlerInterface {
//     public function handle(\Psr\Http\Message\ServerRequestInterface $request): \Psr\Http\Message\ResponseInterface
//     {
//         var_dump('hello from handler');

//         return container()->get(ResponseFactoryInterface::class)->create();
//     }
// });