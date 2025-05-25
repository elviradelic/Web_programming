<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/middleware/AuthMiddleware.php';

// 
Flight::route('GET /', function () {
    echo 'FlightPHP radi!';
});

Flight::set('auth_middleware', new AuthMiddleware());

// CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");


Flight::route('/*', function () {
    $path = Flight::request()->url;
    $method = Flight::request()->method;

    if (
        !in_array($path, ['/', '/login', '/register']) &&
        $method !== 'OPTIONS'
    ) {
        Flight::auth_middleware()->check_token();
    }
});

// Registracija servisa
Flight::register('authService', 'AuthService');
Flight::register('userService', 'UserService');
Flight::register('eventService', 'EventService');
Flight::register('categoryService', 'CategoryService');
Flight::register('feedbackService', 'FeedbackService');
Flight::register('reservationService', 'ReservationService');

// Rute
require_once __DIR__ . '/routes/userRoutes.php';
require_once __DIR__ . '/routes/eventRoutes.php';
require_once __DIR__ . '/routes/categoryRoutes.php';
require_once __DIR__ . '/routes/feedbackRoutes.php';
require_once __DIR__ . '/routes/reservationRoutes.php';
require_once __DIR__ . '/routes/AuthRoutes.php';

//  OPTIONS preflight
Flight::route('OPTIONS *', function () {
    Flight::halt(200);
});

Flight::start();
