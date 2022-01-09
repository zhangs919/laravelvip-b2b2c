<?php

namespace app\Modules\Backend\Http\Controllers\Shop;


use App\Models\ShopClass;
use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\ShopClassRepository;
use App\Repositories\ToolsRepository;
use Illuminate\Http\Request;

class ShopClassController extends Backend
{

    private $links = [
        ['url' => 'shop/shop-class/list', 'text' => '列表'],
        ['url' => 'shop/shop-class/add', 'text' => '添加'],
        ['url' => 'shop/shop-class/edit', 'text' => '编辑'],
    ];

    protected $shopClass;

    protected $tools;

    public function __construct()
    {
        parent::__construct();

        $this->shopClass = new ShopClassRepository();
        $this->tools = new ToolsRepository();

    }

    public function index(Request $request)
    {
        return $this->lists($request);
    }

    public function lists(Request $request)
    {
        $title = '列表';
        $fixed_title = '店铺分类 - '.$title;

        $this->sublink($this->links, 'list', '', '', 'add,edit');

        $action_span = [
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加店铺分类'
            ],
        ];

        $explain_panel = [
            '店铺分类是店铺的经营分类，用于在添加店铺时进行选择，标示店铺的经营分类'
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
        $search_arr = ['cls_name'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == 'cls_name') {
                    $where[] = ['cls_name', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'cls_id',
            'sortorder' => 'desc',
            'limit' => 0
        ];
        list($list, $total) = $this->shopClass->getList($condition, '', true);
        $pageHtml = pagination($total, false);
//        dd($list);
        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('shop.shop-class.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('shop.shop-class.list', $compact);
    }



    public function add(Request $request)
    {
        $title = '添加';
        $this->sublink($this->links, 'add', '', '', 'edit');

        $id = $request->get('id', 0);
        $parent_id = $request->get('parent_id', 0);

        if ($id) {
            // 更新操作
            $extra = '?id='.$id;
            $info = $this->shopClass->getById($id);
            view()->share('info', $info);
            $title = '编辑【'.$info->cls_name.'】';
            $this->sublink($this->links, 'edit', '', $extra, 'add');

        }

        $fixed_title = '店铺分类 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回店铺分类列表'
            ]
        ];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        // 店铺分类 一级分类
        $condition = [
            'where' => [['parent_id', 0]],
            'sortname' => 'cls_id',
            'sortorder' => 'desc',
            'limit' => 0
        ];
        list($cls_list, $total) = $this->shopClass->getList($condition);

        return view('shop.shop-class.add', compact('title', 'parent_id', 'cls_list'));
    }

    public function edit(Request $request)
    {
        return $this->add($request);
    }


    public function saveData(Request $request)
    {
        $post = $request->post('ShopClassModel');
        $cls_id = !empty($post['cls_id']) ? $post['cls_id'] : 0;

        if ($cls_id) {
            // 编辑
            $ret = $this->shopClass->update($cls_id, $post);
            $msg = '店铺分类编辑';
        }else {
            // 添加
            $ret = $this->shopClass->store($post);
            $msg = '店铺分类添加';
        }

        if ($ret === false) {
            // fail
            flash('error', $msg.'失败');
            return redirect('/shop/shop-class/list');
        }
        // success
        flash('success', $msg.'成功');
        return redirect('/shop/shop-class/list');
    }


    /**
     *
     *
     * @param Request $request
     * @return mixed
     */
    public function setIsShow(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->shopClass->changeState($id, 'is_show');
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, '设置成功');
    }

    public function setIsHot(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->shopClass->changeState($id, 'is_hot');
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, '设置成功');
    }

    public function editShopClassInfo(Request $request)
    {
        $id = $request->post('cls_id');
        $title = $request->post('title');
        $value = $request->post('value');

        if ($title == 'cls_sort') {
            $value = intval($value);
        }
        $ret = $this->shopClass->update($id, [$title => $value]);

        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, '', '设置成功');
    }

    public function delete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->shopClass->del($id);
        if ($ret === false) {
            // Log
            admin_log('店铺分类删除失败。ID：'.$id);
            return result(-1, '', '删除失败');
        }

        // Log
        admin_log('店铺分类删除成功。ID：'.$id);
        return result(0, '', '删除成功');
    }

    public function uploadClsImage(Request $request)
    {
        $id = $request->post('id');

        $filename = $request->post('filename', 'name');
        $storePath = 'shop/class';
        $uploadRes = $this->tools->uploadPic($request, $filename, $storePath);

        if (isset($uploadRes['error'])) {
            // 上传出错
            return result(-1, '', $uploadRes['error']);
        }

        $ret = $this->shopClass->update($id, ['cls_image' => $uploadRes['data']['path']]);
        if ($ret === false) {
            return result(-1, '', '设置失败！');
        }

        return result(0, $uploadRes['data'], '设置成功', ['count' => $uploadRes['count']]);
    }
}