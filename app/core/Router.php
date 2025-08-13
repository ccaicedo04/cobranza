<?php
class Router
{
    protected array $routes = [];
    protected array $middlewares = [];

    public function get(string $path, $action): void
    {
        $this->add('GET', $path, $action);
    }

    public function post(string $path, $action): void
    {
        $this->add('POST', $path, $action);
    }

    public function addMiddleware(string $middleware): void
    {
        $this->middlewares[] = $middleware;
    }

    protected function add(string $method, string $path, $action): void
    {
        $this->routes[$method][] = ['path' => $path, 'action' => $action];
    }

    public function dispatch(string $method, string $uri)
    {
        $uri = parse_url($uri, PHP_URL_PATH);
        foreach ($this->routes[$method] ?? [] as $route) {
            $pattern = "@^" . preg_replace('/\{([\w]+)\}/', '(?P<$1>[^/]+)', $route['path']) . "$@";
            if (preg_match($pattern, $uri, $matches)) {
                $params = [];
                foreach ($matches as $k => $v) {
                    if (!is_int($k)) {
                        $params[$k] = $v;
                    }
                }
                foreach ($this->middlewares as $middlewareClass) {
                    $middleware = new $middlewareClass;
                    $middleware->handle();
                }
                return $this->execute($route['action'], $params);
            }
        }
        http_response_code(404);
        echo '404 Not Found';
    }

    protected function execute($action, array $params)
    {
        if (is_callable($action)) {
            return call_user_func_array($action, $params);
        }
        if (is_string($action)) {
            [$controller, $method] = explode('@', $action);
            $controller = new $controller;
            return call_user_func_array([$controller, $method], $params);
        }
    }
}
