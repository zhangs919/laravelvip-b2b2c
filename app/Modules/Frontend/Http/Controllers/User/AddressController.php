<?php

namespace App\Modules\Frontend\Http\Controllers\User;

use App\Models\Region;
use App\Modules\Base\Http\Controllers\UserCenter;
use App\Repositories\UserAddressRepository;
use Illuminate\Http\Request;

class AddressController extends UserCenter
{

    protected $userAddress;


    public function __construct(UserAddressRepository $userAddress)
    {
        parent::__construct();

        $this->userAddress = $userAddress;


    }

    public function index(Request $request)
    {
        $seo_title = '用户中心';

        $condition = [
            'where' => [
                ['user_id', $this->user_id]
            ],
            'sortname' => 'is_default',
            'sortorder' => 'desc',
            'limit' => 20
        ];
        list($address_list, $address_total) = $this->userAddress->getList($condition);

        if (!$address_list->isEmpty()) {
            foreach ($address_list as $v) {
                // 上级地区名称
//                $region_name = array_reverse(get_parent_region_list($v->region_code));
//                $region_name = array_column($region_name, 'region_name');
//                $v->region_name = implode(' ', $region_name);
                $v->region_name = get_region_names_by_region_code($v->region_code, ' ', true);
            }
        }

        // 获取数据
        $pageHtml = frontend_pagination($address_total);
        $page_array = frontend_pagination($address_total, true);
        $page_json = json_encode($page_array);
        $have_address = $address_total > 0;
        $nav_default = 'back';

        $compact = compact('seo_title', 'address_list', 'address_total');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'page' => $page_array,
                'list' => $address_list->toArray(),
                'have_address' => $have_address,
                'nav_default' => $nav_default,
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'user.address.index'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function add(Request $request)
    {

        $seo_title = '用户中心';
        $address_id = $request->get('address_id', 0);
        $checkout = $request->get('checkout', 0); // 是否来源于下单页面
        $back_url = $request->get('back_url','');
        $tpl = 'add';
        $model = [
            'address_name' => ''
        ];

        if ($address_id) {
            // 更新地址
            $address_info = $this->userAddress->getById($address_id);
            if ($address_info) {
                $address_info->region_name = get_region_names_by_region_code($address_info->region_code, ' ', true);
                $model = $address_info->toArray();
            }
            if (empty($address_info) && is_app()) {
                return result(-1, [], INVALID_PARAM);
            }
            view()->share('address_info', $address_info);
            $tpl = 'edit';
        }

        if ($request->ajax()) {
            $address_id = $request->get('address_id');

            if ($address_id) { // 编辑地址
                $address_info = $this->userAddress->getById($address_id);
                // 地区code去掉逗号
                $region_info = Region::where('region_code', $address_info->region_code)->first();
                $address_info->parent_code_str = str_replace(',', '', $region_info->parent_code);
                $data = view('user.address.edit', compact('address_info', 'checkout','back_url'))->render();
            } else { // 新增地址
                $data = view('user.address.add', compact('checkout','back_url'))->render();
            }

            return result(0, $data);
        }

        $freight_mode = 0;
        $address_parse_enable = false;

        $compact = compact('seo_title', 'checkout','back_url');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'model' => $model,
                'checkout' => $checkout,
                'address_id' => $address_id,
                'freight_mode' => $freight_mode,
                'address_parse_enable' => $address_parse_enable,
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'user.address.'.$tpl
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function edit(Request $request)
    {
        return $this->add($request);
    }

    public function saveData(Request $request)
    {
        $post = $request->post('UserAddressModel');
        if (!isset($post)) {
            $post = $request->input();
        }
        $address_id = $request->post('address_id', 0);
        $checkout = $request->get('checkout', 0);
        $back_url = $request->get('back_url','');

        if (!empty($address_id)) {
            // 编辑
            $post['address_id'] = $address_id;
            $ret = $this->userAddress->saveData($post, $this->user_id);
            $msg = '地址编辑';
        }else {
            // 添加
            // 判断用户收货地址是否超过20个
            if (!$this->userAddress->checkUserAddressLimit($this->user_id)) {
                return result(-1, null, '最多只能保存20条地址');
            }
            $post['user_id'] = $this->user_id;
            // 判断是否是第一个
            if (!$this->userAddress->getByField('user_id', $post['user_id'])) {
                $post['is_default'] = 1;// 设置为默认地址
            }
            $ret = $this->userAddress->saveData($post, $this->user_id);
            $msg = '地址添加';
        }

        if ($ret === false) {
            // fail
            if ($checkout && !is_app()) {
                return redirect('/checkout.html');
            }
            return result(-1, null, OPERATE_FAIL);
        }
        // success
        if ($checkout) {
            return result(0, ['address_id'=>$ret], OPERATE_SUCCESS);
//            return redirect('/checkout.html');
        }
        return result(0, $ret, OPERATE_SUCCESS);
    }

    public function setDefault(Request $request)
    {
        $address_id = $request->get('address_id');
        if (!$address_id) {
            return  result(-1, null, '参数错误');
        }

        $ret = $this->userAddress->setDefault($address_id, $this->user_id);
        if ($ret === false) {
            return result(-1, null, '设置失败');
        }

        return result(0, null, '设置成功！');
    }

    public function delete(Request $request)
    {
        $address_id = $request->get('address_id');
        if (!$address_id) {
            return  result(-1, null, '参数错误');
        }

        $ret = $this->userAddress->del($address_id);
        if ($ret === false) {
            return result(-1, null, '删除失败');
        }

//        $count = count($this->userAddress->getByField('user_id', $this->user_id));

        return result(0, null, '删除成功！');
    }
}