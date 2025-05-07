<?php

require_once __DIR__ . '/../dao/EventDao.php';

class EventService {
    private $eventDao;

    public function __construct() {
        $this->eventDao = new EventDao();
    }

    public function getAllEvents() {
        return $this->eventDao->getAllEvents();
    }

    public function getEventById($id) {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid event ID.");
        }

        $event = $this->eventDao->getEventById($id);
        if (!$event) {
            throw new Exception("Event not found.");
        }

        return $event;
    }

    public function createEvent($data) {
        if (empty($data['name']) || strlen($data['name']) < 3) {
            throw new Exception("Event name must be at least 3 characters long.");
        }

        if (empty($data['description']) || strlen($data['description']) < 10) {
            throw new Exception("Event description must be at least 10 characters long.");
        }

        if (empty($data['location'])) {
            throw new Exception("Event location is required.");
        }

        if (empty($data['date']) || !strtotime($data['date'])) {
            throw new Exception("Valid event date is required.");
        }

        if (!isset($data['category_id']) || !is_numeric($data['category_id'])) {
            throw new Exception("Valid category ID is required.");
        }

        if (!isset($data['organizer_id']) || !is_numeric($data['organizer_id'])) {
            throw new Exception("Valid organizer ID is required.");
        }

        return $this->eventDao->createEvent($data);
    }

    public function updateEvent($id, $data) {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid event ID.");
        }

        if (!$this->eventDao->getEventById($id)) {
            throw new Exception("Event not found.");
        }

        if (isset($data['date']) && !strtotime($data['date'])) {
            throw new Exception("Invalid date format.");
        }

        return $this->eventDao->updateEvent($id, $data);
    }

    public function deleteEvent($id) {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid event ID.");
        }

        if (!$this->eventDao->getEventById($id)) {
            throw new Exception("Event not found.");
        }

        return $this->eventDao->deleteEvent($id);
    }
}

