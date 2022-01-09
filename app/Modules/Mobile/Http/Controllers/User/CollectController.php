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
// | Date:2018-08-16
// | Description:商品/店铺/... 收藏/取消收藏
// +----------------------------------------------------------------------

namespace App\Modules\Mobile\Http\Controllers\User;

use App\Models\Goods;
use App\Models\Shop;
use App\Modules\Base\Http\Controllers\MobileUserCenter;
use Illuminate\Http\Request;

class CollectController extends MobileUserCenter
{

    protected $goodsCollect;
    protected $shopCollect;


    public function __construct()
    {
        parent::__construct();

    }

    public function index(Request $request)
    {
        return $this->goods($request);
    }

    public function goods(Request $request)
    {
        $seo_title = '用户中心';

        $compact = compact('seo_title');

        return view('user.collect.goods', $compact);
    }

    public function shop(Request $request)
    {
        $seo_title = '用户中心';

        $compact = compact('seo_title');

        return view('user.collect.shop', $compact);
    }

    /**
     * 商品/店铺/.. 收藏/取消收藏
     *
     * @param Request $request
     * @return array
     */
    public function toggle(Request $request)
    {
        $goods_id = $request->input('goods_id', 0);
        $sku_id = $request->input('sku_id', 0);
        $show_count = $request->input('show_count', 0);
        $shop_id = $request->input('shop_id', 0);

        $collect_count = null;

        if ($shop_id) { // 店铺收藏/取消收藏
            if ($this->shopCollect->checkIsCollected($shop_id, $this->user_id)) {
                // 取消收藏
                $msg = '取消关注';
            } else {
                // 收藏
                $msg = '关注';
            }
            $ret = $this->shopCollect->toggle($shop_id,$this->user_id);
            if ($ret === false) {
                // 失败
                return result(-1, null, $msg.'失败');
            }
            if ($show_count == 1) {
                // 显示收藏数量
                $collect_count = Shop::where('shop_id', $shop_id)->value('collect_num');
            }
        } elseif ($goods_id && $sku_id) { // 商品收藏/取消收藏
            if ($this->goodsCollect->checkIsCollected($goods_id, $this->user_id)) {
                // 取消收藏
                $msg = '取消收藏';
            } else {
                // 收藏
                $msg = '收藏';
            }
            $ret = $this->goodsCollect->toggle($goods_id,$this->user_id);
            if ($ret === false) {
                // 失败
                return result(-1, null, $msg.'失败');
            }
            if ($show_count == 1) {
                // 显示收藏数量
                $collect_count = Goods::where('goods_id', $goods_id)->value('collect_num');
            }
        } else {
            // todo ...

            $ret = 1;
            $msg = '收藏';
        }

        // 成功
        $extra = [
            'bonus_info' => null,
            'collect_count' => $collect_count,
            'show_collect_count' =>"1"
        ];
        return result(0, $ret, $msg.'成功', $extra);
    }

}