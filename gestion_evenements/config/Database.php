<?php

class Database {
    private $host = "localhost";
    private $db_name = "gestion_evenements";
    private $username = "root";
    private $password = "";
    private $conn;

    public function __construct() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset=utf8";
            $this->conn = new PDO($dsn, $this->username, $this->password);

            // Options de PDO pour la sécurité
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Message d’erreur générique pour ne pas exposer les détails techniques
            die("Erreur de connexion à la base de données. Veuillez réessayer plus tard.");
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}
