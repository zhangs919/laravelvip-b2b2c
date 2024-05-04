<?php


namespace App\Services\MQ;


use MQ\Model\TopicMessage;
use MQ\MQClient;

class ProducerTest
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
        // Topic所属的实例ID，在消息队列RocketMQ版控制台创建。
        // 若实例有命名空间，则实例ID必须传入；若实例无命名空间，则实例ID传入null空值或字符串空值。实例的命名空间可以在消息队列RocketMQ版控制台的实例详情页面查看。
        $instanceId = "MQ_INST_1296600567122960_BX05M82P";

        $this->producer = $this->client->getProducer($instanceId, $topic);
    }

    public function run()
    {
        try
        {
            for ($i=1; $i<=4; $i++)
            {
                $publishMessage = new TopicMessage(
                // 消息内容。
                    "hello mq!"
                );
                // 设置消息的自定义属性。
                $publishMessage->putProperty("a", $i);
                // 设置消息的Key。
                $publishMessage->setMessageKey("MessageKey");

                $result = $this->producer->publishMessage($publishMessage);

                print "Send mq message success. msgId is:" . $result->getMessageId() . ", bodyMD5 is:" . $result->getMessageBodyMD5() . "\n";
            }
        } catch (\Exception $e) {
            print_r($e->getMessage() . "\n");
        }
    }

}
