<?php
$config = require __DIR__ . '/../../config/config.php';

define('BASE_PATH', realpath(__DIR__ . '/../..'));
define('BASE_URL', $config['base_url']);

require_once __DIR__ . '/Autoloader.php';
Autoloader::register(BASE_PATH . '/app');

Session::start();
