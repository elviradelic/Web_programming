<?php

require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/ReservationDao.php';
require_once __DIR__ . '/../dao/EventDao.php';

class ReservationService extends BaseService {
    private $eventDao;

    public function __construct() {
        parent::__construct(new ReservationDao());
        $this->eventDao = new EventDao();
    }

    public function add($data) {
        if (!isset($data['user_id']) || !is_numeric($data['user_id'])) {
            throw new Exception("Valid user ID is required.");
        }

        if (!isset($data['event_id']) || !is_numeric($data['event_id'])) {
            throw new Exception("Valid event ID is required.");
        }

        $event = $this->eventDao->getById($data['event_id']);
        if (!$event) {
            throw new Exception("Event does not exist.");
        }

        $existingReservations = $this->dao->getReservationsByUserId($data['user_id']);
        foreach ($existingReservations as $res) {
            $existingEvent = $this->eventDao->getById($res['event_id']);
            if ($existingEvent && $existingEvent['date'] === $event['date']) {
                throw new Exception("User already has a reservation on the same date.");
            }
        }

        $currentCount = $this->dao->countReservationsByEventId($data['event_id']);
        if (isset($event['max_participants']) && $currentCount >= $event['max_participants']) {
            throw new Exception("Event has reached the maximum number of participants.");
        }

        return parent::add($data);
    }

    public function update($id, $data) {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid reservation ID.");
        }

        if (!$this->dao->findById($id)) {
            throw new Exception("Reservation not found.");
        }

        return parent::update($id, $data);
    }
}
