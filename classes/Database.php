<?php

class Database
{
    private static $instance = null; // Static variable to hold the singleton instance
    private $pdo;

    private function __construct()
    {
        $hostname = "localhost";
        $username = "root";
        $password = "";
        $dbname = "veterinary_record";

        try {
            $this->pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode to exceptions
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    // Get the singleton instance of the class or create a new one, preventing multiple instances
    public static function getInstance()
    {
        // If instance doesn't exist yet, create it
        if (self::$instance === null) {
            // self:: refers to the class itself instead of the object (instance of the class) like $this
            // It is used to call static methods and properties
            self::$instance = new Database();
        }

        // Return the existing instance
        return self::$instance;
    }

    // Return the PDO connection
    public function getConnection()
    {
        return $this->pdo;
    }
}
