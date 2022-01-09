<?php

namespace App\Modules\Backend\Http\Controllers\Topic;

use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\TopicRepository;
use Illuminate\Http\Request;

class TopicController extends Backend
{

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
    }

    public function bgSetting(Request $request/*$page, $topic_id*/)
    {
        $page_id = make_uuid();
        $page = $request->get('page');
        $topic_id = $request->get('topic_id');
        $info = $this->topic->getById($topic_id);

        if ($request->method() == 'POST') {
            $post = $request->post('TopicModel');
            $ret = $this->topic->update($topic_id, $post);
            if ($ret === false) {
                return result(-1, '', '设置失败');
            }
            return result(0, '', '设置成功');
        }

        $render = view('topic.topic._bg-setting', compact('page_id', 'info', 'topic_id', 'page'))->render();
        return result(0, $render);
    }

    public function lists(Request $request)
    {
        $title = '专题活动列表';
        $fixed_title = '营销中心 - '.$title;

        $this->sublink($this->links, 'list', '', '', 'add,edit');
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


    public function add(Request $request)
    {
        $title = '专题活动添加';
        $this->sublink($this->links, 'add', '', '', 'edit');

        $id = $request->get('id', 0);
        if ($id) {
            // 更新操作
            $title = '专题活动编辑';
            $info = $this->topic->getById($id);
            $info->header_style = explode(',', $info->header_style);
            $info->bottom_style = explode(',', $info->bottom_style);

            view()->share('info', $info);

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

        if (is_array($post['header_style'])) {
            $post['header_style'] = implode(',', $post['header_style']);
        }
        if (is_array($post['bottom_style'])) {
            $post['bottom_style'] = implode(',', $post['bottom_style']);
        }

        if (!empty($post['topic_id'])) {
            // 编辑
            $ret = $this->topic->update($post['topic_id'], $post);
            $msg = '专题活动编辑';
        }else {
            // 添加
            $ret = $this->topic->store($post);
            $msg = '专题活动添加';
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

    public function delete(Request $request)
    {
        $ids = $request->post('id');

        if (count($ids) > 1) {
            $ret = $this->topic->batchDel($ids);
        } else {
            $ret = $this->topic->del($ids);
        }

        if (is_array($ids)) {
            $ids = implode(',', $ids);
        }
        if ($ret === false) {
            // Log
            admin_log('专题活动删除失败。ID：'.$ids);
            return result(-1, '', '删除失败');
        }

        // Log
        admin_log('专题活动删除成功。ID：'.$ids);
        return result(0, '', '删除成功');
    }

}