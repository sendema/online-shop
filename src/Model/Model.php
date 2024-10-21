<?php

namespace Model;
use PDO;
class Model
{
    protected static PDO $pdo;
    public static function getPdo()
    {
        if (!isset(self::$pdo)){
            $db = getenv('DB_NAME');
            $user = getenv('DB_USER');
            $pass = getenv('DB_PASSWORD');
            self::$pdo = new PDO("pgsql:host=db;port=5432;dbname=$db", $user, $pass);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$pdo;
    }
    public function beginTransaction()
    {
        self::getPdo()->beginTransaction();
    }
    public function commit()
    {
        self::getPdo()->commit();
    }
    public function rollBack()
    {
        self::getPdo()->rollBack();
    }
}