<?php


namespace App\Modules\Frontend\Http\Controllers\WebSocket;


use App\Http\Controllers\Controller;
use App\Jobs\CreateChatMessageJob;
use Carbon\Carbon;
use GatewayWorker\Lib\Gateway;
use Illuminate\Support\Facades\Log;

class WebSocketController extends Controller
{

    public static function onConnect($client_id)
    {
        Gateway::sendToClient($client_id, json_encode(
            [
                'client_id' => $client_id,
                'msg_type' => 0,
            ], 320));
    }

    public static function onMessage($client_id, $data)
    {
        if (!is_array($data)) {
            $data = json_decode($data, true);
        }
        // 业务场景
        $scene_id = isset($data['scene_id']) ? $data['scene_id'] : 1;
        $sender_id = isset($data['sender_id']) ? $data['sender_id'] : 0;
        $nickname = isset($data['nickname']) ? $data['nickname'] : null;

        $res_message_arr['msg_type'] = 4;
        $res_message_arr['message'] = '';
        $extra = []; // 额外信息
        $msg_scene_id = 0;

        switch ($data['type']) {
            case 0:
                //绑定uid,更改上线状态,通知该用户所有的好友
//                $extra = $data['extra'] ?? [];
//                $group = !empty($extra['room_id']) ? 'room' . $extra['room_id'] : '';
//                switch ($scene_id) {
//                    case 1: // 绑定uid
//                        Gateway::bindUid($client_id, $sender_id);
//
//                        break;
//                    case 2: // 解绑uid
//                        Gateway::unbindUid($client_id, $sender_id);
//
//                        break;
//                    case 3: // 加入分组
//                        Gateway::bindUid($client_id, $sender_id);
//                        Gateway::joinGroup($client_id, $group);
//
//                        break;
//                    case 4: // 离开分组
//                        Gateway::leaveGroup($client_id, $group);
//
//                        break;
//                    case 5: // 解散分组
//                        Gateway::ungroup($group);
//
//                        break;
//
//                    default:
//
//                        break;
//                }

//                $res_message_arr['scene_id'] = $scene_id;
//                $res_message_arr['sender_id'] = $sender_id; // 发送消息用户ID
//                $res_message_arr['message'] = $data['message'];
//                $res_message_arr['extra'] = $extra;
//                $res_message_arr['receiver_id'] = 0; // 消息接收用户ID 前端根据这个用户ID来判断是否发给当前登录用户
//                $res_message_arr['msg_type'] = 5;
//                self::sendAll($res_message_arr);

                break;
            case 1:
                //点对点消息

                // 业务场景 1-普通消息 2-邀请同行(司机发送包含行程详情页的卡片消息给乘客) 3-私信消息 4-直播弹幕
                switch ($scene_id) {
                    case 1: // 普通消息
                        $msg_scene_id = 1;
                        break;
                    case 2: // 邀请同行(司机发送包含行程详情页的卡片消息给乘客)
                        $extra = $data['extra'] ?? [];
                        $msg_scene_id = 2;
                        break;

                    case 3: // 私信消息
                        $msg_scene_id = 3;
                        break;

                    case 4: // 乘客位置(乘客发送包含当前位置经纬度信息的卡片消息给司机)
                        $extra = $data['extra'] ?? [];
                        $msg_scene_id = 4;
                        break;

                    default:
                        $msg_scene_id = 0;
                        break;
                }
                if ($sender_id == $data['receiver_id']) {
                    break;
                }

                $res_message_arr['message_id'] = 0;
                $res_message_arr['scene_id'] = $scene_id;
                $res_message_arr['sender_id'] = $sender_id; // 发送消息用户ID
                $res_message_arr['message'] = $data['message'];
                $res_message_arr['extra'] = $extra;
                $res_message_arr['read_at'] = null;
                $res_message_arr['deleted_at'] = null;
                $res_message_arr['created_at'] = Carbon::now()->toDateTimeString();
                $res_message_arr['updated_at'] = Carbon::now()->toDateTimeString();
                $res_message_arr['type'] = 2; // 消息类型 1-作为发送者 2-作为接收者
                $res_message_arr['headimg'] = get_image_url($data['headimg'], 'headimg');
                $res_message_arr['nickname'] = $nickname; // 发送消息用户名
                $res_message_arr['receiver_id'] = $data['receiver_id'] ?? 0; // 消息接收用户ID 前端根据这个用户ID来判断是否发给当前登录用户
                $res_message_arr['msg_type'] = 1;

//                self::sendUid($res_message_arr['receiver_id'], $res_message_arr);
                self::sendAll($res_message_arr);

                // 将消息保存数据库 通过队列任务保存
                $insert = [
                    'scene_id' => $msg_scene_id,
                    'sender_id' => $res_message_arr['sender_id'],
                    'receiver_id' => $res_message_arr['receiver_id'],
                    'message' => $res_message_arr['message'],
                    'extra' => !empty($extra) ? json_encode($extra) : '',
                ];
                dispatch(new CreateChatMessageJob($insert));

                break;
            case 4:
                //心跳 忽略
                break;
            case 5: // 司机推送
                // 业务场景 1-出发接乘客 2-送乘客 3-到达目的地
                $extra = $data['extra'] ?? [];
                switch ($scene_id) {
                    case 1: // 出发接乘客

                        break;
                    case 2: // 送乘客

                        break;
                    case 3: // 到达目的地

                        break;

                    default:

                        break;
                }

                $res_message_arr['scene_id'] = $scene_id;
                $res_message_arr['sender_id'] = $sender_id; // 发送消息用户ID
                $res_message_arr['message'] = $data['message'];
                $res_message_arr['extra'] = $extra;
                $res_message_arr['type'] = 2; // 消息类型 1-作为发送者 2-作为接收者
                $res_message_arr['receiver_id'] = $data['receiver_id'] ?? []; // 消息接收用户ID 前端根据这个用户ID来判断是否发给当前登录用户
                $res_message_arr['msg_type'] = 5;

                self::sendAll($res_message_arr);

                break;
            case 6: // 直播发消息
                // 业务场景 1-进入直播间 2-发送直播弹幕
                $extra = $data['extra'] ?? [];
                $target_id = $extra['target_id'] ?? 0;
                $total_num_init = $extra['total_num_init'] ?? 0;
                $group = $target_id ? 'room_' . $target_id : '';

                switch ($scene_id) {
                    case 1: // 进入直播间
                        $extra['online_ids'] = array_values(Gateway::getUidListByGroup($group)); // 获取在线用户id
                        $extra['online_num'] = Gateway::getClientIdCountByGroup($group); // 实时在线人数
                        $extra['total_num'] = $total_num_init + 1; // 观看总人数

                        break;
                    case 2: // 用户发送直播弹幕
                        $msg_scene_id = 5;
                        break;

                    default:

                        break;
                }

                $res_message_arr['scene_id'] = $scene_id;
                $res_message_arr['sender_id'] = $sender_id; // 发送消息用户ID
                $res_message_arr['message'] = $data['message'];
                $res_message_arr['extra'] = $extra;
                $res_message_arr['receiver_id'] = 0; // 消息接收用户ID 直播间全部成员
                $res_message_arr['msg_type'] = 6;
                echo $group . "\n";
                echo json_encode($res_message_arr);

                Log::info(json_encode($res_message_arr));

                self::sendGroup($group, $res_message_arr);

                // 将消息保存数据库 通过队列任务保存
                $insert = [
                    'scene_id' => $msg_scene_id,
                    'sender_id' => $res_message_arr['sender_id'],
                    'receiver_id' => $res_message_arr['receiver_id'],
                    'target_id' => $target_id,
                    'message' => $res_message_arr['message'],
                    'extra' => !empty($extra) ? json_encode($extra) : '',
                ];
                dispatch(new CreateChatMessageJob($insert));

                break;
            case 7:
                //

            default :

        }
    }

    public static function sendUid($uid, $data)
    {
        Gateway::sendToUid($uid, json_encode($data, 320));
    }

    public static function sendAll($data)
    {
        Gateway::sendToAll(json_encode($data, 320));
    }

    public static function sendGroup($group, $data)
    {
        Gateway::sendToGroup($group, json_encode($data, 320));
    }

    public static function onClose($client_id)
    {

    }
}
