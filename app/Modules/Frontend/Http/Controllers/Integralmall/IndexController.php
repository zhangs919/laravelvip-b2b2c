<?php

namespace App\Modules\Frontend\Http\Controllers\Integralmall;

use App\Modules\Base\Http\Controllers\Frontend;
use App\Repositories\CollectRepository;
use App\Repositories\IntegralGoodsRepository;
use App\Repositories\ShopCollectRepository;
use Illuminate\Http\Request;

class IndexController extends Frontend
{

    protected $integralGoods;
    protected $collect;

    public function __construct()
    {
        parent::__construct();

        $this->integralGoods = new IntegralGoodsRepository();
        $this->collect = new CollectRepository();

    }

    public function index(Request $request)
    {
        $seo_title = '积分商城首页';

        $where = [];
        $where[] = ['goods_status', 1];

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'goods_sort',
            'sortorder' => 'asc'
        ];
        list($list, $total) = $this->integralGoods->getList($condition);

        $pageHtml = frontend_pagination($total);
        $compact = compact('seo_title', 'list', 'total', 'pageHtml');

        return view('integralmall.index.index', $compact);
    }

    public function bonusList(Request $request)
    {
        $seo_title = '红包兑换';

        $compact = compact('seo_title');

        return view('integralmall.index.bonus_list', $compact);
    }

    public function showGoods(Request $request, $goods_id)
    {
        $seo_title = '积分商品详情';
        $goods_info = $this->integralGoods->getById($goods_id);
        $res_images = [];
        if (!empty($goods_info->goods_images)) {
            $goods_images = explode('|', $goods_info->goods_images);
            foreach ($goods_images as $v) {
                $res_images[] = [
                    get_image_url($v).'?x-oss-process=image\/resize,m_pad,limit_0,h_320,w_320',
                    get_image_url($v).'?x-oss-process=image\/resize,m_pad,limit_0,h_450,w_450',
                    get_image_url($v)
                ];
            }
        }
        $goods_info->goods_images = json_encode($res_images);

        // 是否收藏店铺
        $goods_info->shop->is_collected = false;
        if ($this->collect->checkIsCollected($this->user_id, 1, $goods_info->shop_id)) {
            // 已收藏
            $goods_info->shop->is_collected = true;
        }
        $compact = compact('seo_title', 'goods_info');

        return view('integralmall.index.show_goods', $compact);
    }

    public function bonusExchange(Request $request)
    {
        $pointEmpty = false; // 积分不足
        if ($pointEmpty) {
            return result(-1, null, '积分不足');
        }
        $extra = [
            'send_number' => 25,
            'pay_point' => 150
        ];

        return result(0, null, '兑换成功', $extra);
    }

    /**
     * 验证是否登录
     *
     * @param Request $request
     * @return mixed
     */
    public function validates(Request $request)
    {
        if (!auth('user')->check()) {
            return result(-1, null, '校验失败');
        }
        return result(0, $this->user->pay_point, '校验成功');
    }


}