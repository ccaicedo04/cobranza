<?php
$env = require __DIR__.'/env.php';
return [
    'db' => [
        'host' => $env['DB_HOST'],
        'name' => $env['DB_NAME'],
        'user' => $env['DB_USER'],
        'pass' => $env['DB_PASS'],
    ],
    'base_url' => $env['BASE_URL']
];
