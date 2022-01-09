<?php

namespace App\Modules\Seller\Http\Controllers\Shop;

use App\Models\FreightRecord;
use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\FreightRepository;
use App\Repositories\ShopConfigFieldRepository;
use Illuminate\Http\Request;

class FreightController extends Seller
{
    private $links = [
        ['url' => 'shop/freight/list', 'text' => '运费模板列表'],
        ['url' => 'shop/freight/default', 'text' => '店铺统一运费'],
        ['url' => 'shop/freight/calculate', 'text' => '运费模拟计算'],
    ];

    private $manage_links = [
        ['url' => 'shop/freight/list', 'text' => '列表'],
        ['url' => 'shop/freight/add', 'text' => '添加'],
        ['url' => 'shop/freight/map-add', 'text' => '添加'],
        ['url' => 'shop/freight/edit', 'text' => '编辑'],
    ];

    protected $freight;
    protected $shopConfigField;

    public function __construct()
    {
        parent::__construct();

        $this->freight = new FreightRepository();
        $this->shopConfigField = new ShopConfigFieldRepository();

        $this->set_menu_select('goods', 'freight');
    }

    public function lists(Request $request)
    {
        $title = '列表';
        $fixed_title = '运费设置 - '.$title;

        $this->sublink($this->links, 'list');

        $action_span = [
            [
                'url' => 'map-add',
                'icon' => 'fa-map-marker',
                'text' => '添加同城运费模板'
            ],
            [
                'url' => 'add',
                'icon' => 'fa-globe',
                'text' => '添加全国运费模板'
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
        $where[] = ['shop_id', seller_shop_info()->shop_id];

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'freight_id',
            'sortorder' => 'desc',
        ];
        list($list, $total) = $this->freight->getList($condition);

        $pageHtml = pagination($total);

        if ($request->ajax()) {
            $render = view('shop.freight.partials._list', compact('list', 'total', 'pageHtml'))->render();
            return result(0, $render);
        }
        return view('shop.freight.list', compact('title', 'list', 'pageHtml'));
    }

    /**
     * 添加全国运费模板（包括复制模板）
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function globeAdd(Request $request)
    {
        $title = '添加运费模板';
        $id = $request->get('id', 0);

        $tpl = 'globe_add';
        if ($id > 0) {
            // 复制模板 todo
            $tpl = 'copy_add';
        }

        $this->sublink($this->manage_links, 'add', '', '', 'map-add,edit');

        $explain_panel = [];

        $fixed_title = '运费设置 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回运费模板列表'
            ],
        ];

        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        return view('shop.freight.'.$tpl, compact('title'));
    }

    /**
     * 添加同城运费模板（包括复制模板）
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function mapAdd(Request $request)
    {
        $title = '添加运费模板';

        $id = $request->get('id', 0);

        $tpl = 'map_add';
        if ($id > 0) {
            // 复制模板 todo
            $tpl = 'copy_add';
        }

        $this->sublink($this->manage_links, 'map-add', '', '', 'add,edit');

        $explain_panel = [
            '多个配送区域重复叠加在一起时，运费计算按照配送区域的排序进行计算，排序越靠前的越优先匹配',
            '您可以在编辑配送区域时，通过“上移”、“下移”按钮来调整配送区域的顺序，当配送区域重叠时，排序越靠前的在计算运费时越优先匹配',
            '系统的地区管理中已经支持为地区设置具体位置并绑定经纬度，此功能需要平台方管理员进行设置，设置经纬度的地区将更能精确的与地图中的配送区域进行匹配',
            '当系统无法获取用户经纬度的精确位置时，特别是像商品列表、商品详情等页面根据用户选择的地区来匹配商品和计算运费时，系统会根据您在地图上画的范围锁匹配的地区进行处理，您可以通过点击每个画的范围旁的“地区”按钮编辑此范围所对应的地区',
        ];
        $fixed_title = '运费设置 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回运费模板列表'
            ],
        ];

        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        return view('shop.freight.'.$tpl, compact('title'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request)
    {
        $title = '编辑运费模板';
        $id = $request->get('id', 0);

        $this->sublink($this->manage_links, 'edit', '', '', 'map-add,add');

        $info = $this->freight->getById($id);
        view()->share('info', $info);

        $tpl = 'globe_edit'; // 编辑模板名称
        $explain_panel = [];
        if ($info->freight_type == 1) { // 同城运费模板
            $tpl = 'map_edit';
            $explain_panel = [
                '多个配送区域重复叠加在一起时，运费计算按照配送区域的排序进行计算，排序越靠前的越优先匹配',
                '您可以在编辑配送区域时，通过“上移”、“下移”按钮来调整配送区域的顺序，当配送区域重叠时，排序越靠前的在计算运费时越优先匹配',
                '系统的地区管理中已经支持为地区设置具体位置并绑定经纬度，此功能需要平台方管理员进行设置，设置经纬度的地区将更能精确的与地图中的配送区域进行匹配',
                '当系统无法获取用户经纬度的精确位置时，特别是像商品列表、商品详情等页面根据用户选择的地区来匹配商品和计算运费时，系统会根据您在地图上画的范围锁匹配的地区进行处理，您可以通过点击每个画的范围旁的“地区”按钮编辑此范围所对应的地区',
            ];
        }

        $fixed_title = '运费设置 - '.$title;

        $action_span = [
            [
                'url' => 'list',
                'icon' => 'fa-reply',
                'text' => '返回运费模板列表'
            ],
        ];

        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        return view('shop.freight.'.$tpl, compact('title'));
    }

    /**
     * 保存信息
     * @param Request $request
     * @return mixed
     */
    public function saveData(Request $request)
    {
        $postData = $request->post();

//        dd($postData);
        if (!empty($postData['freight']['freight_id'])) {
            // 编辑
            $ret = $this->freight->modifyFreight($postData);
            $msg = '运费模板编辑';
        }else {
            // 添加
            $shop_id = seller_shop_info()->shop_id;
            $ret = $this->freight->addFreight($postData, $shop_id);
            $msg = '运费模板添加';
        }

        if ($ret === false) {
            // fail
            return result(-1, '', $msg.'失败');
        }
        // success
        return result(0, $ret, $msg.'成功');
    }


    public function regionPicker()
    {
        $uuid = make_uuid();

        $render = view('shop.freight.region_picker', compact('uuid'))->render();

        return result(0, $render);
    }

    public function default(Request $request)
    {
        $title = '店铺统一运费';
        $fixed_title = '运费设置 - '.$title;

        $this->sublink($this->links, 'default');

        $action_span = [];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $group = 'freight'; // 当前配置分组
        $group_info = $this->shopConfigField->getConfigList($group);
        $uuid = make_uuid();
        $script_render = view('shop.config.partials.'.$group, compact('uuid'))->render();

        return view('shop.config.config', compact('title', 'group', 'group_info', 'script_render'));
    }



    public function calculate(Request $request)
    {
        $title = '模拟计算';
        $fixed_title = '运费设置 - '.$title;
        $this->sublink($this->links, 'calculate');

        $action_span = [];

        $explain_panel = [
            '运费计算规则：',
            '店铺一笔订单中的多个商品均属于同一个运费模板时，会根据公式：运费=首费+（订单中总商品数-1）*续费金额进行计算',
            '店铺一笔订单中有多个商品，而且隶属于不同的运费模板时，系统会根据公式计算出实际运费。公式：运费=首费（未达包邮条件的运费模板中首费最高的费用）+各运费模板续费数量*续费金额<br/>比如一笔订单中有A商品两件、B商品两件，A运费模板设置为首件10元，续件2元，B运费模板设置为首件5元，续件1元，则这比订单总运费是：10+1（A运费模板商品续件数量）*2（续费金额）+2（B商品购买数量）*1（运费金额）=14元',
            '指定条件包邮的设置只对所属运费模板起作用，指定条件包邮的金额为该运费模板下的商品总金额，件数为该运费模板下的商品总件数',
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $compact = compact('title');

        return view('shop.freight.calculate', $compact);
    }

    public function desc(Request $request)
    {
        /*
         * "freight":{
            "freight_type":0,
            "is_free":0,
            "free_set":1,
            "valuation":0,
            "limit_sale":1,
            "freight_id":82,
            "shop_id":74,
            "title":"aaa",
            "region_code":"12,01,02",
            "add_time":1540366481,
            "last_time":1540375116,
            "region_names":"天津市 天津市 河东区"
        },
        "default_desc":"无",
        "region_names":"石景山区|昌平区|平谷区",
        "desc":"1.0件内2.00元，每增加3.0件，加1.00元"
         */
        $id = $request->get('id', 0);
        if ($id == 0) {
            return result(-1, null, '模板编号不能为空');
        }

        $freight_info = $this->freight->getById($id)->toArray();
        if (empty($freight_info)) {
            return result(-1, null, '模板编号不能为空');
        }
        $freight_info['region_names'] = get_region_names_by_region_code($freight_info['region_code'], '|');

        // freight record
        $default_freight_record = FreightRecord::where([['freight_id', $id], ['is_default', 1]])->first();
        if (empty($default_freight_record)) {
            $freight_record = FreightRecord::where([['freight_id', $id]])->first();
            $default_desc = '无';
        } else {
            $freight_record = $default_freight_record;
            $default_desc = $freight_record->start_num.'件内'.$freight_record->start_money.'元，每增加'.$freight_record->plus_num.'件，加'.$freight_record->plus_money.'元';
        }
        $desc = $freight_record->start_num.'件内'.$freight_record->start_money.'元，每增加'.$freight_record->plus_num.'件，加'.$freight_record->plus_money.'元';

        $data = [
            'freight' => $freight_info,
            'default_desc' => $default_desc,
            'region_names' => $freight_record->region_names,
            'desc' => $desc
        ];
        return result(0, $data);
    }
}