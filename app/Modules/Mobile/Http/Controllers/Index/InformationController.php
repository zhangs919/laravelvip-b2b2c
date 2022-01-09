<?php

namespace App\Modules\Mobile\Http\Controllers\Index;

use App\Modules\Base\Http\Controllers\Mobile;
use App\Repositories\NavBannerRepository;
use App\Repositories\NavigationRepository;
use App\Repositories\NavQuickServiceRepository;
use App\Repositories\TemplateCatRepository;
use App\Repositories\TemplateItemRepository;
use App\Repositories\TemplateRepository;
use App\Repositories\TemplateSelectorRepository;
use Illuminate\Http\Request;

class InformationController extends Mobile
{

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