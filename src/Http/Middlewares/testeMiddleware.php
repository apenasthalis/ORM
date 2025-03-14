<?php

// Interface para definir um middleware
interface MiddlewareInterface
{
    public function handle($request, $next);
}

// Middleware que simula autenticação (ex.: auth:sanctum)
class AuthSanctumMiddleware implements MiddlewareInterface
{
    public function handle($request, $next)
    {
        // Simula a verificação de autenticação
        if (!isset($request['user'])) {
            return 'Não autenticado';
        }

        return $next($request);
    }
}

// Middleware que simula verificação de permissões
class CheckPermissionMiddleware implements MiddlewareInterface
{
    public function handle($request, $next)
    {
        // Simula a verificação de permissão do usuário (ex.: papel de administrador)
        if ($request['user']['role'] !== 'admin') {
            return 'Permissão negada';
        }

        return $next($request);
    }
}

// Classe Router para gerenciar rotas e grupos com middleware
class Router
{
    protected $routes = [];
    protected $middleware = [];

    // Método para registrar rotas GET
    public function get($uri, $action)
    {
        $this->routes[] = [
            'method' => 'GET',
            'uri' => $uri,
            'action' => $action,
            'middleware' => $this->middleware,
        ];
    }

    // Define middlewares para o grupo de rotas
    public function middleware(array $middlewares)
    {
        $this->middleware = $middlewares;

        return $this;
    }

    // Agrupa rotas aplicando os middlewares definidos
    public function group(callable $callback)
    {
        $callback($this);
        // Reseta os middlewares após o grupo
        $this->middleware = [];
    }

    // Método para processar a requisição e despachar a rota
    public function dispatch($method, $uri, $request)
    {
        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $route['uri'] === $uri) {
                $action = $route['action'];

                // Cria a pilha de middlewares
                $middlewareStack = [];
                foreach ($route['middleware'] as $mw) {
                    // Aqui assumimos que os middlewares são nomes de classes
                    $middlewareStack[] = new $mw();
                }

                // Define a ação final (controlador + método)
                $controllerAction = function ($request) use ($action) {
                    $controller = new $action[0]();

                    return call_user_func_array([$controller, $action[1]], [$request]);
                };

                // Cria a cadeia de middlewares
                $next = array_reduce(array_reverse($middlewareStack), function ($next, $middleware) {
                    return function ($request) use ($middleware, $next) {
                        return $middleware->handle($request, $next);
                    };
                }, $controllerAction);

                // Executa a cadeia e retorna a resposta
                return $next($request);
            }
        }

        return 'Rota não encontrada';
    }
}

// Exemplo de controlador
class ShipmentDisembarkationController
{
    public function index($request)
    {
        return 'Página de Desembarque de Shipment';
    }
}

// Instanciando o roteador
$router = new Router();


$router->middleware(['AuthSanctumMiddleware', 'CheckPermissionMiddleware'])->group(function ($router) {    
    $router->get('/shipment-disembarkation', [ShipmentDisembarkationController::class, 'index']);
});

// Simulação de requisição
$request = [
    'user' => [
        'name' => 'João',
        'role' => 'admin',  // Altere para outro valor para testar a negação de permissão
    ],
];

print $router->dispatch('GET', '/shipment-disembarkation', $request);