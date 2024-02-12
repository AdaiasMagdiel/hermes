<?php

namespace AdaiasMagdiel\Hermes;

class Router
{
	private static array $routes = [];
	private static string $pattern = '/\/\[[a-zA-Z]+\]/';

	public static function initialize(): void
	{
		self::$routes["404"] = function () {
			http_response_code(404);
			echo "<p>The current endpoint was not found in the server.</p>";
		};

		self::$routes["500"] = function () {
			http_response_code(500);
			echo "<p>Internal Server Error: it seems that there is an issue with the server.</p>";
		};
	}

	public static function route(array|string $method, string $route, callable $action): void
	{
		$methods = is_array($method) ? $method : [$method];
		$route = strlen($route) > 1 ? rtrim($route, '/') : $route;
		$routeIsFormated = false;

		foreach ($methods as $method) {
			$methodUpper = strtoupper($method);

			if (!isset(self::$routes[$methodUpper])) {
				self::$routes[$methodUpper] = [];
			}

			if (!$routeIsFormated) {
				$route = preg_replace(self::$pattern, '/(\\w+)', $route);
				$route = str_replace('/', '\/', $route);
				$route = "/^{$route}$/";

				$routeIsFormated = true;
			}

			self::$routes[$methodUpper][$route] = $action;
		}
	}

	public static function get(string $route, callable $action): void
	{
		self::route("GET", $route, $action);
	}

	public static function post(string $route, callable $action): void
	{
		self::route("POST", $route, $action);
	}

	public static function put(string $route, callable $action): void
	{
		self::route("PUT", $route, $action);
	}

	public static function delete(string $route, callable $action): void
	{
		self::route("DELETE", $route, $action);
	}

	public static function head(string $route, callable $action): void
	{
		self::route("HEAD", $route, $action);
	}
	public static function options(string $route, callable $action): void
	{
		self::route("OPTIONS", $route, $action);
	}

	public static function patch(string $route, callable $action): void
	{
		self::route("PATCH", $route, $action);
	}

	public static function set404(callable $action): void
	{
		self::$routes["404"] = $action;
	}

	public static function set500(callable $action): void
	{
		self::$routes["500"] = $action;
	}

	public static function execute(): void
	{
		set_error_handler(function ($severity, $message, $file, $line) {
			throw new \ErrorException($message, 500, $severity, $file, $line);
		});

		try {
			self::manageRoute();
		} catch (\Exception $e) {
			self::$routes["500"]();
		} finally {
			restore_error_handler();
		}
	}

	public static function clean(): void {
		self::$routes = [];
		self::initialize();
	}

	private static function manageRoute(): void
	{
		$method = self::getMethod();
		$uri = self::getURI();
		$params = [];

		if (!isset(self::$routes[$method])) {
			self::$routes["404"]();
			return;
		}

		foreach (self::$routes[$method] as $route => $action)
		{
			if (preg_match($route, $uri, $params))
			{
				array_shift($params);
				$action(...$params);
				return;
			}
		}

		self::$routes["404"]();
	}

	public static function getMethod(): string
	{
		return strtoupper($_SERVER["REQUEST_METHOD"]);
	}

	private static function getURI(): string
	{

		$uri = $_SERVER["REQUEST_URI"];
		$uri = strlen($uri) > 1 ? rtrim($uri, '/') : $uri;

		return $uri;
	}
}
