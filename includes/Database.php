<?php
class Database {
    private static $instance = null;
    private $connection;
    private $host = "153.92.15.64";
    private $username = "u105852244_administrator3";
    private $password = "H@rn1c5h0p#@!2025";
    private $database = "u105852244_harnicproducts";

    private function __construct() {
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);
        
        if ($this->connection->connect_error) {
            throw new Exception("Connection failed: " . $this->connection->connect_error);
        }

        // Set connection timeout and other optimizations
        $this->connection->options(MYSQLI_OPT_CONNECT_TIMEOUT, 10);
        $this->connection->set_charset('utf8mb4');
        
        // Enable connection keep-alive
        $this->connection->query("SET SESSION wait_timeout=600"); // 10 minutes
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        // Check if connection is still alive
        if (!$this->connection->ping()) {
            // Reconnect if connection is lost
            $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);
        }
        return $this->connection;
    }

    public function query($sql) {
        return $this->connection->query($sql);
    }

    public function escape($value) {
        return $this->connection->real_escape_string($value);
    }

    public function prepare($query) {
        return $this->connection->prepare($query);
    }

    public function fetchRow($query) {
        $result = $this->query($query);
        return $result ? $result->fetch_assoc() : null;
    }

    public function __destruct() {
        if ($this->connection) {
            $this->connection->close();
        }
    }

    // Prevent cloning of the instance
    private function __clone() {}

    // Prevent unserializing of the instance
    private function __wakeup() {}
}
