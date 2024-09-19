<?php

class Model
{
    protected PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO("pgsql:host=db;port=5432;dbname=dbname", "dbuser", "dbpwd");

    }

    protected function getPdo(): PDO
    {
        return $this->pdo;
    }

}