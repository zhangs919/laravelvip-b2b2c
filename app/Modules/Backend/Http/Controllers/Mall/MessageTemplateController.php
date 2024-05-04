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
// | Date:2018-08-10
// | Description:消息模板管理
// +----------------------------------------------------------------------

namespace App\Modules\Backend\Http\Controllers\Mall;


use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\MessageTemplateRepository;
use App\Services\WechatService;
use Illuminate\Http\Request;

class MessageTemplateController extends Backend
{

    private $links = [
        ['url' => 'mall/message-template/list?type=0', 'text' => '商家模板列表'],
        ['url' => 'mall/message-template/list?type=1', 'text' => '用户模板列表'],
        ['url' => 'mall/message-template/list?type=2', 'text' => '平台模板列表'],
        ['url' => 'mall/message-template/list?type=3', 'text' => '网点模板列表'],
    ];

    private $add_links = [
        ['url' => 'mall/message-template/list?type=0', 'text' => '商家模板列表'],
        ['url' => 'mall/message-template/add', 'text' => '添加消息模板'],
    ];

    private $set_links = [
        ['url' => 'mall/message-template/set?type=sys', 'text' => '站内信模板'],
        ['url' => 'mall/message-template/set?type=sms', 'text' => '短信模板'],
        ['url' => 'mall/message-template/set?type=wx', 'text' => '微信模板'],
        ['url' => 'mall/message-template/set?type=email', 'text' => '邮件模板'],
    ];

    private $sms_test_links = [
        ['url' => 'mall/message-template/set', 'text' => '设置短信模板'],
        ['url' => 'mall/message-template/sms-test', 'text' => '测试短信模板'],
    ];

    protected $messageTemplate;


    public function __construct(MessageTemplateRepository $messageTemplate)
    {
        parent::__construct();

        $this->messageTemplate = $messageTemplate;

    }

    public function lists(Request $request)
    {
        $type = (int)$request->get('type', 0);

        $title = $this->links[$type]['text'];
        $fixed_title = '消息模板 - '.$title;


        $this->sublink($this->links, $type, 'type');

        // todo 该按钮在程序完成后 注释掉
        $action_span = [
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加消息模板'
            ],
        ];

        if ($type == 0) {
            $explain_panel = [
                '商家消息模板，主要用于需要操作或有必要通知的商户类信息，短信、邮件需要用户设置正确店长手机号和邮箱才能正常接收',
                '消息可以以四种形式发送，站内信、短信、邮箱、微信。平台可以选择开启一种或多种通知方式为商家发送消息',
                '在设置消息模板时不能添加新的变量函数，但可以修改变量函数的位置',
                '微信消息仅发送给关注商城微信公众号的商家',
            ];
        } elseif ($type == 1) {
            $explain_panel = [
                '用户消息模板，主要用于需要操作或有必要通知的会员信息，短信、邮件需要用户设置正确号码之后才能正常接收',
                '消息可以以四种形式发送，站内信、短信、邮件、微信；平台可以选择开启一种或多种通知方式为用户发送消息',
                '在设置消息模板时不能添加新的变量函数，但可以修改变量函数的位置',
                '微信消息仅发送给关注商城微信公众号的会员',
            ];
        } elseif ($type == 2) {
            $explain_panel = [
                '平台消息模板，主要用于需要操作或有必要通知的平台类信息，短信、邮件需要用户设置正确平台管理员手机号和邮箱才能正常接收',
                '消息可以以两种形式发送，短信、邮箱。平台可以选择开启一种或多种通知方式来接收消息',
                '在设置消息模板时不能添加新的变量函数，但可以修改变量函数的位置',
            ];
        } elseif ($type == 3) {
            $explain_panel = [
                '网点消息模板，主要用于需要操作或有必要通知的网点信息，短信、邮件需要网点管理员设置正确号码之后才能正常接收',
                '消息可以以四种形式发送，站内信、短信、邮件、微信；平台可以选择开启一种或多种通知方式为网点管理员发送消息',
                '在设置消息模板时不能添加新的变量函数，但可以修改变量函数的位置',
                '微信消息仅发送给关注商城微信公众号的会员'
            ];
        }else {
            $explain_panel = [];
        }

        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();
        $where = [];
        $where[] = ['type', $type]; // 模板类型

