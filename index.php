<?php

require_once "vendor/autoload.php";

use AdaiasMagdiel\Hermes\Router;

Router::initialize();

Router::get('/', function () {
    echo "Home";
});

Router::get('/sobre/', function () {
    echo "/about and /about/ are the same endpoint now!";
});

Router::get('/easter-egg', function () {
    echo "<h1>So Long, and Thanks for All the Fish</h1>";
});

Router::get('/user/[id]', function (string $id) {
    echo "User: {$id}";
});

Router::redirect('/', '/about');
Router::redirect('/about', '/sobre');

Router::execute();
