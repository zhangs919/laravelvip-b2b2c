<?php
// +----------------------------------------------------------------------
// | laravelvip 乐融沃B2B2C商城系统
// +----------------------------------------------------------------------
// | Copyright (c) 2017-2027 http://www.laravelvip.com All rights reserved.
// +----------------------------------------------------------------------
// | Notice: This code is not open source, it is strictly prohibited
// |         to distribute the copy, otherwise it will pursue its
// |         legal responsibility.
// +----------------------------------------------------------------------
// | 版权所有 2015-2027 云南乐融沃网络科技有限公司，并保留所有权利。
// | 网站地址: http://www.laravelvip.com
// +----------------------------------------------------------------------
// | 这不是一个自由软件！禁止拷贝本软件副本，否则将追究其法律责任！
// | 如需使用，请移步官网购买正版授权。
// +----------------------------------------------------------------------
// | Author: 雲溪荏苒 <290648237@qq.com>
// | Date:2021-09-21
// | Description: uni-push 推送服务类
// +----------------------------------------------------------------------

namespace App\Services;

/**
 * uni-push 推送服务类
 *
 * Class UniPushService
 * @package App\Services
 */
class UniPushService
{
    private $apiUrl = 'https://restapi.getui.com';
    private $appId = 'd8cUxoy5Na7EZZ5nxANjT5';
    private $appKey = '8zaMTanloE7gxbMRe0xiK1';
    private $masterSecret = 'XFQT5hjONw5wVL2lz1gNTA';
    private $pushClient;

    public function __construct()
    {
        $this->pushClient = new \GTClient($this->apiUrl, $this->appKey, $this->appId, $this->masterSecret);
    }

    /**
     * 执行cid单推
     *
     * @param $title
     * @param $content
     * @param string $cid 9eea11bec080b30dea017dc9c80d4009
     * @param string $clickType 点击通知后续动作，目前支持以下后续动作: 打开应用内特定页面
     *                          1、url：打开网页地址。
     *                          2、payload：自定义消息内容启动应用。
     *                          3、payload_custom：自定义消息内容不启动应用。
     *                          4、startapp：打开应用首页。
     *                          5、none：纯通知，无后续动作
     * @param string $intent 点击通知打开应用特定页面，长度 ≤ 4096;
     *                          示例：intent:#Intent;component=你的包名/你要打开的 activity 全路径;S.parm1=value1;S.parm2=value2;end
     * @param string $url 点击通知打开链接，长度 ≤ 1024
     * @param string $payload 点击通知加自定义消息，长度 ≤ 3072
     * @return mixed
     */
    public function pushToSingleByCid($params)
    {
        $push = $this->getParams($params);
        $push->setCid($params['cid']);
        $result = $this->pushClient->pushApi()->pushToSingleByCid($push);
        return $result;
    }

    /**
     * 执行别名单推
     *
     * @param $params
     * @return mixed
     */
    public function pushToSingleByAlias($params)
    {
        $push = $this->getParams($params);
        $push->setCid($params['alias']);
        $result = $this->pushClient->pushApi()->pushToSingleByAlias($push);
        return $result;
    }

    /**
     * 执行cid批量单推
     *
     * @param $params
     * @return mixed
     */
    public function pushBatchByCid($params)
    {

        $batch = new \GTPushBatchRequest();
        foreach ($params['msg_list'] as $item) {
            $push = $this->getParams($item);
            $push->setCid($item['cid']);
            $batch->addMsgList($push);
        }

        $batch->setIsAsync($params['is_async']);
        $result = $this->pushClient->pushApi()->pushBatchByCid($batch);
        return $result;
    }

    /**
     * 执行alias批量单推
     *
     * @param $params
     * @return mixed
     */
    public function pushBatchByAlias($params)
    {

        $batch = new \GTPushBatchRequest();
        foreach ($params['msg_list'] as $item) {
            $push = $this->getParams($item);
            $push->setAlias($item['alias']);
            $batch->addMsgList($push);
        }

        $batch->setIsAsync($params['is_async']);
        $result = $this->pushClient->pushApi()->pushBatchByAlias($batch);
        return $result;
    }

    /**
     * 创建消息
     *
     * @param $params
     * @return mixed
     */
    public function createListMsg($params)
    {
        $push = $this->getParams($params);
        $push->setGroupName($params['group_name']);
        $result = $this->pushClient->pushApi()->createListMsg($push);
        return $result;
    }

