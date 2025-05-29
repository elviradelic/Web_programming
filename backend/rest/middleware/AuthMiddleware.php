<?php

require_once __DIR__ . '/../config/config.php';
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

class AuthMiddleware {

    public function __construct() {}

    //  Autentifikacija – validacija tokena
    public function check_token() {
        $headers = getallheaders();

        if (!isset($headers['Authorization'])) {
            Flight::halt(401, 'Authorization token missing');
        }

        $token = str_replace('Bearer ', '', $headers['Authorization']);

        try {
            $decoded = JWT::decode($token, new Key(Config::JWT_SECRET(), 'HS256'));
            Flight::set('user', $decoded->user); // Spasi korisnika globalno
        } catch (Exception $e) {
            Flight::halt(401, 'Invalid token: ' . $e->getMessage());
        }
    }

    // Autorizacija – dozvoljena tačno jedna rola
    public function authorizeRole($requiredRole) {
        $user = Flight::get('user');
        if ($user->role !== $requiredRole) {
            Flight::halt(403, 'Access denied: insufficient privileges');
        }
    }

    // Autorizacija – više uloga (admin ili user)
    public function authorizeRoles($roles) {
        $user = Flight::get('user');
        if (!in_array($user->role, $roles)) {
            Flight::halt(403, 'Access denied: role not allowed');
        }
    }
}
