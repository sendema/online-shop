<?php

namespace Service\Logger;
use Throwable;

interface LoggerServiceInterface
{
    public function error(Throwable $exception);
}