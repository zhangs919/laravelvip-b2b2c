<?php

namespace App\Modules\Backend\Http\Controllers\System;

use App\Models\AdminMenu;
use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\AdminMenuRepository;
use Illuminate\Http\Request;

/**
 * 系统菜单
 *
 * Class MenuController
 * @package App\Modules\Backend\Http\Controllers\System
 */
class MenuController extends Backend
{

    protected $menu;


    public function __construct()
    {
        parent::__construct();

        $this->menu = new AdminMenuRepository();
    }

    public function lists(Request $request)
    {
        // 批量添加系统菜单信息
        /*$insert = [];
        foreach (seller_top_menus() as $menu) {
            // 添加一级菜单
            $insert[] = [
                'title' => $menu['title'],
                'icon' => $menu['icon'],
                'pid' => 0,
                'parent_name' => 'root',
                'name' => $menu['menus'],
                'route' => $menu['route'],
//                'url' => null,
//                'target' => null,
//                'sort' => 255,
//                'is_show' => true,
                'created_at' => format_time(time(), 'Y-m-d H:i:s'),
                'updated_at' => format_time(time(), 'Y-m-d H:i:s'),
            ];
        }

        $ret = $this->menu->addAll($insert);
        dd($ret);*/


        /*$menus = $this->menu->all();
        foreach ($menus as $menu) {
            foreach (seller_top_menus($menu->name)['child'] as $sub) {
                // 添加二级菜单
                $insert[] = [
                    'title' => $sub['title'],
                    'icon' => $sub['icon'] ?? null,
                    'pid' => $menu->id,
                    'parent_name' => $menu->name,
                    'name' => explode('|', $sub['menus'])[1],
                    'route' => $sub['route'],
                    'url' => $sub['url'],
//                    'target' => null,
//                    'sort' => 255,
//                    'is_show' => true,
                    'created_at' => format_time(time(), 'Y-m-d H:i:s'),
                    'updated_at' => format_time(time(), 'Y-m-d H:i:s'),
                ];
            }
        }

        $ret = $this->menu->addAll($insert);
        dd($ret);*/

        $title = '列表';
        $fixed_title = '系统菜单 - 列表';

        $action_span = [
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加菜单'
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
        // 搜索条件
        $search_arr = ['name'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'name') {
                    $where[] = ['title', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'sort',
            'sortorder' => 'asc',
            'limit' => 0
        ];
        list($list, $total) = $this->menu->getList($condition, '', true);

        $pageHtml = pagination($total, false);
        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('system.menu.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('system.menu.list', $compact);
    }

    public function add(Request $request)
    {
        $title = '添加';

        $id = $request->get('id', 0);
        $pid = $request->get('pid', 0);

        if ($id) {
            // 更新操作
            $info = $this->menu->getById($id);
            $pid = $info->pid;
            view()->share('info', $info);
            $title = '编辑';
        }

        // 列表
        $where = [];
        $condition = [
            'where' => $where,
            'sortname' => 'sort',
            'sortorder' => 'asc',
            'limit' => 0
        ];
        list($menu_list, $total) = $this->menu->getList($condition, '', true);

        $fixed_title = '系统菜单 - ' . $title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回系统菜单列表'
            ],
        ];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        return view('system.menu.add', compact('title', 'pid', 'menu_list'));
    }

    public function edit(Request $request)
    {
        return $this->add($request);
    }

    public function saveData(Request $request)
    {
        $post = $request->post('AdminMenu');

        if ($post['pid'] == 0) {
            $post['parent_name'] = 'root';
        } else {
            $post['parent_name'] = AdminMenu::where('id', $post['pid'])->value('name');
        }


        if (!empty($post['id'])) {
            // 编辑
            $ret = $this->menu->update($post['id'], $post);
            $msg = '系统菜单编辑';
        } else {
            // 添加
            $ret = $this->menu->store($post);
            $msg = '系统菜单添加';
        }

        if ($ret === false) {
            // fail
            return result(-1, null, $msg . '失败');
        }
        // success
        return result(0, null, $msg . '成功');
    }

    public function setIsShow(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->menu->changeState($id, 'is_show');
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, '设置成功');
    }

    public function editInfo(Request $request)
    {
        $ret = $this->menu->editSort($request);
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, '', '设置成功');
    }

    public function delete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->menu->del($id);
        if ($ret === false) {
            // Log
            return result(-1, '', '删除失败');
        }

        // Log
        return result(0, '', '删除成功');
    }

}