    /**
     * 执行cid批量推
     *
     * @param $params
     * @return mixed
     */
    public function pushListByCid($params)
    {
        $user = new \GTAudienceRequest();
        $user->setIsAsync($params['is_async']);
        $user->setTaskid($params['task_id']);
        $user->setCidList($params['cid_list']);
        $result = $this->pushClient->pushApi()->pushListByCid($user);
        return $result;
    }

    /**
     * 执行别名批量推
     *
     * @param $params
     * @return mixed
     */
    public function pushListByAlias($params)
    {
        $user = new \GTAudienceRequest();
        $user->setIsAsync($params['is_async']);
        $user->setTaskid($params['task_id']);
        $user->setAliasList($params['alias_list']);
        $result = $this->pushClient->pushApi()->pushListByAlias($user);
        return $result;
    }

    /**
     * 执行群推
     *
     * @param $params
     * @return mixed
     */
    public function pushAll($params)
    {
        $push = $this->getParams($params);
        $push->setGroupName($params['group_name']);
        $result = $this->pushClient->pushApi()->pushAll($push);
        return $result;
    }

    /**
     * 根据条件筛选用户推送
     *
     * @param $params
     * @return mixed
     */
    public function pushByTag($params)
    {
        $push = $this->getParams($params);

        $tags = [];
        foreach ($params['tag_list'] as $item) {
            $tag = new \GTCondition();
            $tag->setOptType($item['opt_type']);
            $tag->setKey($item['key']);
            $tag->setValues($item['values']);
            array_push($tags, $tag);
        }
        $push->setTagList($tags);
        $result = $this->pushClient->pushApi()->pushByTag($push);
        return $result;
    }

    /**
     * 使用标签快速推送
     * 该功能需要申请相关套餐
     *
     * @param $params
     * @return mixed
     */
    public function pushByFastCustomTag($params)
    {
        $push = $this->getParams($params);
        $push->setFastCustomTag($params['fast_custom_tag']);
        $result = $this->pushClient->pushApi()->pushByFastCustomTag($push);
        return $result;
    }

    /**
     * 停止任务
     *
     * @param $taskId
     * @return mixed
     */
    public function stopPushApi($taskId)
    {
        $result = $this->pushClient->pushApi()->stopPush($taskId);
        return $result;
    }

    /**
     * 查询定时任务
     *
     * @param $taskId
     * @return mixed
     */
    public function queryScheduleTask($taskId)
    {
        $result = $this->pushClient->pushApi()->queryScheduleTask($taskId);
        return $result;
    }

    /**
     * 删除定时任务
     *
     * @param $taskId
     * @return mixed
     */
    public function deleteScheduleTask($taskId)
    {
        $result = $this->pushClient->pushApi()->deleteScheduleTask($taskId);
        return $result;
    }

    /**
     *
     * @param string $clickType 点击通知后续动作，目前支持以下后续动作:
     *                          intent:打开应用内特定页面
     *                          url：打开网页地址。
     *                          payload：自定义消息内容启动应用。
     *                          payload_custom：自定义消息内容不启动应用。
     *                          startapp：打开应用首页。
     *                          none：纯通知，无后续动作
     * @param string $intent 点击通知打开应用特定页面，长度 ≤ 4096;
     *                          示例：intent:#Intent;component=你的包名/你要打开的 activity 全路径;S.parm1=value1;S.parm2=value2;end
     * @param string $url 点击通知打开链接，长度 ≤ 1024
     * @param string $payload 点击通知加自定义消息，长度 ≤ 3072
     * @return bool
     */
    private function setClickTypeValue($params, $notify)
    {
        $clickType = $params['click_type'];
        $notify->setClickType($clickType);
        switch ($clickType) {
            case 'intent';
                $notify->setIntent($params['intent']);
                break;
            case 'url';
                $notify->setUrl($params['url']);
                break;

            case 'payload';
            case 'payload_custom';
                $notify->setPayload($params['payload']);
                break;

            case 'startapp';
                break;

            default: // none
                break;
        }
        return true;
    }

