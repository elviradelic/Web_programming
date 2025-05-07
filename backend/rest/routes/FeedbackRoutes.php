<?php

Flight::route('GET /feedbacks', function () {
    Flight::json(Flight::feedbackService()->get_all());
});

Flight::route('GET /feedbacks/@id', function ($id) {
    Flight::json(Flight::feedbackService()->get_by_id($id));
});

Flight::route('POST /feedbacks', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::feedbackService()->add($data));
});

Flight::route('PUT /feedbacks/@id', function ($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::feedbackService()->update($id, $data));
});

Flight::route('DELETE /feedbacks/@id', function ($id) {
    Flight::json(Flight::feedbackService()->delete($id));
});
