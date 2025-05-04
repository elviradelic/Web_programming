<?php
require_once __DIR__ . '/../services/CategoryService.php';

Flight::route('GET /categories', function () {
    $service = new CategoryService();
    Flight::json($service->get_all_categories());
});

Flight::route('GET /categories/@id', function ($id) {
    $service = new CategoryService();
    Flight::json($service->get_category_by_id($id));
});

Flight::route('POST /categories', function () {
    $data = Flight::request()->data->getData();
    $service = new CategoryService();
    Flight::json($service->add_category($data));
});

Flight::route('PUT /categories/@id', function ($id) {
    $data = Flight::request()->data->getData();
    $service = new CategoryService();
    Flight::json($service->update_category($id, $data));
});

Flight::route('DELETE /categories/@id', function ($id) {
    $service = new CategoryService();
    Flight::json($service->delete_category($id));
});
