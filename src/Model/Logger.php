<?php

namespace Model;
use Throwable;

class Logger extends Model
{
    public static function error(Throwable $exception): void
    {
        $stmt = self::getPdo()->prepare('INSERT INTO error_logs (message, file, line, datetime) VALUES (:message, :file, :line, :datetime)');
        $stmt->execute([':message' => $exception->getMessage(), ':file' => $exception->getFile(), ':line' => $exception->getLine(), ':datetime' => date('Y-m-d H:i:s')]);
    }
}