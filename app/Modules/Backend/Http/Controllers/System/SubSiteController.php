<?php

namespace App\Modules\Backend\Http\Controllers\System;


use App\Models\AdminNode;
use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\AdminRoleRepository;
use App\Repositories\SubSiteRepository;
use App\Services\Tree;
use Illuminate\Http\Request;

class SubSiteController extends Backend
{
    private $links = [
        ['url' => 'system/subsite/list', 'text' => '站点列表'],
    ];

    protected $subSite;


    public function __construct(SubSiteRepository $subSite)
    {
        parent::__construct();

        $this->subSite = $subSite;
    }

    public function lists(Request $request)
    {
        $title = '站点列表';
        $fixed_title = '站点管理 - '.$title;
        $this->sublink($this->links, 'list');
        $action_span = [
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加站点'
            ],
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];
        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();
        $where = [];
        // 搜索条件
        $search_arr = ['key_word', 'site_status'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'key_word') {
                    $where[] = ['site_name', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'site_id',
            'sortorder' => 'desc'
        ];
        list($list, $total) = $this->subSite->getList($condition);
        $pageHtml = pagination($total);

        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('system.subsite.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('system.subsite.list', $compact);
    }

    public function add(Request $request)
    {
        $title = '添加站点';

        $id = $request->get('id', 0);
        $auth_codes = [];
        if ($id) {
            // 更新操作
            $title = '编辑站点';
            $info = $this->subSite->getById($id);
            view()->share('info', $info);
        }

        $fixed_title = '站点管理 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回站点列表'
            ]
        ];
        $explain_panel = [
            '站点是由平台方自主创建的分站，站点需向平台方缴纳加盟使用费。逾期未续费平台方管理员可手动关闭该站点，站点关闭后，前台则无法访问站点。',
            '站长（即站点总管理员）统筹管理站点下的店铺、商品、广告等信息。站点可通过收取店铺分成、广告推广等费用盈利。',
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        return view('system.subsite.add', compact('title'));
    }

    public function edit(Request $request)
    {
        return $this->add($request);
    }

    public function saveData(Request $request)
    {
        $post = $request->post('SiteModel');


        if (!empty($post['site_id'])) {
            // 编辑
            $ret = $this->subSite->update($post['site_id'], $post);
            $msg = '站点编辑';
        }else {
            // 添加
            $ret = $this->subSite->store($post);
            $msg = '站点添加';
        }

        if ($ret === false) {
            // fail
            return result(-1, null, $msg.'失败');
        }
        // success
        return result(0, null, $msg.'成功');
    }

    /**
     * 名称验证是否重复
     *
     * @param Request $request
     * @return mixed
     */
    public function clientValidate(Request $request)
    {
        $result = $this->subSite->clientValidate($request, 'SiteModel');
        if (!$result['code']) {
            return result(-1, '', $result['message']);
        }
        return result(0);
    }

    public function delete(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->subSite->del($id);
        if ($ret === false) {
            // Log
            admin_log('站点删除失败。ID：'.$id);
            return result(-1, '', '删除失败');
        }

        // Log
        admin_log('站点删除成功。ID：'.$id);
        return result(0, '', '删除成功');
    }
}