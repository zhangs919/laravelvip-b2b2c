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
// | Date:2018-07-28
// | Description: 前端助手函数
// +----------------------------------------------------------------------

/**
 * 判断用户是否登录
 * 已登录 返回用户id
 *
 * @return bool|int|null
 */
function is_login()
{
    if (auth('user')->id()) {
        return auth('user')->id();
    } else {
        return false;
    }
}

/**
 * 获取商品一二三级分类
 *
 * @param int $parent_id 如果传入parent_id 则获取2 3级分类
 * @return array
 */
function get_goods_category_tree($parent_id = 0)
{
    $tree = $arr = $result = [];
    $query = \App\Models\Category::where('is_show', 1)
                ->select(['cat_id','cat_name','parent_id','cat_image','cat_letter','cat_level','take_rate','show_mode','show_virtual',
                    'keywords','discription','is_show','is_parent','cat_sort','ext_info','cat_link','image_link','code']);
    if ($parent_id) { // 获取1级分类下的2 3级分类
        $cat_ids = get_cat_grandson($parent_id);
        unset($cat_ids[0]);
        $query->whereIn('cat_id', $cat_ids);
    }

    $cat_list = $query->orderBy('cat_sort','asc')->get();
    if (!$cat_list->isEmpty()) {

        foreach ($cat_list as $val) {
            $val = $val->toArray();
            if ($val['cat_level'] == 2) {
                $arr[$val['parent_id']][] = $val;
            }
            if ($val['cat_level'] == 3) {
                $crr[$val['parent_id']][] = $val;
            }
            if ($val['cat_level'] == 1) {
                $tree[] = $val;
            }
        }

        foreach ($arr as $k=>$v) {
            foreach ($v as $kk=>$vv) {
                $arr[$k][$kk]['items'] = !empty($crr[$vv['cat_id']]) ? $crr[$vv['cat_id']] : [];
            }
        }

        foreach ($tree as $val) {
            $val['items'] = !empty($arr[$val['cat_id']]) ? $arr[$val['cat_id']] : [];
            $result[$val['cat_id']] = $val;
        }
    }
    if ($parent_id) { // 如果是获取1级分类的2 3级分类 返回
        return $arr;
    }
    return $result;
}

/**
 * 面包屑导航  用于前台商品
 * @param int $id 商品id  或者是 商品分类id
 * @param int $type 默认0是传递商品分类id  id 也可以传递 商品id type则为1
 * @return array
 */
function navigate_goods($id, $type = 0)
{
    $cat_id = $id;
    if ($type == 1) {
        $cat_id = \App\Models\Goods::where('goods_id', $id)->value('cat_id');
    }
    $catList = \App\Models\Category::where('is_show', 1)->select(['cat_id','cat_name','parent_id'])->get();
    $newCatList = [];
    foreach ($catList as $item) {
        $item = $item->toArray();

        $hasChild = \App\Models\Category::where([['is_show',1],['parent_id',$item['parent_id']],['cat_id', '!=', $item['cat_id']]])->select(['cat_id'])->get();
        $hasChild = count($hasChild) > 0 ? 1 : 0;
        $item['has_child'] = $hasChild;
        $newCatList[$item['cat_id']] = $item;
    }

    if ($type == 1) {
        $goods_name = \App\Models\Goods::where('goods_id',$id)->value('goods_name');
        $arr[] = [
            'cat_id' => $id,
            'cat_name' => $goods_name,
            'parent_id' => 0,
            'has_child' => 0,
            'type' => $type
        ];
    } else {
        $arr[] = [
            'cat_id' => $newCatList[$cat_id]['cat_id'],
            'cat_name' => $newCatList[$cat_id]['cat_name'],
            'parent_id' => $newCatList[$cat_id]['parent_id'],
            'has_child' => $newCatList[$cat_id]['has_child'],
            'type' => 0
        ];
    }

    while (true) {
        $cat_id = $newCatList[$cat_id]['parent_id'];
        if ($cat_id > 0) {
            $arr[] = [
                'cat_id' => $newCatList[$cat_id]['cat_id'],
                'cat_name' => $newCatList[$cat_id]['cat_name'],
                'parent_id' => $newCatList[$cat_id]['parent_id'],
                'has_child' => $newCatList[$cat_id]['has_child'],
                'type' => 0
            ];
        } else {
            break;
        }
    }
    $arr = array_values(array_reverse($arr, true));

    return $arr;
}

/**
 * 微信端 错误页面 获取底部导航菜单
 *
 * @return mixed
 */
function get_mobile_navigation()
{
    $template = new \App\Repositories\TemplateRepository();
    $navigation = $template->getNavigationData('m_site', 5, 3); // 底部导航菜单
    return $navigation;
}

/**
 * 检测是否使用手机访问
 * @access public
 * @return bool
 */
