<?php
require __DIR__ . '/../app/core/bootstrap.php';

$router = new Router();

require BASE_PATH . '/app/routes/web.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$base = rtrim(BASE_URL, '/');
if ($base !== '' && strpos($uri, $base) === 0) {
    $uri = substr($uri, strlen($base));
}
$router->dispatch($_SERVER['REQUEST_METHOD'], $uri ?: '/');
