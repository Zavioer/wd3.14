<?php

require_once "config.php";

class Database {
    private $username;
    private $password;
    private $host;
    private $database;

    public function __construct()
    {
        $config = Config::getInstance();
        $this->username = $config->get('USERNAME');
        $this->password = $config->get('PASSWORD');
        $this->host = $config->get('HOST');
        $this->database = $config->get('DATABASE');
    }

    public function connect()
    {
        try {
            $conn = new PDO(
                "pgsql:host=$this->host;port=5432;dbname=$this->database",
                $this->username,
                $this->password,
                ["sslmode"  => "prefer"]
            );

            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }
        catch(PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}