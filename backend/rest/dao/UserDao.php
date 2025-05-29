<?php

require_once __DIR__ . '/BaseDao.php';

class UserDao extends BaseDao {
    public function __construct() {
        parent::__construct("users");
    }

    //  imala metode  specifične za korisnike (npr. login ili dohvat po emailu)
}
