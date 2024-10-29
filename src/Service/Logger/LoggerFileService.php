<?php

namespace Service\Logger;
use Throwable;

class LoggerFileService implements LoggerServiceInterface
{
    private string $logFile;

    public function __construct()
    {
        $this->logFile = __DIR__ . '/../../Storage/logs/errors.txt';
    }

    public function error(Throwable $exception): void
    {
        $errorMess = "Message: " . $exception->getMessage() . "\n";
        $errorMess .= "File: " . $exception->getFile() . "\n";
        $errorMess .= "Line: " . $exception->getLine() . "\n";
        $errorMess .= "Datetime: " . date("Y-m-d H:i:s") . "\n\n";
        file_put_contents($this->logFile, $errorMess, FILE_APPEND);
    }
}