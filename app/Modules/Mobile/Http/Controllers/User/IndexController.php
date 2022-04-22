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
// | Date:2018-08-17
// | Description: 用户中心
// +----------------------------------------------------------------------

namespace App\Modules\Mobile\Http\Controllers\User;

use App\Modules\Base\Http\Controllers\MobileUserCenter;
use App\Repositories\CartRepository;
use App\Repositories\GoodsRepository;
use Illuminate\Http\Request;

class IndexController extends MobileUserCenter
{

    protected $cart;
    protected $goods;

    public function __construct()
    {
        parent::__construct();

        $this->cart = new CartRepository();
        $this->goods = new GoodsRepository();

    }

    public function center(Request $request)
    {
        $seo_title = '用户中心';

        $compact = compact('seo_title');

        return view('user.index.center', $compact);
    }


}