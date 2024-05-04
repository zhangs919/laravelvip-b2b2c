<?php
namespace App\Services\Scheduler\Commands;

use App\Services\Scheduler\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use MQ\Exception\AckMessageException;
use MQ\Exception\MessageNotExistException;
use Exception;

/**
 * Class ConsumerCommand
 * 消费者类用于监听不同 Topic 的消费者类
 */
class ConsumerCommand extends Command
{
    protected $signature = 'Scheduler:Consumer {topic?} {groupId?} {instanceId?}';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 实际运行器
     */
    public function handle()
    {
        $params = $this->arguments();

        $topic = $params['topic'] ?? config('aliyun.rocket_mq.topic');
        $groupId = $params['group_id'] ?? config('aliyun.rocket_mq.group_id');
        $instanceId = $params['instance_id'] ?? config('aliyun.rocket_mq.instance_id');

        $consumer = (new Client())->getConsumer($topic, $groupId, $instanceId);

        while (True) {
            try {
                $messages = $consumer->consumeMessage(3, 3);
            } catch (Exception $e) {
                if ($e instanceof MessageNotExistException) {
                    // 没有消息可以消费，接着轮询
                    Log::info('暂时没有消息可以被消费继续轮询...', ['requestId' => $e->getRequestId()]);
                    continue;
                }

                Log::error('消息消费异常...', ['err' => $e]);
                sleep(3);
                continue;
            }

            Log::info('消息接收完成...开始处理业务逻辑...', ['messages' => $messages]);
            $receiptHandles = array();
            foreach ($messages as $message) {
                $receiptHandles[] = $message->getReceiptHandle();

                $data = json_decode($message->getMessageBody(), true);
                Log::info('具体业务消息为...', ['message' => $message, 'body' => $data]);
                $cmd = $data['cmd'];
                // 调起响应 Artisan 命令
                Artisan::call($cmd, []);
            }

            // $message->getNextConsumeTime()前若不确认消息消费成功，则消息会重复消费
            // 消息句柄有时间戳，同一条消息每次消费拿到的都不一样
            print_r($receiptHandles);
            try {
                $consumer->ackMessage($receiptHandles);
            } catch (Exception $e) {
                if ($e instanceof AckMessageException) {
                    // 某些消息的句柄可能超时了会导致确认不成功
                    Log::info('消息确认失败...', ['requestId' => $e->getRequestId()]);
                    foreach ($e->getAckMessageErrorItems() as $errorItem) {
                        Log::info('消息确认失败信息为...', ['receiptHandle' => $errorItem->getReceiptHandle(), 'code' => $errorItem->getErrorCode()]);
                    }
                }
            }

            Log::info('消息确消费完成...');
        }
    }
}
