# Reference

Here's a reference for the `Router` class:

## Methods

- [`initialize`](#initialize): Required before defining the first route. Initializes the router by setting default error handling routes (404 and 500).

- [`route`](#routearraystring-method-string-route-callable-action-void): Registers a route with the specified HTTP method(s), route pattern, and associated action.

- [`get`](#getstring-route-callable-action-void): Registers a route for the HTTP GET method.

- [`post`](#poststring-route-callable-action-void): Registers a route for the HTTP POST method.

- [`put`](#putstring-route-callable-action-void): Registers a route for the HTTP PUT method.

- [`delete`](#deletestring-route-callable-action-void): Registers a route for the HTTP DELETE method.

- [`head`](#headstring-route-callable-action-void): Registers a route for the HTTP HEAD method.

- [`options`](#optionsstring-route-callable-action-void): Registers a route for the HTTP OPTIONS method.

- [`patch`](#patchstring-route-callable-action-void): Registers a route for the HTTP PATCH method.

- [`set404`](#set404callable-action-void): Sets a custom handler for the HTTP 404 Not Found error.

- [`set500`](#set500callable-action-void): Sets a custom handler for the HTTP 500 Internal Server Error.

- [`fallback`](#fallbackcallable-action-void): Sets a fallback handler to catch all unmatched routes.

- [`execute`](#execute-void): Required at the end of the routes declaration. Executes the router, matching the incoming request URI and method to registered routes and invoking associated actions.

- [`clean`](#clean-void): Resets the router, clearing all registered routes and reinitializing default error handling routes.

## `initialize()`

Initializes the router by setting default error handling routes (404 and 500). This method is required before call the first route.

```php
<?php
use AdaiasMagdiel\Hermes\Router;

Router::initialize();
```

---

## `route(array|string $method, string $route, callable $action): void`

Registers a route with the specified HTTP method(s), route pattern, and associated action. The `route` method can receive two or more HTTP methods, and can evaluate the same action for these methods.

```php
<?php
use AdaiasMagdiel\Hermes\Router;

Router::route('GET', '/hello', function () {
    echo "Hello, World!";
});

Route::route(['GET', 'POST', 'PATCH'], '/world', function () {
    echo "See how this method can be used";
});
```

---

## `get(string $route, callable $action): void`

Registers a route for the HTTP GET method.

```php
<?php
use AdaiasMagdiel\Hermes\Router;

Router::get('/hello', function () {
    echo "Hello, World!";
});
```

---

## `post(string $route, callable $action): void`

Registers a route for the HTTP POST method.

```php
<?php
use AdaiasMagdiel\Hermes\Router;

Router::post('/submit', function () {
    echo "Form submitted successfully!";
});
```

---

## `put(string $route, callable $action): void`

Registers a route for the HTTP PUT method.

```php
<?php
use AdaiasMagdiel\Hermes\Router;

Router::put('/update', function () {
    echo "Resource updated successfully!";
});
```

---

## `delete(string $route, callable $action): void`

Registers a route for the HTTP DELETE method.

```php
<?php
use AdaiasMagdiel\Hermes\Router;

Router::delete('/delete', function () {
    echo "Resource deleted successfully!";
});
```

---

## `head(string $route, callable $action): void`

Registers a route for the HTTP HEAD method.

```php
<?php
use AdaiasMagdiel\Hermes\Router;

Router::head('/info', function () {
    echo "Information about the resource.";
});
```

---

## `options(string $route, callable $action): void`

Registers a route for the HTTP OPTIONS method.

```php
<?php
use AdaiasMagdiel\Hermes\Router;

Router::options('/info', function () {
    echo "Options available for the resource.";
});
```

---

## `patch(string $route, callable $action): void`

Registers a route for the HTTP PATCH method.

```php
<?php
use AdaiasMagdiel\Hermes\Router;

Router::patch('/update', function () {
    echo "Resource partially updated successfully!";
});
```

---

## `set404(callable $action): void`

Sets a custom handler for the HTTP 404 Not Found error.

```php
<?php
use AdaiasMagdiel\Hermes\Router;

Router::set404(function () {
    echo "404 Not Found: The requested page was not found.";
});
```

---

## `set500(callable $action): void`

Sets a custom handler for the HTTP 500 Internal Server Error.

```php
<?php
use AdaiasMagdiel\Hermes\Router;

Router::set500(function () {
    echo "500 Internal Server Error: There was a server-side issue.";
});
```

---

## `fallback(callable $action): void`

Sets a fallback handler to catch all unmatched routes.

If this method is set, the `set404` method will have no effect. You can refer to the source code for a more complete understanding.

```php
<?php
use AdaiasMagdiel\Hermes\Router;

Router::fallback(function () {
    echo "Fallback: Route not found.";
});
```

---

## `execute(): void`

Executes the router, matching the incoming request URI and method to registered routes and invoking associated actions.

This method is necessary at the end of your route definitions to invoke the current route.

```php
<?php
use AdaiasMagdiel\Hermes\Router;

Router::execute();
```

---

## `clean(): void`

Resets the router, clearing all registered routes and reinitializing default error handling routes.

```php
<?php
use AdaiasMagdiel\Hermes\Router;

Router::clean();
```