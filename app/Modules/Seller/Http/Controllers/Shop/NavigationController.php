<?php

namespace App\Modules\Seller\Http\Controllers\Shop;

use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\LinkTypeRepository;
use App\Repositories\ShopConfigFieldRepository;
use App\Repositories\ShopNavigationRepository;
use Illuminate\Http\Request;

class NavigationController extends Seller
{

    private $links = [
        ['url' => 'shop/navigation/list', 'text' => '店铺导航列表'],
        ['url' => 'shop/navigation/setting', 'text' => '店铺导航设置'],
        ['url' => 'shop/navigation/add', 'text' => '添加'],
        ['url' => 'shop/navigation/edit', 'text' => '编辑'],
    ];


    protected $shopNavigation;
    protected $shopConfigField;
    protected $linkType;

    public function __construct()
    {
        parent::__construct();

        $this->shopNavigation = new ShopNavigationRepository();
        $this->shopConfigField = new ShopConfigFieldRepository();
        $this->linkType = new LinkTypeRepository();

        $this->set_menu_select('shop', 'shop-navigation');
    }

    public function lists(Request $request)
    {
        $title = '列表';

        $fixed_title = '店铺导航 - 列表';
        $this->sublink($this->links, 'list','','','add,edit');

        $is_design = $request->get('is_design', 0); // 是否装修模式 默认0 非装修模式

        $action_span = [
            [
                'url' => '/shop/navigation/add?is_design='.$is_design,
                'icon' => 'fa-plus',
                'text' => '添加店铺导航'
            ],
        ];

        $explain_panel = [
            '清理缓存后您修改的店铺导航信息才会在店铺首页更新',
            '店铺导航展示在前台店铺首页，添加导航时，可自定义链接，也可选择商品分类，自动获取商品分类链接'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();
        $where = [];
        // 搜索条件
        $search_arr = ['nav_name'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'nav_name') {
                    $where[] = ['nav_name', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'nav_id',
            'sortorder' => 'desc'
        ];
        list($list, $total) = $this->shopNavigation->getList($condition);
        $pageHtml = pagination($total);

        $is_design = $request->get('is_design', 0); // 是否装修模式 默认0 非装修模式

        $compact = compact('title', 'list', 'total', 'pageHtml', 'is_design');
        if ($request->ajax()) {
            $render = view('shop.navigation.partials._list', $compact)->render();
            return result(0, $render);
        }

        return view('shop.navigation.list', $compact);
    }

    public function add(Request $request)
    {
        $title = '添加';
        $id = $request->get('id', 0);

        $this->sublink($this->links, 'add', '', '', 'edit');

        if ($id) {
            // 更新操作
            $this->sublink($this->links, 'edit', '', '', 'add');

            $info = $this->shopNavigation->getById($id);
            view()->share('info', $info);
            $title = '编辑';
        }

        $fixed_title = '店铺导航 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回店铺导航列表'
            ],
        ];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        return view('shop.navigation.add', compact('title'));
    }

    public function edit(Request $request)
    {
        return $this->add($request);
    }

    /**
     * 保存信息
     * @param Request $request
     * @return mixed
     */
    public function saveData(Request $request)
    {
        $post = $request->post('ShopNavigationModel');

        if (!empty($post['nav_id'])) {
            // 编辑
            $ret = $this->shopNavigation->update($post['nav_id'], $post);
            $msg = '店铺导航编辑';
        }else {
            // 添加
            $post['shop_id'] = seller_shop_info()->shop_id;
            $ret = $this->shopNavigation->store($post);
            $msg = '店铺导航添加';
        }

        if ($ret === false) {
            // fail
            flash('error', $msg.'失败');
            return redirect('/shop/navigation/list');
        }
        // success
        flash('success', $msg.'成功');
        return redirect('/shop/navigation/list');
    }

    /**
     * 更新信息
     *
     * @param Request $request
     * @return mixed
     */
    public function editNavInfo(Request $request)
    {
        $id = $request->post('nav_id');
        $title = $request->post('title');
        $value = $request->post('value');

        if ($title == 'nav_sort') {
            $value = intval($value);
        }

        $ret = $this->shopNavigation->update($id, [$title => $value]);

        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, '', '设置成功');
    }

    /**
     * 设置是否显示
     *
     * @param Request $request
     * @return mixed
     */
    public function setIsShow(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->shopNavigation->changeShow($id);
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, '设置成功');
    }

    public function setNewOpen(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->shopNavigation->changeState($id, 'new_open');
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, '设置成功');
    }

    /**
     * 删除
     *
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->shopNavigation->del($id);
        if ($ret === false) {
            // Log
            shop_log('店铺导航删除失败。ID：'.$id);
            return result(-1, '', '删除失败');
        }

        // Log
        shop_log('店铺导航删除成功。ID：'.$id);
        return result(0, '', '删除成功');
    }

    /**
     * 批量删除
     *
     * @param Request $request
     * @return mixed
     */
    public function batchDelete(Request $request)
    {
        $ids = $request->post('ids');
        $ret = $this->shopNavigation->batchDel($ids);

        $ids = implode(',', $ids);
        if ($ret === false) {
            // Log
            shop_log('店铺导航批量删除失败。ID：'.$ids);
            return result(-1, '', '删除失败');
        }
        // Log
        shop_log('店铺导航批量删除成功。ID：'.$ids);
        return result(0, '', '删除成功');
    }

    /**
     * 改变链接类型
     *
     * @param Request $request
     * @return mixed
     * @throws \Throwable
     */
    public function getTypeList(Request $request)
    {
        $nav_type = $request->get('nav_type', 0); // 链接类型
        $nav_link = $request->get('nav_link');
        $link_data = $this->linkType->getLinkTypeData($nav_type, seller_shop_info()->shop_id);
        $render = view('shop.navigation.partials._get_type_list', compact('nav_type', 'nav_link', 'link_data'))->render();

        return result(0, $render);
    }

    public function setting(Request $request)
    {
        $title = '店铺导航设置';
        $fixed_title = '店铺导航 - '.$title;
        $this->sublink($this->links, 'setting','','','add,edit');


        $action_span = [];

        $explain_panel = [
            '可以给店铺导航添加背景颜色'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $group = 'navigation'; // 当前配置分组
        $config_info = $this->shopConfigField->getSpecialConfigsByGroup($group, 'code');
        $compact = compact('title', 'config_info', 'group');

        return view('shop.navigation.setting', $compact);
    }
}