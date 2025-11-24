<?php


class DatabaseHelper {
    private static $instance = null;
    private $db;

    // Il costruttore non ha bisogno di parametri se li prende direttamente da Settings
    private function __construct()
    {
        // Importante: Assicurati che Settings sia già stata inclusa!
        $this->db = new mysqli(
            Settings::DB_SERVERNAME,
            Settings::DB_USERNAME,
            Settings::DB_PASSWORD,
            Settings::DB_DBNAME,
            Settings::DB_PORT
        );
        
        // Gestione degli errori tramite eccezione (molto meglio di die())
        if ($this->db->connect_error) {
            die("Connection Failed : " .$this->db->connect_error);
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            // Istanzia la classe senza passare parametri al costruttore
            self::$instance = new self(); 
        }
        return self::$instance;
    }
    
    public function getConnection(): mysqli
    {
        return $this->db;
    }



}