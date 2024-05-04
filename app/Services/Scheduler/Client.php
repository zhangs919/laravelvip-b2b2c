<?php
namespace App\Services\Scheduler;

use MQ\MQClient;
use MQ\MQConsumer;
use MQ\MQProducer;

class Client
{
    protected $client;

    static $instanceId = '';
    static $groupId = '';
    static $topic = '';

    public function __construct()
    {
//        $this->client = new MQClient(config('aliyun.rocket_mq.http_endpoint'), config('aliyun.access_id'), config('aliyun.access_key'));
        $this->client = new MQClient(config('aliyun.rocket_mq.http_endpoint'), sysconf('alioss_access_key_id'), sysconf('alioss_access_key_secret'));
        self::$instanceId = config('aliyun.rocket_mq.instance_id');
        self::$groupId = config('aliyun.rocket_mq.group_id');
        self::$topic = config('aliyun.rocket_mq.topic');
    }

    /**
     * 获得一个消费者实例
     * @param string $topic
     * @param string $groupId
     * @param string $instanceId
     * @return MQConsumer
     */
    public function getConsumer(string $topic = '', string $groupId = '', string $instanceId = '')
    {
        list($topic, $groupId, $instanceId) = $this->getClientConfig($topic, $groupId, $instanceId);

        return $this->client->getConsumer($instanceId, $topic, $groupId);
    }

    /**
     * 获取一个生产者实例
     * @param string $topic
     * @param string $instanceId
     * @return MQProducer
     */
    public function getProducer(string $topic = '', string $instanceId = '')
    {
        list($topic, ,$instanceId) = $this->getClientConfig($topic, '', $instanceId);

        return $this->client->getProducer($instanceId, $topic);
    }

    /**
     * 获取配置
     * @param string $topic
     * @param string $groupId
     * @param string $instanceId
     * @return array
     */
    private function getClientConfig(string $topic, string $groupId, string $instanceId)
    {
        return [
            empty($topic) ? self::$topic : $topic,
            empty($groupId) ? self::$groupId : $groupId,
            empty($instanceId) ? self::$instanceId : $instanceId
        ];
    }
}
