<?php

require_once "vendor/autoload.php";

use AdaiasMagdiel\Hermes\Router;

Router::get('/', function () {
    echo "Home";
});

Router::get('/about/', function () {
    echo "/about and /about/ are the same endpoint now!";
});

Router::get('/easter-egg', function () {
    echo "<h1>So Long, and Thanks for All the Fish</h1>";
});

Router::get('/user/[id]', function () {
    echo "Next feature.";
});

Router::execute();
