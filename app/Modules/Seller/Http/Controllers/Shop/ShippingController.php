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
// | Date:2018-10-22
// | Description: 配送方式
// +----------------------------------------------------------------------

namespace app\Modules\Seller\Http\Controllers\Shop;

use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\ShippingRepository;
use App\Repositories\ShopConfigFieldRepository;
use App\Repositories\ShopConfigRepository;
use App\Repositories\ShopShippingRepository;
use Illuminate\Http\Request;

/**
 * 配送方式管理
 *
 * Class PrintSpecController
 * @package app\Modules\Seller\Http\Controllers\Store
 */
class ShippingController extends Seller
{

    private $links = [
        ['url' => 'shop/shipping/self', 'text' => '自行配送'],
        ['url' => 'shop/shipping/list', 'text' => '第三方配送'],
    ];

    private $edit_links = [
        ['url' => 'shop/shipping/edit', 'text' => '设置运单模板'],
        ['url' => 'shop/shipping/print', 'text' => '打印预览'],
    ];

//    protected $shipping;

    protected $shopShipping;

    protected $shopConfigField;

    public function __construct()
    {
        parent::__construct();

//        $this->shipping = new ShippingRepository();
        $this->shopShipping = new ShopShippingRepository();
        $this->shopConfigField = new ShopConfigFieldRepository();

        $this->set_menu_select('shop', 'shop-express-list');
    }

    public function self(Request $request)
    {
        $title = '自行配送';

        $this->sublink($this->links, 'self');

        $fixed_title = '配送方式 - '.$title;

        $action_span = [];

        $explain_panel = [
            '店铺开启自行配送后，在发货时即可使用无需物流'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $group = 'shipping'; // 当前配置分组
        $config_info = $this->shopConfigField->getSpecialConfigsByGroup($group, 'code');
        $compact = compact('title', 'config_info', 'group');

        return view('shop.shipping.self', $compact);
    }

    public function lists(Request $request)
    {
        $title = '第三方配送';
        $fixed_title = '配送方式 - '.$title;
        $this->sublink($this->links, 'list');

        $action_span = [
            [
                'url' => '/shop/freight/list',
                'icon' => 'fa-plus',
                'text' => '设置运费模板'
            ],
        ];

        $explain_panel = [
            '列表中展示平台方已开启供商家使用的第三方快递公司',
            '商家可启用和禁用快递公司，开启快递公司，商家发货时才可使用，商家可单独设置运单模板'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();
        $where = [];
        $where[] = ['shop_id', seller_shop_info()->shop_id];
        // 搜索条件
        $search_arr = ['shipping_name'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'shipping_name') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'shipping_id',
            'sortorder' => 'asc'
        ];
        list($list, $total) = $this->shopShipping->getList($condition);

        $pageHtml = pagination($total);
        
        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('shop.shipping.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('shop.shipping.list', $compact);
    }

    /**
     * 设置运单模板
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request)
    {
        $title = '设置运单模板';

        $id = $request->get('id', 0);
        $info = $this->shopShipping->getById($id);

        $config_lable = array_filter(explode('||,||', $info->config_lable));
        $lables = [];
        if (!empty($config_lable)) {
            foreach ($config_lable as $item) {
                $lableArr = explode(',', $item);
                $lables[$lableArr[0]] = $lableArr;
            }
        }
        $info->config_lable = $lables;

        view()->share('info', $info);

        $fixed_title = '运费设置 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回快递公司列表'
            ],
            [
                'url' => 'print?id='.$id,
                'icon' => 'fa-print',
                'text' => '打印预览'
            ],
        ];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        if ($request->method() == 'POST') {
            $postData = $request->post('data');
            $postShipping = $postData['ShopShipping'];

            $ret = $this->shopShipping->update($postShipping['id'], $postShipping);
            $msg = '设置运单模板';

            if ($ret === false) {
                // fail
                return result(-1, '', $msg.'失败');
            }
            // success
            return result(0, '', $msg.'成功');
        }

        return view('shop.shipping.edit', compact('title'));
    }

    /**
     * 测试打印
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function prints(Request $request)
    {
        $title = '运单模板打印预览';

        $id = $request->get('id');
        $fixed_title = '运费设置 - '.$title;
        $extra = '?id='.$id;
        $this->sublink($this->edit_links, 'print', '', $extra);

        $info = $this->shopShipping->getById($id);

        $config_lable = array_filter(explode('||,||', $info->config_lable));
        $lables = [];
        if (!empty($config_lable)) {
            foreach ($config_lable as $item) {
                $lableArr = explode(',', $item);
                $lables[$lableArr[0]] = $lableArr;
            }
        }
        $info->config_lable = $lables;
        view()->share('info', $info);

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回快递公司列表'
            ],
            [
                'url' => '',
                'id' => 'btn_print',
                'icon' => 'fa-print',
                'text' => '打印预览'
            ],
        ];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        return view('shop.shipping.print', compact('title'));
    }

    public function setIsShow(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->shopShipping->changeState($id, 'is_open');
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, '设置成功');
    }
}