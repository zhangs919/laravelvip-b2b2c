<?php

namespace App\Workerman;

// 心跳间隔10秒
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;
use stdClass;
use Workerman\Timer;

define('HEARTBEAT_TIME', 50);


class Events4431
{

    public static function onWorkerStart($businessWorker)
    {

    }

    // 处理客户端连接
    public static function onConnect($connection)
    {
        global $text_worker;
//        $text_worker = new stdClass();
//        $text_worker->connections = array();//在线用户连接对象
//        $text_worker->uidInfo = array();//在线用户的用户信息
//        $text_worker->uidConnections = array();//在线用户的用户信息

        // echo "New Connection\n";
//        global $text_worker;

        //判断是否设置了UID
        if (!isset($connection->uid)) {
            //给用户分配一个UID
            $connection->uid = make_uuid();
            //保存用户的uid
            $text_worker->uidConnections["{$connection->uid}"] = $connection;
            //向用户返回创建成功的信息
//            $connection->send("用户:[{$connection->uid}] 创建成功");
        }
    }

    public static function onWebSocketConnect($connection, $data)
    {
    }

    // 处理客户端消息
    public static function onMessage($connection, $message)
    {
        global $text_worker;

        // 获取最后上传数据的时间
//        $connection->lastMessageTime = time();
        /*$message = [
            'user_id' => 'system_1', shop_1
            'url' => 'ws://push.laravelvip.cc:8181',
            'type' => 'add_user'
        ];*/
        /*
         * WS_AddSys({ // todo 平台方后台
                'user_id': 'system_32',
                'url': "ws://push.yunmall.xxxx.com:7272",
                'type': "add_user"
            });
         * WS_AddUser({ // todo 网点后台
                'user_id': 'store_4',
                'url': "ws://push.yunmall.xxxx.com:8181",
                'type': "add_user"
            });
         * WS_AddUser({ // todo 商家后台
                'user_id': 'shop_2711',
                'url': "ws://push.yunmall.xxxx.com:4431",
                'type': "add_user"
            });

            WS_AddPoint({ // todo 前端
                user_id: '2711',
                url: "wss://push.xxxx.com:4431",
                type: "add_point_set"
            });

            ws.send({ // todo 前端 直播
                url : url,
                user_id: user_id,
                user_name: user_name,
                room_id: room_id,
                type: 'live_login_set'
            });
            ws.send({
                user_id : result.data.user_id,
                url: "ws://push.yunmall.xxxx.com:7272",
                type: "qrcode_login_set"
            });

         * */

        echo "message:".$message.PHP_EOL;
        $message_arr = json_decode($message, true);
        if (!$message_arr) {
            return;
        }
//
        $user_str = isset($message_arr['user_id']) ? $message_arr['user_id'] : null;
//        $user_name = isset($message_arr['user_name']) ? $message_arr['user_name'] : null;
        $url = isset($message_arr['url']) ? $message_arr['url'] : null;
//        $type = isset($message_arr['type']) ? $message_arr['type'] : null; // 业务类型
//
//        $user_arr = explode('_', $user_str);
//        $current_user_id = end($user_arr);
//        $msg_type = ''; // 初始化消息类型

        $port = explode(':', $url)[2] ?? '';
        echo "port ----".$port."\n";
//        if ($port != 4431) {
//            return;
//        }

        // 返回数据重新设置
//        $message_arr = [];
//        $message_arr['type'] = 'ping';
//        $message_total = 10;
//        if ($message_total > 0) { // 返回消息数量
//            $message_arr['type'] = 'sys_message';
//            $message_arr['msg_counts'] = $message_total;
//            $message_arr['is_tts'] = 1; // 语音合成
//            $message_arr['content'] = "测试语音合成功能！";
//            $message_arr['auto_refresh'] = 1;
//        }
//
//        $message = json_encode($message_arr);
//        echo $message."\n";
//        $connection->send($message);

        echo $user_str."\n";

        if (Str::contains($user_str, 'shop')) {
//            // 商家后台
//            echo $user_str;
            echo "22222222\n";
            self::shopMessage($connection, $message);

        } else {
            // 用户端
            echo "3333333\n";

            self::userMessage($connection, $message);

        }
//        self::userMessage($connection, $message);

//        $res_message_arr = [];
//        if (Str::contains($user_str, 'system')) {
//            // 平台方后台
//            echo "11111111111111\n";
//            self::systemMessage($connection, $message);
//
//        } elseif (Str::contains($user_str, 'shop')) {
//            // 商家后台
////            echo $user_str;
//            echo "22222222\n";
//            self::shopMessage($connection, $message);
//
//        } elseif (Str::contains($user_str, 'store')) {
//            // 门店后台
//            self::storeMessage($connection, $message);
//
//        } else {
//            // 用户端
//            echo "3333333\n";
//
//            self::userMessage($connection, $message);
//
//        }


//        $message = json_encode($res_message_arr);
//        echo $message."\n";
//        $connection->send($message);
//        $message = json_encode($message_arr);
//        echo $message."\n";
//        $connection->send($message);
    }

