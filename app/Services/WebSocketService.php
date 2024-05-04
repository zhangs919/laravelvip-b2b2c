<?php
namespace App\Services;
use App\Models\FwChatRecord;
use App\Models\Md\DishPay;
use App\Models\RedisString;
use Carbon\Carbon;
use Hhxsv5\LaravelS\Swoole\WebSocketHandlerInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Swoole\Http\Request;
use Swoole\WebSocket\Frame;
use Swoole\WebSocket\Server;
use Illuminate\Support\Facades\Cache;

class WebSocketService implements WebSocketHandlerInterface
{
    /**@var \Swoole\Table $wsTable */
    private $wsTable;
    public function __construct()
    {
        $this->wsTable = app('swoole')->wsTable;
    }

    protected function getConnectSwoole($server,$request){
        $user_id = $request->get["user_id"];//获取user_id
        $service_id = $request->get["service_id"];//获取服务ID
//        $user = Auth::user();
//        $userId = $user ? $user->id : 0; // 0 表示未登录的访客用户
//        Log::debug('$userId:'.$userId);
//        $fd = $this->wsTable->get('uid:' . $user_id);//获取接受者fd
//        if($fd != false){
//            return $server->push($request->fd, "Connected to WebSocket server. #{$request->fd}");
//        }
//         if (!$userId) {
//             // 未登录用户直接断开连接
//             $server->disconnect($request->fd);
//             return;
//         }
//        $rds = new RedisString();
//        $key = 'md_dish_pay_swoole';
//        $result = $rds->get($key);
//        if($result){
//            $pay = json_decode($result,true);
//        }else{
//            $pay = DishPay::select('user_id','md_dishes_id','end_time')->with(['dish'=>function($query){
//                $query->select('id','user_id');
//            }])->where('id',$service_id)->where('state',1)->first();
//            if($pay){
//                $rds->add($key,json_encode($pay,true),3600);
//            }
//        }
//        if(!$pay){//服务数据错误
//            $server->push($request->fd, json_encode(["type"=>"service_id_error"]));
//            $server->disconnect($request->fd);
//            return;
//        }
//        if($user_id != $pay['user_id'] && $user_id != $pay['dish']['user_id']){  //非法的用户结构
//            $server->push($request->fd, json_encode(["type"=>"user_id_error"]));
//            $server->disconnect($request->fd);
//            return;
//        }
//        if($pay['end_time']<Carbon::now()){
//            $server->push($request->fd, json_encode(["type"=>"service_end"]));
//            $server->disconnect($request->fd);
//            return;
//        }
        $usid = $user_id.'_'.$service_id;
        $this->wsTable->set('usid:' . $usid, ['value' => $request->fd]);// 绑定usid到fd的映射
        $this->wsTable->set('fd:' . $request->fd, ['value' => $usid]);// 绑定fd到usid的映射
//        Log::stack(['job'])->debug($usid);
        $server->push($request->fd, json_encode(["type"=>"login_success"]));
    }

