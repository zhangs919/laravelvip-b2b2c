<?php

namespace App\Modules\Backend\Http\Controllers\Goods;

use App\Models\GoodsType;
use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\GoodsTypeRepository;
use Illuminate\Http\Request;

class GoodsTypeController extends Backend
{

    private $links = [
        ['url' => 'goods/goods-type/list', 'text' => '列表'],
        ['url' => 'goods/goods-type/add', 'text' => '添加'] // 列表时不显示
    ];

    protected $goodsType;


    public function __construct(GoodsTypeRepository $goodsType)
    {
        parent::__construct();

        $this->goodsType = $goodsType;
    }


    public function lists(Request $request)
    {
        $title = '列表';
        $fixed_title = '商品类型 - 列表';
        $this->sublink($this->links, 'list', '', '', 'add');

        $action_span = [
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加商品类型'
            ],
        ];

        $explain_panel = [
            '商品类型是为了方便管理员维护属性、规格而设置的，管理员可以将某一类商品属性、规格划分到一个商品类型中，以便快速选择想要的属性、规格',
            '一个商品类型中会包含多个商品属性、规格'
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
        $search_arr = ['type_name'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'type_name') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'type_sort',
            'sortorder' => 'asc'
        ];
        list($list, $total) = $this->goodsType->getList($condition);

        $pageHtml = pagination($total);

        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('goods.goods-type.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('goods.goods-type.list', $compact);
    }

    public function add(Request $request)
    {
        $title = '添加';
        $fixed_title = '商品类型 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回商品类型列表'
            ]
        ];
        $explain_panel = [
            '商品类型是为了方便管理员维护属性、规格而设置的，管理员可以将某一类商品属性、规格划分到一个商品类型中，以便快速选择想要的属性、规格',
            '一个商品类型中会包含多个商品属性、规格'
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block
        $this->sublink($this->links, 'add');

        return view('goods.goods-type.add', compact('title'));
    }

    public function edit(Request $request)
    {
        $title = '编辑';
        $fixed_title = '商品类型 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回商品类型列表'
            ]
        ];
        $explain_panel = [
            '商品类型是为了方便管理员维护属性、规格而设置的，管理员可以将某一类商品属性、规格划分到一个商品类型中，以便快速选择想要的属性、规格',
            '一个商品类型中会包含多个商品属性、规格'
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block
        $this->sublink($this->links, 'add');

        $type_id = $request->get('id');
        $info = $this->goodsType->getById($type_id);
        return view('goods.goods-type.add', compact('title', 'info'));
    }

    public function saveData(Request $request)
    {
        $post = $request->post('GoodsTypeModel');
        if (!empty($post['type_id'])) {
            // 编辑
            $ret = $this->goodsType->update($post['type_id'], $post);
            $msg = '商品类型编辑';
        }else {
            // 添加
            $ret = $this->goodsType->store($post);
            $msg = '商品类型添加';
        }

        if ($ret === false) {
            // fail
            flash('error', $msg.'失败');
            return redirect('/goods/goods-type/list');
        }
        // success
        flash('success', $msg.'成功');
        return redirect('/goods/goods-type/list');
    }

    public function clientValidate(Request $request)
    {
        $attribute = $request->get('attribute');
        $goodsTypeModel = $request->get('GoodsTypeModel');
        $type_name = $goodsTypeModel[$attribute];
        $type_id = !empty($goodsTypeModel['type_id']) ? $goodsTypeModel['type_id'] : '';
        if ($type_id != '') {
            return result(0);
        }
        // 检查type_name 是否重复
        if (GoodsType::where($attribute, $type_name)->count()) {
            return result(-1, '', trans('global.'.$attribute).'"'.$type_name.'"已经被占用了。');
        }
        return result(0);
    }

    public function editSort(Request $request)
    {
        $id = $request->post('type_id');
        $title = $request->post('title');
        $value = $request->post('value');

        if ($title == 'type_sort') {
            $value = intval($value);
        }

        $ret = $this->goodsType->update($id, [$title => $value]);

        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, '', '设置成功');
    }

    public function delete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->goodsType->del($id);
        if ($ret === false) {
            // Log
            admin_log('商品类型删除失败。ID：'.$id);
            return result(-1, '', '删除失败');
        }

        // Log
        admin_log('商品类型删除成功。ID：'.$id);
        return result(0, '', '删除成功');
    }

    public function batchDelete(Request $request)
    {
        $ids = $request->post('ids');
        $ret = $this->goodsType->batchDel($ids);

        $ids = implode(',', $ids);
        if ($ret === false) {
            // Log
            admin_log('商品类型批量删除失败。ID：'.$ids);
            return result(-1, '', '删除失败');
        }
        // Log
        admin_log('商品类型批量删除成功。ID：'.$ids);
        return result(0, '', '删除成功');
    }
}