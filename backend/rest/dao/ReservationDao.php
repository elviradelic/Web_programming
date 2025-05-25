<?php

require_once __DIR__ . '/BaseDao.php';

class ReservationDao extends BaseDao {
    public function __construct() {
        parent::__construct("reservations");
    }

    // Dohvati sve rezervacije za korisnika
    public function getReservationsByUserId($user_id) {
        $stmt = $this->conn->prepare("SELECT * FROM reservations WHERE user_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Prebroj sve rezervacije za određeni događaj
    public function countReservationsByEventId($event_id) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) as total FROM reservations WHERE event_id = ?");
        $stmt->execute([$event_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    // Provjeri da li korisnik ima rezervaciju za događaj
    public function userHasReservationForEvent($user_id, $event_id) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) as total FROM reservations WHERE user_id = ? AND event_id = ?");
        $stmt->execute([$user_id, $event_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] > 0;
    }
}
