<?php

namespace Pericao\Orm\Http;

class Middleware
{
    public array $middleware;

    public function auth(array $middlewares): static
    {
        $this->middleware = $middlewares;
        return $this;
    }

    public function group(callable $callback)
    {
        $callback($this);
        $this->middleware = [];
    }
}