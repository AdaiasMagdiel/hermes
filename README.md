# Hermes

Hermes is an experimental lightweight PHP library for routing management. It provides a simple and intuitive way to define routes and execute actions based on HTTP requests.

## Features

- Define routes easily using HTTP methods (GET, POST).
- Execute actions based on requested routes.
- Lightweight, experimental, and easy to integrate into existing projects.

## Installation

You can install Hermes by downloading the source directly from GitHub.

### Via GitHub

You can download the source code from the [GitHub repository](https://github.com/AdaiasMagdiel/hermes).

```bash
git clone https://github.com/AdaiasMagdiel/hermes.git
```

After downloading the source, make sure to run the following command to install dependencies including PestPHP for running tests:

```bash
composer install
```

## Usage

Here's a basic example of how to use Hermes:

```php
<?php

require_once "vendor/autoload.php";

use AdaiasMagdiel\Hermes\Router;

Router::initialize();

Router::get('/', function() {
    echo "Hello, World!";
});

Router::get('/about', function() {
    echo "About page";
});

Router::post('/submit', function() {
    // Handle form submission
});

// Optional changing the 404 page
Router::set404(function() {
    echo "This is a new 404 page."
});

// Optional changing the 500 page
Router::set500(function() {
    echo "This is a new 500 page."
});

Router::execute();
```

In this example, we define routes for different HTTP methods (`GET` and `POST`) and execute actions based on the requested routes.

First you need to initialize the `Router` class with the static `initialize` method. Then you can use the methods to add routes, also you can add a 404 and 500 page with the `set400` e `set500` methods.

Claro! Vou adicionar uma seção sobre como usar parâmetros dinâmicos na URL:

### Dynamic Parameters in URL

Hermes supports dynamic parameters in the URL, allowing you to create flexible routes that can handle various inputs. To define a dynamic parameter, use the syntax `/route/[param]`, where `[param]` is the name of the parameter.

Here's how you can use dynamic parameters in Hermes:

```php
<?php

use AdaiasMagdiel\Hermes\Router;

Router::initialize();

// Define a route with a dynamic parameter
Router::get('/user/[id]', function (string $id) {
    echo "User with ID: {$id}";
});

// Another example with more params
Router::get('/blog/[category]/[slug]', function (string $category, string $slug) {
    echo "Blog post in {$category}/{$slug}";
});

// Execute the router
Router::execute();
```

Dynamic parameters allow you to create more flexible and expressive routes, making it easier to handle different scenarios in your web application. 

## Tests

To run the tests for Hermes, you can use the following command:

```bash
composer run tests
```

## License

Hermes is open-source software licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.

## Contributing

Contributions are welcome! Please feel free to submit issues or pull requests.

## Credits

Hermes is developed and maintained by [Adaías Magdiel](https://github.com/AdaiasMagdiel).
