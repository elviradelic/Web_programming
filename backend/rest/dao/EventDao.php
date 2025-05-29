<?php

require_once __DIR__ . '/BaseDao.php';

class EventDao extends BaseDao {
    public function __construct() {
        parent::__construct("events");
    }

    // napredne metode za specifične SELECT JOIN upite 
}
