<?php

namespace app\Modules\Backend\Http\Controllers\System;

use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\CategoryRepository;
use App\Repositories\ToolsRepository;
use Illuminate\Http\Request;

class SeoCategoryController extends Backend
{

    private $links = [];

    protected $category;

    protected $tools;

    public function __construct()
    {
        parent::__construct();

        $this->category = new CategoryRepository();
        $this->tools = new ToolsRepository();
    }


    public function lists(Request $request)
    {
        $title = 'SEO列表';
        $fixed_title = '商品分类 - 列表';

        $action_span = [];

        $explain_panel = [
            '此界面用于商城商品分类页面搜索引擎优化设置选项',
            '以下是可用SEO变量：商城名称{site_name}，分类名称{name}，分类关键字{keywords}，分类描述{discription}',
            '默认title ：{name}-{site_name}',
            '默认keywords ：【{name}】{keywords}-{site_name}',
            '默认discription ：【{name}】{discription}-{site_name}'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $where = [];

        // 列表
        $condition = [
            'where' => $where,
            'limit' => 0, // 不分页
            'sortname' => 'created_at',
            'sortorder' => 'desc'
        ];
        list($list, $total) = $this->category->getList($condition, '', false, true);
//        dd($list);

        $pageHtml = pagination($total, false);

        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('system.seo-category.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('system.seo-category.list', $compact);
    }

    public function seoEdit(Request $request)
    {
        $uuid = make_uuid();
        $cat_id = $request->get('cat_id');

        $render = view('system.seo-category.seo_edit', compact('uuid', 'cat_id'))->render();

        return result(0, $render);
    }

    public function seoSave(Request $request)
    {
        $ret = $this->category->update($request->post('cat_id'), $request->post());
        if ($ret === false) {
            result(-1, '', '保存失败');
        }
        return result(0, '', '保存成功');
    }


}