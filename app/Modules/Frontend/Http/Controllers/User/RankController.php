<?php

namespace App\Modules\Frontend\Http\Controllers\User;

use App\Modules\Base\Http\Controllers\UserCenter;
use App\Repositories\UserRankLogRepository;
use App\Repositories\UserRankRepository;
use Illuminate\Http\Request;

class RankController extends UserCenter
{

    protected $userRank;
    protected $userRankLog;

    public function __construct(UserRankRepository $userRank,UserRankLogRepository $userRankLog)
    {
        parent::__construct();

        $this->userRank = $userRank;
        $this->userRankLog = $userRankLog;
    }

    public function growthValue(Request $request)
    {
        $seo_title = '用户中心';

        $condition = [
            'where' => [],
            'sortname' => 'max_points',
            'sortorder' => 'asc',
            'limit' => 0
        ];
        list($list, $total) = $this->userRank->getList($condition);

        // 获取我的成长值记录 目前只有下单或退款会产生成长值的变动
        $condition = [
            'where' => [['user_id', $this->user_id]],
            'sortname' => 'id',
            'sortorder' => 'desc'
        ];

        list($growth_value_list, $growth_value_total) = $this->userRankLog->getList($condition);
        $pageHtml = frontend_pagination($growth_value_total);
        $compact = compact('seo_title', 'list', 'growth_value_list', 'pageHtml');

        if ($request->ajax() && !is_app()) { // web端访问 ajax请求
            $render = view('user.rank.partials._growth_value_list', $compact)->render();
            return result(0, $render);
        }

        return view('user.rank.growth_value', $compact);
    }


}