<?php

namespace App\Modules\Seller\Http\Controllers\Shop;

use App\Models\ShopBindClass;
use App\Models\ShopFieldValue;
use App\Modules\Base\Http\Controllers\Seller;
use App\Repositories\ShopPaymentRepository;
use App\Repositories\ShopRepository;
use Illuminate\Http\Request;

class ShopInfoController extends Seller
{

    private $links = [
        ['url' => 'shop/shop-info/shop-info', 'text' => '店铺信息'],
        ['url' => 'shop/shop-info/renew-list', 'text' => '续签日志'],
        ['url' => 'shop/shop-info/renew-add', 'text' => '申请续签'],
    ];

    protected $shop;
    protected $shopPayment;


    public function __construct(
        ShopRepository $shop
        , ShopPaymentRepository  $shopPayment
    )
    {
        parent::__construct();

        $this->shop = $shop;
        $this->shopPayment = $shopPayment;

        $this->set_menu_select('shop', 'shop-info');

    }

    public function shopInfo(Request $request)
    {
        $title = '店铺信息';
        $fixed_title = $title;
        $this->sublink($this->links, 'shop-info', '', '', 'renew-add');

        $shop_id = seller_shop_info()->shop_id;

        $action_span = [];

        $explain_panel = [
            '界面展示店主基本信息、店铺经营等信息，仅供查看',
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block




        // 获取数据
        $info = $this->shop->getById($shop_id);
        if (empty($info)) {
            abort(404, INVALID_PARAM);
        }
        $shop_info = $info->toArray();
        $shop_field_value = ShopFieldValue::where('shop_id', $shop_id)->first();
        // 身份证正面
        if (empty($shop_field_value->card_side_a)) {
            $shop_field_value->card_side_a = get_idcard_demo_image()[0];
        }
        // 身份证背面
        if (empty($shop_field_value->card_side_b)) {
            $shop_field_value->card_side_b = get_idcard_demo_image()[1];
        }
        // 手持身份证
        if (empty($shop_field_value->hand_card)) {
            $shop_field_value->hand_card = get_idcard_demo_image()[2];
        }
        $special_aptitude = explode('|', $shop_field_value->special_aptitude);
		// 店铺绑定分类 todo 暂时这样 后期再优化成：家用电器 > 厨卫大电，食品酒水 > 水果生鲜
		$cat_name = '';
		$cat_name_arr = [];
		$bind_cls = ShopBindClass::where('shop_id', $shop_id)->with('shopClass')->get()->toArray();
		if (!empty($bind_cls)) {
			foreach ($bind_cls as $item) {
				$cat_name_arr[] = $item['shop_class']['cls_name'];
			}
			$cat_name = implode('，', $cat_name_arr);
		}

        $model = [
            'real_name' => $shop_field_value->real_name,
            'card_no' => $shop_field_value->card_no,
            'special_aptitude' => $special_aptitude,
            'special_aptitude1' => @$special_aptitude[0],
            'special_aptitude2' => @$special_aptitude[1],
            'hand_card' => $shop_field_value->hand_card,
            'card_side_a' => $shop_field_value->card_side_a,
            'card_side_b' => $shop_field_value->card_side_b,
            'address' => $shop_field_value->address,
            'cat_name' => $cat_name
        ];
        $user_info = $info->user->toArray();
        $insure_fee = $shop_info['insure_fee'];
		$shop_qrcode = $this->shop->getShopQrCode($shop_id);

        $compact = compact('title', 'shop_info','model','user_info','insure_fee', 'shop_qrcode');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_extra_data' => [],
            'app_prefix_data' => [
                'shop_info' => $shop_info,
                'model' => $model,
                'user_info' => $user_info,
                'insure_fee' => $insure_fee,
            ],
            'app_context_data' => $this->getAppContext(),
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'shop.shop-info.shop_info'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    public function renewList(Request $request)
    {
        $title = '续签日志';
        $fixed_title = '店铺信息 - '.$title;
        $this->sublink($this->links, 'renew-list', '', '', 'renew-add');


        $action_span = [
            [
                'url' => 'renew-add',
                'icon' => 'fa-plus',
                'text' => '续签'
            ],
        ];

        $explain_panel = [
            '续签流程：卖家申请续签->卖家线下向平台方缴纳使用费->平台方审核，确认收到使用费后，审核通过->卖家申请续签成功，使用有效期自动延长'
        ];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block

        $where = [];
        // 搜索条件

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'pay_id',
            'sortorder' => 'desc'
        ];
        list($list, $total) = $this->shopPayment->getList($condition);
        $pageHtml = pagination($total);
        $compact = compact('title', 'list', 'total', 'pageHtml');
        if ($request->ajax()) {
            $render = view('shop.shop-info.partials._renew_list', $compact)->render();
            return result(0, $render);
        }

        return view('shop.shop-info.renew_list', $compact);
    }

    public function renewAdd(Request $request)
    {
        $title = '申请续签';
        $fixed_title = '店铺信息 - '.$title;
        $this->sublink($this->links, 'renew-add');


        $action_span = [
            [
                'url' => 'renew-list',
                'icon' => 'fa-reply',
                'text' => '返回续签日志'
            ],
        ];

        $explain_panel = [];
        $blocks = [
            'explain_panel' => $explain_panel,
            'fixed_title' => $fixed_title,
            'action_span' => $action_span
        ];

        $this->setLayoutBlock($blocks); // 设置block


        $compact = compact('title');

        return view('shop.shop-info.renew_add', $compact);
    }

    public function renewSaveData(Request $request)
    {
        $post = $request->post('ShopPaymentModel');

        // 添加
        $post['shop_id'] = seller_shop_info()->shop_id;
        $post['apply_time'] = time();
        $ret = $this->shopPayment->store($post);

        if ($ret === false) {
            // fail
            flash('error', '添加失败');
            return redirect('/shop/shop-info/renew-list');
        }
        // success
        flash('success', '添加成功');
        return redirect('/shop/shop-info/renew-list');
    }

    public function delete(Request $request)
    {
        $id = $request->post('id');
        $ret = $this->shopPayment->del($id);
        if ($ret === false) {
            // Log
            shop_log('取消续签失败。ID：'.$id);
            return result(-1, '', '操作失败');
        }
        // Log
        shop_log('取消续签成功。ID：'.$id);
        return result(0, '', '操作成功');
    }
}
