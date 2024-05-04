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
// | Date:2019-6-1
// | Description:红包
// +----------------------------------------------------------------------

namespace App\Modules\Backend\Http\Controllers\Dashboard;


use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\BonusRepository;
use App\Repositories\SystemConfigRepository;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BonusController extends Backend
{

    private $links = [
        ['url' => 'dashboard/bonus/list', 'text' => '红包列表'],
        ['url' => 'dashboard/bonus/config', 'text' => '红包设置'],
        ['url' => 'dashboard/bonus/add', 'text' => '添加红包'],
        ['url' => 'dashboard/bonus/view', 'text' => '红包详情'],
    ];

    protected $systemConfig;
    protected $bonus;

    public function __construct(SystemConfigRepository $systemConfig,BonusRepository $bonus)
    {
        parent::__construct();

        $this->systemConfig = $systemConfig;
        $this->bonus = $bonus;
    }


    public function config(Request $request)
    {
        $action_span = [
            [
                'url' => '/dashboard/center/index',
                'icon' => 'fa-reply',
                'text' => '返回营销中心'
            ]
        ];

        $this->sublink($this->links, 'config', '', '', 'add,view');

        $group = 'bonus'; // 当前配置分组
        $group_info = $this->systemConfig->getConfigList($group);
        $title = $fixed_title = $group_info['title'];
        $uuid = make_uuid();
        $script_render = view('system.config.partials.'.$group, compact('uuid'))->render();

        $explain_panel = $group_info['explain'];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel,
        ];
        $this->setLayoutBlock($blocks); // 设置block

        $introduce_box = '';

        return view('system.config.config', compact('title', 'group', 'group_info', 'script_render', 'introduce_box'));
    }


    public function lists(Request $request)
    {
        $title = '平台方红包列表';
        $fixed_title = '营销中心 - '.$title;

        $this->sublink($this->links, 'list', '', '', 'add,view');

        $action_span = [
            [
                'id' => '',
                'url' => '/dashboard/center/index',
                'icon' => 'fa-reply',
                'text' => '返回营销中心'
            ],
            [
                'id' => '',
                'url' => '/dashboard/user-bonus/list',
                'icon' => 'fa-th',
                'text' => '已发放列表'
            ],
            [
                'id' => '',
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加红包'
            ],
        ];

        $explain_panel = [
            '平台红包：由平台发放的红包，买家领取后可在任意店铺使用。买家使用该红包后，平台会将红包兑换成等值的金额支付给卖家。平台红包产生的金额损失将由平台方承担，请谨慎发放',
            '手动设置红包失效后，买家将不能继续领取红包，但是已经领取的红包仍然可以使用',
            '红包过期后自动失效',
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();

        $where = [];
        $where[] = ['shop_id', 0];
        $where[] = ['is_delete', 0]; // 未删除状态
        // 搜索条件
        $search_arr = ['keywords','start_time','end_time','is_enable','bonus_type'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'keywords') {
                    $where[] = ['bonus_name', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        list($list, $total) = $this->bonus->getBonusList($where);

        $pageHtml = pagination($total);
        $compact = compact('title', 'list', 'pageHtml');

        if ($request->ajax()) {
            $render = view('dashboard.bonus.partials._list', $compact)->render();
            return result(0, $render);
        }

        return view('dashboard.bonus.list', $compact);
    }

    /**
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add(Request $request)
    {
        $title = '添加';


        $this->sublink($this->links, 'add', '', '', 'config,view');

        $fixed_title = '营销中心 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回红包列表'
            ],
        ];

        // 获取数据
        $bonus_type = $request->get('bonus_type',0); // 红包类型
        $explain_panel = [];
        if ($bonus_type == 4) {
            $bonus_type_name = '会员送红包';
            $bonus_type_desc = '平台主动派发，系统提醒用户获得红包';
            $tpl_name = 'add_bonus_type_4';
        } elseif ($bonus_type == 6) {
            $bonus_type_name = '注册送红包';
            $bonus_type_desc = '新注册会员自动发放';
            $tpl_name = 'add_bonus_type_6';
        } elseif ($bonus_type == 9) {
            $bonus_type_name = '推荐送红包';
            $bonus_type_desc = '推荐会员注册，系统自动发放红包作为奖励';
            $tpl_name = 'add_bonus_type_9';
        } elseif ($bonus_type == 10) {
            $bonus_type_name = '积分兑换红包';
            $bonus_type_desc = '积分商城使用积分兑换红包';
            $tpl_name = 'add_bonus_type_10';
        } else {
            $bonus_type_name = '';
            $bonus_type_desc = '';
            $tpl_name = 'add';
            $explain_panel = [
                '商城红包分为平台红包和店铺红包，平台红包由平台方创建并发放，店铺红包由店铺创建并发放',
                '平台红包：由平台发放的红包，买家领取后可以在全站使用；买家使用该红包后，平台会将红包兑换成等值的金额支付给卖家。平台红包产生的金额损失将由平台方承担，请谨慎发放。手动设置红包失效后，买家将不能继续领取红包，但是已经领取的红包仍然可以使用；红包过期后自动失效',
                '店铺红包：由店铺发放的红包，买家领取后仅能在该店铺使用，目前包含：到店送红包、收藏送红包、积分兑换红包、会员送红包',

            ];
        }


        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $model = [
            'is_original_price' => 1,
            'is_enable' => 1,
            'is_delete' => 0,
            'use_range' => 0,
            'bonus_type' => $bonus_type
        ];
        $data_model = [
            'goods_ids' => 0
        ];
        $start_time = date('Y-m-d 00:00:00', time());
        $end_time = date("Y-m-d 23:59:59",strtotime("+7 day"));

        $compact = compact('title','bonus_type', 'bonus_type_name','bonus_type_desc','model', 'data_model', 'start_time', 'end_time');
        return view('dashboard.bonus.'.$tpl_name, $compact);
    }

    /**
     * 保存信息
     *
     * @param Request $request
     * @return mixed
     */
    public function saveData(Request $request)
    {
        $post = $request->post();
        $postModel = $request->post('Bonus');

        $postModel['add_time'] = time();

        // 红包数据
        $bonus_data = $post['bonus_data'];

        if ($postModel['bonus_type'] == 10) {
            // 积分兑换红包
            $bonus_data['exchange_points'] = $postModel['exchange_points'];
            if ($postModel['exchange_limit'] == 0) {
                // 不限制
                $postModel['start_time'] = date('Y-m-d 00:00:00', time());
                $postModel['end_time'] = 0;
                $bonus_data['exchange_start_time'] = strtotime($postModel['start_time']);
                $bonus_data['exchange_end_time'] = 0;
            } else {
                // 限制
                $postModel['start_time'] = $bonus_data['exchange_start_time'];
                $postModel['end_time'] = $bonus_data['exchange_end_time'];
                $bonus_data['exchange_start_time'] = strtotime($bonus_data['exchange_start_time']);
                $bonus_data['exchange_end_time'] = strtotime($bonus_data['exchange_end_time']);
            }
        }

        if (isset($bonus_data['time_mode']) && $bonus_data['time_mode'] == 0) {
            $bonus_data['start_time'] = strtotime($bonus_data['start_time']);
            $bonus_data['end_time'] = strtotime($bonus_data['end_time']);
            $bonus_data['delay_days'] = 0;
            $bonus_data['valid_days'] = 0;
        } else {
            $bonus_data['start_time'] = null;
            $bonus_data['end_time'] = null;
        }

        // todo 以下两个字段 暂时这样写着
        $bonus_data['is_self_shop'] = 1;
        $bonus_data['cat_ids'] = 0;

        if (!empty($postModel['use_range'])) {
            $postModel['goods_ids'] = $postModel['use_range'];
            $bonus_data['goods_ids'] = explode(',', $postModel['use_range']);
            $postModel['use_range'] = 1;
        } else {
            $postModel['goods_ids'] = null;
            $bonus_data['goods_ids'] = null;
            $postModel['use_range'] = 0;
        }
        $postModel['bonus_data'] = serialize($bonus_data);
//        $postModel['shop_id'] = $this->seller_info->shop_id;

        $ret = $this->bonus->store($postModel);
        if ($ret === false) {
            // fail
            return result(-1, null, '红包添加失败');
        }

        // success
        // Log
        admin_log('添加了一个红包。ID：'.$ret->bonus_id);
        return result(0, null, '红包添加成功');
    }

    public function view(Request $request)
    {
        $title = '红包详情';

        $this->sublink($this->links, 'view', '', '', 'config,add');

        $fixed_title = '红包 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回红包列表'
            ],
            [
                'id' => '',
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加红包'
            ],
        ];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        // 获取数据
        $bonus_id = $request->get('bonus_id',0);
        $bonus_info = $this->bonus->getById($bonus_id);
        if (empty($bonus_info)) {
            abort(404, '红包id无效');
        }
        $bonus_type = $bonus_info->bonus_type;

        if ($bonus_type == 4) {
            $bonus_type_name = '会员送红包';
            $bonus_type_desc = '平台主动派发，系统提醒用户获得红包';
            $tpl_name = 'view_bonus_type_4';
        } elseif ($bonus_type == 6) {
            $bonus_type_name = '注册送红包';
            $bonus_type_desc = '新注册会员自动发放';
            $tpl_name = 'view_bonus_type_6';
        } elseif ($bonus_type == 9) {
            $bonus_type_name = '推荐送红包';
            $bonus_type_desc = '推荐会员注册，系统自动发放红包作为奖励';
            $tpl_name = 'view_bonus_type_9';
        } elseif ($bonus_type == 10) {
            $bonus_type_name = '积分兑换红包';
            $bonus_type_desc = '积分商城使用积分兑换红包';
            $tpl_name = 'view_bonus_type_10';
        } else {
            $bonus_type_name = '';
            $bonus_type_desc = '';
            $tpl_name = 'add';
        }

        $model = $bonus_info->toArray();

        $data_model = [
            'goods_ids' => 0
        ];
        $goods_list = $this->bonus->getBonusGoodsList($bonus_info['bonus_data']['goods_ids']);


        $compact = compact('title','bonus_type', 'bonus_type_name','bonus_type_desc', 'model', 'data_model', 'goods_list');

        return view('dashboard.bonus.'.$tpl_name, $compact);
    }

    /**
     * 推广
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function push(Request $request)
    {
        $bonus_id = $request->get('bonus_id',0);

        $bonus_info = $this->bonus->getById($bonus_id);
        if (empty($bonus_info)) {
            return result(-1, null, '红包id无效');
        }

//        $bonus_info->shop_name = Shop::where('shop_id', $bonus_info->shop_id)->value('shop_name');

        $render = view('dashboard.bonus.push', compact('bonus_id', 'bonus_info'))->render();
        return result(0, $render);
    }

    public function qrcode(Request $request)
    {
        $bonus_id = $request->get('bonus_id');
        $url = 'http://'.config('lrw.mobile_domain').'/bonus-'.$bonus_id;

        $qrCode = QrCode::errorCorrection('L')
            ->format('png')
            ->size(180)
//            ->merge('/public/qrcodes/water.png',.15) // 合并水印图片到二维码
            ->margin(0)
//            ->color(255,0,255)
//            ->backgroundColor(125,245,0)
            ->encoding('UTF-8')
            ->generate($url);
        return response()->make($qrCode, 200, ['Content-Type' => 'image/png']);
    }

    /**
     * 下载二维码
     * todo 还有问题 不能下载
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadQcode(Request $request)
    {

    }

    /**
     * 下载推广图
     *
     * @param Request $request
     */
    public function downloadPushPicture(Request $request)
    {

    }

    public function enable(Request $request)
    {
        $id = $request->post('ids');
        $ret = $this->bonus->update($id, ['is_enable' => 0]);

        if ($ret === false) {
            // Log
            admin_log('红包作废失败。ID：'.$id);
            return result(-1, null, OPERATE_FAIL);
        }

        // Log
        admin_log('红包作废成功。ID：'.$id);
        return result(0, null, OPERATE_SUCCESS);
    }

    /**
     * 删除 - 软删除
     *
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request)
    {
        $id = $request->post('ids');
        $ret = $this->bonus->update($id, ['is_delete' => 1]);

        if ($ret === false) {
            // Log
            admin_log('红包删除失败。ID：'.$id);
            return result(-1, null, '删除失败');
        }

        // Log
        admin_log('红包删除成功。ID：'.$id);
        return result(0, null, '删除成功');
    }


    public function editSort(Request $request)
    {
        $ret = $this->bonus->editInfo($request);
        if ($ret === false) {
            return result(-1, null);
        }
        return result(0, null);
    }
}