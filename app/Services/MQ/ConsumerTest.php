<?php


namespace App\Services\MQ;


use MQ\Exception\AckMessageException;
use MQ\Exception\MessageNotExistException;
use MQ\MQClient;

class ConsumerTest
{
    private $client;
    private $producer;

    public function __construct()
    {
        $this->client = new MQClient(
        // 设置HTTP协议客户端接入点，进入消息队列RocketMQ版控制台实例详情页面的接入点区域查看。
            "http://1296600567122960.mqrest.cn-qingdao-public.aliyuncs.com",
            // AccessKey ID阿里云身份验证，在阿里云RAM控制台创建。
			sysconf('alioss_access_key_id'), //env('ALI_ACCESS_KEY_ID'),
            // AccessKey Secret阿里云身份验证，在阿里云RAM控制台创建。
			sysconf('alioss_access_key_secret'), //env('ALI_ACCESS_KEY_SECRET')
        );

        // 消息所属的Topic，在消息队列RocketMQ版控制台创建。
        $topic = "lrw";
        // 您在消息队列RocketMQ版控制台创建的Group ID。
        $groupId = "GID_lrw";
        // Topic所属的实例ID，在消息队列RocketMQ版控制台创建。
        // 若实例有命名空间，则实例ID必须传入；若实例无命名空间，则实例ID传入null空值或字符串空值。实例的命名空间可以在消息队列RocketMQ版控制台的实例详情页面查看。
        $instanceId = "MQ_INST_1296600567122960_BX05M82P";

        $this->consumer = $this->client->getConsumer($instanceId, $topic, $groupId);
    }

    public function run()
    {
        // 在当前线程循环消费消息，建议多开个几个线程并发消费消息。
        while (True) {
            try {
                // 长轮询消费消息。
                // 长轮询表示如果Topic没有消息,则请求会在服务端挂起3s，3s内如果有消息可以消费则立即返回客户端。
                $messages = $this->consumer->consumeMessage(
                    3, // 一次最多消费3条（最多可设置为16条）。
                    3  // 长轮询时间3秒（最多可设置为30秒）。
                );
            } catch (\Exception $e) {
                if ($e instanceof MessageNotExistException) {
                    // Topic中没有消息可消费，继续轮询。
                    printf("No message, contine long polling!RequestId:%s\n", $e->getRequestId());
                    continue;
                }

                print_r($e->getMessage() . "\n");

                sleep(3);
                continue;
            }

            print "consume finish, messages:\n";

            // 处理业务逻辑。
            $receiptHandles = array();
            foreach ($messages as $message) {
                $receiptHandles[] = $message->getReceiptHandle();
                printf("MessageID:%s TAG:%s BODY:%s \nPublishTime:%d, FirstConsumeTime:%d, \nConsumedTimes:%d, NextConsumeTime:%d,MessageKey:%s\n",
                    $message->getMessageId(), $message->getMessageTag(), $message->getMessageBody(),
                    $message->getPublishTime(), $message->getFirstConsumeTime(), $message->getConsumedTimes(), $message->getNextConsumeTime(),
                    $message->getMessageKey());
                print_r($message->getProperties());
            }

            // $message->getNextConsumeTime()前若不确认消息消费成功，则消息会被重复消费。
            // 消息句柄有时间戳，同一条消息每次消费拿到的都不一样。
            print_r($receiptHandles);
            try {
                $this->consumer->ackMessage($receiptHandles);
            } catch (\Exception $e) {
                if ($e instanceof AckMessageException) {
                    // 某些消息的句柄可能超时，会导致消息消费状态确认不成功。
                    printf("Ack Error, RequestId:%s\n", $e->getRequestId());
                    foreach ($e->getAckMessageErrorItems() as $errorItem) {
                        printf("\tReceiptHandle:%s, ErrorCode:%s, ErrorMsg:%s\n", $errorItem->getReceiptHandle(), $errorItem->getErrorCode(), $errorItem->getErrorCode());
                    }
                }
            }
            print "ack finish\n";


        }

    }
}