    /**
     * 平台方后台
     */
    private static function systemMessage($connection, $message)
    {
        global $text_worker;

        // 获取最后上传数据的时间
        $connection->lastMessageTime = time();

        $message_arr = json_decode($message, true);
        if (!$message_arr) {
            return;
        }

        $user_str = isset($message_arr['user_id']) ? $message_arr['user_id'] : null;
        $user_name = isset($message_arr['user_name']) ? $message_arr['user_name'] : null;
        $url = isset($message_arr['url']) ? $message_arr['url'] : null;
        $type = isset($message_arr['type']) ? $message_arr['type'] : null; // 业务类型

        $user_arr = explode('_', $user_str);
        $current_user_id = end($user_arr);
        $msg_type = ''; // 初始化消息类型

        $res_message_arr['type'] = 'pong';
        switch ($type) {
            case 'add_user': //
                // 订单自动打印
//                $res_message_arr['type'] = 'ping';
//                $res_message_arr['is_auto_print'] = true;
//                $res_message_arr['order_id'] = 1;


                // 新订单提醒

//                $res_message_arr['type'] = 'sys_message';
//                $res_message_arr['msg_counts'] = 10; // 消息数量
////                $res_message_arr['content'] = '扫码成功，请核销！';
//                $res_message_arr['content'] = '您有新的订单，请及时查收！';
//                $res_message_arr['auto_refresh'] = 1; // 自动刷新页面
//                $res_message_arr['is_tts'] = 1; // 语音
//                $res_message_arr['link'] = '/goods/image/list'; // 跳转url

                break;

            default:
                break;
        }

        $message = json_encode($res_message_arr);
        echo $message;
        $connection->send($message);
    }

    /**
     * 商家后台
     */
    private static function shopMessage($connection, $message)
    {
        global $text_worker;

        // 获取最后上传数据的时间
        $connection->lastMessageTime = time();

        $message_arr = json_decode($message, true);
        if (!$message_arr) {
            return;
        }

        $user_str = isset($message_arr['user_id']) ? $message_arr['user_id'] : null;
        $user_name = isset($message_arr['user_name']) ? $message_arr['user_name'] : null;
        $url = isset($message_arr['url']) ? $message_arr['url'] : null;
        $type = isset($message_arr['type']) ? $message_arr['type'] : null; // 业务类型

        $user_arr = explode('_', $user_str);
        $current_user_id = end($user_arr);
        $msg_type = ''; // 初始化消息类型

        $res_message_arr['type'] = 'pong';
        switch ($type) {
            case 'add_user': //
                // 订单自动打印
//                $res_message_arr['type'] = 'ping';
//                $res_message_arr['is_auto_print'] = true;
//                $res_message_arr['order_id'] = 1;


                // 新订单提醒

//                $res_message_arr['type'] = 'sys_message';
//                $res_message_arr['msg_counts'] = 10; // 消息数量
////                $res_message_arr['content'] = '扫码成功，请核销！';
//                $res_message_arr['content'] = '您有新的订单，请及时查收！';
//                $res_message_arr['auto_refresh'] = 1; // 自动刷新页面
//                $res_message_arr['is_tts'] = 1; // 语音
//                $res_message_arr['link'] = '/trade/order/list'; // 跳转url

                break;

            default:
                break;
        }

        $message = json_encode($res_message_arr);
        echo $message;
        $connection->send($message);
    }

    /**
     * 门店后台
     */
    private static function storeMessage($conection, $message)
    {

    }

