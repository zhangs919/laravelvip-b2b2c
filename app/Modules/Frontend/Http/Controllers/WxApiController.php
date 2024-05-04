<?php

namespace App\Modules\Frontend\Http\Controllers;


use App\Models\WeixinKeyword;
use App\Modules\Base\Http\Controllers\Frontend;
use App\Services\WechatService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WxApiController extends Frontend
{


    public function __construct()
    {
        parent::__construct();


    }

    public function index(Request $request)
    {
        $shop_id = $request->get('shop_id', 0);

        Log::stack(['api'])->info("微信公众号 自定义消息：" . json_encode($request->all()));

        $token = sysconf('token'); // 微信公众号平台 统一使用平台设置的微信公众号 token
		$auth_verify = sysconf('auth_verify');

		if ($shop_id) {
			$auth_verify = shopconf('auth_verify', false, $shop_id);
		}
        $app = WechatService::app($shop_id, $token, $auth_verify);
        $server = $app->getServer();

		$message = $server->getRequestMessage(); // 原始消息
//		$message = $server->getDecryptedMessage(); // 解密后的消息
		Log::stack(['api'])->info("微信公众号 自定义消息 message1：" . json_encode($message));

//        $server->with(function ($message) use ($app, $shop_id) {
//			Log::stack(['api'])->info("微信公众号 自定义消息 message2：" . json_encode($message));
//
//			switch ($message['MsgType']) {
//                case 'event':
//                    if ($message['Event'] == 'subscribe') {
//                        return "感谢您的关注，快去注册，开启愉快的购物之旅吧！<br/><a href='http://".config('lrw.mobile_domain')."/oauth?url=login&shop_id=0&type=mobile_weixin'>点击注册</a>";
//                    }
//                    break;
//                case 'text':
//                    $serverReplyModel = new WeixinKeyword();
////                    $fileModel = new File();
//                    //查找客服回复的对应内容
//                    $result = $serverReplyModel->where('shop_id', $shop_id)->where('key_name', 'like', '%' . $message['Content'] . '%')->first();
//                    if ($result) {
//                        switch ($result->key_type) {
//                            case 0:
//                                // 回复文本消息
//                                return $result->key_content;
//                                break;
//                            case 1:
//                                // 回复图文
//                                $items = [
//                                    new NewsItem([
//                                        'title' => $result->key_title,
//                                        'url' => $result->key_link,
//                                        'description' => $result->key_desc,
//                                        'image' => get_image_url($result->key_img)
//                                    ]),
//                                ];
//                                $news = new News($items);
//                                return $news;
//                                break;
//
//
////                            case 1:
////                                //回复一条文本消息
////                                $content = new Text($result['reply_content']);
////                                $app->customer_service->message($content)->to($message['FromUserName'])->send();
////                                break;
////                            case 2:
////                                //回复一张图片消息
////                                $image_url = $fileModel->getPath($result['reply_content']);
////                                $media_id = $this->getMediaId($image_url);
////                                $content = new Image($media_id);
////                                $app->customer_service->message($content)->to($message['FromUserName'])->send();
////                                break;
////                            case 3:
////                                //回复一条链接消息
////                                $data = [];
////                                $data['touser']= $message['FromUserName'] ;
////                                $data['msgtype'] = 'link';
////                                $data['link']= [
////                                    'title'=>$result['title'],
////                                    'description'=>$result['description'],
////                                    'url'=>$result['url'],
////                                    'thumb_url'=>$fileModel->getPath($result['image_id'])
////                                ];
////                                $content = new Raw(json_encode($data));
////                                $app->customer_service->message($content)->to($message['FromUserName'])->send();
////                                break;
//                        }
//                    } else {
//                        $app->customer_service->message('查询不到匹配的内容')->to($message['FromUserName'])->send();
//                    }
//                    // return '收到文字消息';
//                    break;
//                case 'miniprogrampage':
//                    // return '收到卡包消息';
//                    break;
//                case 'image':
//                    // return '收到图片消息';
//                    break;
//                case 'voice':
//                    // return '收到语音消息';
//                    break;
//                case 'video':
//                    // return '收到视频消息';
//                    break;
//                case 'location':
//                    // return '收到坐标消息';
//                    break;
//                case 'link':
//                    // return '收到链接消息';
//                    break;
//                case 'file':
//                    // return '收到文件消息';
//                    // ... 其它消息
//                default:
//                    // return '收到其它消息';
//                    break;
//            }
//        });
        return $server->serve();
    }




}
