<?php
namespace App\Error;

use Branch\Interfaces\EnvInterface;
use Throwable;

class Handler
{
    public function __invoke(Throwable $e)
    {
        $eol = PHP_EOL;
        $codeInt = is_integer($e->getCode()) ? $e->getCode() : 500;

        http_response_code($codeInt);

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