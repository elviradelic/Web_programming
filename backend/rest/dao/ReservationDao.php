<?php
require_once __DIR__ . '/../config/database.php';

class ReservationDao {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM reservations");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM reservations WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($data) {
        $stmt = $this->conn->prepare("INSERT INTO reservations (user_id, event_id, status, reservation_date) VALUES (?, ?, ?, ?)");
        return $stmt->execute([
            $data['user_id'],
            $data['event_id'],
            $data['status'],
            $data['reservation_date']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->conn->prepare("UPDATE reservations SET user_id = ?, event_id = ?, status = ?, reservation_date = ? WHERE id = ?");
        return $stmt->execute([
            $data['user_id'],
            $data['event_id'],
            $data['status'],
            $data['reservation_date'],
            $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM reservations WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
