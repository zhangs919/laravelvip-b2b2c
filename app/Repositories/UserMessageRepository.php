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
// | Date:2018-11-02
// | Description: 会员消息/店铺消息
// +----------------------------------------------------------------------

namespace App\Repositories;


use App\Models\UserMessage;
use Illuminate\Support\Facades\DB;

/**
 * 会员消息/店铺消息模型
 *
 * Class MessageRepository
 * @package App\Repositories
 */
class UserMessageRepository
{
    use BaseRepository;

    protected $model;

    public function __construct()
    {
        $this->model = new UserMessage();
    }


    /**
     * 获取消息列表
     *
     * @param int $type 消息类型 1-会员消息 2-店铺消息
     * @param int $user_id 会员id
     * @param int $status 消息是否已读 0-未读 1-已读
     * @return int
     */
    public function getMessageCount($type,$user_id = 0, $status = 0)
    {
        // 列表
        $where[] = ['receiver', $user_id];
        $where[] = ['type', $type];
        $where[] = ['status', $status];

        return DB::table('user_message')
            ->where($where)
            ->join('message', 'user_message.msg_id','=','message.msg_id','left')
            ->select(['user_message.*','message.*'])
            ->count();
    }

    /**
     * 设置消息已读
     *
     * @param $msg_id
     * @param $user_id
     * @return mixed
     */
    public function setRead($msg_id, $user_id)
    {
        if (!is_array($msg_id)) {
            $msg_id = [$msg_id];
        }
        return $this->model->whereIn('msg_id', $msg_id)->where([['receiver', $user_id]])->update(['read_time'=>time(),'status'=>1]);
    }
}