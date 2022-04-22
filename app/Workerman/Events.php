<?php

namespace App\Workerman;

// 心跳间隔10秒
define('HEARTBEAT_TIME',50);

class Events
{

    public static function onWorkerStart($businessWorker)
    {
    }

    // 处理客户端连接
    public static function onConnect($client_id)
    {
        echo "New Connection\n";
    }

    public static function onWebSocketConnect($client_id, $data)
    {
    }

    // 处理客户端消息
    public static function onMessage($client_id, $message)
    {
        //当上来数据获取最后上传数据的时间
        $client_id->lastMessageTime = time();
        /*$message = [
            'user_id' => 'system_1',
            'url' => 'ws://push.laravelvip.cc:8181',
            'type' => 'add_user'
        ];*/
        $user_id = isset($message['user_id']) ? $message['user_id'] : null;
        $url = isset($message['url']) ? $message['url'] : null;
        $type = isset($message['type']) ? $message['type'] : null;

        $client_id->send($message);
    }

    // 处理客户端断开
    public static function onClose($client_id)
    {
        echo "Connection Closed\n";
    }
}