<?php

namespace App\Modules\Seller\Http\Controllers\Goods;

use App\Models\Attribute;
use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\AttributeRepository;
use Illuminate\Http\Request;

class SpecController extends Seller
{

    private $links = [
        ['url' => 'goods/spec/list', 'text' => '规格列表'],
    ];

    protected $attribute;


    public function __construct(AttributeRepository $attribute)
    {
        parent::__construct();

        $this->attribute = $attribute;

        $this->set_menu_select('goods', 'goods-spec-list');

    }

    public function lists(Request $request)
    {
        $title = '规格列表';
        $fixed_title = '规格管理 - '.$title;

        $this->sublink($this->links, 'list');

        $action_span = [
            [
                'url' => 'add',
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
        $where[] = ['shop_id', seller_shop_info()->shop_id];
        $where[] = ['is_spec', 1]; // 只查询规格
        // 搜索条件
        $search_arr = ['keywords'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'keywords') { // todo
//                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'attr_sort',
            'sortorder' => 'asc',
        ];
        list($list, $total) = $this->attribute->getList($condition);
        if (!empty($list)) {
            foreach ($list as $item) {
                $attr_values = Attribute::find($item->attr_id)->attr_value()->where('is_delete', 0)->orderBy('attr_vsort')->pluck('attr_vname')->toArray();
                $item->attr_values = implode('、', $attr_values);
            }
        }
        $pageHtml = pagination($total);
        if ($request->ajax()) {
            $render = view('goods.spec.partials._list', compact('list', 'total', 'pageHtml'))->render();
            return result(0, $render);
        }
        return view('goods.spec.list', compact('title', 'list', 'pageHtml'));
    }

    public function add(Request $request)
    {
        $title = '添加规格';

        $id = $request->get('id', 0);

        if ($id) {
            // 更新操作
            $info = $this->attribute->getAttrInfo($id);
            view()->share('info', $info);
            $title = '编辑规格';
        }

        $fixed_title = '规格管理 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回规格列表'
            ],
        ];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        return view('goods.spec.add', compact('title', 'info'));
    }

    public function edit(Request $request)
    {
        return $this->add($request);
    }

    public function saveData(Request $request)
    {
        $post = json_decode($request->post('data'), true);
        $postAttribute = $post['Attribute'];
        $postAttrValue = $post['attr_values'];

        // attribute表中attr_values字段处理
        $attr_vnames = [];
        if (!empty($postAttrValue)) {
            foreach ($postAttrValue as $k=>$v) {
                if (!intval($v['is_delete'])) {
                    $attr_vnames[] = $v['attr_vname'];
                }
            }
        }
        $attr_values = implode(',', $attr_vnames);
        if (!empty($postAttribute['attr_id'])) {
            // 编辑
            $postAttribute['attr_values'] = $attr_values;
            $ret = $this->attribute->updateAttr($postAttribute, $postAttrValue);
            $msg = '编辑规格';
        }else {
            // 添加
            $postAttribute['shop_id'] = seller_shop_info()->shop_id;
            $postAttribute['attr_values'] = $attr_values;
            $ret = $this->attribute->storeAttr($postAttribute, $postAttrValue);
            $msg = '添加规格';
        }

        if ($ret === false) {
            // fail
            return result(-1, null, $msg.'失败');
        }
        // success
        return result(0, '/goods/spec/list', $msg.'成功');
    }

    public function editAttrInfo(Request $request)
    {
        $ret = $this->attribute->editSort($request);
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, '', '设置成功');
    }

    /**
     * 删除
     * todo 删除时 需要删除关联规格值
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->attribute->del($id);
        if ($ret === false) {
            // Log
            return result(-1, '', '删除失败');
        }

        // Log
        return result(0, '', '删除成功');
    }

    /**
     * 批量删除
     * todo 删除时 需要删除关联规格值
     * @param Request $request
     * @return mixed
     */
    public function batchDelete(Request $request)
    {
        $ids = $request->post('ids');
        $ret = $this->attribute->batchDel(explode(',', $ids));

        if ($ret === false) {
            // Log
            shop_log('商品属性批量删除失败。ID：'.$ids);
            return result(-1, '', '删除失败');
        }
        // Log
        shop_log('商品属性批量删除成功。ID：'.$ids);
        return result(0, '', '删除成功');
    }
}