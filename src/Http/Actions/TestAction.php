<?php
declare(strict_types=1);

namespace App\Http\Actions;

use Branch\Middleware\Action;
use Nyholm\Psr7\Stream;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;


class TestAction extends Action
{
    public function run(Request $request, Response $response, array $args): Response
    {
        return $response->withBody(Stream::create('test action response body'));
    }
}