function is_mobile()
{
    if (isset($_SERVER['HTTP_VIA']) && stristr($_SERVER['HTTP_VIA'], "wap")) {
        return true;
    } elseif (isset($_SERVER['HTTP_ACCEPT']) && strpos(strtoupper($_SERVER['HTTP_ACCEPT']), "VND.WAP.WML")) {
        return true;
    } elseif (isset($_SERVER['HTTP_X_WAP_PROFILE']) || isset($_SERVER['HTTP_PROFILE'])) {
        return true;
    } elseif (isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/(blackberry|configuration\/cldc|hp |hp-|htc |htc_|htc-|iemobile|kindle|midp|mmp|motorola|mobile|nokia|opera mini|opera |Googlebot-Mobile|YahooSeeker\/M1A1-R2D2|android|iphone|ipod|mobi|palm|palmos|pocket|portalmmm|ppc;|smartphone|sonyericsson|sqh|spv|symbian|treo|up.browser|up.link|vodafone|windows ce|xda |xda_)/i', $_SERVER['HTTP_USER_AGENT'])) {
        return true;
    } else {
        return false;
    }
}

/**
 * 检测是否使用app访问
 *
 * @param string $clientType
 * @return bool
 */
function is_app($clientType = '')
{
    if ($clientType == 'android') {
        // Android
        if (isset($_SERVER['HTTP_USER_AGENT']) && ($_SERVER['HTTP_USER_AGENT'] == 'lrwapp/android')) {
            return true;
        } else {
            return false;
        }
    } elseif ($clientType == 'ios') {
        // Ios
        if (isset($_SERVER['HTTP_USER_AGENT']) && ($_SERVER['HTTP_USER_AGENT'] == 'lrwapp/ios')) {
            return true;
        } else {
            return false;
        }
    } else {
        // Android、Ios
        if (isset($_SERVER['HTTP_USER_AGENT']) && ($_SERVER['HTTP_USER_AGENT'] == 'lrwapp/android' || $_SERVER['HTTP_USER_AGENT'] == 'lrwapp/ios')) {
            return true;
        } else {
            return false;
        }
    }
}

/**
 * 获取地区一二三级
 *
 * @param string $parent_code 如果传入 parent_code 则获取2 3级
 * @return array
 */
//function get_region_tree($parent_code = '')
//{
//    $tree = $arr = $result = [];
//    $query = \App\Models\Region::where('is_enable', 1);
//    if ($parent_code) { // 获取1级地区下的2 3级
//        $region_ids = get_region_grandson($parent_code);
//        unset($region_ids[0]);
//        $query->whereIn('region_id', $region_ids);
//    }
//
//    $region_list = $query->orderBy('sort','asc')->get();
//    if (!$region_list->isEmpty()) {
//
//        foreach ($region_list as $val) {
//            $val = $val->toArray();
//            if ($val['level'] == 2) {
//                $arr[$val['parent_code']][] = $val;
//            }
//            if ($val['level'] == 3) {
//                $crr[$val['parent_code']][] = $val;
//            }
//            if ($val['level'] == 1) {
//                $tree[] = $val;
//            }
//        }
//
//        foreach ($arr as $k=>$v) {
//            foreach ($v as $kk=>$vv) {
//                $arr[$k][$kk]['sub_menu'] = !empty($crr[$vv['region_id']]) ? $crr[$vv['region_id']] : [];
//            }
//        }
//
//        foreach ($tree as $val) {
//            $val['tmenu'] = !empty($arr[$val['region_id']]) ? $arr[$val['region_id']] : [];
//            $result[$val['region_id']] = $val;
//        }
//    }
//    if ($parent_code) { // 如果是获取1级地区的2 3级 返回
//        return $arr;
//    }
//    return $result;
//}

/**
 * 商品列表筛选 uri拼接
 *
 * @param array $params 所有参数
 * @param array $extra 选中参数
 * @return string
 */
function build_goods_uri($params, $extra = [])
{
    extract(array_merge($params, $extra));
    $uri = '/list.html';
    if (isset($cat_id) && !empty($cat_id)) {
        $uri .= '?cat_id='.$cat_id;
    } elseif (isset($keyword) && !empty($keyword)) {
        $uri .= '?keyword='.$keyword;
    } else {
        $uri .= '?s=1';
    }
    if (isset($go) && !empty($go)) {
        $uri .= '&go='.$go;
    }
    if (isset($sort) && !empty($sort)) {
        $uri .= '&sort='.$sort;
    }
    if (isset($price_min) && !empty($price_min)) {
        $uri .= '&price_min='.$price_min;
    }
    if (isset($is_stock) && !empty($is_stock)) {
        $uri .= '&is_stock='.$is_stock;
    }
    if (isset($brand_id) && !empty($brand_id)) {
        $uri .= '&brand_id='.$brand_id;
    }
    if (isset($filter_attr) && !empty($filter_attr)) {
        $uri .= '&filter_attr='.$filter_attr;
    }
    if (isset($is_free) && !empty($is_free)) {
        $uri .= '&is_free='.$is_free;
    }
    if (isset($is_cash) && !empty($is_cash)) {
        $uri .= '&is_cash='.$is_cash;
    }
    if (isset($is_self) && !empty($is_self)) {
        $uri .= '&is_self='.$is_self;
    }
    if (isset($price_max) && !empty($price_max)) {
        $uri .= '&price_max='.$price_max;
    }
    if (isset($sort) && !empty($sort)) {
        $uri .= '&sort='.$sort;
    }
    if (isset($order) && !empty($order)) {
        $uri .= '&order='.$order;
    }
    if (isset($region) && !empty($region)) {
        $uri .= '&region='.$region;
    }
    if (isset($style) && !empty($style)) {
        $uri .= '&style='.$style;
    }

    return $uri;
}

