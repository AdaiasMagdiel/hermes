# Hermes

<p align="center">
  <img src="hermes.png" height="280">
  <br>
  <sub><sup>The image was generated using AI.</sup></sub>
</p>

[![Latest Stable Version](http://poser.pugx.org/adaiasmagdiel/hermes/v)](https://packagist.org/packages/adaiasmagdiel/hermes)
[![Total Downloads](http://poser.pugx.org/adaiasmagdiel/hermes/downloads)](https://packagist.org/packages/adaiasmagdiel/hermes)
[![License](http://poser.pugx.org/adaiasmagdiel/hermes/license)](https://packagist.org/packages/adaiasmagdiel/hermes)
[![PHP Version Require](http://poser.pugx.org/adaiasmagdiel/hermes/require/php)](https://packagist.org/packages/adaiasmagdiel/hermes)


Hermes is an experimental lightweight PHP library for routing management. It provides a simple and intuitive way to define routes and execute actions based on HTTP requests.

## Navigation

- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
- [Documentation](#documentation)
- [Tests](#tests)
- [License](#license)
- [Contributing](#contributing)
- [Credits](#credits)

## Features

- Define routes easily using HTTP methods (GET, POST, PUT, DELETE, HEAD, OPTIONS and PATCH).
- Execute actions based on requested routes.
- Lightweight, experimental, and easy to integrate into existing projects.

## Installation

You can install Hermes via composer.

```bash
composer require adaiasmagdiel/hermes
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
    http_response_code(404);
    echo "This is a new 404 page.";
});

// Optional changing the 500 page
Router::set500(function() {
    http_response_code(500);
    echo "This is a new 500 page.";
});

Router::execute();
```

In this example, we define routes for different HTTP methods (`GET` and `POST`) and execute actions based on the requested routes.

First you need to initialize the `Router` class with the static `initialize` method. Then you can use the methods to add routes, also you can add a 404 and 500 page with the `set400` e `set500` methods.

## Documentation

To access the full documentation and see more examples of usage, please visit the [documentation page](https://adaiasmagdiel.github.io/hermes/).

## Tests

To run the tests for Hermes, you can use the following command:

```bash
composer run tests
```

## License

Hermes is open-source software licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.

## Contributing

I welcome contributions to the Hermes project! To contribute, follow these steps:

1. Clone the repository to your local machine:
   ```bash
   git clone https://github.com/AdaiasMagdiel/hermes.git
   ```

2. Install the development dependencies using Composer:
   ```bash
   composer install
   ```

3. Make your changes or additions to the codebase.

4. Write and test your changes to ensure they work as expected:
   ```bash
   composer run tests
   ```

5. Commit your changes and push them to your fork of the repository.

6. Submit a pull request with a clear description of your changes.

I appreciate your contributions and feedback! If you encounter any issues or have suggestions for improvements, please don't hesitate to open an issue on GitHub.

## Credits

Hermes is developed and maintained by [Adaías Magdiel](https://github.com/AdaiasMagdiel).
