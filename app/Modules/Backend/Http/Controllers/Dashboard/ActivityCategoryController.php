<?php

namespace App\Modules\Backend\Http\Controllers\Dashboard;


use App\Models\ActivityCategory;
use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\ActivityCategoryRepository;
use App\Repositories\ToolsRepository;
use Illuminate\Http\Request;

class ActivityCategoryController extends Backend
{

    private $links = [
        ['url' => 'dashboard/group-buy/group-buy_list', 'text' => '团购列表'],
        ['url' => 'dashboard/activity-category/activity-category_list', 'text' => '团购分类'],
        ['url' => 'dashboard/group-buy/slide-config', 'text' => '幻灯片管理'],
    ];

    protected $activityCategory;

    protected $tools;

    public function __construct(
        ActivityCategoryRepository $activityCategory
        ,ToolsRepository $toolsRepository
    )
    {
        parent::__construct();

        $this->activityCategory = $activityCategory;
        $this->tools = $toolsRepository;
    }


    public function lists(Request $request)
    {
        $title = '团购分类列表';
        $fixed_title = '营销中心 - '.$title;
        $this->sublink($this->links, 'activity-category_list');

        $action_span = [
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加团购分类'
            ]
        ];

        $explain_panel = [
            '团购分类最多为2级分类，商家发布团购活动时选择分类，用于团购页面展示以及对团购活动进行筛选',
            '建议最多添加13个一级分类前台显示效果是最佳',
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
        $search_arr = ['cat_name'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'cat_name') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'relation' => ['goodsActivity'],
            'limit' => 0, // 不分页
            'sortname' => 'created_at',
            'sortorder' => 'desc'
        ];
        list($list, $total) = $this->activityCategory->getList($condition, '', true);

        $pageHtml = pagination($total, false);

        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('dashboard.activity-category.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('dashboard.activity-category.list', $compact);
    }


    public function add(Request $request)
    {
        $title = '添加';

        $id = $request->get('id', 0);
        $parent_id = $request->get('parent_id', 0);

        $where[] = ['parent_id', 0];
        $parent_list = ActivityCategory::where($where)->get();

        $tpl = 'add';
        if ($id) {
            // 更新操作
            $tpl = 'edit';
            $info = $this->activityCategory->getById($id);
            view()->share('info', $info);
            $title = '编辑';
//            $this->sublink($this->links, 'edit', '', '', 'add');

            if ($info->parent_id > 0) {
                $where[] = ['parent_id', $info->parent_id];
                $parent_list = ActivityCategory::where($where)->get();
            } else {
                $parent_list = [];
            }

        }



        $fixed_title = '团购分类 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回团购分类列表'
            ]
        ];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        return view('dashboard.activity-category.add', compact('title', 'parent_list', 'parent_id'));
    }

    public function edit(Request $request)
    {
        return $this->add($request);
    }

    public function saveData(Request $request)
    {
        $post = $request->post('ActivityCategory');

        if (!empty($post['id'])) {
            // 编辑
            $ret = $this->activityCategory->update($post['id'], $post);
        }else {
            // 添加
            $ret = $this->activityCategory->store($post);
        }

        if ($ret === false) {
            // fail
            return result(-1, null, OPERATE_FAIL);
        }
        // success
        return result(0, null, OPERATE_SUCCESS);
    }

    public function setShow(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->activityCategory->changeShow($id);
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, '设置成功');
    }

    public function editSort(Request $request)
    {
        $ret = $this->activityCategory->editSort($request);

        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, '', '设置成功');
    }

    public function delete(Request $request)
    {
        $id = $request->post('id');
        $info = $this->activityCategory->getById($id);

        $ret = $this->activityCategory->del($id);
        if ($ret === false) {
            // Log
            admin_log('团购分类删除失败。ID：'.$id);
            return result(-1, '', '删除失败');
        }

        // Log
        admin_log('团购分类删除成功。ID：'.$id);


        $extra = [
            'parent_id' => $info->parent_id
        ];
        return result(0, '', '删除成功', $extra);
    }
}