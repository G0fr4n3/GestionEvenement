<?php
require_once __DIR__ . '/../config/Database.php';

class ParticipantModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function create($nom, $email) {
        $sql = "INSERT INTO participants (nom, email) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$nom, $email]);
    }

    public function readAll() {
        return $this->conn->query("SELECT * FROM participants")->fetchAll();
    }

    public function readById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM participants WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
