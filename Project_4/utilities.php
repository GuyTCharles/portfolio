<?php
// Author: Guy Charles
// Written on: 08-16-2024
// Project Name: Bug Report Web Page
// Description: A utility class for database connection and input sanitization using config.php.

// Include the config.php file
require_once 'config.php'; 

class Database {
    private $conn;
    private $hostname;
    private $username;
    private $password;
    private $dbname;
    private $socket;

    public function __construct() {
        // Use constants from config.php
        $this->hostname = DB_HOSTNAME;
        $this->username = DB_USERNAME;
        $this->password = DB_PASSWORD;
        $this->dbname = DB_NAME;
        $this->socket = DB_SOCKET;

        // Create connection using object-oriented style
        $this->conn = new mysqli($this->hostname, $this->username, $this->password, $this->dbname, null, $this->socket);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error . " - Error No: " . $this->conn->connect_errno);
        }

        // Set database encoding
        if (!$this->conn->set_charset('utf8')) {
            die("There was a problem setting the charset.");
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function sanitizeInput($data) {
        return htmlspecialchars(strip_tags(trim($data)));
    }

    public function closeConnection() {
        $this->conn->close();
    }
}