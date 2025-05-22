<?php
require_once __DIR__ . '/../config/Database.php';

class EventModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function create($titre, $date, $description) {
        $sql = "INSERT INTO events (titre, date_evenement, description) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$titre, $date, $description]);
    }

    public function readAll() {
        $sql = "SELECT * FROM events ORDER BY date_evenement DESC";
        return $this->conn->query($sql)->fetchAll();
    }

    public function readById($id) {
        $sql = "SELECT * FROM events WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function update($id, $titre, $date, $description) {
        $sql = "UPDATE events SET titre = ?, date_evenement = ?, description = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$titre, $date, $description, $id]);
    }

    public function delete($id) {
        $sql = "DELETE FROM events WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function getAll() {
        $stmt = $this->conn->query("SELECT * FROM events ORDER BY date_evenement ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
