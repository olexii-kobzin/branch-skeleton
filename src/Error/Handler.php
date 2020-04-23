<?php
namespace App\Error;

use Branch\Interfaces\EnvInterface;
use Branch\Helpers\ErrorHelper;
use Throwable;

class Handler
{
    public function __invoke(Throwable $e)
    {
        $eol = PHP_EOL;

        http_response_code(ErrorHelper::getHttpCode($e));

        if (ENV['APP_ENV'] === EnvInterface::ENV_DEV) {
            echo <<<RESPONSE
{$e->getCode()} {$e->getMessage()} ({$e->getFile()}:{$e->getLine()}){$eol}
{$e->getTraceAsString()}
RESPONSE;  
        } else {
            echo <<<RESPONSE
{$e->getCode()} {$e->getMessage()}
RESPONSE;  
        }
    }
}