/**
 * 计算商品价格区间
 *
 * @param int $price_min
 * @param int $price_max
 * @param string $price_str
 * @return array
 */
function price_range($price_min = 0, $price_max = 0, $price_str = '')
{
    if (empty($price_min)) {
        $price_min = 0;
    }
    if (empty($price_max)) {
        $price_max = 0;
    }

    //算法:计算商品价格的七个区间
    $priceNumber=7;
    $sprice=ceil(($price_max-$price_min)/$priceNumber);
    $firsetPrice = $price_min;
   //接收七个区间的价格范围
   $_priceNumber=array();
   for($i=0;$i<$priceNumber;$i++){
       if($i<($priceNumber-1)) {
           $start_price = floor($firsetPrice/10)*10;
           $end_price = floor(($firsetPrice+$sprice)/10)*10-1;
       } else {
           $start_price = floor($firsetPrice/10)*10;
           $end_price = ceil($price_max/10)*10;
       }
        $_priceNumber[] = [
            'start' => $start_price,
            'end'=> $end_price,
            'start_end' => $start_price.'&nbsp;-&nbsp;'.$end_price
        ];
       $firsetPrice+=$sprice;
   }
   //把从商品中取出来的价格字符串转化成数组后,
   $goodsPrice=explode(',',$price_str);
   sort($goodsPrice);
   //在价格区间中做比对，如果区间中有商品保存价格区间，否则删除
   foreach($_priceNumber as $k => $v){
       $panduan=array();
       foreach($goodsPrice as $k1 => $v1){
           $v1=floor($v1);
           //价格在此区间，把该价格保存在数组中
           if($v1>=$v['start'] && $v1<=$v['end'])
               $panduan[]=$v1;

       }
       //如果取出的商品没有在此价格区间的，删除该区间范围
       if(empty($panduan))
           unset($_priceNumber[$k]);
   }

   return $_priceNumber;
}

function get_goods_sort_array($value = '')
{
    $list = [
        [
            'name' => '综合',
            'param' => 'sort',
            'value' => 0,
            'sort' => 'goods_sort',
            'order' => null,
        ],
        [
            'name' => '销量',
            'param' => 'sort',
            'value' => 1,
            'sort' => 'sale_num',
            'order' => 'DESC',
        ],
        [
            'name' => '新品',
            'param' => 'sort',
            'value' => 2,
            'sort' => 'last_time',
            'order' => 'DESC',
        ],
        [
            'name' => '评论',
            'param' => 'sort',
            'value' => 3,
            'sort' => 'comment_num',
            'order' => 'DESC',
        ],
        [
            'name' => '价格',
            'param' => 'sort',
            'value' => 4,
            'sort' => 'goods_price',
            'order' => 'DESC',
        ],
        [
            'name' => '人气',
            'param' => 'sort',
            'value' => 5,
            'sort' => 'collect_num',
            'order' => 'DESC',
        ],
    ];

    if ($value != '') {
        foreach ($list as $v) {
            if ($v['value'] == $value) {
                return $v['sort'];
            }
        }
    }

    return $list;
}


/*
*function：计算两个日期相隔多少年，多少月，多少天
*param string $date1[格式如：2011-11-5]
*param string $date2[格式如：2012-12-01]
*return array array('年','月','日');
*/
function diffDate($date1,$date2)
{
    if (strtotime($date1) > strtotime($date2)) {
        $tmp = $date2;
        $date2 = $date1;
        $date1 = $tmp;
    }
    list($Y1, $m1, $d1) = explode('-', $date1);
    list($Y2, $m2, $d2) = explode('-', $date2);
    $Y = $Y2 - $Y1;
    $m = $m2 - $m1;
    $d = $d2 - $d1;
    if ($d < 0) {
        $d += (int)date('t', strtotime("-1 month $date2"));
        $m--;
    }
    if ($m < 0) {
        $m += 12;
        $Y--;
    }
    return array('year' => $Y, 'month' => $m, 'day' => $d);
}

/**
 * 计算开店时长
 * 时间格式为: 1年 4个月 8天
 *
 * @param $open_time
 * @param $end_time
 * @return null|string
 */
function calc_shop_duration($open_time, $end_time)
{
    $result = diffDate(date('Y-m-d',$end_time), date('Y-m-d',$open_time));
    $arr = [];
    if ($result['year'] > 0) {
        $arr[] = $result['year'].'年';
    }
    if ($result['month'] > 0) {
        $arr[] = $result['month'].'个月';
    }
    if ($result['day'] > 0) {
        $arr[] = $result['day'].'天';
    }

    if (empty($arr)) {
        return null;
    }

    $str = implode(' ', $arr);
    return $str;
}