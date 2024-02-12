<?php

use AdaiasMagdiel\Hermes\Router;

describe('Routes method tests', function () {
	beforeEach(function () {
		Router::clean();
	});

	it('registers a GET route', function () {
		Router::get('/test', function () {
			echo 'GET route';
		});

		ob_start();
		$_SERVER['REQUEST_METHOD'] = 'GET';
		$_SERVER['REQUEST_URI'] = '/test';
		Router::execute();
		$output = ob_get_clean();

		expect($output)->toBe('GET route');
	});

	it('registers a POST route', function () {
		Router::post('/test', function () {
			echo 'POST route';
		});

		ob_start();
		$_SERVER['REQUEST_METHOD'] = 'POST';
		$_SERVER['REQUEST_URI'] = '/test';
		Router::execute();
		$output = ob_get_clean();

		expect($output)->toBe('POST route');
	});

	it('registers a PUT route', function () {
		Router::put('/test', function () {
			echo 'PUT route';
		});

		ob_start();
		$_SERVER['REQUEST_METHOD'] = 'PUT';
		$_SERVER['REQUEST_URI'] = '/test';
		Router::execute();
		$output = ob_get_clean();

		expect($output)->toBe('PUT route');
	});

	it('registers a DELETE route', function () {
		Router::delete('/test', function () {
			echo 'DELETE route';
		});

		ob_start();
		$_SERVER['REQUEST_METHOD'] = 'DELETE';
		$_SERVER['REQUEST_URI'] = '/test';
		Router::execute();
		$output = ob_get_clean();

		expect($output)->toBe('DELETE route');
	});

	it('registers a HEAD route', function () {
		Router::head('/test', function () {
			echo 'HEAD route';
		});

		ob_start();
		$_SERVER['REQUEST_METHOD'] = 'HEAD';
		$_SERVER['REQUEST_URI'] = '/test';
		Router::execute();
		$output = ob_get_clean();

		expect($output)->toBe('HEAD route');
	});

	it('registers a OPTIONS route', function () {
		Router::options('/test', function () {
			echo 'OPTIONS route';
		});

		ob_start();
		$_SERVER['REQUEST_METHOD'] = 'OPTIONS';
		$_SERVER['REQUEST_URI'] = '/test';
		Router::execute();
		$output = ob_get_clean();

		expect($output)->toBe('OPTIONS route');
	});

	it('registers a PATCH route', function () {
		Router::patch('/test', function () {
			echo 'PATCH route';
		});

		ob_start();
		$_SERVER['REQUEST_METHOD'] = 'PATCH';
		$_SERVER['REQUEST_URI'] = '/test';
		Router::execute();
		$output = ob_get_clean();

		expect($output)->toBe('PATCH route');
	});

	it('executes a custom 404 action', function () {
		Router::set404(function () {
			echo 'Custom 404 page';
		});

		ob_start();
		$_SERVER['REQUEST_METHOD'] = 'GET';
		$_SERVER['REQUEST_URI'] = '/not-found';
		Router::execute();
		$output = ob_get_clean();

		expect($output)->toBe('Custom 404 page');
	});

	it('executes a custom 500 action', function () {
		Router::set500(function () {
			echo 'Custom 500 page';
		});

		Router::get('/error', function () {
			echo $error;
		});

		ob_start();
		$_SERVER['REQUEST_METHOD'] = 'GET';
		$_SERVER['REQUEST_URI'] = '/error';
		Router::execute();
		$output = ob_get_clean();

		expect($output)->toBe('Custom 500 page');
	});

	it('executes a multiple methods route', function () {
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

		var_dump($outputGet, $outputPost);

		expect($outputPost)->toBe('GET and POST Test');
		expect($outputGet)->toBe('GET and POST Test');
	});

	it('executes a route with or without trailing slash', function () {
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

	it('executes a route with url params', function () {
		Router::get('/user/[id]', function (string $id) {
			echo "User with id: {$id}";
		});

		ob_start();
		$_SERVER['REQUEST_METHOD'] = 'GET';
		$_SERVER['REQUEST_URI'] = '/user/42';
		Router::execute();
		$output = ob_get_clean();

		expect($output)->toBe("User with id: 42");
	});

	it('executes a route with a query string', function () {
		Router::get('/route', function () {
			echo 'Route with query string';
		});

		ob_start();
		$_SERVER['REQUEST_METHOD'] = 'GET';
		$_SERVER['REQUEST_URI'] = '/route?answer=42';
		Router::execute();
		$output = ob_get_clean();

		expect($output)->toBe('Route with query string');
	});
});

describe("Error routes tests", function () {
	beforeEach(function () {
		Router::clean();
	});

	it('executes a 404 page', function () {
		ob_start();
		$_SERVER['REQUEST_METHOD'] = 'GET';
		$_SERVER['REQUEST_URI'] = '/not-found';
		Router::execute();
		$output = ob_get_clean();

		expect($output)->toBe('<p>The current endpoint was not found in the server.</p>');
	});

	it('executes a 500 page', function () {
		Router::get('/error', function () {
			echo $error;
		});

		ob_start();
		$_SERVER['REQUEST_METHOD'] = 'GET';
		$_SERVER['REQUEST_URI'] = '/error';
		Router::execute();
		$output = ob_get_clean();

		expect($output)->toBe('<p>Internal Server Error: it seems that there is an issue with the server.</p>');
	});
});
