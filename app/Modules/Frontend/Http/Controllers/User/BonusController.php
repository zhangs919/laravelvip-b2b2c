<?php

namespace App\Modules\Frontend\Http\Controllers\User;

use App\Models\UserBonus;
use App\Modules\Base\Http\Controllers\UserCenter;
use App\Repositories\BonusRepository;
use App\Repositories\UserBonusRepository;
use Illuminate\Http\Request;

class BonusController extends UserCenter
{

    protected $bonus;
    protected $userBonus;

    public function __construct(BonusRepository $bonus, UserBonusRepository $userBonus)
    {
        parent::__construct();

        $this->bonus = $bonus;
        $this->userBonus = $userBonus;
    }

    public function lists(Request $request)
    {
        $seo_title = '用户中心';

        $params = $request->all();
        $params['shop_name'] = $request->get('shop_name', '');
        $params['type'] = $request->get('type', 1); // 红包类型 0-平台红包 1-店铺红包
        $params['show_type'] = $request->get('show_type', 0); // 0-我的红包 1-红包历史记录


        // 获取数据

        $where = [];
        // 搜索条件 name 商品名称/订单编号/买家账号
        $search_arr = ['shop_name'];
        foreach ($search_arr as $v) {
            if (isset($params[$v]) && !empty($params[$v])) {
                if ($v == 'shop_name') { // todo
//                    $where[] = [$v, 'like', "%{$params[$v]}%"];
                }
//                   elseif ($v == 'bonus_status') {
//                    $where[] = ['bonus_status', '>', 0];
//                }
                else {
                    $where[] = [$v, $params[$v]];
                }
            }
        }

        $where[] = ['user_id', $this->user_id];
        $where[] = ['bonus_type', $params['type']];
        if ($params['show_type']) {
            // 红包历史记录
            $where[] = ['bonus_status', '>', 0];
        } else { // 我的红包
            $where[] = ['bonus_status', 0];
        }

        // 列表
        list($list, $total) = $this->userBonus->getUserBonusList($where);
        $pageHtml = frontend_pagination($total);
        $page_array = frontend_pagination($total,true);
        $page_json = json_encode($page_array);

        $type = $params['type'];
        $nav_default = 'bonus';
        $show_type = $params['show_type'];

        $systemWhere = $where;
        $systemWhere[] = ['bonus_type', 0];
        $shopWhere = $where;
        $shopWhere[] = ['bonus_type', 1];
        $system_bonus_count = $this->userBonus->getBonusCount($systemWhere);
        $shop_bonus_count = $this->userBonus->getBonusCount($shopWhere);

        $compact = compact('seo_title','list', 'pageHtml','page_json', 'params','system_bonus_count','shop_bonus_count','nav_default','show_type');

        if ($request->ajax()) { // ajax请求
            $render = view('user.bonus.partials._list', $compact)->render();
            return result(0, $render);
        }

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'list' => $list,
                'page' => $page_array,
                'system_bonus_count' => $system_bonus_count,
                'shop_bonus_count' => $shop_bonus_count,
                'type' => $type,
                'nav_default' => $nav_default,
                'show_type' => $show_type,
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'user.bonus.list'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
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

        // 检查当前登录用户是否已经领取过该红包
        $is_receive = UserBonus::where([['bonus_id',$bonus_id], ['user_id', $this->user_id]])->exists();
        if ($is_receive) {
            // 已经领取过
            return result(-1, ['url' => "/bonus-list.html"], '不能领取更多了，贪心会长胖呦，去看看别的红包吧');
        }

        $ret = $this->userBonus->receiveBonus($bonus_id, $this->user_id, $this->user['user_name']);
        if ($ret === false) {
            return result(-1, null, '红包领取失败');
        }

        return result(0, 0, '红包领取成功');
    }
}