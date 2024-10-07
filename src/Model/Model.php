<?php

namespace Model;
use PDO;
class Model
{
    protected PDO $pdo;

    public function __construct()
    {
        $db = getenv('DB_NAME');
        $user = getenv('DB_USER');
        $pass = getenv('DB_PASSWORD');

        $this->pdo = new PDO("pgsql:host=db;port=5432;dbname=$db", $user, $pass);

    }
}