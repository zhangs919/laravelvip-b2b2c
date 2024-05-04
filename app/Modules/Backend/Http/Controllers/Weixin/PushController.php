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
// | Date:2020-08-09
// | Description: 微信关键词回复
// +----------------------------------------------------------------------

namespace App\Modules\Backend\Http\Controllers\Weixin;

use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\WeixinMaterialGroupRepository;
use App\Repositories\WeixinMaterialRepository;
use App\Services\WechatService;
use Illuminate\Http\Request;

class PushController extends Backend
{


    private $links = [
        ['url' => 'weixin/push/index', 'text' => '消息推送'],
    ];

    protected $weixinMaterial;
    protected $weixinMaterialGroup;

    public function __construct(WeixinMaterialRepository $weixinMaterial, WeixinMaterialGroupRepository $weixinMaterialGroup)
    {
        parent::__construct();

        $this->weixinMaterial = $weixinMaterial;
        $this->weixinMaterialGroup = $weixinMaterialGroup;
    }

    /**
     * 消息推送
     * 
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function index(Request $request)
    {
        $title = '消息推送';
        $fixed_title = '消息推送 - '. $title;

        $this->sublink($this->links, 'index');

        $action_span = [

        ];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        // 获取数据
        if ($request->method() == 'POST') {
            $msgType = $request->post('msg_type',1); // 推送类型 1-图文 2-文字
            $materialId = $request->post('material_id',0);// 素材id
            $content = $request->post('content');// 文字推送内容

            // 对接微信消息群发接口
            $app = WechatService::app();
            if ($msgType == 1) {
                // 图文 根据素材id获取素材信息并新增到微信公众号素材库，获取到mediaId

                $articles = [];
                $result = $app->material->uploadArticle($articles);

                // 获取图文mediaId
                $mediaId = '';

                // 推送消息
                try {
                    $ret = $app->broadcasting->sendNews($mediaId);
                } catch (\Exception $e) {
                    flash('error', $e->getMessage());
                    return back();
                }

            } else {
                // 文字
                try {
                    $ret = $app->broadcasting->sendText($content);
                } catch (\Exception $e) {
                    flash('error', $e->getMessage());
                    return back();
                }
            }

            flash('success', '消息推送成功');
            return back();
        }

        $compact = compact('title');
        
        return view('weixin.push.index', $compact);
    }

    /**
     * 选择素材
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Throwable
     */
    public function selectMaterial(Request $request)
    {
        $type = $request->get('type',0);

        if ($request->method() == 'POST') {
            $id = $request->post('id');
            $info = $this->weixinMaterialGroup->getInfo($id);


            $render = view('weixin.push.selected_material', compact('info','type'))->render();

            return result(0, $render,'', ['material_id'=>$id]);
        }

        $render = view('weixin.push.select_material_'.$type)->render();

        return result(0, $render);
    }

    /**
     * 新建图文素材
     */
    public function addMaterial()
    {
        // todo

    }
   
}