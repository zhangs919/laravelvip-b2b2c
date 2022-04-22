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
// | Date:2018-08-11
// | Description:
// +----------------------------------------------------------------------

namespace app\Modules\Backend\Http\Controllers\Mall;


use App\Models\Contract;
use App\Models\Shop;
use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\ContractRepository;
use App\Repositories\ShopContractRepository;
use Illuminate\Http\Request;

class ContractController extends Backend
{

    private $links = [
        ['url' => 'mall/contract/audit-list', 'text' => '保障服务申请'],
        ['url' => 'mall/contract/audit-access-list', 'text' => '店铺保障服务'],
        ['url' => 'mall/contract/list', 'text' => '保障服务管理'],
    ];

    protected $contract;
    protected $shopContract;

    public function __construct()
    {
        parent::__construct();

        $this->contract = new ContractRepository();
        $this->shopContract = new ShopContractRepository();

    }

    /**
     * 保障服务申请
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function auditList(Request $request)
    {
        $title = '保障服务申请';
        $fixed_title = '消费保障 - '.$title;

        $this->sublink($this->links, 'audit-list');

        $action_span = [];

        $explain_panel = [
            '列表上展示各店铺申请加入的各项消费者保障服务信息',
            '申请流程：店铺申请->平台方审核->审核通过->店铺成功加入'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();
        $where = [];
        $where[] =['status','!=', 2]; // 审核状态 未审核和审核未通过
        // 搜索条件
        $search_arr = ['contract_name','contract_type','status'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'contract_name') {
                    $where[] = ['contract_name', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'with' => ['shop', 'contract'],
            'sortname' => 'id',
            'sortorder' => 'desc',
        ];
        list($list, $total) = $this->shopContract->getList($condition);
        $pageHtml = pagination($total);
        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('mall.contract.partials._audit_list', $compact)->render();
            return result(0, $render);
        }
        return view('mall.contract.audit_list', $compact);
    }

    /**
     * 店铺保障服务
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function auditAccessList(Request $request)
    {
        $title = '店铺保障服务';
        $fixed_title = '消费保障 - '.$title;

        $this->sublink($this->links, 'audit-access-list');

        $action_span = [];

        $explain_panel = [
            '列表上展示各店铺已经成功加入的各项消费者保障服务信息',
            '店铺未做到某一项保障服务，平台管理员可禁止店铺使用该保障服务'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();
        $where = [];
        $where[] =['status', 2]; // 审核状态 审核通过
        // 搜索条件
        $search_arr = ['contract_name','contract_type','status'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'contract_name') {
                    $where[] = ['contract_name', 'like', "%{$params[$v]}%"];
                } elseif ($v == 'status') {
                    $where[] = ['is_enable', $params[$v]];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'with' => ['shop', 'contract'],
            'sortname' => 'id',
            'sortorder' => 'desc',
        ];
        list($list, $total) = $this->shopContract->getList($condition);
        $pageHtml = pagination($total);
        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('mall.contract.partials._audit_access_list', $compact)->render();
            return result(0, $render);
        }
        return view('mall.contract.audit_access_list', $compact);
    }

    public function lists(Request $request)
    {
        $title = '保障服务管理';
        $fixed_title = '消费保障 - '.$title;

        $this->sublink($this->links, 'list');

        $action_span = [
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加保障服务'
            ],
        ];

        $explain_panel = [
            '列表为平台消费者保障服务项目',
            '是否启用：当状态为“是”时，店铺可以申请加入该服务；状态为“否”时，平台将会禁止店铺加入该保障服务'
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
        $search_arr = ['contract_name','is_open','contract_type'];
        foreach ($search_arr as $v) {
            if (isset($params[$v])/* && !empty($params[$v])*/) {

                if ($v == 'contract_name') {
                    $where[] = ['contract_name', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'contract_sort',
            'sortorder' => 'asc',
        ];
        list($list, $total) = $this->contract->getList($condition);
        $pageHtml = pagination($total);
        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('mall.contract.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('mall.contract.list', $compact);
    }



    public function add(Request $request)
    {
        $title = '添加';

        $id = $request->get('id', 0);

        if ($id) {
            // 更新操作
            $info = $this->contract->getById($id);
            // 检查该保障服务下是否有店铺正在使用
            $isInUse = $this->contract->checkIsInUse($id);
            $info->is_in_use = $isInUse; // 是否正在使用中
            view()->share('info', $info);
            $title = '编辑';
        }

        $fixed_title = '消费保障 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回消费保障列表'
            ]
        ];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        return view('mall.contract.add', compact('title'));
    }

    public function edit(Request $request)
    {
        return $this->add($request);
    }


    public function saveData(Request $request)
    {
        $post = $request->post('ContractModel');
        $contract_id = !empty($post['contract_id']) ? $post['contract_id'] : 0;

        if ($contract_id) {
            // 编辑
            // 检查该保障服务下是否有店铺正在使用
            $isInUse = $this->contract->checkIsInUse($contract_id);
            if ($isInUse) { // 如果正在使用中 不修改is_open
                unset($post['is_open']);
            }
            $ret = $this->contract->update($contract_id, $post);
            $msg = '编辑';
        }else {
            // 添加
            $ret = $this->contract->store($post);
            $msg = '添加';
        }

        if ($ret === false) {
            // fail
            flash('error', $msg.'失败');
            return redirect('/mall/contract/list');
        }
        // success
        flash('success', $msg.'成功');
        return redirect('/mall/contract/list');
    }

    /**
     * 禁止使用 店铺保障服务
     *
     * @param Request $request
     * @return array
     */
    public function forbidden(Request $request)
    {
        $id = $request->get('id');

        $ret = $this->shopContract->changeState($id, 'is_enable');
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, null, '设置成功');
    }

    /**
     * 开启使用 店铺保障服务
     *
     * @param Request $request
     * @return array
     */
    public function enabled(Request $request)
    {
        $id = $request->get('id');

        $ret = $this->shopContract->changeState($id, 'is_enable');
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, null, '设置成功');
    }

    /**
     * 批量开启店铺保障服务
     *
     * @param Request $request
     * @return array
     */
    public function batchOpen(Request $request)
    {
        $ids = $request->post('data');
        $update = [
            'is_enable' => 1
        ];
        $ret = $this->shopContract->batchUpdate('id', $ids, $update);
        if ($ret === false) {
            return result(-1, null, '批量开启失败');
        }
        return result(0, null, '批量开启成功');
    }

    /**
     * 批量禁止使用店铺保障服务
     *
     * @param Request $request
     * @return array
     */
    public function batchForbidden(Request $request)
    {
        $ids = $request->post('data');
        $update = [
            'is_enable' => 0
        ];
        $ret = $this->shopContract->batchUpdate('id', $ids, $update);
        if ($ret === false) {
            return result(-1, null, '批量禁止失败');
        }
        return result(0, null, '批量禁止成功');
    }

    /**
     * 批量审核拒绝保障服务申请
     *
     * @param Request $request
     * @return array
     */
    public function batchRefuse(Request $request)
    {
        $ids = $request->post('data');
        $update = [
            'status' => 3,
            'audit_time' => time()
        ];
        $ret = $this->shopContract->batchUpdate('id', $ids, $update);
        if ($ret === false) {
            return result(-1, null, '批量审核拒绝失败');
        }
        return result(0, null, '批量审核拒绝成功');
    }

    /**
     * 批量审核通过保障服务申请
     *
     * @param Request $request
     * @return array
     */
    public function batchAccess(Request $request)
    {
        $ids = $request->post('data');
        $update = [
            'status' => 2,
            'audit_time' => time()
        ];
        $ret = $this->shopContract->batchUpdate('id', $ids, $update);
        if ($ret === false) {
            return result(-1, null, '批量审核通过失败');
        }
        return result(0, null, '批量审核通过成功');
    }

    /**
     * 审核保障服务申请
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function toAudit(Request $request)
    {
        $title = '审核';
        $id = $request->get('id', 0);
        $info = $this->shopContract->getById($id);
        $info->contract_name = Contract::where('contract_id', $info->contract_id)->value('contract_name');
        $info->shop_name = Shop::where('shop_id', $info->shop_id)->value('shop_name');
        $fixed_title = '消费保障 - '.$title;
        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回消费保障列表'
            ]
        ];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        if ($request->isMethod('POST')) {
            $audit = $request->post('audit'); // 审核状态
            $remark = $request->post('remark'); //
            $id = $request->post('id');

            // 如果状态为待审核 提交的审核状态也为待审核 不保存数据跳转到申请列表
            if ($info->status == 1 && $audit == 1) {
                return redirect('mall/contract/audit-list');
            }
            $update = [
                'status' => $audit,
                'remark' => $remark,
                'audit_time' => time()
            ];
            $ret = $this->shopContract->update($id, $update);
            if ($ret === false) {
                return result(-1, null, '审核失败');
            }
            return redirect('mall/contract/audit-access-list');
        }

        return view('mall.contract.to_audit', compact('title', 'info'));
    }

    /**
     *
     *
     * @param Request $request
     * @return mixed
     */
    public function setIsOpen(Request $request)
    {
        $id = $request->get('id');
        // 检查该保障服务下是否有店铺正在使用
        $isInUse = $this->contract->checkIsInUse($id);
        $contract_info = $this->contract->getById($id);
        if ($isInUse && $contract_info->is_open == 1) {
            return result(-1, null, $contract_info->contract_name.'保障服务正被使用，禁止修改启用状态');
        }
        $ret = $this->contract->changeState($id, 'is_open');
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, '设置成功');
    }


    public function editContractInfo(Request $request)
    {
        $id = $request->post('id');
        $title = $request->post('title');
        $value = $request->post('value');

        if ($title == 'contract_sort') {
            $value = intval($value);
        }
        $ret = $this->contract->update($id, [$title => $value]);

        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, '', '设置成功');
    }

    public function delete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->contract->del($id);
        if ($ret === false) {
            // Log
            admin_log('保障服务删除失败。ID：'.$id);
            return result(-1, '', '删除失败');
        }

        // Log
        admin_log('保障服务删除成功。ID：'.$id);
        return result(0, '', '删除成功');
    }

}