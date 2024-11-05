<?php

namespace Pericao\Orm\Http;

class Route
{
    private static array $routes = [];

    public static function get(string $path, string $action)
    {
        self::$routes[] = [
            'path' => $path,
            'action' => $action,
            'method' => 'GET'
        ];
    }

    public static function post(string $path, string $action)
    {
        self::$routes[] = [
            'path' => $path,
            'action' => $action,
            'method' => 'GET'
        ];
    }

    public static function put(string $path, string $action)
    {
        self::$routes[] = [
            'path' => $path,
            'action' => $action,
            'method' => 'GET'
        ];
    }

    public static function delete(string $path, string $action)
    {
        self::$routes[] = [
            'path' => $path,
            'action' => $action,
            'method' => 'GET'
        ];
    }

    public static function getRoutes() 
    {
        return self::$routes;
    } 
}