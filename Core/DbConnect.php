<?php

namespace App\Core;

use Exception;
use PDO;

class DbConnect
{
    const SERVER = 'localhost';
    const USER = 'root';
    const PASSWORD = '';
    const BASE = 'movie_theater';

    protected $connection;
    protected $request;

    public function __construct()
    {
        try {
            $this->connection = new PDO('mysql:host=' . self::SERVER . ';dbname=' . self::BASE, self::USER, self::PASSWORD);
            $this->connection->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES utf8");
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
}