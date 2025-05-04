<?php
require_once __DIR__ . '/../services/EventService.php';

Flight::route('GET /events', function () {
    $service = new EventService();
    Flight::json($service->get_all_events());
});

Flight::route('GET /events/@id', function ($id) {
    $service = new EventService();
    Flight::json($service->get_event_by_id($id));
});

Flight::route('POST /events', function () {
    $data = Flight::request()->data->getData();
    $service = new EventService();
    Flight::json($service->add_event($data));
});

Flight::route('PUT /events/@id', function ($id) {
    $data = Flight::request()->data->getData();
    $service = new EventService();
    Flight::json($service->update_event($id, $data));
});

Flight::route('DELETE /events/@id', function ($id) {
    $service = new EventService();
    Flight::json($service->delete_event($id));
});
