<?php
require __DIR__ . '/../app/core/bootstrap.php';

$router = new Router();

require BASE_PATH . '/app/routes/web.php';

$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
