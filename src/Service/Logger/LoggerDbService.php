<?php

namespace Service\Logger;
use Model\Model;
use Throwable;

class LoggerDbService extends Model implements LoggerServiceInterface
{
    public function error(Throwable $exception): void
    {
        $errorMess = $exception->getMessage();
        $file = $exception->getFile();
        $line = $exception->getLine();
        $datetime = date('Y-m-d H:i:s');

        $stmt = self::getPdo()->prepare('INSERT INTO errors (message, file, line, datetime) VALUES (:message, :file, :line, :datetime)');
        $stmt->execute(['message' => $errorMess, 'file' => $file, 'line' => $line, 'datetime' => $datetime]);
    }
}