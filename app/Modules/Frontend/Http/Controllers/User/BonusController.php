<?php

namespace App\Modules\Frontend\Http\Controllers\User;

use App\Modules\Base\Http\Controllers\UserCenter;
use App\Repositories\BonusRepository;
use App\Repositories\UserBonusRepository;
use Illuminate\Http\Request;

class BonusController extends UserCenter
{

    protected $bonus;
    protected $userBonus;

    public function __construct()
    {
        parent::__construct();

        $this->bonus = new BonusRepository();
        $this->userBonus = new UserBonusRepository();
    }

    public function lists(Request $request)
    {
        $seo_title = '用户中心';

        $params = $request->all();
        $params['shop_name'] = $request->get('shop_name', '');
        $params['type'] = $request->get('type', 1); // 红包类型 0-平台红包 1-店铺红包

        $where = [];
        // 搜索条件 name 商品名称/订单编号/买家账号
        $search_arr = ['shop_name', 'type'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {
                if ($v == 'shop_name') { // todo
//                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                } else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

        $where[] = ['user_id', $this->user_id];

        // 列表
        $condition = [
            'where' => $where,
            'sortname' => 'user_bonus_id',
            'sortorder' => 'asc'
        ];

        list($list, $total) = $this->userBonus->getList($condition);
        $pageHtml = frontend_pagination($total);
        if ($request->ajax()) {
            $render = view('user.bonus.partials._list', compact('list', 'total', 'pageHtml', 'params'))->render();
            return result(0, $render);
        }
//        dd($list);
        return view('user.bonus.list', compact('seo_title', 'list', 'pageHtml', 'params'));
    }

    /**
     * 用户领取红包
     *
     * @param Request $request
     * @return array
     */
    public function receive(Request $request)
    {
        $bonus_id = $request->post('bonus_id',0);

        if (!$bonus_id) {
            return result(-1, null, '红包id无效');
        }

        $ret = $this->userBonus->receiveBonus($bonus_id, $this->user_id, $this->user['user_name']);
        if ($ret === false) {
            return result(-1, null, '红包领取失败');
        }

        // 不能领取更多了，贪心会长胖呦，去看看别的红包吧

        return result(0, 0, '红包领取成功');
    }

    /**
     * 用户领取红包
     *
     * @param Request $request
     * @return array
     */
    /*public function receive(Request $request)
    {
        $bonus_id = $request->post('bonus_id',0);

        if (!$bonus_id) {
            return result(-1, null, '红包id无效');
        }

        $ret = $this->userBonus->receiveBonus($bonus_id, $this->user_id, $this->user['user_name']);
        if ($ret === false) {
            return result(-1, ['url' => '/bonus-'.$bonus_id], '红包领取失败');
        }

        // 不能领取更多了，贪心会长胖呦，去看看别的红包吧

        return result(0, ['url' => '/bonus-success-'.$bonus_id], '红包领取成功');
    }*/
}