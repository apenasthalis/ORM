<?php

namespace Pericao\Orm\Http;

class Route
{
    private static array $routes = [];
    private static array $middleware = [];

    public static function get(string $path, string $action)
    {
        self::$routes[] = [
            'path' => $path,
            'action' => $action,
            'method' => 'GET',
            'middleware' => self::$middleware,
        ];
    }

    public static function post(string $path, string $action)
    {
        self::$routes[] = [
            'path' => $path,
            'action' => $action,
            'method' => 'POST',
            'middleware' => self::$middleware,
        ];
    }

    public static function put(string $path, string $action)
    {
        self::$routes[] = [
            'path' => $path,
            'action' => $action,
            'method' => 'PUT',
            'middleware' => self::$middleware,
        ];
    }

    public static function delete(string $path, string $action)
    {
        self::$routes[] = [
            'path' => $path,
            'action' => $action,
            'method' => 'DELETE',
            'middleware' => self::$middleware,
        ];
    }

    public function middleware(array $middlewares)
    {
        self::$middleware = $middlewares;
        return $this;
    }

    public function group(callable $callback)
    {
        $callback($this);
        self::$middleware = [];
    }

    public static function getRoutes() 
    {
        return self::$routes;
    }

    public static function getMiddlewares()
    {
        return self::$middleware;
    }
}