        // 搜索条件
        $search_arr = ['name'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'name') {
                    $where[] = ['name', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'id',
            'sortorder' => 'desc',
        ];
        list($list, $total) = $this->messageTemplate->getList($condition);
        $pageHtml = pagination($total);

        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('mall.message-template.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('mall.message-template.list', $compact);
    }



    public function add(Request $request)
    {
        $title = '添加消息模板';
        $this->sublink($this->add_links, 'add');

//        $id = $request->get('id', 0);
//
//        if ($id) {
//            // 更新操作
//            $extra = '?id='.$id;
//            $info = $this->messageTemplate->getById($id);
//            view()->share('info', $info);
//            $title = '编辑消息模板';
//            $this->sublink($this->links, 'edit', '', $extra, 'add');
//
//        }

        $fixed_title = '消息模板 - '.$title;

        $action_span = [
            [
                'url' => 'list?type=0',
                'icon' => 'fa-reply',
                'text' => '返回消息模板列表'
            ]
        ];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        return view('mall.message-template.add', compact('title'));
    }

//    public function edit(Request $request)
//    {
//        return $this->add($request);
//    }

    public function set(Request $request)
    {

        $id = $request->get('id', 0);
        $type = $request->get('type', 'sys');

        $info = $this->messageTemplate->getById($id);

        if ($info->type == 0) {
            $sT = '商家模板';
        } elseif ($info->type == 1) {
            $sT = '用户模板';
        } elseif ($info->type == 2) {
            $sT = '平台模板';
        } elseif ($info->type == 3) {
            $sT = '网点模板';
        }else {
            $sT = '';
        }
        $title = $sT.'设置';
        $fixed_title = '消息模板 - '.$title;
        $extra = '&id='.$id;
        $this->sublink($this->set_links, $type, 'type', $extra);

        $action_span[] = [
            'url' => 'list?type='.$info->type,
            'icon' => 'fa-reply',
            'text' => '返回'.$sT.'列表'
        ];
        if ($type == 'sms') {
            $action_span[] = [
                'url' => 'sms-test?id='.$id,
                'icon' => 'fa-plus',
                'text' => '测试短信'
            ];
        }
        $explain_panel = [
            '模板内容格式：<br>- 不支持营销短信、全变量短信模板；例如：您好，${msg}<br>- 变量格式如${name}，不能使用${email}、${mobile}、${id}、${nick}、${site}<br>- 请勿在变量中添加特殊符号，如： , . # / : - ，。<br>- 如有链接，请将链接地址写于模板内容中，便于核实<br>- 模板内容无需添加签名，内容首尾不能添加[]、【】符号，调用接口时传入签名即可',
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        // 获取微信模板消息列表
        $app = WechatService::app();
        //{
        //     "template_list": [{
        //      "template_id": "iPk5sOIt5X_flOVKn5GrTFpncEYTojx6ddbt8WYoV5s",
        //      "title": "领取奖金提醒",
        //      "primary_industry": "IT科技",
        //      "deputy_industry": "互联网|电子商务",
        //      "content": "{ {result.DATA} }\n\n领奖金额:{ {withdrawMoney.DATA} }\n领奖  时间:    { {withdrawTime.DATA} }\n银行信息:{ {cardInfo.DATA} }\n到账时间:  { {arrivedTime.DATA} }\n{ {remark.DATA} }",
        //      "example": "您已提交领奖申请\n\n领奖金额：xxxx元\n领奖时间：2013-10-10 12:22:22\n银行信息：xx银行(尾号xxxx)\n到账时间：预计xxxxxxx\n\n预计将于xxxx到达您的银行卡"
        //   }]
        //}
//        $wxTplList = $app->template_message->getPrivateTemplates();
        $wxTplList = [
            [
                'template_id' => 'iPk5sOIt5X_flOVKn5GrTFpncEYTojx6ddbt8WYoV5s',
                'title' => '领取奖金提醒',
                'primary_industry' => 'IT科技',
                'deputy_industry' => '互联网|电子商务',
                'content' => '{ {result.DATA} }\n\n领奖金额:{ {withdrawMoney.DATA} }\n领奖  时间:    { {withdrawTime.DATA} }\n银行信息:{ {cardInfo.DATA} }\n到账时间:  { {arrivedTime.DATA} }\n{ {remark.DATA} }',
                'example' => '您已提交领奖申请\n\n领奖金额：xxxx元\n领奖时间：2013-10-10 12:22:22\n银行信息：xx银行(尾号xxxx)\n到账时间：预计xxxxxxx\n\n预计将于xxxx到达您的银行卡',
            ]
        ];

        if ($request->isMethod('POST')) {
            $post = $request->post('MessageTemplate');
            $post['last_modify'] = time();
            $ret = $this->messageTemplate->update($id, $post);
            if ($ret === false) {
                return result(-1, null, OPERATE_FAIL);
            }
            return result(0, null, OPERATE_SUCCESS);
        }

        return view('mall.message-template.set', compact('title', 'info', 'type','wxTplList'));
    }

    public function saveData(Request $request)
    {
        $post = $request->post('MessageTemplate');
        $id = !empty($post['id']) ? $post['id'] : 0;

        $post['last_modify'] = time();
        if ($id) {
            // 编辑
            $ret = $this->messageTemplate->update($id, $post);
            $msg = '消息模板编辑';
        }else {
            // 添加
            $ret = $this->messageTemplate->store($post);
            $msg = '消息模板添加';
        }

        if ($ret === false) {
            // fail
            flash('error', $msg.'失败');
            return redirect('/mall/message-template/list?type=0');
        }
        // success
        flash('success', $msg.'成功');
        return redirect('/mall/message-template/list?type=0');
    }

    public function smsTest(Request $request)
    {

        $id = $request->get('id', 0);

        $extra = '?id='.$id.'&type=sms';
        $info = $this->messageTemplate->getById($id);
        // 获取模板参数
        $pattern = '/\$\{([\s\S]*?)\}/';
        preg_match_all($pattern, $info->sms_content, $match_params);
        $tpl_params = $match_params[1];

        view()->share('info', $info);
        view()->share('tpl_params', $tpl_params);
        $title = $info->name;
        $this->sublink($this->sms_test_links, 'sms-test', '', $extra);

        if ($info->type == 0) {
            $sT = '商家模板';
        } elseif ($info->type == 1) {
            $sT = '用户模板';
        } elseif ($info->type == 2) {
            $sT = '平台模板';
        } elseif ($info->type == 3) {
            $sT = '网点模板';
        }else {
            $sT = '';
        }

        $fixed_title = '测试短信模板 - '.$title;

        $action_span = [
            [
                'url' => 'list?type='.$info->type,
                'icon' => 'fa-reply',
                'text' => '返回'.$sT.'列表'
            ]
        ];
        $explain_panel = [
            '模板内容格式：<br>- 不支持营销短信、全变量短信模板；例如：您好，${msg}<br>- 变量格式如${name}，不能使用${email}、${mobile}、${id}、${nick}、${site}<br>- 请勿在变量中添加特殊符号，如： , . # / : - ，。<br>- 如有链接，请将链接地址写于模板内容中，便于核实<br>- 模板内容无需添加签名，内容首尾不能添加[]、【】符号，调用接口时传入签名即可',
            '亲爱的顾客${nickname}，您的会员等级已升级至${shop_name}的${user_shop_rank_name}，您可登录用户中心进行查询。'
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        if ($request->isMethod('POST')) {
            $id = $request->input('id');
            $is_asyn = $request->input('is_asyn',0);
            $mobile = $request->input('mobile');
            $params = $request->input('params');

            // 调用短信接口 发送测试短信
            $ret = false;
            if ($ret === false) {
                return result(-1, null, '短信不足');
            }
            return result(0, null, OPERATE_SUCCESS);
        }

        return view('mall.message-template.sms_test', compact('title'));
    }

    /**
     *
     *
     * @param Request $request
     * @return mixed
     */
    public function setSysOpen(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->messageTemplate->changeState($id, 'sys_open');
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, 1);
    }

    /**
     *
     *
     * @param Request $request
     * @return mixed
     */
    public function setSmsOpen(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->messageTemplate->changeState($id, 'sms_open');
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, 1);
    }

    /**
     *
     *
     * @param Request $request
     * @return mixed
     */
    public function setEmailOpen(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->messageTemplate->changeState($id, 'email_open');
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, 1);
    }

