<?php

namespace App\Modules\Frontend\Http\Controllers\Activity;

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


    /**
     * 用户领取红包
     *
     * @param Request $request
     * @return array
     */
    public function index(Request $request)
    {
        $bonus_id = $request->post('bonus_id', 0);

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

//        return result(0, 0, '红包领取成功', ['url' => "/bonus-success-{{ $bonus_id.html?is_redirect=1"]);
        return result(0, ['url' => "/bonus-list.html"], '红包领取成功');
    }

}