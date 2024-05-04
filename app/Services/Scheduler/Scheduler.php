<?php
namespace App\Services\Scheduler;


use App\Services\Scheduler\Messages\Message;

class Scheduler
{
    /**
     * 发生消息
     * @param Message $message
     * @param string $topic
     * @param string $instanceId
     * @return mixed
     */
    public function sendMessage(Message $message, string $topic = '', string $instanceId = '')
    {
        $producer = (new Client())->getProducer($topic, $instanceId);

        return $producer->publishMessage($message);
    }
}