    private function getParams($params)
    {
        $push = new \GTPushRequest();
        $push->setRequestId(make_uuid());
        //设置setting
        $set = new \GTSettings();
        $set->setTtl(3600000);
//    $set->setSpeed(1000);
//    $set->setScheduleTime(1591794372930);
        $strategy = new \GTStrategy();
        $strategy->setDefault(\GTStrategy::STRATEGY_THIRD_FIRST);
//    $strategy->setIos(GTStrategy::STRATEGY_GT_ONLY);
//    $strategy->setOp(GTStrategy::STRATEGY_THIRD_FIRST);
//    $strategy->setHw(GTStrategy::STRATEGY_THIRD_ONLY);
        $set->setStrategy($strategy);
        $push->setSettings($set);
        //设置PushMessage，
        $message = new \GTPushMessage();
        //通知
        $notify = new \GTNotification();
        $notify->setTitle($params['title']);
        $notify->setBody($params['body']);
        if (isset($params['big_text'])) {
            $notify->setBigText($params['big_text']);
        } elseif (isset($params['big_image'])) { // 与big_text二选一
            $notify->setBigImage($params['big_image']);
        }

//        $notify->setLogo("push.png");
//        $notify->setLogoUrl("http://backend.mall.laravelvip.com/oss/images/system/config/website/backend_logo_0.png");
//        $notify->setChannelId("Default");
//        $notify->setChannelName("Default");
//        $notify->setChannelLevel(4);

        $this->setClickTypeValue($params, $notify);

//        $notify->setNotifyId(22334455);
//        $notify->setRingName("ring_name");
//        $notify->setBadgeAddNum(100);
        $message->setNotification($notify);
        //透传 ，与通知、撤回三选一
//        $message->setTransmission("试试透传12");
        //撤回
        $revoke = new \GTRevoke();
        $revoke->setForce(true);
        $revoke->setOldTaskId("taskId");
//    $message->setRevoke($revoke);
        $push->setPushMessage($message);
//        $message->setDuration("1590547347000-1590633747000");
        //厂商推送消息参数
        $pushChannel = new \GTPushChannel();
        //ios
        $ios = new \GTIos();
        $ios->setType("notify");
        $ios->setAutoBadge("1");
        $ios->setPayload("ios_payload");
        $ios->setApnsCollapseId("apnsCollapseId");
        //aps设置
        $aps = new \GTAps();
        $aps->setContentAvailable(0);
        $aps->setSound("com.gexin.ios.silenc");
        $aps->setCategory("category");
        $aps->setThreadId("threadId");

        $alert = new \GTAlert();
        $alert->setTitle("alert title");
        $alert->setBody("alert body");
        $alert->setActionLocKey("ActionLocKey");
        $alert->setLocKey("LocKey");
        $alert->setLocArgs(array("LocArgs1", "LocArgs2"));
        $alert->setLaunchImage("LaunchImage");
        $alert->setTitleLocKey("TitleLocKey");
        $alert->setTitleLocArgs(array("TitleLocArgs1", "TitleLocArgs2"));
        $alert->setSubtitle("Subtitle");
        $alert->setSubtitleLocKey("SubtitleLocKey");
        $alert->setSubtitleLocArgs(array("subtitleLocArgs1", "subtitleLocArgs2"));
        $aps->setAlert($alert);
        $ios->setAps($aps);

        $multimedia = new \GTMultimedia();
        $multimedia->setUrl("url");
        $multimedia->setType(1);
        $multimedia->setOnlyWifi(false);
        $multimedia2 = new \GTMultimedia();
        $multimedia2->setUrl("url2");
        $multimedia2->setType(2);
        $multimedia2->setOnlyWifi(true);
        $ios->setMultimedia(array($multimedia));
        $ios->addMultimedia($multimedia2);
        $pushChannel->setIos($ios);
        //安卓
//        $android = new \GTAndroid();
//        $ups = new \GTUps();
//    $ups->setTransmission("ups Transmission");
//        $thirdNotification = new \GTThirdNotification();
//        $thirdNotification->setTitle("title" . micro_time());
//        $thirdNotification->setBody("body" . micro_time());
//        $thirdNotification->setClickType(\GTThirdNotification::CLICK_TYPE_URL);
//        $thirdNotification->setIntent("intent:#Intent;component=你的包名/你要打开的 activity 全路径;S.parm1=value1;S.parm2=value2;end");
//        $thirdNotification->setUrl("http://docs.getui.com/getui/server/rest_v2/push/");
//        $thirdNotification->setPayload("payload");
//        $thirdNotification->setNotifyId(456666);
//        $ups->addOption("HW", "badgeAddNum", 1);
//        $ups->addOption("OP", "channel", "Default");
//        $ups->addOption("OP", "aaa", "bbb");
//        $ups->addOption(null, "a", "b");
//
//        $ups->setNotification($thirdNotification);
//        $android->setUps($ups);
//        $pushChannel->setAndroid($android);
//        $push->setPushChannel($pushChannel);

        return $push;
    }
}