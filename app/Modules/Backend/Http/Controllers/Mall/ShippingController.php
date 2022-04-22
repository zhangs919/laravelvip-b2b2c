<?php

namespace app\Modules\Backend\Http\Controllers\Mall;


use App\Models\SheetConfig;
use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\SheetConfigRepository;
use App\Repositories\ShippingRepository;
use Illuminate\Http\Request;

class ShippingController extends Backend
{

    private $links = [
        ['url' => 'mall/shipping/edit', 'text' => '设置运单模板'],
        ['url' => 'mall/shipping/print', 'text' => '打印预览'],
    ];

    protected $shipping;
    protected $sheetConfig;

    public function __construct()
    {
        parent::__construct();

        $this->shipping = new ShippingRepository();
        $this->sheetConfig = new SheetConfigRepository();
    }


    public function lists(Request $request)
    {
        $title = '列表';
        $fixed_title = '快递公司 - '.$title;

        $action_span = [
            [
                'url' => 'add',
                'icon' => 'fa-plus',
                'text' => '添加快递公司'
            ]
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
        $search_arr = ['shipping_name', 'is_open', 'is_sheet'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {
                if ($v == 'shipping_name') {
                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'shipping_sort',
            'sortorder' => 'asc'
        ];

        list($list, $total) = $this->shipping->getList($condition);

        $pageHtml = pagination($total);
        if ($request->ajax()) {
            $render = view('mall.shipping.partials._list', compact('list', 'total', 'pageHtml'))->render();
            return result(0, $render);
        }

        return view('mall.shipping.list', compact('title', 'list', 'pageHtml'));
    }

    /**
     * 添加快递公司
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add(Request $request)
    {
        $title = '添加';

        $id = $request->get('id', 0);

        if ($id) {
            // 更新操作
            $extra = '?id='.$id;
            $info = $this->shipping->getById($id);
            view()->share('info', $info);
            $title = '编辑';
        }

        $fixed_title = '快递公司 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回快递公司列表'
            ]
        ];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        return view('mall.shipping.add', compact('title'));
    }

    /**
     * 编辑快递公司
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editShipping(Request $request)
    {
        return $this->add($request);
    }

    /**
     * 快递公司添加/编辑 保存数据
     *
     * @param Request $request
     * @return array
     */
    public function saveData(Request $request)
    {
        $post = $request->post('Shipping');
        if (!empty($post['shipping_id'])) {
            // 编辑
            $ret = $this->shipping->update($post['shipping_id'], $post);
            $msg = '快递公司编辑';
        }else {
            // 添加
            $ret = $this->shipping->store($post);
            $msg = '快递公司添加';
        }

        if ($ret === false) {
            // fail
            return result(-1, '', $msg.'失败');
        }
        // success
        return result(0, '', $msg.'成功');
    }

    /**
     * 设置运单模板
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request)
    {
        $title = '设置运单模板';

        $id = $request->get('id', 0);
        $info = $this->shipping->getById($id);
        view()->share('info', $info);
        $config_lable = array_filter(explode('||,||', $info->config_lable));
        $lables = [];
        if (!empty($config_lable)) {
            foreach ($config_lable as $item) {
                $lableArr = explode(',', $item);
                $lables[$lableArr[0]] = $lableArr;
            }
        }
        $info->config_lable = $lables;
        $fixed_title = '快递公司 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回快递公司列表'
            ],
            [
                'url' => 'print?id='.$id,
                'icon' => 'fa-print',
                'text' => '打印预览'
            ],
        ];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        if ($request->method() == 'POST') {
            $postData = $request->post('data');
            $postShipping = $postData['Shipping'];

            if (!empty($postShipping['shipping_id'])) {
                // 编辑
                $ret = $this->shipping->update($postShipping['shipping_id'], $postShipping);
                $msg = '设置运单模板';
            }else {
                // 添加

//            dd($postShipping);
                $ret = $this->shipping->store($postShipping);
                $msg = '快递公司添加';
            }

            if ($ret === false) {
                // fail
                return result(-1, '', $msg.'失败');
            }
            // success
            return result(0, '', $msg.'成功');
        }

        return view('mall.shipping.edit', compact('title'));
    }

    /**
     * 测试打印
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function prints(Request $request)
    {
        $title = '运单模板打印预览';

        $id = $request->get('id');
        $fixed_title = '快递公司 - '.$title;
        $extra = '?id='.$id;
        $this->sublink($this->links, 'print', '', $extra);

        $info = $this->shipping->getById($id);

        $config_lable = array_filter(explode('||,||', $info->config_lable));
        $lables = [];
        if (!empty($config_lable)) {
            foreach ($config_lable as $item) {
                $lableArr = explode(',', $item);
                $lables[$lableArr[0]] = $lableArr;
            }
        }
        $info->config_lable = $lables;
        view()->share('info', $info);

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回快递公司列表'
            ],
            [
                'url' => '',
                'id' => 'btn_print',
                'icon' => 'fa-print',
                'text' => '打印预览'
            ],
        ];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        return view('mall.shipping.print', compact('title'));
    }

    public function setIsShow(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->shipping->changeState($id, 'is_open');
        if ($ret === false) {
            return result(-1, '', '设置失败');
        }
        return result(0, $ret, '设置成功');
    }

    /**
     * 电子面单参数配置
     *
     * @param Request $request
     * @return array
     * @throws \Throwable
     */
    public function sheetConfig(Request $request)
    {
        $shipping_code = $request->get('shipping_code');
        $sheet_config = SheetConfig::where('shipping_code', $shipping_code)->first();
        $render = view('mall.shipping.sheet-config', compact('shipping_code', 'sheet_config'))->render();

        if ($request->method() == 'POST') {
            $post = $request->post('SheetConfigModel');
            $sheet_config = SheetConfig::where('shipping_code', $post['shipping_code'])->first();
            if (!empty($sheet_config)) {
                // 更新
                $ret = SheetConfig::where('shipping_code', $post['shipping_code'])->update($post);
            } else {
                // 新增
                $ret = $this->sheetConfig->store($post);
            }
            if ($ret === false) {
                return result(-1, '', '保存失败！');
            }
            return result(0, $ret, '保存成功！');
        }
        return result(0, $render);
    }
}