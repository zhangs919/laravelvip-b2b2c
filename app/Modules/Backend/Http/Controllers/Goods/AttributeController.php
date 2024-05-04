<?php

namespace App\Modules\Backend\Http\Controllers\Goods;

use App\Models\CatAttribute;
use App\Models\Category;
use App\Models\GoodsAttr;
use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\AttributeRepository;
use App\Repositories\AttrValueRepository;
use App\Repositories\GoodsTypeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class AttributeController extends Backend
{

    private $attr_links = [
        ['url' => 'goods/attribute/base-list', 'text' => '属性列表'],
        ['url' => 'goods/attribute/edit-base', 'text' => '编辑'],
    ];

    private $spec_links = [
        ['url' => 'goods/attribute/spec-list', 'text' => '规格列表'],
        ['url' => 'goods/attribute/edit-spec', 'text' => '编辑'],

    ];


    protected $attribute;

    protected $goodsType;

    protected $attrValue;


    public function __construct(
        AttributeRepository $attribute,
        GoodsTypeRepository $goodsType,
        AttrValueRepository $attrValue
    )
    {
        parent::__construct();

        $this->attribute = $attribute;
        $this->goodsType = $goodsType;
        $this->attrValue = $attrValue;

        $goodsTypeAll = $this->goodsType->all();
        view()->share('goods_type_all', $goodsTypeAll);
    }


    public function baseList(Request $request)
    {
        $title = '列表';
        $fixed_title = '商品类型 - 属性列表';
        $this->sublink($this->attr_links, 'base-list', '', '', 'edit-base');

        $type_id = $request->get('type_id');

        $action_span = [
            [
                'url' => '/goods/goods-type/list',
                'icon' => 'fa-reply',
                'text' => '返回商品类型列表'
            ],
            [
                'url' => 'add-base?type_id=' . $type_id,
                'icon' => 'fa-plus',
                'text' => '添加属性'
            ],
        ];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $where = [];
        $where[] = ['is_spec', 0]; // 是否是规格 查询属性
        $where[] = ['type_id', $type_id];

        // 搜索条件
        $search_arr = ['keywords', 'attr_style'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'keywords') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'attr_id',
            'sortorder' => 'asc',
        ];
        list($list, $total) = $this->attribute->getList($condition);

        if (!empty($list)) {
            foreach ($list as &$item) {
                $attr_value = DB::table('attr_value')->where('attr_id', $item->attr_id)->orderBy('attr_vsort', 'asc')->pluck('attr_vname');
                $item->attr_values = implode(',', $attr_value->toArray());
                $item->type_name = $this->goodsType->getById($item->type_id)['type_name'];
                $item->attr_style = attr_style($item->attr_style);
            }
        }

        $pageHtml = pagination($total);

        $compact = compact('title', 'list', 'total', 'pageHtml', 'type_id');
        if ($request->ajax()) {
            $render = view('goods.attribute.partials._base_list', $compact)->render();
            return result(0, $render);
        }
        return view('goods.attribute.base_list', $compact);
    }

    public function specList(Request $request)
    {
        $title = '列表';
        $fixed_title = '商品类型 - 规格列表';
        $this->sublink($this->spec_links, 'spec-list', '', '', 'edit-spec');

        $type_id = $request->get('type_id');

        $action_span = [
            [
                'url' => '/goods/goods-type/list',
                'icon' => 'fa-reply',
                'text' => '返回商品类型列表'
            ],
            [
                'url' => 'add-spec?type_id=' . $type_id,
                'icon' => 'fa-plus',
                'text' => '添加规格'
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
        $where[] = ['is_spec', 1]; // 是否是规格 查询规格
        $where[] = ['type_id', $type_id];

        // 搜索条件
        $search_arr = ['keywords', 'attr_style'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'keywords') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'attr_id',
            'sortorder' => 'asc'
        ];
        list($list, $total) = $this->attribute->getList($condition);

        if (!empty($list)) {
            foreach ($list as &$item) {
                $attr_value = DB::table('attr_value')->where('attr_id', $item->attr_id)->orderBy('attr_vsort', 'asc')->pluck('attr_vname');
                $item->attr_values = implode(',', $attr_value->toArray());
                $item->type_name = $this->goodsType->getById($item->type_id)['type_name'];
                $item->attr_style = attr_style($item->attr_style);
            }
        }

        $pageHtml = pagination($total);

        $compact = compact('title', 'list', 'total', 'pageHtml', 'type_id');
        if ($request->ajax()) {
            $render = view('goods.attribute.partials._spec_list', $compact)->render();
            return result(0, $render);
        }
        return view('goods.attribute.spec_list', $compact);
    }

    public function addBase(Request $request)
    {
        $title = '添加属性';
        $fixed_title = '商品类型 - ' . $title;

        $type_id = $request->get('type_id');

        $action_span = [
            [
                'url' => '/goods/goods-type/list',
                'icon' => 'fa-reply',
                'text' => '返回商品类型列表'
            ],
            [
                'url' => '/goods/attribute/base-list?type_id=' . $type_id,
                'icon' => 'fa-reply',
                'text' => '返回属性列表'
            ],
        ];
        $explain_panel = [
            '商品属性的显示样式在编辑的时候不允许进行随意更换，以免造成商家发布商品的数据丢失，如果有需要变更属性的显示样式，请重新创建一个商品属性'
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        return view('goods.attribute.add_base', compact('title', 'type_id'));
    }

    public function editBase(Request $request)
    {
        $id = $request->get('id', 0);
        $type_id = $request->get('type_id', 0);

        $this->sublink($this->attr_links, 'edit-base', '', '?type_id=' . $type_id);

        $title = '编辑';
        $fixed_title = '商品类型 - ' . $title;

        $action_span = [
            [
                'url' => 'base-list?type_id=' . $type_id,
                'icon' => 'fa-reply',
                'text' => '返回商品类型列表'
            ]
        ];
        $explain_panel = [
            '商品属性的显示样式在编辑的时候不允许进行随意更换，以免造成商家发布商品的数据丢失，如果有需要变更属性的显示样式，请重新创建一个商品属性'
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        $info = $this->attribute->getById($id);
        $attrValueCondition = [
            'where' => [['attr_id', $info->attr_id]],
            'limit' => 0,
            'sortname' => 'attr_vsort',
            'sortorder' => 'asc'
        ];
        list($info->attr_values, $attr_value_total) = $this->attrValue->getList($attrValueCondition);
        return view('goods.attribute.edit_base', compact('title', 'info', 'type_id'));
    }

    public function saveData(Request $request)
    {
        $type_id = $request->get('type_id');

        $post = $request->post('data');
        $postData = json_decode($post, true);
        $attributeModel = $postData['AttributeModel'];
        $attr_values = $postData['attr_values'];

        if ($attributeModel['attr_style'] != 2) {
            // 多选 单选
            array_multisort(array_column($attr_values, 'attr_vsort'), SORT_ASC, $attr_values);
        }

        $saveData = $attributeModel;
        $saveData['type_id'] = $type_id;

        if (!empty($attributeModel['attr_id'])) {
            // 编辑
            $ret = $this->attribute->updateAttr($saveData, $attr_values);
            $msg = '商品属性编辑';
        } else {
            // 添加
            $ret = $this->attribute->storeAttr($saveData, $attr_values);
            $msg = '商品属性添加';
        }

        if ($attributeModel['is_spec']) {
            // 如果是规格
            $url = 'spec-list?type_id=' . $type_id;
        } else {
            $url = 'base-list?type_id=' . $type_id;
        }


        if ($ret === false) {
            // fail
            return result(-1, '', OPERATE_FAIL);
        }
        // success
        return result(0, $url, OPERATE_SUCCESS);
    }


    /**
     * 添加规格
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addSpec(Request $request)
    {
        $title = '添加规格';
        $fixed_title = '商品类型 - ' . $title;

        $type_id = $request->get('type_id');

        $action_span = [
            [
                'url' => '/goods/goods-type/list',
                'icon' => 'fa-reply',
                'text' => '返回商品类型列表'
            ],
            [
                'url' => '/goods/attribute/spec-list?type_id=' . $type_id,
                'icon' => 'fa-reply',
                'text' => '返回规格列表'
            ],
        ];
        $explain_panel = [
            '商品规格只有“多选”的显示样式'
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        return view('goods.attribute.add_spec', compact('title', 'type_id'));
    }

    public function editSpec(Request $request)
    {
        $id = $request->get('id', 0);
        $type_id = $request->get('type_id', 0);

        $this->sublink($this->spec_links, 'edit-spec', '', '?type_id=' . $type_id);

        $title = '编辑';
        $fixed_title = '商品类型 - ' . $title;

        $action_span = [
            [
                'url' => 'spec-list?type_id=' . $type_id,
                'icon' => 'fa-reply',
                'text' => '返回规格列表'
            ]
        ];
        $explain_panel = [
            '商品规格只有“多选”的显示样式'
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        $info = $this->attribute->getById($id);
        $attrValueCondition = [
            'where' => [['attr_id', $info->attr_id]],
            'limit' => 0,
            'sortname' => 'attr_vsort',
            'sortorder' => 'asc'
        ];
        list($info->attr_values, $attr_value_total) = $this->attrValue->getList($attrValueCondition);
        return view('goods.attribute.edit_spec', compact('title', 'info', 'type_id'));
    }

    public function editAttrInfo(Request $request)
    {
        $id = $request->post('id');
        $title = $request->post('title');
        $value = $request->post('value');

        if ($title == 'attr_sort') {
            $value = intval($value);
        }

        $ret = $this->attribute->update($id, [$title => $value]);

        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, '', '设置成功');
    }

    /**
     * 批量删除/单个删除
     *
     * @param Request $request
     * @return array
     */
    public function delete(Request $request)
    {
        $ids = $request->post('ids');
        $confirm = $request->post('confirm', false);
        $ids_arr = explode(',', $ids);

        $ret = $this->attribute->deleteAttribute($ids, $confirm);

        if (!empty($ret['code'])) {
            return result($ret['code'], $ret['data'], $ret['message']);
        }

        if (count($ids_arr) > 1) {
            // 批量删除
            $log_msg = '商品属性批量';
        } else {
            // 单个删除
            $log_msg = '商品属性';
        }
        if ($ret === false) {
            // Log
            admin_log($log_msg . '删除失败。ID：' . $ids);
            return result(-1, '', '删除失败');
        }
        // Log
        admin_log($log_msg . '删除成功。ID：' . $ids);
        return result(0, '', '删除成功');
    }


}