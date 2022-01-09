<?php

namespace App\Modules\Frontend\Http\Controllers\Index;

use App\Modules\Base\Http\Controllers\Frontend;
use Illuminate\Http\Request;

/**
 * 微信端控制器
 *
 * Class InformationController
 * @package App\Modules\Frontend\Http\Controllers\Index
 */
class InformationController extends Frontend
{

    public function __construct()
    {
        parent::__construct();

    }

    /**
     * 判断是否是微信访问
     *
     * @param Request $request
     * @return mixed
     */
    public function isWeixin(Request $request)
    {
        if (!is_weixin()) {
            return result(-1, null);
        }
        return result(0, null, '');
    }

    /**
     *
     *
     * @param Request $request
     * @return mixed
     */
    public function isFollow(Request $request)
    {

        return result(0, null, '',['is_show'=>0]);
    }

    /**
     * 搜索历史
     *
     * @param Request $request
     * @return mixed
     */
    public function searchRecord(Request $request)
    {

        return result(0, []);
    }

    public function getWeiXinConfig(Request $request)
    {
        return result(-1, null, '');
    }
}