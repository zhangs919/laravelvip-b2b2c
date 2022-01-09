<?php

require_once __DIR__ . '/vendor/autoload.php';
use Workerman\Worker;

// 创建一个 Websocket Server
$ws_worker = new Worker("websocket://127.0.0.1:8181");
// 4 process
$ws_worker->count = 4;

$ws_worker->onConnect = function ($connection) {
    echo "New Connection\n";
};

$ws_worker->onMessage = function ($connection, $data) {
    $connection->send($data);
};

$ws_worker->onClose = function ($connection) {
    echo "Connection Closed\n";
};

// Run Server
Worker::runAll();