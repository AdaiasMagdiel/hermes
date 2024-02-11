# Hermes

Hermes is a experimental lightweight PHP library for routing management. It provides a simple and intuitive way to define routes and execute actions based on HTTP requests.

## Features

- Define routes easily using HTTP methods (GET, POST).
- Execute actions based on requested routes.
- Lightweight, experimental and easy to integrate into existing projects.

## Installation

You can install Hermes by downloading the source directly from GitHub.

### Via GitHub

You can download the source code from the [GitHub repository](https://github.com/AdaiasMagdiel/hermes).

```bash
git clone https://github.com/AdaiasMagdiel/hermes.git
```

## Usage

Here's a basic example of how to use Hermes:

```php
<?php

require_once "vendor/autoload.php";

use AdaiasMagdiel\Hermes\Router;

Router::get('/', function() {
    echo "Hello, World!";
});

Router::get('/about', function() {
    echo "About page";
});

Router::post('/submit', function() {
    // Handle form submission
});

Router::execute();
```

In this example, we define routes for different HTTP methods (`GET` and `POST`) and execute actions based on the requested routes.

## License

Hermes is open-source software licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.

## Contributing

Contributions are welcome! Please feel free to submit issues or pull requests.

## Credits

Hermes is developed and maintained by [Adaías Magdiel](https://github.com/AdaiasMagdiel).
