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
// | Date:2019-03-14
// | Description:万能表单数据
// +----------------------------------------------------------------------

namespace App\Modules\Backend\Http\Controllers\Dashboard;

use App\Models\CustomFormData;
use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\CustomFormDataRepository;
use App\Repositories\CustomFormRepository;
use Illuminate\Http\Request;

/**
 *
 * Class CustomFormController
 * @package App\Modules\Backend\Http\Controllers\Dashboard
 */
class CustomFormDataController extends Backend
{

    private $links = [
        ['url' => 'dashboard/custom-form-data/list', 'text' => '数据收集列表'],
        ['url' => 'dashboard/custom-form-data/view', 'text' => '统计视图'],
        ['url' => 'dashboard/custom-form-data/detail', 'text' => '查看明细'],
    ];

    protected $customForm;
    protected $customFormData;

    public function __construct(
        CustomFormRepository $customForm
        ,CustomFormDataRepository $customFormData
    )
    {
        parent::__construct();

        $this->customForm = $customForm;
        $this->customFormData = $customFormData;
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
        $title = '数据收集列表';
        $fixed_title = '万能表单 - '.$title;
        $form_id = $request->get('form_id');

        $this->sublink($this->links, 'list', '', '?form_id='.$form_id, 'detail');
        $action_span = [
            [
                'url' => '/dashboard/custom-form/list',
                'icon' => 'fa-reply',
                'text' => '返回表单列表'
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
        $search_arr = ['start_time','end_time'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {
//                if ($v == 'name') {
//                    $where[] = [$v, 'like', "%{$params[$v]}%"];
//                } else {
//                    $where[] = [$v, $params[$v]];
//                }
            }
        }

        $where[] = ['form_id', $form_id];
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'id',
            'sortorder' => 'asc'
        ];

        list($list, $total) = $this->customFormData->getList($condition);

        $pageHtml = pagination($total);
        if ($request->ajax()) {
            $render = view('dashboard.custom-form-data.partials._list', compact('list', 'total', 'pageHtml'))->render();
            return result(0, $render);
        }

        return view('dashboard.custom-form-data.list', compact('title', 'list', 'pageHtml'));
    }

    /**
     * 查看明细
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detail(Request $request)
    {
        $title = '查看明细';
        $fixed_title = '万能表单 - '.$title;
        $id = $request->get('id');

        $form_data_info = $this->customFormData->getById($id);
        if (empty($form_data_info)) {
            abort(200, '表单明细id无效');
        }

        $form_info = $this->customForm->getById($form_data_info->form_id);

        $action_span = [
            [
                'url' => '/dashboard/custom-form-data/list?form_id='.$form_data_info->form_id,
                'icon' => 'fa-reply',
                'text' => '返回反馈列表'
            ],
        ];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel,
        ];
        $this->setLayoutBlock($blocks); // 设置block

        return view('dashboard.custom-form-data.detail', compact('title','form_data_info','form_info'));
    }

    public function view(Request $request)
    {
        $title = '统计视图';
        $fixed_title = '万能表单 - '.$title;
        $form_id = $request->get('form_id');

        $form_info = $this->customForm->getById($form_id);
        if (empty($form_info)) {
            abort(200, '表单id无效');
        }

        $this->sublink($this->links, 'view', '', '?form_id='.$form_id, 'detail');
        $action_span = [
            [
                'url' => '/dashboard/custom-form/list',
                'icon' => 'fa-reply',
                'text' => '返回表单列表'
            ],
        ];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel,
        ];
        $this->setLayoutBlock($blocks); // 设置block

        // 统计每个选项的选择次数 radio-单选、checkbox-多选、select-下拉框
        $statistics_form_data = [];
        if (!empty($form_info->form_data)) {
            $form_data = [];
            foreach (json_decode($form_info->form_data,true) as $k=>$v) {
                $item_type = $v['type'].'_'.$k;
                if (in_array($v['type'], ['radio','checkbox','select'])) {
                    foreach ($v['items'] as $kk=>$vv) {

                    }
                    $form_data[$item_type] = [
                        'title' => $v['title'],
                        'type' => $item_type,
                        'items' => array_column($v['items'],'val')
                    ];
                }
            }

            $form_data_list = CustomFormData::where('form_id', $form_id)->pluck('form_data')->toArray();


            foreach ($form_data_list as $k=>$v) {
                foreach ($v as $kk=>$vv) {
                    if (in_array($vv['type'], array_keys($form_data))) {
                        $all_data_items = $form_data[$vv['type']]['items'];

                        foreach ($all_data_items as $adi) {

                            if (is_string($vv['value']) && $adi == $vv['value']) {
                                @$statistics_form_data[$vv['type']]['items'][$adi]++;
                            } elseif (is_array($vv['value']) && in_array($adi, $vv['value'])) {
                                @$statistics_form_data[$vv['type']]['items'][$adi]++;
                            }
                        }

                        $statistics_form_data[$vv['type']]['title'] = $vv['title'];
                        $statistics_form_data[$vv['type']]['type'] = $vv['type'];

                    }
                }
            }
            foreach ($statistics_form_data as $k=>$v) {
                $all_data_items = $form_data[$k]['items'];
                foreach ($all_data_items as $kk=>$vv) {
                    if (in_array($vv, array_keys($v['items']))) { // todo items数组未按all_data_items里的数组顺序排序
                        $statistics_form_data[$k]['items'][$vv] = $v['items'][$vv];
                    } else {
                        $statistics_form_data[$k]['items'][$vv] = 0;
                    }
                }
            }
        }


        return view('dashboard.custom-form-data.view', compact('title','form_info', 'statistics_form_data'));
    }

}