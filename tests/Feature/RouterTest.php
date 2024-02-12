<?php

use AdaiasMagdiel\Hermes\Router;

it('executes a GET route', function () {
	Router::initialize();
	
	Router::get('/test', function () {
		echo "GET route";
	});

	$_SERVER['REQUEST_METHOD'] = 'GET';
	$_SERVER['REQUEST_URI'] = '/test';

	ob_start();
	Router::execute();
	$output = ob_get_clean();

	expect($output)->toBe('GET route');
});

it('executes a POST route', function () {
	Router::initialize();
	
	Router::post('/test', function () {
		echo 'POST Test';
	});

	$_SERVER['REQUEST_METHOD'] = 'POST';
	$_SERVER['REQUEST_URI'] = '/test';

	ob_start();
	Router::execute();
	$output = ob_get_clean();

	expect($output)->toBe('POST Test');
});

it('executes a multiple methods route', function () {
	Router::initialize();
	
	Router::route(['GET', 'POST'], '/test', function () {
		echo 'GET and POST Test';
	});

	ob_start();
	$_SERVER['REQUEST_METHOD'] = 'POST';
	$_SERVER['REQUEST_URI'] = '/test';
	Router::execute();
	$outputPost = ob_get_clean();

	ob_start();
	$_SERVER['REQUEST_METHOD'] = 'GET';
	$_SERVER['REQUEST_URI'] = '/test';
	Router::execute();
	$outputGet = ob_get_clean();

	expect($outputPost)->toBe('GET and POST Test');
	expect($outputGet)->toBe('GET and POST Test');
});

it('executes a route with or without trailing slash', function () {
	Router::initialize();
	
    Router::get('/test/', function () {
        echo 'Test route';
    });

    ob_start();
    $_SERVER['REQUEST_METHOD'] = 'GET';
    $_SERVER['REQUEST_URI'] = '/test/';
    Router::execute();
    $outputWithSlash = ob_get_clean();

    ob_start();
    $_SERVER['REQUEST_METHOD'] = 'GET';
    $_SERVER['REQUEST_URI'] = '/test';
    Router::execute();
    $outputWithoutSlash = ob_get_clean();

    expect($outputWithSlash)->toBe('Test route');
    expect($outputWithoutSlash)->toBe('Test route');
});
