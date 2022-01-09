<?php

namespace app\Modules\Backend\Http\Controllers\System;


use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\ShopConfigFieldRepository;
use App\Repositories\ShopConfigRepository;
use Illuminate\Http\Request;

class ShopConfigFieldController extends Backend
{
    private $links = [
        ['url' => 'system/shop-config-field/index', 'text' => '全部配置'],

    ];

    protected $shopConfig;

    protected $shopConfigField;

    public function __construct()
    {
        parent::__construct();

        $this->shopConfig = new ShopConfigRepository();
        $this->shopConfigField = new ShopConfigFieldRepository();

    }

    public function index(Request $request)
    {
        $title = '配置列表';
        $fixed_title = '配置列表 - 全部配置';
        $this->sublink($this->links, 'index');

        $params = $request->all();

        $group = $request->get('group', '');
        $status = $request->get('status', '');
        $where = [];

        // 搜索条件
        $search_arr = ['group', 'status', 'title', 'code'];
        foreach ($search_arr as $v) {
            if (isset($params[$v])) {
                $where[$v] = $params[$v];
            }
        }

        $condition = [
            'where' => $where
        ];
        list($list, $total) = $this->shopConfigField->getConfigsByGroup($condition, 'code');
        $pageHtml = pagination($total);
        if ($request->ajax()) {
            $render = view('system.shop-config-field.partials.config_list', compact('list', 'total', 'pageHtml'))->render();
            return result(0, $render);
        }

        $configGroups = $this->shopConfigField->getConfigGroups();
        $formItemTypes = $this->shopConfigField->getFormItemTypes();

        $action_span = [
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加配置'
            ],
        ];
        $explain_panel = [
            '店铺中心基本配置管理。',
            '通过修改排序数字可以控制前台显示顺序，数字越小越靠前'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];
        $this->setLayoutBlock($blocks); // 设置block

        return view('system.shop-config-field.index', compact('title', 'list', 'total', 'pageHtml', 'configGroups', 'formItemTypes', 'group'));
    }

    public function add(Request $request)
    {
        $id = $request->get('id', 0);

        $title = '添加配置';
        if ($id) {
            $title = '编辑配置';
        }

        $fixed_title = '配置列表 - '.$title;
        $action_span = [
            [
                'url' => 'index',
                'icon' => 'fa-reply',
                'text' => '返回配置列表'
            ],
        ];

        $configGroups = $this->shopConfigField->getConfigGroups();
        $formItemTypes = $this->shopConfigField->getFormItemTypes();

        $explain_panel = [
            '店铺中心基本配置管理。',
            '通过修改排序数字可以控制前台显示顺序，数字越小越靠前'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];
        $this->setLayoutBlock($blocks); // 设置block

        return view('system.shop-config-field.add', compact('title', 'configGroups', 'formItemTypes'));
    }

    public function edit(Request $request)
    {
        $id = $request->get('id');
        $info = $this->shopConfigField->getById($id);
        view()->share('info', $info);

//        $group_info = get_shop_config_group($info->group);
//        view()->share('group_info', $group_info);

        return $this->add($request);
    }

    public function saveData(Request $request)
    {
        $post = $request->post('ConfigModel');
        if (!empty($post['id'])) {
            // 编辑
            // 验证参数
            $this->validate($request, [
                'ConfigModel.code' => 'required|max:40',
            ]);
//            dd($post);
            $ret = $this->shopConfigField->update((int)$post['id'], $post);
            $msg = '编辑';
        }else {
            // 添加
            // 验证参数
            $this->validate($request, [
                'ConfigModel.code' => 'required|unique:shop_config_field,code|max:40',
            ]);
            $ret = $this->shopConfigField->store($post);
            $msg = '添加';
        }


        if ($ret === false) {
            // fail
            // todo Log
            admin_log($msg.'店铺配置信息失败。ID：'.$ret->id);
            flash('error', $msg.'失败');
            return redirect('/system/shop-config-field/index');
        }
        // success
        // todo Log
        admin_log($msg.'店铺配置信息成功。ID：'.$ret->id);
        flash('success', $msg.'成功');
        return redirect('/system/shop-config-field/index');
    }

    public function setStatus(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->shopConfigField->changeStatus($id);
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, '设置成功');
    }

    public function editConfigInfo(Request $request)
    {
        $id = $request->post('id');
        $title = $request->post('title');
        $value = $request->post('value');

        if ($title == 'sort') {
            $value = intval($value);
        }
        $ret = $this->shopConfigField->update($id, [$title => $value]);

        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, '', '设置成功');
    }

    public function delete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->shopConfigField->del($id);
        if ($ret === false) {
            // Log
            admin_log('配置信息删除失败。ID：'.$id);
            return result(-1, '', '删除失败');
        }

        // Log
        admin_log('配置信息删除成功。ID：'.$id);
        return result(0, '', '删除成功');
    }

    public function batchDelete(Request $request)
    {
        $ids = $request->post('ids');
        $ret = $this->shopConfigField->batchDel($ids);

        $ids = implode(',', $ids);
        if ($ret === false) {
            // Log
            admin_log('配置信息批量删除失败。ID：'.$ids);
            return result(-1, '', '删除失败');
        }
        // Log
        admin_log('配置信息批量删除成功。ID：'.$ids);
        return result(0, '', '删除成功');
    }


}