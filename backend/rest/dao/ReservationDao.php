<?php
require_once __DIR__ . '/../config/database.php';

class ReservationDao {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getAllReservations() {
        $stmt = $this->conn->prepare("SELECT * FROM reservations");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getReservationById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM reservations WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createReservation($data) {
        $stmt = $this->conn->prepare("INSERT INTO reservations (user_id, event_id, status, reservation_date) VALUES (?, ?, ?, ?)");
        return $stmt->execute([
            $data['user_id'],
            $data['event_id'],
            $data['status'],
            $data['reservation_date']
        ]);
    }

    public function updateReservation($id, $data) {
        $stmt = $this->conn->prepare("UPDATE reservations SET user_id = ?, event_id = ?, status = ?, reservation_date = ? WHERE id = ?");
        return $stmt->execute([
            $data['user_id'],
            $data['event_id'],
            $data['status'],
            $data['reservation_date'],
            $id
        ]);
    }

    public function deleteReservation($id) {
        $stmt = $this->conn->prepare("DELETE FROM reservations WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getReservationsByUserId($user_id) {
        $stmt = $this->conn->prepare("SELECT * FROM reservations WHERE user_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countReservationsByEventId($event_id) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) as total FROM reservations WHERE event_id = ?");
        $stmt->execute([$event_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    // NOVO: Provjeri da li korisnik ima rezervaciju za događaj
    public function userHasReservationForEvent($user_id, $event_id) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) as total FROM reservations WHERE user_id = ? AND event_id = ?");
        $stmt->execute([$user_id, $event_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] > 0;
    }
}
