<?php

namespace Pericao\Orm\Core;

use Pericao\Orm\Exceptions\Exceptions;
use Pericao\Orm\Http\Request;
use Pericao\Orm\Http\Response;

class Core
{
    public static function dispatch(array $routes)
    {
        isset($_GET['url']) && $url = $_GET['url'];
        if ($url !== '/') {
            $url = rtrim($url, '/');
        }
        // $url !== '/' && $url = rtrim($url, '/');
        $prefixController = 'Pericao\\Orm\\Http\\Controllers\\';
        $prefixMiddleware = 'Pericao\\Orm\\Http\\Middlewares\\';
        $routeFound = false;
        foreach ($routes as $route) {
            $pattern = '#^' . preg_replace('/{id}/', '([\w-]+)', $route['path']) . '$#';
            if (preg_match($pattern, $url, $matches) && $route['method'] == Request::method()) {
                array_shift($matches);
                $routeFound = true;
                if ($route['method'] !== Request::method()) {
                    Response::json([
                        'error' => true,
                        'success' => false,
                        'message' => 'Sorry, method not allowed'
                    ], 405);
                    return;
                }
                foreach ($route['middleware'] as $middleware) {
                    try {
                        $middleware = ucfirst($middleware);
                        $aliasMiddlewares = $prefixMiddleware . $middleware;
                        $extendMiddleware = new $aliasMiddlewares();
                        $extendMiddleware->handle();
                    } catch (Exceptions $e) {
                        return response()->json(['error' => $e->getMessage()], $e->getCode());
                    }
                }
                [$controller, $action] = explode('@', $route['action']);
                $controller = $prefixController . $controller;
                $extendController = new $controller();
                $extendController->$action(new Request, new Response, $matches);
            }
        }
        if (!$routeFound) {
            $controller = $prefixController . 'NotFoundController';
            $extendController = new $controller();
            $extendController->index(new Request, new Response );
        }
    }
}