    /**
     *
     *
     * @param Request $request
     * @return mixed
     */
    public function setWxOpen(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->messageTemplate->changeState($id, 'wx_open');
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, 1);
    }

    /**
     * 选择微信模板消息
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Throwable
     */
    public function disTemplate(Request $request)
    {
        $wxCode = $request->post('wx_code');

        $app = WechatService::app();
//        $wxTplList = $app->template_message->getPrivateTemplates();
        $wxTplList = [
            [
                'template_id' => 'iPk5sOIt5X_flOVKn5GrTFpncEYTojx6ddbt8WYoV5s',
                'title' => '领取奖金提醒',
                'primary_industry' => 'IT科技',
                'deputy_industry' => '互联网|电子商务',
                'content' => '{ {result.DATA} }\n\n领奖金额:{ {withdrawMoney.DATA} }\n领奖  时间:    { {withdrawTime.DATA} }\n银行信息:{ {cardInfo.DATA} }\n到账时间:  { {arrivedTime.DATA} }\n{ {remark.DATA} }',
                'example' => '您已提交领奖申请\n\n领奖金额：xxxx元\n领奖时间：2013-10-10 12:22:22\n银行信息：xx银行(尾号xxxx)\n到账时间：预计xxxxxxx\n\n预计将于xxxx到达您的银行卡',
            ]
        ];
        foreach ($wxTplList as $item) {
            if ($item['template_id'] == $wxCode) {
                $wxContent = $item['content'];
            }
        }
        if (empty($wxContent)) {
            return result(-1, null, '微信模板id无效');
        }
        $render = view('mall.message-template.dis_template', compact('wxContent'))->render();

        return result(0,$render, '成功');
    }

    /**
     * 名称验证是否重复
     *
     * @param Request $request
     * @return mixed
     */
    public function clientValidate(Request $request)
    {
        $result = $this->messageTemplate->clientValidate($request, 'MessageTemplate');
        if (!$result['code']) {
            return result(-1, '', $result['message']);
        }
        return result(0);
    }

    /*public function delete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->messageTemplate->del($id);
        if ($ret === false) {
            // Log
            admin_log('消息模板删除失败。ID：'.$id);
            return result(-1, '', '删除失败');
        }

        // Log
        admin_log('消息模板删除成功。ID：'.$id);
        return result(0, '', '删除成功');
    }*/

}