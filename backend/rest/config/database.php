<?php

require_once __DIR__ . '/config.php';

class Database {
    private static $instance = null;
    private $connection;

    private function __construct() {
        $host = Config::DB_HOST();
        $port = Config::DB_PORT();
        $db_name = Config::DB_NAME();
        $username = Config::DB_USER();
        $password = Config::DB_PASSWORD();

        try {
            $dsn = "mysql:host=$host;port=$port;dbname=$db_name;charset=utf8mb4";
            $this->connection = new PDO($dsn, $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}
