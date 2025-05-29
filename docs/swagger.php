<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/../backend/rest/vendor/autoload.php';

$openapi = \OpenApi\Generator::scan([
    __DIR__ . '/doc_setup.php',
    __DIR__ . '/../backend/rest/routes'
]);

header('Content-Type: application/json');
echo $openapi->toJson();
