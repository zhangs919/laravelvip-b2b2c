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
// | Description:友情链接管理
// +----------------------------------------------------------------------

namespace app\Modules\Backend\Http\Controllers\Mall;


use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\LinksRepository;
use Illuminate\Http\Request;

class LinksController extends Backend
{

    private $links = [
        ['url' => 'mall/links/list', 'text' => '友情链接列表'],
        ['url' => 'mall/links/add', 'text' => '添加友情链接'],
        ['url' => 'mall/links/edit', 'text' => '编辑友情链接'],
    ];

    protected $flinks;


    public function __construct()
    {
        parent::__construct();

        $this->flinks = new LinksRepository();

    }

    public function lists(Request $request)
    {
        $title = '友情链接列表';
        $fixed_title = '友情链接 - '.$title;

        $this->sublink($this->links, 'list', '', '', 'add,edit');

        $action_span = [
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加友情链接'
            ],
        ];

        $explain_panel = [
            '平台可控制友情链接显示顺序以及是否显示'
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
        $search_arr = ['key_word'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'key_word') {
                    $where[] = ['links_name', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'links_sort',
            'sortorder' => 'asc',
        ];
        list($list, $total) = $this->flinks->getList($condition);
        $pageHtml = pagination($total);

        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('mall.links.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('mall.links.list', $compact);
    }



    public function add(Request $request)
    {
        $title = '添加友情链接';
        $this->sublink($this->links, 'add', '', '', 'edit');

        $id = $request->get('id', 0);

        if ($id) {
            // 更新操作
            $extra = '?id='.$id;
            $info = $this->flinks->getById($id);
            view()->share('info', $info);
            $title = '编辑友情链接';
            $this->sublink($this->links, 'edit', '', $extra, 'add');

        }

        $fixed_title = '友情链接 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回友情链接列表'
            ]
        ];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        return view('mall.links.add', compact('title'));
    }

    public function edit(Request $request)
    {
        return $this->add($request);
    }


    public function saveData(Request $request)
    {
        $post = $request->post('LinksModel');
        $links_id = !empty($post['links_id']) ? $post['links_id'] : 0;

        if ($links_id) {
            // 编辑
            $ret = $this->flinks->update($links_id, $post);
            $msg = '友情链接编辑';
        }else {
            // 添加
            $ret = $this->flinks->store($post);
            $msg = '友情链接添加';
        }

        if ($ret === false) {
            // fail
            flash('error', $msg.'失败');
            return redirect('/mall/links/list');
        }
        // success
        flash('success', $msg.'成功');
        return redirect('/mall/links/list');
    }


    /**
     *
     *
     * @param Request $request
     * @return mixed
     */
    public function setIsShow(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->flinks->changeState($id, 'is_show');
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, '设置成功');
    }


    public function editLinksInfo(Request $request)
    {
        $id = $request->post('id');
        $title = $request->post('title');
        $value = $request->post('value');

        if ($title == 'links_sort') {
            $value = intval($value);
        }
        $ret = $this->flinks->update($id, [$title => $value]);

        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, '', '设置成功');
    }

    public function delete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->flinks->del($id);
        if ($ret === false) {
            // Log
            admin_log('友情链接删除失败。ID：'.$id);
            return result(-1, '', '删除失败');
        }

        // Log
        admin_log('友情链接删除成功。ID：'.$id);
        return result(0, '', '删除成功');
    }

}