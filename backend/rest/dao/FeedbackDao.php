<?php
require_once __DIR__ . '/../config/database.php';

class FeedbackDao {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getAllFeedbacks() {
        $stmt = $this->conn->prepare("SELECT * FROM feedback");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFeedbackById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM feedback WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createFeedback($data) {
        $stmt = $this->conn->prepare("INSERT INTO feedback (user_id, event_id, message, rating, created_at) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([
            $data['user_id'],
            $data['event_id'],
            $data['message'],
            $data['rating'],
            $data['created_at']
        ]);
    }

    public function updateFeedback($id, $data) {
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

    public function deleteFeedback($id) {
        $stmt = $this->conn->prepare("DELETE FROM feedback WHERE id = ?");
        return $stmt->execute([$id]);
    }
}

