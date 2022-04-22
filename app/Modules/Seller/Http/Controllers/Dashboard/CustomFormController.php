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
// | Date:2019-03-17
// | Description:万能表单
// +----------------------------------------------------------------------

namespace App\Modules\Seller\Http\Controllers\Dashboard;

use App\Models\CustomFormTemplate;
use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\CustomFormRepository;
use App\Repositories\CustomFormTemplateRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 *
 * Class CustomFormController
 * @package App\Modules\Seller\Http\Controllers\Dashboard
 */
class CustomFormController extends Seller
{

    private $links = [
        ['url' => 'dashboard/custom-form/list', 'text' => '表单列表'],
        ['url' => 'dashboard/custom-form/add', 'text' => '添加'],
        ['url' => 'dashboard/custom-form/edit', 'text' => '编辑'],
    ];

    protected $customForm;
    protected $customFormTemplate;

    public function __construct()
    {
        parent::__construct();

        $this->customForm = new CustomFormRepository();
        $this->customFormTemplate = new CustomFormTemplateRepository();

        $this->set_menu_select('dashboard', 'dashboard-center');
    }

    /**
     * 表单列表
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function lists(Request $request)
    {
        $title = '万能表单';
        $fixed_title = '营销中心 - '.$title;

//        $this->sublink($this->links, 'list', '', '', 'add,edit');
        $action_span = [
            [
                'url' => '/dashboard/center/index',
                'icon' => 'fa-reply',
                'text' => '返回营销中心'
            ],
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加万能表单'
            ],

        ];
        $explain_panel = [
            '万能表单：自行设置表单展示项，收集消费者针对表单提交的信息，可应用于收集消费者反馈信息、调研信息、报名登录类信息。'
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel,
        ];
        $this->setLayoutBlock($blocks); // 设置block

        $params = $request->all();
        $where = [];
        // 搜索条件
        $search_arr = ['name'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {
                if ($v == 'name') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'form_id',
            'sortorder' => 'asc'
        ];

        list($list, $total) = $this->customForm->getList($condition);

        $pageHtml = pagination($total);
        if ($request->ajax()) {
            $render = view('dashboard.custom-form.partials._list', compact('list', 'total', 'pageHtml'))->render();
            return result(0, $render);
        }

        return view('dashboard.custom-form.list', compact('title', 'list', 'pageHtml'));
    }


    /**
     * 设计表单
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function edit(Request $request)
    {
        $title = '万能表单-设计表单';
        $form_id = $request->get('form_id');
        $form_info = $this->customForm->getById($form_id);
        if (empty($form_info)) {
            abort(200, '表单id无效');
        }
        $form_info->form_data = !empty(json_decode($form_info->form_data,true)) ? json_decode($form_info->form_data,true) : [];
        $form_info->global_data = !empty(json_decode($form_info->global_data,true)) ? json_decode($form_info->global_data,true) : [];
        $form_info = $form_info->toArray();

        return view('dashboard.custom-form.edit', compact('title', 'form_info'));
    }

    public function preview(Request $request)
    {
        $title = '万能表单-预览';

        $form_id = $request->get('form_id');
        $form_info = $this->customForm->getById($form_id);
        if (empty($form_info)) {
            abort(200, '没有可以预览的数据');
        }

        $form_info['form_data'] = json_decode($request->post('form_datas'),true);
        $form_info['global_data'] = json_decode($request->post('global_datas'),true);

        $compact = compact('title', 'form_info');

        return view('dashboard.custom-form.preview', $compact);
    }

    /**
     * 选择模板
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function template(Request $request)
    {
        $title = '万能表单-选择模板';
        $form_id = $request->get('form_id',0);

        $info = $this->customForm->getById($form_id);
        if (empty($info)) {
            abort(200, '表单id无效');
        }
        // 列表
        $condition = [
            'where' => [],
            'sortname' => 'id',
            'sortorder' => 'asc',
            'limit' => 0
        ];
        list($tpl_list, $tpl_total) = $this->customFormTemplate->getList($condition, 'group');


        return view('dashboard.custom-form.template', compact('title', 'form_id', 'tpl_list'));
    }

    /**
     * 生成表单二维码
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function formQrcode(Request $request)
    {
        $form_id = $request->get('form_id');
        $download = $request->get('download', 0); // 是否下载二维码 默认0
        $info = $this->customForm->getById($form_id);
        if (empty($info)) {
            abort(200, '表单id无效');
        }
        $qrcode = $this->customForm->generateFormQrcode($form_id);
        if ($download) {
            // 下载二维码 todo 下载功能还有问题
//            $savename = $this->seller_info->shop_name.'-'.$info->form_title.'-'.$form_id;
//            return response()->download($qrcode, $savename);
        }

        // 渲染二维码
        return $qrcode;
    }

    public function design(Request $request)
    {
        $title = '万能表单-装修';
        $form_id = $request->get('form_id',0);
        $group = $request->get('group','signup'); // 模板类型
        $code = $request->get('code','blank'); // 模板编号
//        dd(Storage::get('/images/site/1/images/2018/06/03/15280053665794.jpg'));
//        dd(Storage::size('/images/shop/1/gallery/2019/03/17/15528031705446.mp4'));
        $form_info = $this->customForm->getById($form_id);
        if (empty($form_info)) {
            abort(200, '表单id无效');
        }
//        $form_info->form_data = json_decode($form_info->form_data,true);
//        $form_info->global_data = json_decode($form_info->global_data,true);
//        $form_info = $form_info->toArray();

        $tpl_info = CustomFormTemplate::where([['group',$group],['code',$code]])->first();
        if (!empty($tpl_info)) {
            $tpl_info->form_datas = json_decode($tpl_info->form_datas,true);
            $tpl_info->global_form_datas = json_decode($tpl_info->global_form_datas,true);
        }
        $tpl_info = $tpl_info->toArray();


        if ($request->method() == 'POST') {

            $update = [
                'form_data' => $request->post('form_datas'),
                'global_data' => $request->post('global_datas'),
            ];
            $is_publish = $request->post('is_publish');
            if (isset($is_publish)) {
                $update['is_publish'] = $is_publish;
            }
            $ret = $this->customForm->update($form_id, $update);
            if ($ret === false) {
                return result(-1, null, '保存发布失败');
            }

            return result(0, $form_id, '保存发布成功');
        }

        return view('dashboard.custom-form.design', compact('title','form_id', 'tpl_info'));
    }

    /**
     * 添加
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add(Request $request)
    {
        $title = '万能表单添加';

        $id = $request->get('form_id', 0);
        $this->sublink($this->links, 'add', '', '', 'edit');

        if ($id) {
            // 更新操作
            $title = '万能表单编辑';
            $info = $this->customForm->getById($id);
            $info->header_style = explode(',', $info->header_style);
            $info->bottom_style = explode(',', $info->bottom_style);

            view()->share('info', $info);

            $this->sublink($this->links, 'edit', '', '', 'add');

        }

        $fixed_title = '万能表单 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回表单列表'
            ]
        ];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        return view('dashboard.custom-form.add', compact('title'));
    }

    /**
     * 修改万能表单
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editForm(Request $request)
    {
        return $this->add($request);
    }

    public function saveData(Request $request)
    {
        $post = $request->post('Form');

        if (is_array($post['header_style'])) {
            $post['header_style'] = implode(',', $post['header_style']);
        }
        if (is_array($post['bottom_style'])) {
            $post['bottom_style'] = implode(',', $post['bottom_style']);
        }
        if ($request->post('start_time') != -1) {
            $post['start_time'] = $request->post('start_time');
        } else {
            $post['start_time'] = 0;
        }
        if ($request->post('end_time') != -1) {
            $post['end_time'] = $request->post('end_time');
        } else {
            $post['end_time'] = 0;
        }

        if (!empty($post['form_id'])) {
            // 编辑
            $ret = $this->customForm->update($post['form_id'], $post);
            $msg = '万能表单编辑';
            $form_id = $post['form_id'];
        }else {
            // 添加
            $post['shop_id'] = $this->seller_info->shop_id; // 店铺id
//            $post['store_id'] = $this->seller_info->store_id; // 网点id
            $ret = $this->customForm->store($post);
            $msg = '万能表单添加';
            $form_id = $ret->form_id;
        }

        if ($ret === false) {
            // fail
            return result(-1, $msg.'失败');
        }
        // success
        // Log
        shop_log('添加了一个万能表单。ID：'.$form_id);
        return result(0, $form_id, $msg.'成功');
    }

    public function delete(Request $request)
    {
        $ids = $request->get('form_id');

        if (is_array($ids)) {
            $ret = $this->customForm->batchDel($ids);
            $ids = implode(',', $ids);
        } else {
            $ret = $this->customForm->del($ids);
        }

        if ($ret === false) {
            // Log
            shop_log('万能表单删除失败。ID：'.$ids);
            return result(-1, '', '删除失败');
        }

        // Log
        shop_log('万能表单删除成功。ID：'.$ids);
        return result(0, '', '删除成功');
    }

}