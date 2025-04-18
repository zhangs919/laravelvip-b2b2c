<?php

namespace App\Modules\Frontend\Http\Controllers\User;

use App\Modules\Base\Http\Controllers\Frontend;
use App\Repositories\ChatRepository;
use GatewayWorker\Lib\Gateway;
use Illuminate\Http\Request;


/**
 * 聊天控制器
 *
 * Class ChatController
 * @package App\Modules\Frontend\Http\Controllers\User
 */
class ChatController extends Frontend
{
    protected $chat;

    public function __construct(
        ChatRepository $chat
    )
    {
        parent::__construct();

        $this->chat = $chat;
    }

    /**
     * 获取会话列表
     *
     * @param ChatRepository $chatRep
     * @return \Illuminate\Http\JsonResponse
     */
    public function getConversationList(Request $request)
    {

        $data = $this->chat->getConversationList($this->user_id);
        return result(0, $data, '获取成功');
    }

    /**
     * 查询某个会话的聊天信息列表
     *
     * @param ChatRepository $chatRep
     * @return \Illuminate\Http\JsonResponse
     */
    public function getConversationMessages(Request $request)
    {
        $to_user_id = $request->input('to_user_id', 0);
        $scene_id = $request->input('scene_id', '1,2');
        $scene_id = explode(',', $scene_id);

        $target_id = $request->input('target_id', 0);
        if (!$to_user_id && $scene_id == '1,2') {
            return result(-1, [], '接收者ID无效');
        }
        $data = $this->chat->getConversationMessages($this->user_id, $to_user_id, $scene_id, $target_id);
        return result(0, $data, '获取成功');
    }

    /**
     * client_id与uid绑定
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function bindClientId(Request $request)
    {
        $client_id = $request->input('client_id');
        $group_id = $request->input('group_id');
        // 假设用户已经登录，用户uid和群组id在session中
        $uid = $this->user_id;
        // client_id与uid绑定
        // 设置GatewayWorker服务的Register服务ip和端口，请根据实际情况改成实际值(ip不能是0.0.0.0)
        Gateway::$registerAddress = '127.0.0.1:1238';
        Gateway::bindUid($client_id, $uid);
        if ($group_id) {
            // 加入某个群组（可调用多次加入多个群组）
            Gateway::joinGroup($client_id, 'room_'.$group_id);
        }

        return result(0, [], '绑定成功');
    }
}
