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
// | Date:2018-08-13
// | Description:
// +----------------------------------------------------------------------

namespace app\Modules\Seller\Http\Controllers\Topic;


use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\TopicRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TopicController extends Seller
{
//    private $title;

    private $links = [
        ['url' => 'topic/topic/list', 'text' => '专题活动列表'],
        ['url' => 'topic/topic/add', 'text' => '专题活动添加'],
        ['url' => 'topic/topic/edit', 'text' => '专题活动编辑'],
    ];


    protected $topic;

    public function __construct()
    {
        parent::__construct();

        $this->topic = new TopicRepository();

        $this->set_menu_select('dashboard', 'dashboard-center');

    }


    public function lists(Request $request)
    {
        $title = '专题活动列表';
        $fixed_title = '营销中心 - '.$title;

        $action_span = [
            [
                'url' => '/dashboard/center/index',
                'icon' => 'fa-reply',
                'text' => '返回营销中心'
            ],
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加专题活动'
            ],
        ];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel,
        ];
        $this->setLayoutBlock($blocks); // 设置block
        $this->sublink($this->links, 'list', '', '', 'add,edit');

        $params = $request->all();


        $where = [];

        // 搜索条件
        $search_arr = ['topic_name'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'topic_name') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

        $where[] = ['shop_id', seller_shop_info()->shop_id]; // 店铺id

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'topic_id',
            'sortorder' => 'asc'
        ];

        list($list, $total) = $this->topic->getList($condition);

        $pageHtml = pagination($total);
        if ($request->ajax()) {
            $render = view('topic.topic.partials._list', compact('list', 'total', 'pageHtml'))->render();
            return result(0, $render);
        }

        return view('topic.topic.list', compact('title', 'list', 'pageHtml'));
    }

    public function add(Request $request)
    {
        $title = '专题活动添加';
        $this->sublink($this->links, 'add', '', '', 'edit');
        $id = $request->get('id', 0);

        if ($id) {
            // 更新操作
            $info = $this->topic->getById($id);
            $info->header_style = explode(',', $info->header_style);
            $info->bottom_style = explode(',', $info->bottom_style);

            view()->share('info', $info);
            $title = '专题活动编辑';
            $this->sublink($this->links, 'edit', '', '', 'add');
        }

        $fixed_title = '营销中心 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回专题活动列表'
            ]
        ];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        return view('topic.topic.add', compact('title'));
    }

    public function edit(Request $request)
    {
        return $this->add($request);
    }


    public function saveData(Request $request)
    {
        $post = $request->post('TopicModel');
        $topic_id = !empty($post['topic_id']) ? $post['topic_id'] : 0;

        $post['shop_id'] = seller_shop_info()->shop_id;
        if (is_array($post['header_style'])) {
            $post['header_style'] = implode(',', $post['header_style']);
        }
        if (is_array($post['bottom_style'])) {
            $post['bottom_style'] = implode(',', $post['bottom_style']);
        }

        if ($topic_id) {
            // 编辑
            $ret = $this->topic->update($topic_id, $post);
            $msg = '编辑';
        }else {
            // 添加
            $ret = $this->topic->store($post);
            $msg = '添加';
        }

        if ($ret === false) {
            // fail
            flash('error', $msg.'失败');
            return redirect('/topic/topic/list');
        }
        // success
        flash('success', $msg.'成功');
        return redirect('/topic/topic/list');
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
        $ret = $this->topic->del($id);
        if ($ret === false) {
            // Log
            shop_log('专题活动删除失败。ID：'.$id);
            return result(-1, '', '删除失败');
        }

        // Log
        shop_log('删除了一个专题活动。ID：'.$id);
        return result(0, '', '删除成功');
    }

    public function batchDelete(Request $request)
    {
        $ids = $request->post('ids');
        $ret = $this->topic->batchDel($ids);

        $ids = implode(',', $ids);
        if ($ret === false) {
            // Log
            shop_log('专题活动删除失败。ID：'.$ids);
            return result(-1, '', '删除失败');
        }
        // Log
        shop_log('删除了多个专题活动。ID：'.$ids);
        return result(0, '', '删除成功');
    }

    /**
     * 专题活动 装修
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function design(Request $request)
    {
        $topic_id = $request->get('id');

        return redirect('/design/tpl-setting/setup?page=topic&topic_id='.$topic_id);
    }
}