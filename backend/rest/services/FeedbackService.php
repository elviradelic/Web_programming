<?php

require_once __DIR__ . '/../dao/FeedbackDao.php';
require_once __DIR__ . '/../dao/ReservationDao.php';

class FeedbackService {
    private $feedbackDao;
    private $reservationDao;

    public function __construct() {
        $this->feedbackDao = new FeedbackDao();
        $this->reservationDao = new ReservationDao();
    }

    public function getAllFeedbacks() {
        return $this->feedbackDao->getAllFeedbacks();
    }

    public function getFeedbackById($id) {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid feedback ID.");
        }

        $feedback = $this->feedbackDao->getFeedbackById($id);
        if (!$feedback) {
            throw new Exception("Feedback not found.");
        }

        return $feedback;
    }

    public function createFeedback($data) {
        if (empty($data['user_id']) || !is_numeric($data['user_id'])) {
            throw new Exception("Valid user ID is required.");
        }

        if (empty($data['event_id']) || !is_numeric($data['event_id'])) {
            throw new Exception("Valid event ID is required.");
        }

        if (empty($data['message']) || strlen($data['message']) < 5) {
            throw new Exception("Message must be at least 5 characters long.");
        }

        // Provjera da li korisnik ima rezervaciju za događaj
        if (!$this->reservationDao->userHasReservationForEvent($data['user_id'], $data['event_id'])) {
            throw new Exception("User must attend the event to leave feedback.");
        }

        return $this->feedbackDao->createFeedback($data);
    }

    public function updateFeedback($id, $data) {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid feedback ID.");
        }

        if (!$this->feedbackDao->getFeedbackById($id)) {
            throw new Exception("Feedback not found.");
        }

        if (isset($data['message']) && strlen($data['message']) < 5) {
            throw new Exception("Message must be at least 5 characters long.");
        }

        return $this->feedbackDao->updateFeedback($id, $data);
    }

    public function deleteFeedback($id) {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid feedback ID.");
        }

        if (!$this->feedbackDao->getFeedbackById($id)) {
            throw new Exception("Feedback not found.");
        }

        return $this->feedbackDao->deleteFeedback($id);
    }
}
