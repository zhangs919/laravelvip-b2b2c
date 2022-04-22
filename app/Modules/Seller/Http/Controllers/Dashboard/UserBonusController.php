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
// | Date:2019-4-5
// | Description:
// +----------------------------------------------------------------------

namespace app\Modules\Seller\Http\Controllers\Dashboard;

use App\Models\Activity;
use App\Models\Goods;
use App\Models\Shop;
use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\ActivityCategoryRepository;
use App\Repositories\ActivityRepository;
use App\Repositories\BonusRepository;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\GoodsRepository;
use App\Repositories\UserBonusRepository;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

/**
 * 用户红包管理
 *
 * Class UserBonusController
 * @package app\Modules\Seller\Http\Controllers\Dashboard
 */
class UserBonusController extends Seller
{

    private $links = [
        ['url' => 'dashboard/bonus/list', 'text' => '已发放用户红包列表'],
    ];

    protected $userBonus;

    public function __construct()
    {
        parent::__construct();

        $this->userBonus = new UserBonusRepository();

        $this->set_menu_select('dashboard', 'dashboard-center');
    }


    public function lists(Request $request)
    {
        $title = '用户红包列表';
        $fixed_title = '营销中心 - '.$title;

        $this->sublink($this->links, 'list');

        $bonus_id = $request->get('bonus_id',0);

        $action_span = [
            [
                'id' => '',
                'url' => '/dashboard/bonus/list',
                'icon' => 'fa-reply',
                'text' => '返回红包列表'
            ],
        ];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();

        $where = [];
        $where[] = ['shop_id', seller_shop_info()->shop_id];
        if ($bonus_id) {
            $where[] = ['bonus_id', $bonus_id];
        }
        // 搜索条件
        $search_arr = ['keywords','bonus_status','receive_status','bonus_type'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'keywords') {
                    $where[] = ['bonus_sn', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        list($list, $total) = $this->userBonus->getUserBonusList($where);

        $pageHtml = pagination($total);
        $page = frontend_pagination($total, true);

        if ($request->ajax()) {
            $render = view('dashboard.user-bonus.partials._list', compact('list', 'total', 'pageHtml'))->render();
            return result(0, $render);
        }

        // 获取数据
        $bonus_types = [
            1 => '到店送红包',
            2 => '收藏送红包',
            4 => '会员送红包',
            6 => '注册送红包',
            9 => '推荐送红包',
            10 => '积分兑换红包',
            '' => '全部'
        ];

        $compact = compact('title', 'list', 'pageHtml', 'bonus_id', 'bonus_types');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'list' => $list,
                'page' => $page,
                'bonus_id' => $bonus_id,
                'bonus_types' => $bonus_types
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'dashboard.user-bonus.list'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

}