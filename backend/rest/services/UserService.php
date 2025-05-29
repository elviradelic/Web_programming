<?php

require_once __DIR__ . '/BaseService.php';
require_once __DIR__ . '/../dao/UserDao.php';

class UserService extends BaseService {

    public function __construct() {
        parent::__construct(new UserDao());
    }

    public function add($data) {
        if (empty($data['full_name']) || strlen($data['full_name']) < 2) {
            throw new Exception("Full name must be at least 2 characters long.");
        }

        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format.");
        }

        if (empty($data['password']) || strlen($data['password']) < 6) {
            throw new Exception("Password must be at least 6 characters long.");
        }

        return parent::add($data);
    }

    public function update($id, $data) {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid user ID.");
        }

        $user = $this->dao->getById($id); 

        if (!$user) {
            throw new Exception("User not found.");
        }

        if (isset($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format.");
        }

        if (isset($data['password']) && strlen($data['password']) < 6) {
            throw new Exception("Password must be at least 6 characters long.");
        }

        return parent::update($id, $data);
    }
}
