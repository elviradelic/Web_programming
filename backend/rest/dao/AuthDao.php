<?php

require_once __DIR__ . '/BaseDao.php';

class AuthDao extends BaseDao {
    public function __construct() {
        parent::__construct("users");
    }

    public function get_user_by_email($email) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function add($user) {
        try {
            $stmt = $this->conn->prepare(
                "INSERT INTO users (full_name, email, password, role)
                 VALUES (:full_name, :email, :password, :role)"
            );

            $stmt->execute([
                ':full_name' => $user['full_name'],
                ':email' => $user['email'],
                ':password' => $user['password'],
                ':role' => $user['role']
            ]);

            return true;
        } catch (PDOException $e) {
            error_log(">>> AuthDao::add error: " . $e->getMessage());
            throw $e; // važno da AuthService može dalje obraditi grešku
        }
    }
}
