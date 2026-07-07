<?php

foreach ([
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/framework/views',
    '/tmp/storage/logs',
] as $directory) {
    if (! is_dir($directory)) {
        mkdir($directory, 0777, true);
    }
}

$_ENV['VIEW_COMPILED_PATH'] = $_SERVER['VIEW_COMPILED_PATH'] = $_ENV['VIEW_COMPILED_PATH'] ?? '/tmp/storage/framework/views';
$_ENV['APP_STORAGE_PATH'] = $_SERVER['APP_STORAGE_PATH'] = $_ENV['APP_STORAGE_PATH'] ?? '/tmp/storage';

require __DIR__ . '/../public/index.php';
