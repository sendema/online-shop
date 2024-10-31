<?php

namespace Model;
use Throwable;

class Logger extends Model
{
    public static function create(Throwable $exception): void
    {
        $errorMess = $exception->getMessage();
        $file = $exception->getFile();
        $line = $exception->getLine();
        $datetime = date('Y-m-d H:i:s');

        $stmt = self::getPdo()->prepare('INSERT INTO logs (message, file, line, datetime) VALUES (:message, :file, :line, :datetime)');
        $stmt->execute(['message' => $errorMess, 'file' => $file, 'line' => $line, 'datetime' => $datetime]);
    }
}