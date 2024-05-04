<?php

// +----------------------------------------------------------------------
// | laravelvip 乐融沃B2B2C商城系统
// +----------------------------------------------------------------------
// | Copyright (c) 2017-2027 http://www.laravelvip.com All rights reserved.
// +----------------------------------------------------------------------
// | Notice: This code is not open source, it is strictly prohibited
// |         to distribute the copy, otherwise it will pursue its
// |         legal responsibility.
// +----------------------------------------------------------------------
// | 版权所有 2015-2027 云南乐融沃网络科技有限公司，并保留所有权利。
// | 网站地址: http://www.laravelvip.com
// +----------------------------------------------------------------------
// | 这不是一个自由软件！禁止拷贝本软件副本，否则将追究其法律责任！
// | 如需使用，请移步官网购买正版授权。
// +----------------------------------------------------------------------
// | Author: 雲溪荏苒 <290648237@qq.com>
// | Date:2018-08-15
// | Description:基类控制器
// +----------------------------------------------------------------------


namespace App\Kernel\Modules\Base\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\Common\LrwRepository;
use Illuminate\Support\Facades\Storage;

class Foundation extends Controller
{
    public function __construct()
    {
        // 判断系统是否授权 使用授权码从系统服务器获取授权信息，如果存在，则表示授权成功，否则，未授权或授权过期等。
        $empowerRes = (new LrwRepository())->checkEmpower(1);
        if (!empty($empowerRes) && $empowerRes['code'] == -1) {
            abort(403, $empowerRes['message']);
        }

		// 判断是否安装
        if (!Storage::disk('local')->exists('seeder/install.lock') && \request()->path() != 'install/seeder') {
            $install_url = \request()->getSchemeAndHttpHost()."/install/index.php";
			header("Location:$install_url");
        }
    }

    /**
     * 设置模板相关模块视图
     *
     * @param array $blocks 模块 如：explain_panel
     */
    protected final function setLayoutBlock($blocks)
    {
        if (!empty($blocks) && is_array($blocks)) {
            foreach ($blocks as $k=>$v) {
                view()->share($k, $v);
            }
        }
    }

}
