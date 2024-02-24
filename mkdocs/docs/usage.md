# Usage

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

Router::execute();
```

In this example, we define routes for different HTTP methods and execute actions based on the requested routes.

First you need to initialize the `Router` class with the static `initialize` method. Then you can use the verbs methods to add routes.

It's possible to define a route that executes for two or more HTTP methods using the static method `route` like this:

```php
<?php

require_once "vendor/autoload.php";

use AdaiasMagdiel\Hermes\Router;

Router::initialize();

Router::route(['GET', 'POST'], '/', function() {
    echo "This route will be triggered for both GET and POST requests.";
});

Router::execute();
```

## Custom Error Routes

You can customize the Not Found (404) and the Internal Server Error (500) route with the static `set404` and `set500` methods. The `set500` method receive the Exception object as argument, so you can handle it.

```php
<?php

require_once "vendor/autoload.php";

use AdaiasMagdiel\Hermes\Router;

Router::initialize();

// Optional changing the 404 page
Router::set404(function() {
    http_response_code(404);
    echo "This is a new 404 page.";
});

// Optional changing the 500 page
Router::set500(function(\Exception $e) {
    http_response_code(500);
    echo "This is a new 500 page.";
    var_dump($e);
});

Router::execute();
```

## Dynamic Parameters in URL

Hermes supports dynamic parameters in the URL, allowing you to create flexible routes that can handle various inputs. To define a dynamic parameter, use the syntax `/route/[param]`, where `[param]` is the name of the parameter.

Here's how you can use dynamic parameters in Hermes:

```php
<?php

require_once "vendor/autoload.php";

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

## Fallback Route

If you want to get all extra routes in one place, you should use the `fallback` method. You have the flexibility to specify particular routes and employ `fallback` to catch any remaining ones, or you can solely depend on `fallback` to manage them comprehensively.

Keep in mind: When you establish a fallback route, there's no need to use `set404` route separately; in fact, using `set404` has no effect when `fallback` is in play.

```php
<?php

require_once "vendor/autoload.php";

use AdaiasMagdiel\Hermes\Router;

Router::initialize();

Router::get('/', function () {
    echo "Home";
});

Router::get('/about', function () {
    echo "About";
});

Router::fallback(function () {
    echo "Getting all extra routes";
});

Router::execute();
```

Or just:

```php
<?php

require_once "vendor/autoload.php";

use AdaiasMagdiel\Hermes\Router;

Router::initialize();

Router::fallback(function () {
    echo "Getting all routes";
});

Router::execute();
```

## Redirects

In Hermes, it's possible to define redirects as well. For this, you will use the `redirect` method.

This method requires three arguments: the 'from' route, the 'to' route, and whether it is a permanent (301) or temporary (302) redirect.

```php
<?php

require_once "vendor/autoload.php";

use AdaiasMagdiel\Hermes\Router;

Router::initialize();

Router::get("/route", function () {
    echo "Every request on / will be redirected to this route";
});

Router::redirect("/", "/route");

Router::execute();
```

You can define whether the redirect is permanent by using the third argument in the redirect method and setting it to true. This will set the status code to 301. 

```php
<?php

require_once "vendor/autoload.php";

use AdaiasMagdiel\Hermes\Router;

Router::initialize();

Router::get("/new-route", function () {
    echo "A new route";
});

Router::redirect("/old-route", "/new-route", true);

Router::execute();
```
