<?php 

namespace Pericao\Orm\Core;

class Core
{
    public static function dispatch (array $routes)
    {
        $url = "/";

        isset($_GET['$url']) && $url .= $_GET['url'];

        foreach ($routes as $route) {
            $pattern = '#^'. preg_replace('/{id}/', '([\w-]+)', $route['path']) . '$#';
        }

        $prefixController = 'Pericao\\Orm\\Http\\Controllers';

        print_r($prefixController);
        if (preg_match(pattern: $pattern, subject: $url, matches: $matches)) {
            print_r(value: $prefixController);
            // array_shift($matches);

            // [$controller, $action] = explode('@', $route['action']);

            // $controller = $prefixController . $controller;
            // $extendController = new $controller();
            // $extendController->$action();
        }
    } 
}