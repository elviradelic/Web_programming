<?php

require_once __DIR__ . '/../dao/UserDao.php';

class UserService {
    private $userDao;

    public function __construct() {
        $this->userDao = new UserDao();
    }

    public function getAllUsers() {
        return $this->userDao->getAllUsers();
    }

    public function getUserById($id) {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid user ID.");
        }

        $user = $this->userDao->getUserById($id);
        if (!$user) {
            throw new Exception("User not found.");
        }

        return $user;
    }

    public function createUser($data) {
        if (empty($data['full_name']) || strlen($data['full_name']) < 2) {
            throw new Exception("Full name must be at least 2 characters long.");
        }

        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format.");
        }

        if (empty($data['password']) || strlen($data['password']) < 6) {
            throw new Exception("Password must be at least 6 characters long.");
        }

        return $this->userDao->createUser($data);
    }

    public function updateUser($id, $data) {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid user ID.");
        }

        if (!$this->userDao->getUserById($id)) {
            throw new Exception("User not found.");
        }

        if (isset($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format.");
        }

        if (isset($data['password']) && strlen($data['password']) < 6) {
            throw new Exception("Password must be at least 6 characters long.");
        }

        return $this->userDao->updateUser($id, $data);
    }

    public function deleteUser($id) {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("Invalid user ID.");
        }

        if (!$this->userDao->getUserById($id)) {
            throw new Exception("User not found.");
        }

        return $this->userDao->deleteUser($id);
    }
}
