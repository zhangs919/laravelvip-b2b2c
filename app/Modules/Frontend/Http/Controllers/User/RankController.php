<?php

namespace App\Modules\Frontend\Http\Controllers\User;

use App\Modules\Base\Http\Controllers\UserCenter;
use App\Repositories\UserRankRepository;
use Illuminate\Http\Request;

class RankController extends UserCenter
{

    protected $userRank;

    public function __construct()
    {
        parent::__construct();

        $this->userRank = new UserRankRepository();
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

        $compact = compact('seo_title', 'list');

        return view('user.rank.growth_value', $compact);
    }


}