    /**
     * 用户端
     */
    private static function userMessage($connection, $message)
    {
        global $text_worker;

        // 获取最后上传数据的时间
        $connection->lastMessageTime = time();

        $message_arr = json_decode($message, true);
        if (!$message_arr) {
            return;
        }

        $user_str = isset($message_arr['user_id']) ? $message_arr['user_id'] : null;
        $user_name = isset($message_arr['user_name']) ? $message_arr['user_name'] : null;
        $url = isset($message_arr['url']) ? $message_arr['url'] : null;
        $type = isset($message_arr['type']) ? $message_arr['type'] : null; // 业务类型

        $user_arr = explode('_', $user_str);
        $current_user_id = end($user_arr);
        $msg_type = ''; // 初始化消息类型

        $res_message_arr['type'] = 'ping';
        $res_message_arr['message'] = '';

        if ($type == 'qrcode_login_set') {
            // PC端扫码登录

        }
        if ($type == 'add_point_set') {
            // 增加积分
            $res_message_arr['type'] = 'add_point_set';
            $res_message_arr['message'] = [
                'point' => 100,
                'user_id' => $current_user_id
            ];
        }


        // 前端
        // content: "请主播讲解一下1号宝贝"
        //headimg: "http://image.laravelvip.com/images/user/1/2019/05/29/15591391722010.jpeg"
        //room_id: "1"
        //type: "live_say_set"
        //user_id: "1"
        //user_name: "1"

        //content: "aa"
        //from_user_id: "qi58a8bq68i927nnu85sreq61u"
        //from_user_name: "游客_1072852710"
        //room_id: "260"
        //time: "2020-10-05 06:19:25"
        //to_user_id: 0
        //type: "live_say_set"
        //user_headimg: "https://xxxx/images/746/system/config/default_image/default_user_portrait_0.png"


        if ($type == 'live_say_set') { // 用户对话

//                $message_arr['type'] = $type;
//                $message_arr['from_user_id'] = 2; // 卖家id
//                $message_arr['from_user_name'] = 'lrw'; // 卖家用户名
//                $message_arr['content'] = "卖家回复内容....."; // 卖家回复内容

            $res_message_arr['content'] = $message_arr['content'];
            $res_message_arr['from_user_id'] = $current_user_id;
            $res_message_arr['from_user_name'] = $user_name;
            $res_message_arr['room_id'] = $message_arr['room_id'] ?? 0;
            $res_message_arr['time'] = format_time(time());
            $res_message_arr['to_user_id'] = 0;
            $res_message_arr['type'] = 'live_say_set';
            $res_message_arr['user_headimg'] = $message_arr['user_headimg'] ?? '';

            if ($res_message_arr['to_user_id'] == 0) { // 全频道广播
                //向所有用户发送数据
                $message = json_encode($res_message_arr);
                foreach ($text_worker->uidConnections as $conn) {
                    $conn->send($message);
                }
            } else {
                // 向指定用户发送数据 如：直播时，给卖家发商品讲解消息
                $message = json_encode($res_message_arr);
                $connection->send($message);
            }
        }

        if ($type == 'live_login_set') { // 进入直播间
            // todo 用户进入直播间 获取直播人数
            //room_id: "71"
            //total_num_init: "6"
            //type: "live_ping"
            //url: "wss://push.xxxx.com:4431/"
            //user_headimg: "https://xxxx/images/system/config/default_image/default_user_portrait_0.png"
            //user_id: "2711"
            //user_name: "qdm"
//                $message_arr['room_id'] = $message_arr['room_id'] ?? 0;
//                $message_arr['total_num_init'] = 999; // 观看总人数
//                $message_arr['type'] = 'live_ping';
//                $message_arr['user_headimg'] = $message_arr['user_headimg'] ?? '';
//                $message_arr['user_id'] = $current_user_id;
//                $message_arr['user_name'] = $user_name;

            // online_ids: ["2711"]
            //online_num: 1
            //room_id: "71"
            //total_num: 7
            //type: "live_login_set"
            //url: "wss://push.xxxx.com:4431/"
            //user_headimg: "https://xxxx/images/system/config/default_image/default_user_portrait_0.png"
            //user_id: "2711"
            //user_name: "qdm"

            // online_ids: ["2711"]
            //online_num: 1
            //room_id: "260"
            //total_num: 12
            //type: "live_login_set"
            //url: "wss://push.xxxx.com:4431/"
            //user_headimg: "https://xxxx/images/746/system/config/default_image/default_user_portrait_0.png"
            //user_id: "qi58a8bq68i927nnu85sreq61u"
            //user_name: "游客_1072852710"

            $room_id = $message_arr['room_id'];


            //判断用户信息是否存在
//            if(empty($message_arr['user_id'])){
//                $connection->send("{'type':'error','message':'非法请求'}");
//                return $connection->close();
//            }
//            //判断用户是否已经登录了
//            $user_ids=array_column($text_worker->uidInfo,"user_id");
//            if(in_array($message_arr['user_id'],$user_ids)){
//                $connection->send("{'type':'error','message':'你在其它地方已登录'}");
//                return $connection->close();
//            }
            //存储用户信息
            $text_worker->uidInfo["{$connection->uid}"] = array(
                "room_id" => $room_id,
                "user_id" => $message_arr['user_id'],
                "user_name" => htmlspecialchars($message_arr['user_name']),
                "user_headimg" => $message_arr['user_headimg'],
                "create_time" => date("Y-m-d H:i"),
            );
            $redis = Redis::connection();
            // 是否在线
            $ol_key = 'live_online_ids_' . $room_id;
            $is_online = $redis->zscore($ol_key, $current_user_id);
            if (!empty($is_online)) {    // 不在线，移除当前客户端
                $redis->zrem($ol_key, $current_user_id);
            }
            $redis->zadd($ol_key, time(), $current_user_id);
            $online_ids = $redis->zrange($ol_key, 0, -1) ?? [];
            $online_num = $redis->zcard($ol_key);

            $res_message_arr['online_ids'] = array_reverse($online_ids); // 获取在线用户id
            $res_message_arr['online_num'] = $online_num; // 实时在线人数
            $res_message_arr['room_id'] = $message_arr['room_id'];
            $res_message_arr['total_num'] = $message_arr['total_num_init']; // 观看总人数
            $res_message_arr['type'] = $message_arr['type'];
            $res_message_arr['url'] = $message_arr['url'];
            $res_message_arr['user_headimg'] = $message_arr['user_headimg'] ?? '';
            $res_message_arr['user_id'] = $current_user_id;
            $res_message_arr['user_name'] = $user_name;

            //向所有用户发送数据
            $message = json_encode($res_message_arr);
            echo "向所有用户发送数据\n";
            foreach ($text_worker->uidConnections as $conn) {
                echo "发送数据 $conn->uid \n";
                $conn->send($message);
            }
            echo "发送数据完成\n";
        }

        $res_message_arr = [
            'type' => 'pong'
        ];
        $message = json_encode($res_message_arr);
        $connection->send($message);

    }


