<?php

namespace App\Modules\Mobile\Http\Controllers\Integralmall;

use App\Modules\Base\Http\Controllers\Mobile;
use Illuminate\Http\Request;

class IndexController extends Mobile
{

    public function __construct()
    {
        parent::__construct();


    }

    public function index(Request $request)
    {
        $seo_title = '积分商城首页';

        $compact = compact('seo_title');

        return view('integralmall.index.index', $compact);
    }

    public function bonusList(Request $request)
    {
        $seo_title = '红包兑换';

        $compact = compact('seo_title');

        return view('integralmall.index.bonus_list', $compact);
    }

    public function showGoods(Request $request)
    {
        $seo_title = '积分商品详情';

        $compact = compact('seo_title');

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
        $pay_point = $this->user->pay_point;
        return result(0, $pay_point, '校验成功');
    }


}