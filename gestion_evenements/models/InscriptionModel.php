<?php
require_once __DIR__ . '/../config/Database.php';

class InscriptionModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function create($event_id, $participant_id) {
        $sql = "INSERT INTO inscriptions (event_id, participant_id, date_inscription) VALUES (?, ?, NOW())";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$event_id, $participant_id]);
    }

    public function readAll() {
        $sql = "SELECT * FROM inscriptions ORDER BY date_inscription DESC";
        return $this->conn->query($sql)->fetchAll();
    }

    public function addInscription($event_id, $participant_id) {
        $stmt = $this->pdo->prepare("INSERT INTO inscriptions (event_id, participant_id, date_inscription) VALUES (?, ?, NOW())");
        return $stmt->execute([$event_id, $participant_id]);
    }

    
}
