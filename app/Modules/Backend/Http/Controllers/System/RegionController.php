<?php

namespace App\Modules\Backend\Http\Controllers\System;

use App\Http\Requests\RegionRequest;
use App\Models\Region;
use App\Modules\Base\Http\Controllers\Backend;
use App\Repositories\RegionRepository;
use App\Repositories\SystemConfigRepository;
use Illuminate\Http\Request;

class RegionController extends Backend
{

    private $links = [
        ['url' => 'system/region/list', 'text' => '列表'],
        ['url' => 'system/region/setting', 'text' => '设置'],
    ];

    protected $regions;

    protected $systemConfig;

    public function __construct(
        RegionRepository $regions
        ,SystemConfigRepository $systemConfig
    )
    {
        parent::__construct();

        $this->regions = $regions;
        $this->systemConfig = $systemConfig;

        // share parent area data.
        $condition = [
            'where' => [['parent_code', \request('parent_code', 0)]],
            'limit' => 0
        ];
        list($parent_data, $total) = $this->regions->getList($condition);
        view()->share('parent_area', $parent_data);

        // share region type data.
        $region_type_data = [
            'province' => '省',
            'city' => '市',
            'district' => '区/县',
            'street' => '乡/镇、街道/村'
        ];
        view()->share('region_type_data', $region_type_data);
    }

    /**
     * 地区列表
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function lists(Request $request)
    {
        $params = $request->all();
        $parent_code = $request->get('parent_code', 0);

        // 根据region_code 获取parent_code
        $region_info = Region::where('region_code', $parent_code)->select('parent_code')->first();
        $back_parent_code = 0;
        if (!empty($region_info)) {
            $back_parent_code = $region_info->parent_code;
        }

        $title = '列表';
        $fixed_title = '地区管理- 列表';
        $this->sublink($this->links, 'list');

        if ($parent_code != 0) {
            $action_span[] = [
                'url' => 'list?parent_code='.$back_parent_code,
                'icon' => 'fa-reply',
                'text' => '返回上级地区'
            ];
        }
        $action_span[] = [
            'url' => 'add?parent_code='.$parent_code,
            'icon' => 'fa-reply',
            'text' => '添加地区'
        ];

        $explain_panel = [
            '您可以自己编辑地区数据，不过全站所有涉及的地区均来源于此处，强烈建议对此处谨慎操作',
            '所在层级为该地区的所在的层级深度，如北京>北京市>朝阳区，其中北京层级为1，北京市层级为2，朝阳区层级为3；层级深度最多支持5级',
            '地区状态分为启用、禁用，禁用的地区将不会出现在系统中的任何地址中，启用地区后可以选择地区作为经营地区或者非经营地区',
            '系统中的经营地区主要用于控制平台方经营的范围，在系统内主要体现在运费模板设置、网点地区设置等涉及到平台方经营范围的地区选择',
            '非经营地区一般与国家的行政级别一致，主要用于商品的发货地址、相关注册项里的居住地等与平台方经营范围无关的地区选择',
            '自定义新添加的地区通过设置地区位置绑定经纬度后，可以匹配同城运费模板中指定的地区',
            '<i class="location-icon m-r-5"></i>表示当前地区已经设置了经纬度位置',
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $where = [];
        $where[] = ['parent_code', $parent_code];
        // 搜索条件
        $search_arr = ['region_code', 'is_enable', 'is_scope'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && (!empty($params[$v]) || in_array($params[$v], [0,1]))) {
                $where[] = [$v, $params[$v]];
            }
        }

        // 分类列表
        $condition = [
            'where' => $where,
            'limit' => 0,
            'sortname' => 'region_id',
            'sortorder' => 'asc'
        ];
        list($region_list, $total) = $this->regions->getList($condition);
        $list = [];

        for ($i = 0; $i < $total; $i++) {
            $list[] = array_slice($region_list->toArray(), $i * 3, 3);
        }
        $list = array_filter($list);

        $pageHtml = pagination($total, false);

        $compact = compact('title', 'list', 'total', 'pageHtml', 'parent_code');
        if ($request->ajax()) {
            $render = view('system.region.partials._list', $compact)->render();
            return result(0, $render);
        }

        return view('system.region.list', $compact);
    }

    /**
     * 地区设置
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function setting()
    {
        $group = 'region';

        $title = '设置';

        $fixed_title = '地区管理 - 设置';
        $this->sublink($this->links, 'setting');

        $config_info = $this->systemConfig->getSpecialConfigsByGroup($group, 'code');

        $explain_panel = [
            '经营地区最高级别：指在地区选择的时候开始的级别，比如网站只经营一个或几个城市，可直接从市级开始省去“省”的选择',
            '经营地区最低级别：指在地区选择的时候结束的级别，比如乡镇级，最低级为乡镇级，则村级不可选择',
            '例如：最高级别为“市级”，最低级别为“乡镇”选择范围为市，县区，乡镇'
        ];
        $blocks = [
            'fixed_title' => $fixed_title,
            'explain_panel' => $explain_panel
        ];
        $this->setLayoutBlock($blocks); // 设置block

        return view('system.region.setting', compact('title', 'group', 'config_info'));
    }

    public function add(Request $request)
    {
        $id = $request->get('id', 0);
        $parent_code = $request->get('parent_code', 0);
        $uuid = make_uuid();

        $parent_region_name = null;
        if ($parent_code) { // 获取地区名称
            $parent_region_name = Region::where('region_code', $parent_code)->value('region_name');
        }
        $title = '添加';
        if ($id) {
            $title = '编辑';
            // 获取地区信息
            $info = $this->regions->getById($id);

            // 地区code去掉逗号
            $info->parent_code_str = str_replace(',', '', $info->parent_code);
            $parent_code = $info['parent_code'];
            // 上级地区名称
            $parent_region_name = array_reverse(get_parent_region_list($info->parent_code));
            $parent_region_name = array_column($parent_region_name, 'region_name');

            $info->parent_region_name = implode(',', $parent_region_name);
            $lng_lat = explode(',', $info->center);
            $lng = $lng_lat[0];
            $lat = $lng_lat[1];
            $info->lng = $lng;
            $info->lat = $lat;
            view()->share('info', $info);
        }

        $fixed_title = '地区管理 - '.$title;
        $action_span = [
            [
                'url' => 'list?parent_code='.$parent_code,
                'icon' => 'fa-reply',
                'text' => '返回上级地区'
            ],
        ];



        $explain_panel = [
            '商城系统中的地图均采用高德地图进行定位',
            '新增、编辑地区时，前三级的地区代码强烈建议与高德地图中获取的地区代码保持一致，不一致系统将会在地区代码和上级代码旁进行提示，如果不一致会导致同城运费模板的地区定位与您所定义的地区匹配不上无法精确计算运费'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];
        $this->setLayoutBlock($blocks); // 设置block

        return view('system.region.add', compact('title', 'parent_code', 'uuid', 'parent_region_name'));
    }

    public function edit(Request $request)
    {
        return $this->add($request);
    }

    /**
     * 保存信息
     *
     * @param RegionRequest $request
     * @return mixed
     */
    public function saveData(RegionRequest $request)
    {
        $post = $request->post();



        if (!empty($post['region_id'])) {
            // 编辑
            $ret = $this->regions->update((int)$post['region_id'], $post);
            $msg = '编辑';
        }else {
            // 添加
            if (is_null(@$post['parent_code'])) {
                $post['parent_code'] = '0';
            }

            $number = Region::where('parent_code', $post['parent_code'])->count();
            $number = sprintf('%02s', ($number + 1));
            $region_code = $post['parent_code'].",".$number;
            $post['region_code'] = $region_code;

            $ret = $this->regions->store($post);
            $msg = '添加';
        }

        if ($ret === false) {
            // Log
            admin_log($msg.'地区信息失败。ID：'.$ret->region_id);
            // fail
            return result(-1, '', $msg.'失败');
        }
        // Log
        admin_log($msg.'地区信息成功。ID：'.$ret->region_id);
        // success

        return result(0, '', $msg.'成功');
    }

