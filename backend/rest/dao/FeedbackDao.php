<?php
require_once __DIR__ . '/../config/database.php';

class FeedbackDao {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM feedback");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM feedback WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($data) {
        $stmt = $this->conn->prepare("INSERT INTO feedback (user_id, event_id, message, rating, created_at) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([
            $data['user_id'],
            $data['event_id'],
            $data['message'],
            $data['rating'],
            $data['created_at']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->conn->prepare("UPDATE feedback SET user_id = ?, event_id = ?, message = ?, rating = ?, created_at = ? WHERE id = ?");
        return $stmt->execute([
            $data['user_id'],
            $data['event_id'],
            $data['message'],
            $data['rating'],
            $data['created_at'],
            $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM feedback WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
