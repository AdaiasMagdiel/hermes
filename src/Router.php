<?php

namespace AdaiasMagdiel\Hermes;

class Router {
	private static array $routes = [];

	public static function route(array|string $method, string $route, callable $action): void {
		$methods = is_array($method) ? $method : [$method];

		foreach ($methods as $method) {
			$methodUpper = strtoupper($method);

			if (!isset(self::$routes[$methodUpper])) {
				self::$routes[$methodUpper] = [];
			}

			self::$routes[$methodUpper][$route] = $action;
		}
	}

	public static function get(string $route, callable $action): void {
		self::route("GET", $route, $action);
	}

	public static function post(string $route, callable $action): void {
		self::route("POST", $route, $action);
	}

	public static function execute(): void {
		$method = self::getMethod();
		$uri = self::getURI();

		if (!isset(self::$routes[$method])) {
			throw new \Exception("There's no routes to load with \"{$method}\" method.", 1);
		}

		if (!isset(self::$routes[$method][$uri])) {
			throw new \Exception("The current endpoint is not setted in routes.");
		}

		self::$routes[$method][$uri]();
	}

	public static function getMethod(): string {
		return strtoupper($_SERVER["REQUEST_METHOD"]);
	}

	private static function getURI(): string {
		return $_SERVER["REQUEST_URI"];
	}
}
