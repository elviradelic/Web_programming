<?php

require_once __DIR__ . '/../dao/ReservationDao.php';
require_once __DIR__ . '/../dao/EventDao.php';

class ReservationService {
    private $reservationDao;
    private $eventDao;

    public function __construct() {
        $this->reservationDao = new ReservationDao();
        $this->eventDao = new EventDao();
    }

    public function getAllReservations() {
        return $this->reservationDao->getAllReservations();
    }

    public function getReservationById($id) {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid reservation ID.");
        }

        $reservation = $this->reservationDao->getReservationById($id);
        if (!$reservation) {
            throw new Exception("Reservation not found.");
        }

        return $reservation;
    }

    public function createReservation($data) {
        // Validacija korisnika i događaja
        if (!isset($data['user_id']) || !is_numeric($data['user_id'])) {
            throw new Exception("Valid user ID is required.");
        }

        if (!isset($data['event_id']) || !is_numeric($data['event_id'])) {
            throw new Exception("Valid event ID is required.");
        }

        $event = $this->eventDao->getEventById($data['event_id']);
        if (!$event) {
            throw new Exception("Event does not exist.");
        }

        // ✅ Provjera da korisnik već nema rezervaciju za drugi event na isti datum
        $userReservations = $this->reservationDao->getReservationsByUserId($data['user_id']);
        foreach ($userReservations as $res) {
            $reservedEvent = $this->eventDao->getEventById($res['event_id']);
            if ($reservedEvent && $reservedEvent['date'] === $event['date']) {
                throw new Exception("User already has a reservation on the same date.");
            }
        }

        // ✅ Provjera da broj rezervacija ne prelazi maksimalan broj učesnika
        $currentCount = $this->reservationDao->countReservationsByEventId($data['event_id']);
        if (isset($event['max_participants']) && $currentCount >= $event['max_participants']) {
            throw new Exception("Event has reached the maximum number of participants.");
        }

        // ✅ Rezervacija je validna
        return $this->reservationDao->createReservation($data);
    }

    public function updateReservation($id, $data) {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid reservation ID.");
        }

        if (!$this->reservationDao->getReservationById($id)) {
            throw new Exception("Reservation not found.");
        }

        return $this->reservationDao->updateReservation($id, $data);
    }

    public function deleteReservation($id) {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid reservation ID.");
        }

        if (!$this->reservationDao->getReservationById($id)) {
            throw new Exception("Reservation not found.");
        }

        return $this->reservationDao->deleteReservation($id);
    }
}



