<?php
namespace App\Error;

use Branch\Interfaces\EnvInterface;

class Handler
{
    private array $env;

    public function __construct(array $env)
    {
        $this->env = $env;
    }

    public function __invoke(\Throwable $e): void
    {
        $eol = PHP_EOL;

        http_response_code(500);

        if ($this->env['APP_ENV'] === EnvInterface::ENV_DEV) {
            echo <<<RESPONSE
{$e->getMessage()} ({$e->getFile()}:{$e->getLine()}){$eol}
{$e->getTraceAsString()}
RESPONSE;  
        } else {
            echo <<<RESPONSE
{$e->getMessage()}
RESPONSE;  
        }
    }
}