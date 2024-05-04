<?php

namespace App\Modules\Frontend\Http\Controllers\User;

use App\Modules\Base\Http\Controllers\UserCenter;
use Illuminate\Http\Request;

class GiftCardController extends UserCenter
{

    public function __construct()
    {
        parent::__construct();

    }

    public function index(Request $request)
    {
        $seo_title = '用户中心';

        // 获取数据
        $nav_default = 'gift-card';
        $model = null;
        $error_count = 1;

        $compact = compact('seo_title', 'nav_default', 'model','error_count');

        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'nav_default' => $nav_default,
                'model' => $model,
                'error_count' => $error_count
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'user.gift-card.index'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

}