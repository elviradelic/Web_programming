<?php
require_once __DIR__ . '/../services/UserService.php';

Flight::route('GET /users', function () {
    $service = new UserService();
    Flight::json($service->get_all_users());
});

Flight::route('GET /users/@id', function ($id) {
    $service = new UserService();
    Flight::json($service->get_user_by_id($id));
});

Flight::route('POST /users', function () {
    $data = Flight::request()->data->getData();
    $service = new UserService();
    Flight::json($service->add_user($data));
});

Flight::route('PUT /users/@id', function ($id) {
    $data = Flight::request()->data->getData();
    $service = new UserService();
    Flight::json($service->update_user($id, $data));
});

Flight::route('DELETE /users/@id', function ($id) {
    $service = new UserService();
    Flight::json($service->delete_user($id));
});
