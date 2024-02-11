<?php

require_once "vendor/autoload.php";

use AdaiasMagdiel\Hermes\Router;

Router::get('/', function() {
    echo "Hello, World!";
});

Router::get('/about', function() {
    echo "About page";
});

Router::get('/easter-egg', function() {
    echo "<h1>So Long, and Thanks for All the Fish</h1>";
});

Router::post('/submit', function() {
    // Handle form submission
});

Router::execute();
