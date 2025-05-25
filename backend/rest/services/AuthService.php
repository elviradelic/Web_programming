<?php

require_once __DIR__ . '/../dao/AuthDao.php';
require_once __DIR__ . '/../config/config.php';
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

class AuthService {
    private $dao;

    public function __construct() {
        $this->dao = new AuthDao();
    }

    public function login($email, $password) {
        $user = $this->dao->get_user_by_email($email);

        if (!$user || !password_verify($password, $user['password'])) {
            return null;
        }

        unset($user['password']);

        $payload = [
            'user' => $user,
            'iat' => time(),
            'exp' => time() + (60 * 60 * 24), // token važi 1 dan
            'role' => $user['role']
        ];

        return JWT::encode($payload, Config::JWT_SECRET(), 'HS256');
    }

    public function register($user) {
        try {
            // Loguj primljene podatke
            error_log(">>> REGISTRATION INPUT:");
            error_log(print_r($user, true));

            // Hashuj lozinku
            $user['password'] = password_hash($user['password'], PASSWORD_BCRYPT);

            // Pokušaj insert
            $success = $this->dao->add($user);

            if (!$success) {
                error_log(">>> ERROR: Insert failed in DAO layer.");
                return ['success' => false, 'error' => 'Insertion failed'];
            }

            return ['success' => true];
        } catch (Exception $e) {
            error_log(">>> REGISTRATION EXCEPTION: " . $e->getMessage());
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function decode_token($token) {
        return JWT::decode($token, new Key(Config::JWT_SECRET(), 'HS256'));
    }
}
