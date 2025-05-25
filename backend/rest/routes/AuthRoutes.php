<?php

require_once __DIR__ . '/../services/AuthService.php';

// Registracija servisa
Flight::register('authService', 'AuthService');

// RUTA: Registracija korisnika
Flight::route('POST /register', function () {
    $data = Flight::request()->data->getData();
    $result = Flight::authService()->register($data);

    if ($result['success']) {
        Flight::json(['message' => 'User registered successfully']);
    } else {
        Flight::halt(500, $result['error']);
    }
});

// RUTA: Login korisnika
Flight::route('POST /login', function () {
    $data = Flight::request()->data->getData();
    $token = Flight::authService()->login($data['email'], $data['password']);

    if ($token) {
        Flight::json(['token' => $token]);
    } else {
        Flight::halt(401, "Invalid credentials");
    }
});

