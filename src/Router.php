<?php

namespace AdaiasMagdiel\Hermes;

class Router
{
	private static array $routes = [];

	public static function route(array|string $method, string $route, callable $action): void
	{
		$methods = is_array($method) ? $method : [$method];
		$route = strlen($route) > 1 ? rtrim($route, '/') : $route;

		foreach ($methods as $method) {
			$methodUpper = strtoupper($method);

			if (!isset(self::$routes[$methodUpper])) {
				self::$routes[$methodUpper] = [];
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

	public static function route404(): void
	{
		$uri = self::getURI();
		echo "<p>The current endpoint \"{$uri}\" was not found in the server.</p>";
	}

	public static function execute(): void
	{
		$method = self::getMethod();
		$uri = self::getURI();

		if (!isset(self::$routes[$method])) {
			self::route404();
		}

		if (!isset(self::$routes[$method][$uri])) {
			self::route404();
		}

		self::$routes[$method][$uri]();
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
