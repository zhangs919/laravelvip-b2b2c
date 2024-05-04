<?php

namespace App\Modules\Backend\Http\Controllers\System;

use App\Models\AdminNode;
use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\AdminNodeRepository;
use Illuminate\Http\Request;

/**
 * 权限节点
 *
 * Class MenuController
 * @package App\Modules\Backend\Http\Controllers\System
 */
class NodeController extends Backend
{

    protected $node;


    public function __construct()
    {
        parent::__construct();

        $this->node = new AdminNodeRepository();
    }

    public function lists(Request $request)
    {

        $title = '列表';
        $fixed_title = '权限节点 - 列表';

        $action_span = [
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加节点'
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
                    $where[] = ['node_title', 'like', "%{$params[$v]}%"];
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
        list($list, $total) = $this->node->getList($condition, '', true);

        $pageHtml = pagination($total, false);
        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('system.node.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('system.node.list', $compact);
    }

    public function add(Request $request)
    {
        $title = '添加';

        $id = $request->get('id', 0);
        $parent_node_id = $request->get('parent_node_id', 0);

        if ($id) {
            // 更新操作
            $info = $this->node->getById($id);
            $parent_node_id = $info->parent_node_id;
            view()->share('info', $info);
            $title = '编辑';
        }

        // 列表
        $condition = [
            'sortname' => 'sort',
            'sortorder' => 'asc',
            'limit' => 0
        ];
        list($node_list, $total) = $this->node->getList($condition, '', true);

        $fixed_title = '权限节点 - ' . $title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回权限节点列表'
            ],
        ];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        return view('system.node.add', compact('title', 'parent_node_id', 'node_list'));
    }

    public function edit(Request $request)
    {
        return $this->add($request);
    }

    public function saveData(Request $request)
    {
        $post = $request->post('AdminNode');

        if ($post['parent_node_id'] == 0) {
            $post['parent_node'] = 'root';
        } else {
            $post['parent_node'] = AdminNode::where('id', $post['parent_node_id'])->value('node_name');
        }
        if (!empty($post['id'])) {
            // 编辑
            $ret = $this->node->update($post['id'], $post);
            $msg = '权限节点编辑';
        } else {
            // 添加
            $ret = $this->node->store($post);
            $msg = '权限节点添加';
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
        $ret = $this->node->changeState($id, 'is_show');
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, '设置成功');
    }

    public function editInfo(Request $request)
    {
        $ret = $this->node->editSort($request);
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, '', '设置成功');
    }

    public function delete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->node->del($id);
        if ($ret === false) {
            // Log
            return result(-1, '', '删除失败');
        }

        // Log
        return result(0, '', '删除成功');
    }

}