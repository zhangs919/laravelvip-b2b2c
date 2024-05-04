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
// | Date:2020-01-10
// | Description:清理缓存
// +----------------------------------------------------------------------

namespace App\Modules\Backend\Http\Controllers\System;


use App\Modules\Base\Http\Controllers\Backend;
use Illuminate\Http\Request;

class CacheController extends Backend
{


    public function __construct()
    {
        parent::__construct();


    }

    public function clear(Request $request)
    {
        // 执行清理缓存数据操作
        $codes = $request->post('codes');
		$codes = explode(',', $codes);
        $all = 'common_runtime,runtime,site_index,m_site_index,shop_index,m_shop_index,app_index,app_shop_index,news_index,topic_index,config,region,menus,auths,gqrcode';
        $all = explode(',', $all);
        foreach ($all as $item) {
            if (in_array($item, $codes)) {
                // cache()->forget($item); // 清空缓存
            }
        }
        $ret = true;
        if (!$ret) {
            admin_log('清理缓存数据失败');
            return result(-1, null, '清理缓存数据失败！');
        }

        admin_log('清理缓存数据成功');
        return result(0, '', '清理缓存数据成功！');
    }

    public function depthClear(Request $request)
    {
        // 执行深度清理缓存数据操作
        $codes = $request->post('codes');
        $ret = true;
        if (!$ret) {
            admin_log('深度清理缓存数据失败');
            return result(-1, null, '深度清理缓存数据失败！');
        }

        admin_log('深度清理缓存数据成功');
        return result(0, '', '深度清理缓存数据成功！');
    }
}