    // 场景：WebSocket中UserId与FD绑定
    public function onOpen(Server $server, Request $request)
    {
        $this->getConnectSwoole($server,$request);
    }
    public function onMessage(Server $server, Frame $frame)
    {
        $info = json_decode($frame->data);
        if (!isset($info->type)) {
            return $server->push($frame->fd, json_encode(["type" => "error1"]));//type类型不在
        }
        if($info->command=='dish'){
            switch ($info->type) {
                //心跳包
                case "ping":
                    break;
                //聊天消息
                case "chat_message":
                    $data =  [];
                    if ($info->message->type == "msg") {//文字
                        $type = 1;
                    }elseif($info->message->type == "img") {//图片
                        $type = 2;
                    }elseif($info->message->type == "icon") {//表情符号
                        $type = 3;
                    }elseif($info->message->type == "voice") {//语音
                        $type = 4;
                    }
                    $uid = $this->wsTable->get('fd:' . $frame->fd);//获取发送者ID
//                    var_dump($uid);
                    if ($uid == false){ //发送者已下线
                        return $server->push($frame->fd, json_encode(["type" => "error2"]));//发送消息
                    }
                    $arr = explode('_',$uid['value']);
//                    var_dump($arr);
                    if ($info->message->arrive_user_id == $arr[0]) {//不能发送给自己
                        return $server->push($frame->fd, json_encode(["type" => "error3"]));//发送消息
                    }
                    if(empty($info->message->content)){
                        return $server->push($frame->fd, json_encode(["type" => "error4"]));//发送消息为空
                    }

                    $rds = new RedisString();
                    $key = 'md_dish_pay_swoole_'.$info->message->service_id;
//                    var_dump($info->message->service_id);
                    $result = $rds->get($key);
                    if($result){
                        $pay = json_decode($result,true);
                    }else{
                        $pay = DishPay::select('user_id','md_dishes_id','end_time')->with(['dish'=>function($query){
                            $query->select('id','user_id');
                        }])->where('id',$info->message->service_id)->where('state',1)->first();
                        if($pay){
                            $rds->add($key,json_encode($pay,true),3600);
                        }
                    }
                    if(!$pay){//服务数据错误
                        return $server->push($frame->fd, json_encode(["type"=>"service_id_error"]));
                    }
                    if($info->message->user_id != $pay['user_id'] && $info->message->user_id != $pay['dish']['user_id']){  //非法的用户结构
                        return $server->push($frame->fd, json_encode(["type"=>"user_id_error"]));
                    }
                    if($pay['end_time']<Carbon::now()){
                        return $server->push($frame->fd, json_encode(["type"=>"service_end"]));
                    }
                    if($info->message->type == 'img' || $info->message->type == 'voice'){
                        $data['content'] = pictureHandleUrl($info->message->content); //补全url
                    }else{
                        $data['content'] = $info->message->content;            //消息内容
                    }
                    if($info->message->type == 'img'){
                        $data['width'] = $info->message->width??0;            //宽度
                        $data['height'] = $info->message->height??0;            //高度
                    }
                    if($info->message->type == 'voice'){
                        $data['duration'] = $info->message->duration??0;            //语音时长
                    }
//                    $data['content'] = $info->message->content;            //消息内容
                    $data['username'] = $info->message->username??'名厨用户';          //用户名
                    $data['head_picture'] = isset($info->message->head_picture)&&!empty($info->message->head_picture)?pictureHandleUrl($info->message->head_picture,200,200): 'https://cookhome.club/vendor/userdish/img/userLogo.png';  //头像
                    $data['type'] = $info->message->type;                        //消息类型
                    $data['arrive_user_id'] = $info->message->arrive_user_id;      //接收方用户ID
                    $data['mine'] = $info->message->user_id == $arr[0] ? true : false;   //是否自己发送给自己
                    $data['user_id'] = $info->message->user_id;           //发送方的用户ID
                    $data['service_id'] = $info->message->service_id;//服务ID
                    $data['time'] = time();                //发送时间
                    $data['msg_id'] = $info->message->msg_id??'';               //msg_id
                    if(stripos($data['content'], 'QQ')!==false
                        ||stripos($data['content'], '扣扣')!==false
                        ||stripos($data['content'], '微信')!==false
                        ||stripos($data['content'], '手机')!==false
                    ){
                        $data['content'] = "******";
                    }
                    $fd = $this->wsTable->get('usid:' . $info->message->arrive_user_id.'_'.$info->message->service_id);//获取接受者fd
//                    var_dump($fd);
//                    Log::stack(['job'])->debug($fd);
                    if ($fd == false){ //接受者已下线
                        $data['is_read'] = 0;   //状态，0未读，1已读
                    }else{
                        if($server->isEstablished($fd['value'])){
                            $server->push($fd['value'], json_encode($data));//发送消息
                            $data['is_read'] = 1;   //状态，0未读，1已读
                        }
                    }
                    $succ_data = [
                        "type"=>"success",
                        'msg_id'=>$info->message->msg_id??'',
                        'content'=>$data['content']??'',
                        'duration'=>$data['duration']??0,
                        'width'=>$data['width']??0,
                        'height'=>$data['height']??0,
                        'time'=>time()
                    ];
                    $rs = json_encode($succ_data,JSON_UNESCAPED_UNICODE);
                    Log::stack(['api'])->debug("websocket111:".$rs);
                    $server->push($frame->fd, $rs);//回传发送人
                    //记录聊天记录--后面可存入redis，待通信中断后一次性写入mysql
                    $data['is_read_voice'] = 0;   //音频状态 0未读，1已读   只有类型为语音时才起作用
                    $data['type'] = $type ;
                    $data['msg_id'] = $info->message->msg_id??null;
                    unset($data['mine']);
                    FwChatRecord::create($data);//插入聊天记录
                    break;
                default:
                    return $server->push($frame->fd, json_encode(["type"=>"error5"]));//不存在message_type
                    break;
            }
        }else{
            return $server->push($frame->fd, json_encode(["type" => "error6"]));//command模块不对
        }

//        foreach ($this->wsTable as $key => $row) {
//            if (strpos($key, 'uid:') === 0 && $server->isEstablished($row['value'])) {
//                $content = sprintf('Broadcast: new message "%s" from #%d', $frame->data, $frame->fd);
//                $server->push($row['value'], $content);
//            }
//        }
    }
    public function onClose(Server $server, $fd, $reactorId)
    {
//        var_dump($fd);
        $usid = $this->wsTable->get('fd:' . $fd);
//        var_dump($usid);
        if ($usid !== false) {
            $this->wsTable->del('usid:' . $usid['value']); // 解绑usid映射
        }
        $this->wsTable->del('fd:' . $fd);// 解绑fd映射
        //把redis存的数据写入mysql
        //----------begin------------

        //----------end------------

        $server->push($fd, "Goodbye #{$fd}");
    }
}