    /**
     * 设置是否启用地区
     *
     * @param Request $request
     * @return mixed
     */
    public function setEnable(Request $request)
    {
        $id = $request->get('id');
        $ret = $this->regions->changeEnable($id);
        if ($ret === false) {
            return result(-1, $ret, '设置失败');
        }
        return result(0, $ret, '设置成功');
    }

    /**
     * 设置经营地区
     *
     * @param Request $request
     * @return mixed
     */
    public function setScope(Request $request)
    {
        $id = $request->get('id');
        $is_sync = $request->post('is_sync', 0); // 是否同时将所有下级地区设置为经营地区
        if ($is_sync) {
            // todo
        }
        $ret = $this->regions->changeScope($id);
        if ($ret === false) {
            return result(-1, $ret, '设置失败');
        }
        return result(0, $ret, '设置成功');
    }

    public function applicationService()
    {
        $title = '应用服务';
        $fixed_title = $title;

        $action_span = [];
        $explain_panel = [];
        $blocks = [
            'fixed_title' => $fixed_title,
            'action_span' => $action_span,
            'explain_panel' => $explain_panel,
        ];
        $this->setLayoutBlock($blocks); // 设置block

        return view('system.region.application_service', compact('title'));
    }

    /**
     * 名称验证是否重复
     *
     * @param Request $request
     * @return mixed
     */
    public function clientValidate(Request $request)
    {
        $result = $this->regions->clientValidate($request, 'Region');
        if (!$result['code']) {
            return result(-1, '', $result['message']);
        }
        return result(0);
    }
}