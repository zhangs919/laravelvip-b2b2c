<?php
namespace App\Services\Scheduler\Messages;

use MQ\Model\TopicMessage;

class Message extends TopicMessage
{
    /**
     * @var string 设置调用的命令
     */
    public $cmd = '';

    public function __construct(array $params = [], int $delay = 0, string $key = '')
    {
        parent::__construct(json_encode(['cmd' => $this->cmd, 'params' => $params]));

        if ($delay > 0) {
            $this->setStartDeliverTime((time() + $delay) * 1000);
        }

        if (!empty($key)) {
            $this->setMessageKey($key);
        }

        $this->setMessageBody(json_encode(['cmd' => $this->cmd, 'params' => $params]));
    }
}
