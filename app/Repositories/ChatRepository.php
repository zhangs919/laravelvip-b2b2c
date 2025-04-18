<?php

namespace App\Repositories;


use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ChatRepository
{

    /**
     * 发送消息
     *
     * @param $data
     * @return bool
     * @throws \Exception
     */
    public function sendMessage($data)
    {
        DB::beginTransaction();
        try {
            // 发送消息
            DB::table('chat_message')->insert([
                'sender_id' => $data['sender_id'],
                'receiver_id' => $data['receiver_id'],
                'message' => $data['message'],
                'scene_id' => $data['scene_id'],
                'target_id' => $data['target_id'] ?? 0,
                'extra' => $data['extra'] ?? '',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);


            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * 获取聊天记录
     *
     * @param $user_id
     * @param $to_user_id
     * @param array $scene_id
     * @param int $target_id
     * @return \Illuminate\Support\Collection
     */
    public function getConversationMessages($user_id, $to_user_id = 0, $scene_id = [], $target_id = 0)
    {
        $where = [
            ['m.sender_id', $user_id],
        ];
        if ($scene_id) {
            $where[] = ['m.scene_id', $scene_id];
        }
        if (in_array(3, $scene_id) && $target_id) {
            $where[] = ['m.target_id', $target_id];
        }
        $data = DB::table('chat_message as m')
            ->selectRaw('m.*,u.headimg,u.nickname')
            ->leftJoin('user as u', 'u.user_id', '=', 'm.sender_id')
            ->where($where)
            ->where(function ($q) use ($user_id, $to_user_id) {
                $q->where('m.sender_id', $user_id)
                    ->where('m.receiver_id', $to_user_id);
            })
            ->orWhere(function ($q) use ($user_id, $to_user_id) {
                $q->where('m.receiver_id', $user_id)
                    ->where('m.sender_id', $to_user_id);
            })
            ->orderBy('message_id', 'asc')
            ->get();
        foreach ($data as $item) {
            $item->extra = json_decode($item->extra, true);
            if ($item->sender_id == $user_id) {
                // 作为发送者
                $item->type = 1;
            } else {
                // 作为接收者
                $item->type = 2;
                DB::table('chat_message')
                    ->where('message_id', $item->message_id)
                    ->update([
                        'read_at' => Carbon::now()->toDateTimeString(),
                        'updated_at' => Carbon::now()->toDateTimeString()
                    ]);
            }
            $item->headimg = get_image_url($item->headimg, 'headimg');
        }
        return $data;
    }

    public function getConversationList($user_id)
    {
        // 查询会话列表
        $data = DB::table('chat_message')
            ->selectRaw('sender_id,receiver_id')
            ->where('scene_id', [1,2])
            ->where(function ($q) use ($user_id) {
                $q->where('sender_id', $user_id);
            })
            ->orWhere(function ($q) use ($user_id) {
                $q->where('receiver_id', $user_id);
            })
            ->groupBy(['sender_id', 'receiver_id'])
            ->get();
        $rStr = [];
        foreach ($data as $item) {
            if ($item->sender_id == $item->receiver_id) {
                continue;
            }
            if (!in_array($item->receiver_id . ':' . $item->sender_id, $rStr)) {
                $rStr[] = $item->sender_id . ':' . $item->receiver_id;
            }
        }
        $resData = [];
        foreach ($rStr as $v) {
            $vs = explode(':', $v);
            if ($vs[0] == $user_id) {
                $sender_id = $vs[0];
                $receiver_id = $vs[1];
            } else {
                $sender_id = $vs[1];
                $receiver_id = $vs[0];
            }
            $resData[] = [
                'sender_id' => $sender_id,
                'receiver_id' => $receiver_id
            ];
        }

        foreach ($resData as $k => $item) {
            // 获取最新一条聊天记录
            $last_message = DB::table('chat_message')
                ->where(function ($q) use ($user_id, $item) {
                    $q->where('sender_id', $item['sender_id'])->where('receiver_id', $item['receiver_id']);
                })
                ->orWhere(function ($q) use ($user_id, $item) {
                    $q->where('sender_id', $item['receiver_id'])->where('receiver_id', $item['sender_id']);
                })
                ->orderBy('message_id', 'desc')
                ->first();
            if (!empty($last_message)) {
                if ($last_message->sender_id == $user_id) {
                    $o_user_id = $last_message->receiver_id;
                } else {
                    $o_user_id = $last_message->sender_id;
                }
                $o_user = DB::table('user')->select(['nickname', 'headimg'])->where('user_id', $o_user_id)->first();
                $last_message->nickname = $o_user->nickname ?? '';
                $last_message->headimg = $o_user->headimg ?? '';
                $last_message->headimg = get_image_url($last_message->headimg, 'headimg');
            }
            $resData[$k]['last_message'] = $last_message;
        }
        return $resData;
    }


}
