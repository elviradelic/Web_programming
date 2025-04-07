<?php
require_once __DIR__ . '/../config/database.php';

class EventDao {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getAllEvents() {
        $stmt = $this->conn->prepare("SELECT * FROM events");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEventById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM events WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createEvent($data) {
        $stmt = $this->conn->prepare("INSERT INTO events (title, description, date, location, category_id, created_by) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $data['title'],
            $data['description'],
            $data['date'],
            $data['location'],
            $data['category_id'],
            $data['created_by']
        ]);
    }

    public function updateEvent($id, $data) {
        $stmt = $this->conn->prepare("UPDATE events SET title = ?, description = ?, date = ?, location = ?, category_id = ? WHERE id = ?");
        return $stmt->execute([
            $data['title'],
            $data['description'],
            $data['date'],
            $data['location'],
            $data['category_id'],
            $id
        ]);
    }

    public function deleteEvent($id) {
        $stmt = $this->conn->prepare("DELETE FROM events WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
