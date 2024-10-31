<?php

namespace Service\Logger;
use Model\Logger;
use Throwable;

class LoggerDbService implements LoggerServiceInterface
{
    public function error(Throwable $exception): void
    {
        Logger::create($exception);
    }
}