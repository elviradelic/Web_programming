<?php

Flight::route('GET /reservations', function () {
    Flight::json(Flight::reservationService()->get_all());
});

Flight::route('GET /reservations/@id', function ($id) {
    Flight::json(Flight::reservationService()->get_by_id($id));
});

Flight::route('POST /reservations', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::reservationService()->add($data));
});

Flight::route('PUT /reservations/@id', function ($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::reservationService()->update($id, $data));
});

Flight::route('DELETE /reservations/@id', function ($id) {
    Flight::json(Flight::reservationService()->delete($id));
});
