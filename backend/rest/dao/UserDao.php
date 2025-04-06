<?php

require_once __DIR__ . '/../config/database.php';

class UserDao {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getAllUsers() {
        $stmt = $this->conn->prepare("SELECT * FROM users");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createUser($full_name, $email, $password, $role) {
        $stmt = $this->conn->prepare("INSERT INTO users (full_name, email, password, role) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$full_name, $email, $password, $role]);
    }

    public function updateUser($id, $full_name, $email, $password, $role) {
        $stmt = $this->conn->prepare("UPDATE users SET full_name = ?, email = ?, password = ?, role = ? WHERE id = ?");
        return $stmt->execute([$full_name, $email, $password, $role, $id]);
    }

    public function deleteUser($id) {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
