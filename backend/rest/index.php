<?php
require_once __DIR__ . '/vendor/autoload.php';

// Dodaj demo rutu da testiraš da li sve radi
Flight::route('/', function(){
    echo 'FlightPHP radi!';
});

Flight::start();
