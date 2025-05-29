<?php

require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/FeedbackDao.php';
require_once __DIR__ . '/../dao/ReservationDao.php';

class FeedbackService extends BaseService {
    private $reservationDao;

    public function __construct() {
        parent::__construct(new FeedbackDao());
        $this->reservationDao = new ReservationDao();
    }

    public function add($data) {
        if (empty($data['user_id']) || !is_numeric($data['user_id'])) {
            throw new Exception("Valid user ID is required.");
        }

        if (empty($data['event_id']) || !is_numeric($data['event_id'])) {
            throw new Exception("Valid event ID is required.");
        }

        if (empty($data['message']) || strlen($data['message']) < 5) {
            throw new Exception("Message must be at least 5 characters long.");
        }

        if (!$this->reservationDao->userHasReservationForEvent($data['user_id'], $data['event_id'])) {
            throw new Exception("User must attend the event to leave feedback.");
        }

        return parent::add($data);
    }

    public function update($id, $data) {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid feedback ID.");
        }

        if (isset($data['message']) && strlen($data['message']) < 5) {
            throw new Exception("Message must be at least 5 characters long.");
        }

        return parent::update($id, $data);
    }
}

