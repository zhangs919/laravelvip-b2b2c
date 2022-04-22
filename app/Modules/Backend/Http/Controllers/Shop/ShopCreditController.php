<?php

namespace app\Modules\Backend\Http\Controllers\Shop;


use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\ShopCreditRepository;
use App\Repositories\ToolsRepository;
use Illuminate\Http\Request;

class ShopCreditController extends Backend
{

    private $links = [
        ['url' => 'shop/shop-credit/list', 'text' => '列表'],
        ['url' => 'shop/shop-credit/add', 'text' => '添加'],
        ['url' => 'shop/shop-credit/edit', 'text' => '编辑'],
    ];

    protected $shopCredit;

    protected $tools;

    public function __construct()
    {
        parent::__construct();

        $this->shopCredit = new ShopCreditRepository();
        $this->tools = new ToolsRepository();

    }

    public function index(Request $request)
    {
        return $this->lists($request);
    }

    public function lists(Request $request)
    {
        $title = '列表';
        $fixed_title = '店铺信誉 - '.$title;

        $this->sublink($this->links, 'list', '', '', 'add,edit');

        $action_span = [
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加店铺信誉'
            ],
        ];

        $explain_panel = [
            '信誉值：会员对购买商品的宝贝与描述相符的评分进行累计（"好评"加一分，"中评"不加分，"差评"扣一分），店铺的信誉值增加时机是会员对商品宝贝与描述相符评价之后进行计算的，与对店铺的评分无关',
            '店铺信誉等级的最小值必须为0，如果设置为大于0，新开店铺将在店铺列表中无法正确展示信誉图标',
            '商城已经存在店铺时，请谨慎添加、编辑修改店铺信誉，操作之后会导致数据丢失，店铺信誉无法正常显示'
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
        /*$search_arr = [];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {

                if ($v == '') {
                    $where[] = ['', 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }*/
        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'max_point',
            'sortorder' => 'asc',
        ];
        list($list, $total) = $this->shopCredit->getList($condition);
        $pageHtml = pagination($total);
        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('shop.shop-credit.partials._list', $compact)->render();
            return result(0, $render);
        }
        return view('shop.shop-credit.list', $compact);
    }



    public function add(Request $request)
    {
        $title = '添加';
        $this->sublink($this->links, 'add', '', '', 'edit');

        $id = $request->get('id', 0);

        if ($id) {
            // 更新操作
            $extra = '?id='.$id;
            $info = $this->shopCredit->getById($id);
            view()->share('info', $info);
            $title = '编辑【'.$info->credit_name.'】';
            $this->sublink($this->links, 'edit', '', $extra, 'add');

        }

        $fixed_title = '店铺信誉 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回店铺信誉列表'
            ]
        ];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        return view('shop.shop-credit.add', compact('title'));
    }

    public function edit(Request $request)
    {
        return $this->add($request);
    }


    public function saveData(Request $request)
    {
        $post = $request->post('ShopCreditModel');
        $credit_id = !empty($post['credit_id']) ? $post['credit_id'] : 0;

        if ($credit_id) {
            // 编辑
            $ret = $this->shopCredit->update($credit_id, $post);
            $msg = '店铺信誉编辑';
        }else {
            // 添加
            $ret = $this->shopCredit->store($post);
            $msg = '店铺信誉添加';
        }

        if ($ret === false) {
            // fail
            flash('error', $msg.'失败');
            return redirect('/shop/shop-credit/list');
        }
        // success
        flash('success', $msg.'成功');
        return redirect('/shop/shop-credit/list');
    }

    /**
     * 名称验证是否重复
     *
     * @param Request $request
     * @return mixed
     */
    public function clientValidate(Request $request)
    {
        $result = $this->shopCredit->clientValidate($request, 'ShopCreditModel');
        if (!$result['code']) {
            return result(-1, '', $result['message']);
        }
        return result(0);
    }

    public function delete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->shopCredit->del($id);
        if ($ret === false) {
            // Log
            admin_log('店铺信誉删除失败。ID：'.$id);
            return result(-1, null, '删除失败');
        }

        // Log
        admin_log('店铺信誉删除成功。ID：'.$id);
        return result(0, null, '删除成功');
    }

    public function batchDelete(Request $request)
    {
        $ids = $request->post('ids');
        $ret = $this->shopCredit->batchDel($ids);

        $ids = implode(',', $ids);
        if ($ret === false) {
            // Log
            admin_log('店铺信誉删除失败。ID：'.$ids);
            return result(-1, '', '删除失败');
        }
        // Log
        admin_log('删除了多个店铺信誉。ID：'.$ids);
        return result(0, '', '删除成功');
    }

    public function uploadCreditImg(Request $request)
    {
        $id = $request->post('id');

        $filename = $request->post('filename', 'name');
        $storePath = 'shop/shop-credit';
        $uploadRes = $this->tools->uploadPic($request, $filename, $storePath);

        if (isset($uploadRes['error'])) {
            // 上传出错
            return result(-1, '', $uploadRes['error']);
        }

        $ret = $this->shopCredit->update($id, ['credit_img' => $uploadRes['data']['path']]);
        if ($ret === false) {
            return result(-1, '', '设置失败！');
        }

        return result(0, $uploadRes['data'], '设置成功', ['count' => $uploadRes['count']]);
    }
}