    // 处理客户端断开
    public static function onClose($connection)
    {
        echo "Connection Closed\n";
        echo "------" . $connection->uid . "\n";
        global $text_worker;
//        $current_user_id = $text_worker->uidInfo[$connection->uid]['user_id'] ?? "";
//        $user_name = $text_worker->uidInfo[$connection->uid]['user_name'] ?? "";
        $uidInfo = $text_worker->uidInfo[$connection->uid] ?? [];

        unset($text_worker->uidConnections["{$connection->uid}"]);
        unset($text_worker->uidInfo["{$connection->uid}"]);

        // 是否在线
        if (!empty($uidInfo)) {
            $return_data = array(
                "type" => "logout",
                "uid" => $connection->uid,
                "user_name" => $uidInfo['user_name'],
                "create_time" => date("Y-m-d H:i:s"),
            );
            foreach ($text_worker->uidConnections as $conn) {
                $conn->send(json_encode($return_data));
            }

            echo "--- ".json_encode($uidInfo)."\n";
            $room_id = $uidInfo['room_id'];
            echo "room id - ".$room_id."\n";
            $redis = Redis::connection();
            $ol_key = 'live_online_ids_'.$room_id;
            $is_online = $redis->zscore($ol_key, $uidInfo['user_id']);
            if (!empty($is_online)) {    // 不在线，移除当前客户端
                $redis->zrem($ol_key, $uidInfo['user_id']);
            }
        }

    }
}
