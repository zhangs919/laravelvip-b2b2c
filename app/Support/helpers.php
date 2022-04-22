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
// | Date:2018-07-26
// | Description: 公共助手函数
// +----------------------------------------------------------------------

/**
 * 获取浏览器 phpsessionid
 *
 * @return null|string
 */
function real_cart_mac_ip()
{
    $upperDomain = str_replace('.','_', strtoupper(env('ROOT_DOMAIN'))).'_USER_PHPSESSID';

    session_name($upperDomain);
    $session_id_ip = cookie($upperDomain)->getValue();

    if (empty($session_id_ip) && $upperDomain != '_USER_PHPSESSID') {
        session_start();
//        $session_id_ip = md5(session_id() . dirname(__DIR__));
        $session_id_ip = session_id();
        $time = 60 * 24 * 365;
        cookie($upperDomain, $session_id_ip, $time);
    }

    return $session_id_ip;
}

if (!function_exists('get_client_ip')) {
    /**
     * 获取客户端IP地址
     * @param int $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
     * @param bool $adv 是否进行高级模式获取（有可能被伪装）
     * @return mixed
     */
    function get_client_ip($type = 0, $adv = false) {
        $type       =  $type ? 1 : 0;
        static $ip  =   NULL;
        if ($ip !== NULL) return $ip[$type];
        if($adv){
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                $pos    =   array_search('unknown',$arr);
                if(false !== $pos) unset($arr[$pos]);
                $ip     =   trim($arr[0]);
            }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
                $ip     =   $_SERVER['HTTP_CLIENT_IP'];
            }elseif (isset($_SERVER['REMOTE_ADDR'])) {
                $ip     =   $_SERVER['REMOTE_ADDR'];
            }
        }elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        // IP地址合法验证
        $long = sprintf("%u",ip2long($ip));
        $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
        return $ip[$type];
    }
}

/**
 * 获取实名认证示例图片
 *
 * @return array
 */
function get_idcard_demo_image()
{
    $images = explode('|', sysconf('idcard_demo_image'));

    return $images;
}

if (! function_exists('sysconf')) {
    /**
     * 设置或配置系统参数
     * @param string $code 参数code
     * @param bool $value 默认是false为获取值，否则为更新
     * @return string|bool
     */
    function sysconf($code, $value = false)
    {
//        static $config = [];
        $config = [];
        $systemConfigRep = new \App\Repositories\SystemConfigRepository();

        // 将值为0的情况转换为字符串形式:'0',防止不能更新
        if (is_int($value)) {
            $value = strval($value);
        }
        if ($value !== false) {
            list($config, $data) = [[], ['code' => $code, 'value' => $value]];

            if (\App\Models\SystemConfig::where(['code'=>$code])->count() == 0) {
                return false;
            }
            // 更新
            return $systemConfigRep->updates(['code'=>$code], $data);
        }
        if (empty($config)) {
            $config = $systemConfigRep->detail(['code'=>$code]);
            if (!empty($config)) {
                $config = [
                    $code => $config['value']
                ];
            }
        }
        return isset($config[$code]) ?  html_entity_decode($config[$code]) : '';
    }
}

if (! function_exists('shopconf')) {
    /**
     * 设置或配置店铺参数
     * @param string $code 参数code
     * @param bool $value 默认是false为获取值，否则为更新
     * @param int $shop_id 店铺id 传参表示获取该店铺的配置 否则获取或设置当前登录店铺的配置
     * @return string|bool
     */
    function shopconf($code, $value = false, $shop_id = 0)
    {
        if ($shop_id == 0) {
            $shop_id = empty(seller_shop_info()) ? 0 : seller_shop_info()->shop_id;
        }

        $condition[] = ['config_code',$code];
        $condition[] = ['shop_id',$shop_id];

        // 将值为0的情况转换为字符串形式:'0',防止不能更新
        if (is_int($value)) {
            $value = strval($value);
        }
        if ($value !== false) {
            if (\App\Models\ShopConfig::where($condition)->count() == 0) {
                return false;
            }

            // 更新
            $ret = \App\Models\ShopConfig::where($condition)->update(['value'=>$value]);
            return $ret;
        }

        $retValue = \App\Models\ShopConfig::where($condition)->value('value');

        return !empty($retValue) ? html_entity_decode($retValue) : '';
    }
}

if (! function_exists('assets_path')) {
    function assets_path($filename)
    {
        $assets_path = asset('assets/d2eace91/'.$filename);
        return $assets_path;
    }
}

/**
 * 返回json格式数据
 */
if (! function_exists('result')) {
    function result($code = 0, $data = "0", $message = "", $extra = [], $is_json = true)
    {
        $result = [
            'code' => $code,
            'data' => $data,
            'message' => $message
        ];
        if (!empty($extra)) { // 数组追加
            foreach ($extra as $k=>$v) {
                $result[$k] = $v;
            }
        }
        if ($is_json) {// 返回json格式
            return response($result, 200)
                ->header('Content-Type', 'text/html; charset=UTF-8'); // 设置response头信息 否则会报错
        }

        return $result; // 返回数组格式
    }
}

/**
 * 返回json格式数据
 */
if (! function_exists('json_result')) {
    function json_result($data)
    {
        return response($data, 200)
            ->header('Content-Type', 'text/html; charset=UTF-8'); // 设置response头信息 否则会报错
    }
}

/**
 * 返回数组格式数据
 */
if (! function_exists('arr_result')) {
    function arr_result($code = 0, $data = "0", $message = "", $extra = [])
    {
        $result = result($code, $data, $message, $extra, false);
        return $result;
    }
}

//if (! function_exists('design_tpl')) {
//    function design_tpl($code = '')
//    {
//        $data = [
//            [
//                'cat_id' => '1', // 模板分类id
//                'selector_type' => 3, // 模板选择器id
//                'tpl_name' => '一栏广告',
//                'code' => 'ad_one_column',
//                'type' => '1', // 模板类型 1 2 3 4 5 6 7
//                'remarks' => '',
//                'number' => 1,
//                'icon' => '/assets/d2eace91/images/design/icon/0/ad_one_column.png',
//
//            ],
//            [
//                'cat_id' => '1', // 模板分类id
//                'selector_type' => 3, // 模板选择器id
//                'tpl_name' => '五栏广告',
//                'code' => 'ad_five_column',
//                'type' => '1', // 模板类型 1 2 3 4 5 6 7
//                'remarks' => '',
//                'number' => 1,
//                'icon' => '/assets/d2eace91/images/design/icon/0/ad_five_column.png',
//
//            ],
//        ];
//
//        if ($code != '') {
//            foreach ($data as $k=>$v) {
//                if ($v['code'] == $code) {
//                    return $data[$k];
//                }
//            }
//            return false;
//        }
//
//        return $data;
//    }
//}

if (! function_exists('design_tpl_type')) {
    /**
     * 装修模板类型
     * @param string $key
     * @return array|bool|mixed
     */
    function design_tpl_type($key = '')
    {
        $data = [
            '1' => '广告模板',
            '2' => '商品模板',
            '3' => '通用模板',
            '4' => '分页模板',
            '5' => '导航模板',
            '6' => '资讯模板',
            '7' => '专题模板',
            '8' => '营销模板',
        ];

        if ($key != '') {
            return isset($data[$key]) ? $data[$key] : false;
        }

        return $data;
    }
}

if (! function_exists('design_tpl_selector')) {
    /**
     * 装修模板选择器
     * @param string $key
     * @return array|bool|mixed
     */
    function design_tpl_selector($key = '')
    {
        $data = [
            '99' => '样式选择器',
            '1' => '文章选择器',
            '2' => '商品选择器',
            '3' => '图片选择器',
            '4' => '标题选择器',
            '5' => '品牌选择器',
            '6' => '分类选择器',
            '7' => '活动选择器',
            '8' => '导航选择器',
            '9' => '店铺选择器',
            '10' => '自定义选择器',
            '11' => '红包选择器',
            '12' => '文本选择器',
        ];

        if ($key != '') {
            return isset($data[$key]) ? $data[$key] : false;
        }

        return $data;
    }
}

/*if (! function_exists('design_tpl_item')) {
    function design_tpl_item($uid = '')
    {
        $data = [
            [
                'data' => '',
                'uid' => '1518927139SWHG1K',
                'shop_id' => '0',
                'page' => 'topic',
                'sort' => '1',
                'ext_info' => null,
                'is_valid' => '1',
                'site_id' => '0',
                'code' => 'ad_one_column',
                'topic_id' => '2',
                'is_publish' => '0'
            ],
            [
                'data' => '',
                'uid' => 'A1518927139SWHG1K',
                'shop_id' => '0',
                'page' => 'topic',
                'sort' => '6',
                'ext_info' => null,
                'is_valid' => '1',
                'site_id' => '0',
                'code' => 'ad_five_column',
                'topic_id' => '2',
                'is_publish' => '0'
            ],
        ];
//        dd($uid);
        if ($uid != '') {
            foreach ($data as $k=>$v) {
                if ($v['uid'] == $uid) {
                    return $data[$k];
                }
            }
            return false;
        }

        return $data;
    }
}*/


if (! function_exists('str_replace_style')) {
    /**
     * 正则替换两个字符串之间的内容
     * 用法：str_replace_style('second_color', '#eee', file_get_contents(public_path('frontend/css/custom/site-color-style-0.css')))
     *
     * @param $code
     * @param $replacement
     * @param $str
     * @return null|string|string[]
     */
    function str_replace_style($code, $replacement, $str)
    {
        $stag="\/\*".$code."_start\*\/";
        $sta = "/*".$code."_start*/";
        $etag = "\/\*".$code."_end\*\/";
        $eta = "/*".$code."_end*/";
        $result = preg_replace("'".$stag.".*".$etag."'Usi", $sta.$replacement.$eta, $str);
        return $result;
    }
}

if (! function_exists('short_pagination')) {
    /**
     * 公共分页类
     * 适用于ajax弹出框中的分页 不支持页码搜索跳转
     *
     * @param int $total 数据总条数
     * @param int $page_size 每页数量
     * @return mixed
     */
    function short_pagination($total, $page_size = 10)
    {
        $pageArr = request()->all();
        $curPage = !empty($pageArr['page']['cur_page']) ? $pageArr['page']['cur_page'] : 1;
        $pageSize = !empty($pageArr['page']['page_size']) ? $pageArr['page']['page_size'] : $page_size;
        $page_id = !empty($pageArr['page']['page_id']) ? $pageArr['page']['page_id'] : '#pagination';
        $page_id = str_replace('#', '', $page_id);
        $offset = ($curPage - 1) * $pageSize; // 从第几条数据开始查询

        $pageTotal = ceil($total / $pageSize);
        $pageArr = [
            'page_key' => 'page',
            'page_id' => $page_id, //'pagination',
            'default_page_size' => 10,
            'cur_page' => $curPage,
            'page_size' => $pageSize, // todo
            'page_size_list' => [5,10,15,20],
            'record_count' => $total,
            'page_count' => $pageTotal,
            'offset' => $offset,
            'url' => null,
            'sql' => null
        ];

        //分页
        $num = 7; //需要显示的最多页数
        $num = min($pageTotal, $num); //处理显示的页码数大于总页数的情况
        $end = $curPage + floor($num/2) <= $pageTotal ? $curPage + floor($num/2) : $pageTotal; //计算结束页号
        $start = $end - $num + 1; //计算开始页号
        if($start < 1) { //处理开始页号小于1的情况
            $end -= $start - 1;
            $start = 1;
        }

        $html = '<div id="'.$page_id.'">';
        $html .= '<script data-page-json="true" type="text">';
        $html .= json_encode($pageArr);
        $html .= '</script>';

        $html .= '<div class="pagination-info">';
        $html .= '共'.$pageArr['record_count'].'条记录，每页显示：';
        $html .= '<select class="select m-r-5" data-page-size="'.$pageSize.'">';
        foreach ($pageArr['page_size_list'] as $size){
            $selected = ($pageSize == $size) ? 'selected="selected"' : '';
            $html .= '<option value="'.$size.'" '.$selected.'>'.$size.'</option>';
        }
        $html .= '</select>';
        $html .= '条';
        $html .= '</div>';

        $html .= '<ul class="pagination">';
        if($curPage > 1) {
            $html .= '<li style="display: none;">
                    <a class="fa fa-angle-double-left" data-go-page="1" title="第一页"></a>
                </li>
                <li>
                    <a class="fa fa-angle-left" data-go-page="'.($curPage - 1).'" title="上一页"></a>
                </li>';
        }else {
            $html .= '<li class="disabled" style="display: none;">
                    <a class="fa fa-angle-double-left" title="第一页"></a>
                </li>
                <li class="disabled">
                    <a class="fa fa-angle-left" title="上一页"></a>
                </li>';
        }

        for($i = $start; $i <= $end; $i++){
            if($i == $curPage){
                $html .= '<li class="active">
                        <a data-cur-page="'.$i.'">'.$i.'</a>
                    </li>';
            }else{
                $html .= '<li>
                        <a href="javascript:void(0);" data-go-page="'.$i.'">'.$i.'</a>
                    </li>';
            }
        }

        if($curPage < $pageTotal) {
            $html .= '<li>
                    <a class="fa fa-angle-right" data-go-page="'.($curPage + 1).'" title="下一页"></a>
                </li>

                <li class="" style="display: none;">
                    <a class="fa fa-angle-double-right" data-go-page="'.$pageTotal.'" title="最后一页"></a>
                </li>';
        }else {
            $html .= '<li class="disabled">
                    <a class="fa fa-angle-right" title="下一页"></a>
                </li>

                <li class="" style="display: none;">
                    <a class="fa fa-angle-double-right" title="最后一页"></a>
                </li>';
        }
        $html .= '</ul>';
        $html .= '</div>';

        return $html;
    }
}


if (! function_exists('pagination')) {
    /**
     * 平台后台、商家后台公共分页类
     *
     * @param int $total 数据总条数
     * @param  bool $showPage 是否显示分页 默认显示
     * @return mixed
     */
    function pagination($total, $showPage = true) {

        $pageArr = request()->all();
        $curPage = !empty($pageArr['page']['cur_page']) ? $pageArr['page']['cur_page'] : 1;
        $pageSize = !empty($pageArr['page']['page_size']) ? $pageArr['page']['page_size'] : 10;
        $page_id = !empty($pageArr['page']['page_id']) ? $pageArr['page']['page_id'] : '#pagination';
        $page_id = str_replace('#', '', $page_id);

        $offset = ($curPage - 1) * $pageSize; // 从第几条数据开始查询

        $pageTotal = ceil($total / $pageSize);
        $pageArr = [
            'page_key' => 'page',
            'page_id' => $page_id,
            'default_page_size' => (int)$pageSize,
            'cur_page' => (int)$curPage,
            'page_size' => $pageSize, // todo
            'page_size_list' => [10,50,500,1000],
            'record_count' => (int)$total,
            'page_count' => (int)$pageTotal,
            'offset' => (int)$offset,
            'url' => null,
            'sql' => null
        ];


        //分页
        $num = 7; //需要显示的最多页数
        $num = min($pageTotal, $num); //处理显示的页码数大于总页数的情况
        $end = $curPage + floor($num/2) <= $pageTotal ? $curPage + floor($num/2) : $pageTotal; //计算结束页号
        $start = $end - $num + 1; //计算开始页号
        if($start < 1) { //处理开始页号小于1的情况
            $end -= $start - 1;
            $start = 1;
        }

        $html = '<div id="'.$page_id.'">';
        $html .= '<script data-page-json="true" type="text">';
        $html .= json_encode($pageArr);
        $html .= '</script>';

        if ($showPage) {
            // 显示分页 拼装分页html
            $html .= '<div class="pagination-info">';
            $html .= '共'.$pageArr['record_count'].'条记录，每页显示：';
            $html .= '<select class="select m-r-5" data-page-size="'.$pageSize.'">';
            foreach ($pageArr['page_size_list'] as $size){
                $selected = ($pageSize == $size) ? 'selected="selected"' : '';
                $html .= '<option value="'.$size.'" '.$selected.'>'.$size.'</option>';
            }
            $html .= '</select>';
            $html .= '条';
            $html .= '</div>';


            $html .= '<ul class="pagination">';
            if($curPage > 1) {
                $html .= '<li style="display: none;">
                    <a class="fa fa-angle-double-left" data-go-page="1" title="第一页"></a>
                </li>
                <li>
                    <a class="fa fa-angle-left" data-go-page="'.($curPage - 1).'" title="上一页"></a>
                </li>';
            }else {
                $html .= '<li class="disabled" style="display: none;">
                    <a class="fa fa-angle-double-left" title="第一页"></a>
                </li>
                <li class="disabled">
                    <a class="fa fa-angle-left" title="上一页"></a>
                </li>';
            }

            for($i = $start; $i <= $end; $i++){
                if($i == $curPage){
                    $html .= '<li class="active">
                        <a data-cur-page="'.$i.'">'.$i.'</a>
                    </li>';
                }else{
                    $html .= '<li>
                        <a href="javascript:void(0);" data-go-page="'.$i.'">'.$i.'</a>
                    </li>';
                }
            }

            if($curPage < $pageTotal) {
                $html .= '<li>
                    <a class="fa fa-angle-right" data-go-page="'.($curPage + 1).'" title="下一页"></a>
                </li>

                <li class="" style="display: none;">
                    <a class="fa fa-angle-double-right" data-go-page="'.$pageTotal.'" title="最后一页"></a>
                </li>';
            }else {
                $html .= '<li class="disabled">
                    <a class="fa fa-angle-right" title="下一页"></a>
                </li>

                <li class="" style="display: none;">
                    <a class="fa fa-angle-double-right" title="最后一页"></a>
                </li>';
            }
            $html .= '</ul>';

            $html .= '<div class="pagination-goto">
                <input class="ipt form-control goto-input" type="text">
                <button class="btn btn-default goto-button" title="点击跳转到指定页面">GO</button>
                <a class="goto-link" data-go-page="'.$curPage.'" style="display: none;"></a>
            </div>';

            $html .= '</div>';
            $html .= '<script type="text/javascript">
                $().ready(function () {
                    $(".pagination-goto > .goto-input").keyup(function (e) {
                        $(".pagination-goto > .goto-link").attr("data-go-page", $(this).val());
                        if (e.keyCode == 13) {
                            $(".pagination-goto > .goto-link").click();
                        }
                    });
                    $(".pagination-goto > .goto-button").click(function () {
                        var page = $(".pagination-goto > .goto-link").attr("data-go-page");
                        if ($.trim(page) == \'\') {
                            return false;
                        }
                        $(".pagination-goto > .goto-link").attr("data-go-page", page);
                        $(".pagination-goto > .goto-link").click();
                        return false;
                    });
                });
            </script>';
        }

        $html .= '</div>';

        return $html;
    }
}

if (! function_exists('frontend_pagination')) {
    /**
     * 前端公共分页类
     *
     * @param int $total 数据总条数
     * @param  bool $isAjax 是否ajax加载分页 只返回分页json数组 不返回html
     * @return mixed
     */
    function frontend_pagination($total, $isAjax = false) {

        $pageArr = request()->all();
        $curPage = !empty($pageArr['page']['cur_page']) ? $pageArr['page']['cur_page'] : 1;
        $pageSize = !empty($pageArr['page']['page_size']) ? $pageArr['page']['page_size'] : 12;
        $page_id = !empty($pageArr['page']['page_id']) ? $pageArr['page']['page_id'] : '#pagination';
        $page_id = str_replace('#', '', $page_id);

        $offset = ($curPage - 1) * $pageSize; // 从第几条数据开始查询

        $pageTotal = ceil($total / $pageSize);
        $pageArr = [
            'page_key' => 'page',
            'page_id' => $page_id,
            'default_page_size' => (int)$pageSize,
            'cur_page' => (int)$curPage,
            'page_size' => $pageSize, // todo
            'page_size_list' => [10,50,500,1000],
            'record_count' => (int)$total,
            'page_count' => (int)$pageTotal,
            'offset' => (int)$offset,
            'url' => null,
            'sql' => null
        ];

        if ($isAjax) {
            return $pageArr;
        }

        //分页
        $num = 7; //需要显示的最多页数
        $num = min($pageTotal, $num); //处理显示的页码数大于总页数的情况
        $end = $curPage + floor($num/2) <= $pageTotal ? $curPage + floor($num/2) : $pageTotal; //计算结束页号
        $start = $end - $num + 1; //计算开始页号
        if($start < 1) { //处理开始页号小于1的情况
            $end -= $start - 1;
            $start = 1;
        }

        $html = '<div id="pagination" class="page">';
        $html .= '<script data-page-json="true" type="text">';
        $html .= json_encode($pageArr);
        $html .= '</script>';
        $html .= '<div class="page-wrap fr">';
        $html .= '<div class="total">';
        $html .= '共'.$pageArr['record_count'].'条记录';
        $html .='</div>';
        $html .= '</div>';


        $html .= '<div class="page-num fr">';
        if($curPage > 1) {
            $html .='<span class="num prev disabled" style="display: none;">
                        <a class="fa fa-angle-double-left" data-go-page="1" title="第一页"></a>
                    </span>
                    <span>
                        <a class="num prev " data-go-page="'.($curPage - 1).'" title="上一页">上一页</a>
                    </span>';
        }else {
            $html .='<span class="num prev disabled" style="display: none;">
                        <a class="fa fa-angle-double-left" data-go-page="1" title="第一页"></a>
                    </span>
                    <span>
                        <a class="num prev disabled " title="上一页">上一页</a>
                    </span>';
        }

        for($i = $start; $i <= $end; $i++){
            if($i == $curPage){
                $html .='<span class="num curr">
                            <a data-cur-page="'.$i.'">'.$i.'</a>
                        </span>';
            }else{
                $html .='<span>
                            <a class="num " href="javascript:void(0);" data-go-page="'.$i.'">'.$i.'</a>
                        </span>';
            }
        }

        if($curPage < $pageTotal) {
            $html .='<span class="" style="display: none;">
                        <a class="num " data-go-page="'.$pageTotal.'" title="最后一页"></a>
                    </span>
                    <span>
                        <a class="num next" data-go-page="'.($curPage + 1).'" title="下一页">下一页</a>
                    </span>';
        }else {
            $html .='<span class="disabled" style="display: none;">
                        <a class="num " data-go-page="'.$pageTotal.'" title="最后一页"></a>
                    </span>
                    <span>
                        <a class="num next disabled" title="下一页">下一页</a>
                    </span>';
        }
        $html .= '</div>';

        /*$html .= '<div class="pagination-goto">
                    <input class="ipt form-control goto-input" type="text">
                    <button class="btn btn-default goto-button" title="点击跳转到指定页面">GO</button>
                    <a class="goto-link" data-go-page="'.I('get.page[cur_page]').'" style="display: none;"></a>
                </div>';*/

        $html .= '<script type="text/javascript">
                $().ready(function () {
                    $(".pagination-goto > .goto-input").keyup(function (e) {
                        $(".pagination-goto > .goto-link").attr("data-go-page", $(this).val());
                        if (e.keyCode == 13) {
                            $(".pagination-goto > .goto-link").click();
                        }
                    });
                    $(".pagination-goto > .goto-button").click(function () {
                        var page = $(".pagination-goto > .goto-link").attr("data-go-page");
                        if ($.trim(page) == \'\') {
                            return false;
                        }
                        $(".pagination-goto > .goto-link").attr("data-go-page", page);
                        $(".pagination-goto > .goto-link").click();
                        return false;
                    });
                });
            </script>';
        $html .= '</div>';

        return $html;
    }
}

if (! function_exists('cdn')) {
    function cdn($filepath)
    {
        if (env('URL_STATIC')) {
            return env('URL_STATIC') . $filepath;
        } else {
            return config('app.url') . $filepath;
        }
    }
}


if (! function_exists('article_cat_type')) {

    /**
     * Get article cat types.
     *
     * @param string $key
     * @return array|bool|mixed
     */
    function article_cat_type($key = '')
    {
        $data = [
            '1' => '普通分类', // 可以添加子分类
            '2' => '商城公告',
            '3' => '商家指南', // 可以添加子分类
            '4' => '帮助中心',
            '5' => '用户公告',
            '6' => '商家公告',
            '7' => '网点公告',
            '8' => '供货商公告',
            '9' => '站点公告',
            '11' => '入驻指南',
            '12' => '信息公告',
            '14' => '分销帮助中心',
        ];

        if ($key != '') {
            return isset($data[$key]) ? $data[$key] : false;
        }

        return $data;
    }
}

if (! function_exists('flash')) {
    /**
     * Put session to flash.
     * @param string $status
     * @param string $msg
     * @param string $key
     */
    function flash($status = 'success', $msg = '操作成功', $key = 'layerMsg')
    {
        session()->flash($key, ['status' => $status, 'msg' => $msg]);
    }
}

function get_form_item_type()
{
//    text:单行文本
//textarea:多行文本
//password:密码
//hidden:隐藏
//switch:开关
//radio:单选按钮
//imagegroup:图片组
    $data = [
        'text' => [
            'name' => 'text',
            'title' => '单行文本'
        ],
        'textarea' => [
            'name' => 'textarea',
            'title' => '多行文本'
        ],
        'short_text' => [
            'name' => 'short_text',
            'title' => '短单行文本'
        ],
        'html' => [
            'name' => 'html',
            'title' => '自定义html' // 自定义html包含配置信息
        ],
        'static' => [
            'name' => 'static',
            'title' => '静态文本' // label
        ],
        'password' => [
            'name' => 'password',
            'title' => '密码'
        ],
        'hidden' => [
            'name' => 'hidden',
            'title' => '隐藏'
        ],
        'switch' => [
            'name' => 'switch',
            'title' => '开关'
        ],
        'radio' => [
            'name' => 'radio',
            'title' => '单选按钮'
        ],
        'imagegroup' => [
            'name' => 'imagegroup',
            'title' => '图片组'
        ],
        'select' => [
            'name' => 'select',
            'title' => '下拉框'
        ],
        'checkbox' => [
            'name' => 'checkbox',
            'title' => '复选框'
        ],
        'kindeditor' => [
            'name' => 'kindeditor',
            'title' => 'KindEditor'
        ],
        'region' => [
            'name' => 'region',
            'title' => '地区联动'
        ],
        'colorpicker' => [
            'name' => 'colorpicker',
            'title' => '取色器'
        ],
    ];

    return $data;
}

if (! function_exists('get_config_groups'))
{

    /**
     * 平台后台配置分组
     *
     * @param $group
     * @return bool|mixed
     */
    function get_config_group($group = '')
    {
        $data = [
            'system' => [
                'code' => 'system',
                'title' => '系统',
                'explain' => [],
                'anchor' => [],
//                'validate_json' => ''
            ],
            'web_static' => [
                'code' => 'web_static',
                'title' => 'PC静态页面设置',
                'explain' => [],
                'anchor' => [],
            ],
            'web_mobile_static' => [
                'code' => 'web_mobile_static',
                'title' => 'Mobile静态页面设置',
                'explain' => [],
                'anchor' => [],
            ],
            'site_style' => [
                'code' => 'site_style',
                'title' => 'PC自定义风格',
                'explain' => [
                    '主体颜色包含商城各个页面的背景或文字颜色，包含项指：首页请登录文字颜色、商品金额颜色、搜索框颜色、左侧导航背景颜色、鼠标经过文字/图标颜色、楼层快捷导航按钮颜色；',
                    '商品详情页的加入购物车、进入店铺、关注店铺按钮、tab切换颜色；商品列表页收藏按钮颜色、卖光了按钮颜色；店铺街分类文字背景色；团购页面马上抢按钮颜色；用户中心头部导航背景色'
                ],
                'anchor' => [],
            ],
            'mobile_site_style' => [
                'code' => 'mobile_site_style',
                'title' => 'Mobile自定义风格',
                'explain' => [
                    '主体颜色包含商城各个页面的背景或文字颜色，包含项指：首页请登录文字颜色、商品金额颜色、搜索框颜色、左侧分类导航背景颜色、鼠标经过文字/图标颜色、楼层快捷导航按钮颜色；',
                    '商品详情页的加入购物车、进入店铺、关注店铺按钮、tab切换颜色；商品列表页收藏按钮颜色、卖光了按钮颜色；店铺街分类文字背景色；团购页面马上抢按钮颜色；用户中心头部导航背景色'
                ],
                'anchor' => [],
            ],
            'news_setting' => [
                'code' => 'news_setting',
                'title' => '资讯频道设置',
                'explain' => [
                    '可以控制资讯频道头部和底部模块的显示和隐藏，默认为全部显示状态，如果您希望某个模块隐藏掉就选中它'
                ],
                'anchor' => [],
            ],
            'website' => [
                'code' => 'website',
                'title' => '网站设置',
                'explain' => [],
                'anchor' => [
                    '网站设置',
                    'pc网站状态',
                    '网站状态'
                ],
//                'validate_json' => '[{"id": "systemconfigmodel-site_name", "name": "SystemConfigModel[site_name]", "attribute": "site_name", "rules": {"string":true,"messages":{"string":"网站名称必须是一条字符串。"}}},{"id": "systemconfigmodel-site_name", "name": "SystemConfigModel[site_name]", "attribute": "site_name", "rules": {"required":true,"messages":{"required":"网站名称不能为空。"}}},{"id": "systemconfigmodel-site_name", "name": "SystemConfigModel[site_name]", "attribute": "site_name", "rules": {"string":true,"messages":{"string":"网站名称必须是一条字符串。","maxlength":"网站名称只能包含至多30个字符。"},"maxlength":30}},{"id": "systemconfigmodel-site_index_topic", "name": "SystemConfigModel[site_index_topic]", "attribute": "site_index_topic", "rules": {"string":true,"messages":{"string":"专题页编号必须是一条字符串。"}}},{"id": "systemconfigmodel-site_index", "name": "SystemConfigModel[site_index]", "attribute": "site_index", "rules": {"string":true,"messages":{"string":"网站首页必须是一条字符串。"}}},{"id": "systemconfigmodel-favicon", "name": "SystemConfigModel[favicon]", "attribute": "favicon", "rules": {"string":true,"messages":{"string":"网站头像必须是一条字符串。"}}},{"id": "systemconfigmodel-backend_logo", "name": "SystemConfigModel[backend_logo]", "attribute": "backend_logo", "rules": {"string":true,"messages":{"string":"后台系统Logo必须是一条字符串。"}}},{"id": "systemconfigmodel-backend_logo", "name": "SystemConfigModel[backend_logo]", "attribute": "backend_logo", "rules": {"required":true,"messages":{"required":"后台系统Logo不能为空。"}}},{"id": "systemconfigmodel-site_icp", "name": "SystemConfigModel[site_icp]", "attribute": "site_icp", "rules": {"string":true,"messages":{"string":"ICP证书号必须是一条字符串。"}}},{"id": "systemconfigmodel-site_copyright", "name": "SystemConfigModel[site_copyright]", "attribute": "site_copyright", "rules": {"string":true,"messages":{"string":"版权信息必须是一条字符串。"}}},{"id": "systemconfigmodel-timezone", "name": "SystemConfigModel[timezone]", "attribute": "timezone", "rules": {"string":true,"messages":{"string":"默认时区必须是一条字符串。"}}},{"id": "systemconfigmodel-stats_code", "name": "SystemConfigModel[stats_code]", "attribute": "stats_code", "rules": {"string":true,"messages":{"string":"第三方流量统计代码(PC端)必须是一条字符串。"}}},{"id": "systemconfigmodel-stats_code_wap", "name": "SystemConfigModel[stats_code_wap]", "attribute": "stats_code_wap", "rules": {"string":true,"messages":{"string":"第三方流量统计代码(WAP端)必须是一条字符串。"}}},{"id": "systemconfigmodel-pc_site_status", "name": "SystemConfigModel[pc_site_status]", "attribute": "pc_site_status", "rules": {"string":true,"messages":{"string":"PC端状态必须是一条字符串。"}}},{"id": "systemconfigmodel-pc_site_close_image", "name": "SystemConfigModel[pc_site_close_image]", "attribute": "pc_site_close_image", "rules": {"string":true,"messages":{"string":"PC端关闭提示图片必须是一条字符串。"}}},{"id": "systemconfigmodel-site_status", "name": "SystemConfigModel[site_status]", "attribute": "site_status", "rules": {"string":true,"messages":{"string":"网站状态必须是一条字符串。"}}},{"id": "systemconfigmodel-close_comment", "name": "SystemConfigModel[close_comment]", "attribute": "close_comment", "rules": {"string":true,"messages":{"string":"关闭原因必须是一条字符串。"}}},{"id": "systemconfigmodel-upgrade_comment", "name": "SystemConfigModel[upgrade_comment]", "attribute": "upgrade_comment", "rules": {"string":true,"messages":{"string":"升级描述必须是一条字符串。"}}},]'
            ],
            'captcha' => [
                'code' => 'captcha',
                'title' => '验证码设置',
                'explain' => [],
                'anchor' => [
                    '图片验证码',
                    '短信验证码'
                ],
//                'validate_json' => '[{"id": "systemconfigmodel-captcha_login_fail", "name": "SystemConfigModel[captcha_login_fail]", "attribute": "captcha_login_fail", "rules": {"string":true,"messages":{"string":"登录失败时显示图片验证码必须是一条字符串。"}}},{"id": "systemconfigmodel-captcha_login_fail", "name": "SystemConfigModel[captcha_login_fail]", "attribute": "captcha_login_fail", "rules": {"required":true,"messages":{"required":"登录失败时显示图片验证码不能为空。"}}},{"id": "systemconfigmodel-captcha_noise", "name": "SystemConfigModel[captcha_noise]", "attribute": "captcha_noise", "rules": {"string":true,"messages":{"string":"图片验证码干扰点必须是一条字符串。"}}},{"id": "systemconfigmodel-captcha_noise", "name": "SystemConfigModel[captcha_noise]", "attribute": "captcha_noise", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"图片验证码干扰点必须是整数。","min":"图片验证码干扰点必须不小于0。","max":"图片验证码干扰点必须不大于10。"},"min":0,"max":10}},{"id": "systemconfigmodel-captcha_curve", "name": "SystemConfigModel[captcha_curve]", "attribute": "captcha_curve", "rules": {"string":true,"messages":{"string":"图片验证码干扰线必须是一条字符串。"}}},{"id": "systemconfigmodel-captcha_curve", "name": "SystemConfigModel[captcha_curve]", "attribute": "captcha_curve", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"图片验证码干扰线必须是整数。","min":"图片验证码干扰线必须不小于0。","max":"图片验证码干扰线必须不大于3。"},"min":0,"max":3}},{"id": "systemconfigmodel-captcha_sms_max", "name": "SystemConfigModel[captcha_sms_max]", "attribute": "captcha_sms_max", "rules": {"string":true,"messages":{"string":"短信验证码控制必须是一条字符串。"}}},{"id": "systemconfigmodel-captcha_sms_max", "name": "SystemConfigModel[captcha_sms_max]", "attribute": "captcha_sms_max", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"短信验证码控制必须是整数。","min":"短信验证码控制必须不小于1。"},"min":1}},{"id": "systemconfigmodel-captcha_sms_mobile_max", "name": "SystemConfigModel[captcha_sms_mobile_max]", "attribute": "captcha_sms_mobile_max", "rules": {"string":true,"messages":{"string":"每个手机号码地址短信验证码控制必须是一条字符串。"}}},{"id": "systemconfigmodel-captcha_sms_mobile_max", "name": "SystemConfigModel[captcha_sms_mobile_max]", "attribute": "captcha_sms_mobile_max", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"每个手机号码地址短信验证码控制必须是整数。","min":"每个手机号码地址短信验证码控制必须不小于1。"},"min":1}},{"id": "systemconfigmodel-captcha_sms_mobile_max", "name": "SystemConfigModel[captcha_sms_mobile_max]", "attribute": "captcha_sms_mobile_max", "rules": {"compare":{"operator":"<","type":"number","compareAttribute":"systemconfigmodel-captcha_sms_mobile_time","skipOnEmpty":1},"messages":{"compare":"每个手机号码地址短信验证码控制的值必须小于\"时间范围\"。"}}},{"id": "systemconfigmodel-captcha_sms_mobile_time", "name": "SystemConfigModel[captcha_sms_mobile_time]", "attribute": "captcha_sms_mobile_time", "rules": {"string":true,"messages":{"string":"时间范围必须是一条字符串。"}}},{"id": "systemconfigmodel-captcha_sms_mobile_time", "name": "SystemConfigModel[captcha_sms_mobile_time]", "attribute": "captcha_sms_mobile_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"时间范围必须是整数。","min":"时间范围必须不小于10。"},"min":10}},{"id": "systemconfigmodel-captcha_sms_mobile_interval", "name": "SystemConfigModel[captcha_sms_mobile_interval]", "attribute": "captcha_sms_mobile_interval", "rules": {"string":true,"messages":{"string":"限制发送间隔时间必须是一条字符串。"}}},{"id": "systemconfigmodel-captcha_sms_mobile_interval", "name": "SystemConfigModel[captcha_sms_mobile_interval]", "attribute": "captcha_sms_mobile_interval", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"限制发送间隔时间必须是整数。","min":"限制发送间隔时间必须不小于10。"},"min":10}},{"id": "systemconfigmodel-captcha_sms_ip_max", "name": "SystemConfigModel[captcha_sms_ip_max]", "attribute": "captcha_sms_ip_max", "rules": {"string":true,"messages":{"string":"每个IP地址短信验证码控制必须是一条字符串。"}}},{"id": "systemconfigmodel-captcha_sms_ip_max", "name": "SystemConfigModel[captcha_sms_ip_max]", "attribute": "captcha_sms_ip_max", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"每个IP地址短信验证码控制必须是整数。","min":"每个IP地址短信验证码控制必须不小于1。"},"min":1}},{"id": "systemconfigmodel-captcha_sms_ip_max", "name": "SystemConfigModel[captcha_sms_ip_max]", "attribute": "captcha_sms_ip_max", "rules": {"compare":{"operator":"<","type":"number","compareAttribute":"systemconfigmodel-captcha_sms_ip_time","skipOnEmpty":1},"messages":{"compare":"每个IP地址短信验证码控制的值必须小于\"时间范围\"。"}}},{"id": "systemconfigmodel-captcha_sms_ip_time", "name": "SystemConfigModel[captcha_sms_ip_time]", "attribute": "captcha_sms_ip_time", "rules": {"string":true,"messages":{"string":"时间范围必须是一条字符串。"}}},{"id": "systemconfigmodel-captcha_sms_ip_time", "name": "SystemConfigModel[captcha_sms_ip_time]", "attribute": "captcha_sms_ip_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"时间范围必须是整数。","min":"时间范围必须不小于10。"},"min":10}},{"id": "systemconfigmodel-captcha_sms_ip_interval", "name": "SystemConfigModel[captcha_sms_ip_interval]", "attribute": "captcha_sms_ip_interval", "rules": {"string":true,"messages":{"string":"限制发送间隔时间必须是一条字符串。"}}},{"id": "systemconfigmodel-captcha_sms_ip_interval", "name": "SystemConfigModel[captcha_sms_ip_interval]", "attribute": "captcha_sms_ip_interval", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"限制发送间隔时间必须是整数。","min":"限制发送间隔时间必须不小于10。"},"min":10}},{"id": "systemconfigmodel-captcha_sms_limit", "name": "SystemConfigModel[captcha_sms_limit]", "attribute": "captcha_sms_limit", "rules": {"string":true,"messages":{"string":"短信验证码发送频繁限制方式必须是一条字符串。"}}},]'
            ],
            'region' => [
                'code' => 'region',
                'title' => '地区设置',
                'explain' => [
                    '经营地区最高级别：指在地区选择的时候开始的级别，比如网站只经营一个或几个城市，可直接从市级开始省去“省”的选择',
                    '经营地区最低级别：指在地区选择的时候结束的级别，比如乡镇级，最低级为乡镇级，则村级不可选择',
                    '例如：最高级别为“市级”，最低级别为“乡镇”选择范围为市，县区，乡镇'
                ],
                'anchor' => [],
//                'validate_json' => '[{"id": "systemconfigmodel-sale_level_names", "name": "SystemConfigModel[sale_level_names]", "attribute": "sale_level_names", "rules": {"string":true,"messages":{"string":"经营地区行政级别名称必须是一条字符串。"}}},{"id": "systemconfigmodel-sale_level_names", "name": "SystemConfigModel[sale_level_names]", "attribute": "sale_level_names", "rules": {"required":true,"messages":{"required":"经营地区行政级别名称不能为空。"}}},{"id": "systemconfigmodel-region_start", "name": "SystemConfigModel[region_start]", "attribute": "region_start", "rules": {"string":true,"messages":{"string":"经营地区最高级别必须是一条字符串。"}}},{"id": "systemconfigmodel-region_start", "name": "SystemConfigModel[region_start]", "attribute": "region_start", "rules": {"required":true,"messages":{"required":"经营地区最高级别不能为空。"}}},{"id": "systemconfigmodel-region_start", "name": "SystemConfigModel[region_start]", "attribute": "region_start", "rules": {"compare":{"operator":"<=","type":"string","compareAttribute":"systemconfigmodel-region_end","skipOnEmpty":1},"messages":{"compare":"地区起始行政级别不能大于结束行政级别"}}},{"id": "systemconfigmodel-region_end", "name": "SystemConfigModel[region_end]", "attribute": "region_end", "rules": {"string":true,"messages":{"string":"经营地区最低级别必须是一条字符串。"}}},{"id": "systemconfigmodel-region_end", "name": "SystemConfigModel[region_end]", "attribute": "region_end", "rules": {"required":true,"messages":{"required":"经营地区最低级别不能为空。"}}},{"id": "systemconfigmodel-region_end", "name": "SystemConfigModel[region_end]", "attribute": "region_end", "rules": {"compare":{"operator":">=","type":"string","compareAttribute":"systemconfigmodel-region_start","skipOnEmpty":1},"messages":{"compare":"地区结束行政级别不能小于起始行政级别"}}},{"id": "systemconfigmodel-level_names", "name": "SystemConfigModel[level_names]", "attribute": "level_names", "rules": {"string":true,"messages":{"string":"行政地区行政级别名称必须是一条字符串。"}}},{"id": "systemconfigmodel-level_names", "name": "SystemConfigModel[level_names]", "attribute": "level_names", "rules": {"required":true,"messages":{"required":"行政地区行政级别名称不能为空。"}}},{"id": "systemconfigmodel-region_min_level", "name": "SystemConfigModel[region_min_level]", "attribute": "region_min_level", "rules": {"string":true,"messages":{"string":"行政地区最低级别必须是一条字符串。"}}},{"id": "systemconfigmodel-region_min_level", "name": "SystemConfigModel[region_min_level]", "attribute": "region_min_level", "rules": {"required":true,"messages":{"required":"行政地区最低级别不能为空。"}}},{"id": "systemconfigmodel-region_min_level", "name": "SystemConfigModel[region_min_level]", "attribute": "region_min_level", "rules": {"compare":{"operator":">=","type":"number","compareAttribute":"systemconfigmodel-user_address_level","skipOnEmpty":1},"messages":{"compare":"“行政地区最低级别”不能高于“会员收货地址地区选择的最低级别”"}}},{"id": "systemconfigmodel-user_address_level", "name": "SystemConfigModel[user_address_level]", "attribute": "user_address_level", "rules": {"string":true,"messages":{"string":"会员收货地址地区选择的最低级别必须是一条字符串。"}}},{"id": "systemconfigmodel-user_address_level", "name": "SystemConfigModel[user_address_level]", "attribute": "user_address_level", "rules": {"required":true,"messages":{"required":"会员收货地址地区选择的最低级别不能为空。"}}},{"id": "systemconfigmodel-user_address_level", "name": "SystemConfigModel[user_address_level]", "attribute": "user_address_level", "rules": {"compare":{"operator":"<=","type":"number","compareAttribute":"systemconfigmodel-region_min_level","skipOnEmpty":1},"messages":{"compare":"“会员收货地址地区选择的最低级别”不能低于“行政地区最低级别”"}}},{"id": "systemconfigmodel-region_short_name", "name": "SystemConfigModel[region_short_name]", "attribute": "region_short_name", "rules": {"string":true,"messages":{"string":"地区名称是否使用简写必须是一条字符串。"}}},]'
            ],
            'default_image' => [
                'code' => 'default_image',
                'title' => '默认图片',
                'explain' => [],
//                'validate_json' => '[{"id": "systemconfigmodel-default_goods_image", "name": "SystemConfigModel[default_goods_image]", "attribute": "default_goods_image", "rules": {"string":true,"messages":{"string":"默认商品图片必须是一条字符串。"}}},{"id": "systemconfigmodel-default_goods_image", "name": "SystemConfigModel[default_goods_image]", "attribute": "default_goods_image", "rules": {"required":true,"messages":{"required":"默认商品图片不能为空。"}}},{"id": "systemconfigmodel-default_shop_logo", "name": "SystemConfigModel[default_shop_logo]", "attribute": "default_shop_logo", "rules": {"string":true,"messages":{"string":"默认店铺Logo必须是一条字符串。"}}},{"id": "systemconfigmodel-default_shop_logo", "name": "SystemConfigModel[default_shop_logo]", "attribute": "default_shop_logo", "rules": {"required":true,"messages":{"required":"默认店铺Logo不能为空。"}}},{"id": "systemconfigmodel-default_shop_image", "name": "SystemConfigModel[default_shop_image]", "attribute": "default_shop_image", "rules": {"string":true,"messages":{"string":"默认店铺头像必须是一条字符串。"}}},{"id": "systemconfigmodel-default_user_portrait", "name": "SystemConfigModel[default_user_portrait]", "attribute": "default_user_portrait", "rules": {"string":true,"messages":{"string":"默认用户头像必须是一条字符串。"}}},{"id": "systemconfigmodel-default_micro_shop_image", "name": "SystemConfigModel[default_micro_shop_image]", "attribute": "default_micro_shop_image", "rules": {"string":true,"messages":{"string":"默认微店头像必须是一条字符串。"}}},{"id": "systemconfigmodel-default_article_cat_image", "name": "SystemConfigModel[default_article_cat_image]", "attribute": "default_article_cat_image", "rules": {"string":true,"messages":{"string":"默认文章分类图片必须是一条字符串。"}}},{"id": "systemconfigmodel-default_lazyload", "name": "SystemConfigModel[default_lazyload]", "attribute": "default_lazyload", "rules": {"string":true,"messages":{"string":"PC端默认缓载图片必须是一条字符串。"}}},{"id": "systemconfigmodel-default_lazyload_mobile", "name": "SystemConfigModel[default_lazyload_mobile]", "attribute": "default_lazyload_mobile", "rules": {"string":true,"messages":{"string":"手机端默认缓载图片必须是一条字符串。"}}},{"id": "systemconfigmodel-default_noresult", "name": "SystemConfigModel[default_noresult]", "attribute": "default_noresult", "rules": {"string":true,"messages":{"string":"无记录默认图片必须是一条字符串。"}}},{"id": "systemconfigmodel-default_video_image", "name": "SystemConfigModel[default_video_image]", "attribute": "default_video_image", "rules": {"string":true,"messages":{"string":"默认视频封面图必须是一条字符串。"}}},{"id": "systemconfigmodel-idcard_demo_image", "name": "SystemConfigModel[idcard_demo_image]", "attribute": "idcard_demo_image", "rules": {"string":true,"messages":{"string":"实名认证示例图片必须是一条字符串。"}}},{"id": "systemconfigmodel-company_demo_image", "name": "SystemConfigModel[company_demo_image]", "attribute": "company_demo_image", "rules": {"string":true,"messages":{"string":"企业认证示例图片必须是一条字符串。"}}},]'
            ],
            'image_upload' => [
                'code' => 'image_upload',
                'title' => '上传参数',
                'explain' => ['依据服务器环境支持最大上传组件大小设置选项，如需要上传超大附件需调整服务器环境配置'],
                'anchor' => [],
//                'validate_json' => '[{"id": "systemconfigmodel-image_dir_type", "name": "SystemConfigModel[image_dir_type]", "attribute": "image_dir_type", "rules": {"string":true,"messages":{"string":"图片存放方式必须是一条字符串。"}}},{"id": "systemconfigmodel-image_max_filesize", "name": "SystemConfigModel[image_max_filesize]", "attribute": "image_max_filesize", "rules": {"string":true,"messages":{"string":"图片/附件大小必须是一条字符串。"}}},{"id": "systemconfigmodel-image_max_filesize", "name": "SystemConfigModel[image_max_filesize]", "attribute": "image_max_filesize", "rules": {"required":true,"messages":{"required":"图片/附件大小不能为空。"}}},{"id": "systemconfigmodel-image_max_filesize", "name": "SystemConfigModel[image_max_filesize]", "attribute": "image_max_filesize", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"图片/附件大小必须是整数。","min":"图片/附件大小必须不小于1。","max":"图片/附件大小必须不大于4194304。"},"min":1,"max":4194304}},{"id": "systemconfigmodel-video_max_filesize", "name": "SystemConfigModel[video_max_filesize]", "attribute": "video_max_filesize", "rules": {"string":true,"messages":{"string":"视频大小必须是一条字符串。"}}},{"id": "systemconfigmodel-video_max_filesize", "name": "SystemConfigModel[video_max_filesize]", "attribute": "video_max_filesize", "rules": {"required":true,"messages":{"required":"视频大小不能为空。"}}},{"id": "systemconfigmodel-video_max_filesize", "name": "SystemConfigModel[video_max_filesize]", "attribute": "video_max_filesize", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"视频大小必须是整数。","min":"视频大小必须不小于1。","max":"视频大小必须不大于4194304。"},"min":1,"max":4194304}},]'
            ],

            /*系统-接口*/
            'smtp' => [
                'code' => 'smtp',
                'title' => '邮件设置',
                'explain' => [
                    '邮件设置用于设置您的邮件服务，不进行邮件设置，您将无法使用系统中的各种服务'
                ],
                'anchor' => [],
            ],
            'sms' => [
                'code' => 'sms',
                'title' => '短信设置 - 短信',
                'explain' => [
                    '短信需平台方自行与短信服务商进行购买，购买并配置完成后，系统将根据短信设置内容为商家、用户等发送短信信息',
                    '根据国家相关政策法规，发送短信必须带有签名，并且签名不应频繁变更，以免被服务商认为是垃圾短信而造成短信发送失败或者延误',
                    '设置短信接口后请到商城 –&gt; 设置 –&gt; <a href="/mall/message-template/list" target="_blank" title="点击去消息模板" style="color:red;margin:0px 3px">"消息模板"</a>中设置短信内容'
                ],
                'anchor' => [],
            ],
            'aliyunsms' => [
                'code' => 'aliyunsms',
                'title' => '短信设置 - 阿里云短信服务',
                'explain' => [
                    '由于阿里大于服务搬迁，短信服务全部在阿里云中进行设置，短信接口发生改变，配置信息也随之进行变更，最新注册阿里大于的用户需在此处进行参数配置',
                    '<span style="color: red;">阿里云短信从2017年11月份开始，在消息模板中变量不再支持下划线，但目前老用户的消息模板里依然可以使用带下划线的变量，为了区分新老版本，增加接口版本类型选项，如果您是在之后注册的请选择新版本选项</span>',
                    '<span style="color: red;">注意：选择接口类型为新版本后，系统内的参数变量在提交给阿里云短信时，会自动去掉“_”，并将单词拼接在一起，从第二个单词开始单词首字母大写，例如：系统消息模板中的变量${user_name}对应阿里云短信模板中的${userName}，系统消息模板中的变量${order_id}对应阿里云短信模板中的${orderId}，以此类推</span>'
                ],
                'anchor' => [],
            ],
            'aliyusms' => [
                'code' => 'aliyusms',
                'title' => '短信设置 - 阿里大于',
                'explain' => [
                    '系统将根据短信设置为商家、用户发送短信信息',
                    '根据国家相关政策法规，发送短信必须带有签名，并且签名不应频繁变更，以免被服务商认为是垃圾短信而造成短信发送失败或者延误',
                    '此配置发送短信所使用的是"阿里大于"提供的发送短信服务，您可以根据帐号密码登录<a href="http://www.alidayu.com/" target="_blank" title="点击去阿里大于官网" style="color:red;margin:0px 3px">"阿里大于官网"</a>查询自己短信的使用情况，请在短信使用完前充值，以免系统发送短信失败为您造成损失'
                ],
                'anchor' => [],
            ],
            'yunsms' => [
                'code' => 'yunsms',
                'title' => '短信设置 - 云短信',
                'explain' => [
                    '系统将根据短信设置为商家、用户发送短信信息',
                    '根据国家相关政策法规，发送短信必须带有签名，并且签名不应频繁变更，以免被服务商认为是垃圾短信而造成短信发送失败或者延误',
                    '此配置用于发送短信所使用的是"云短信"提供的发送短信服务，您可以根据帐号密码登录<a href="http://www.yunsms.cn/" target="_blank" title="点击去云短信官网" style="color:red;margin:0px 3px">"云短信官网"</a>查询自己短信的使用情况，请在短信使用完前充值，以免系统发送短信失败为您造成损失'
                ],
                'anchor' => [],
            ],
            'alioss' => [
                'code' => 'alioss',
                'title' => ' 阿里OSS对象存储',
                'explain' => [
                    '阿里云对象存储（Object Storage Service，简称OSS），是阿里云提供的海量、安全、低成本、高可靠的云存储服务',
                    '系统如需使用此功能，请登录官网“ <a class="c-red" href="https://www.aliyun.com/product/oss/" target="_blank" title="点击进入官网">对象存储OSS</a> ”进行设置',
                    '设置步骤：<br>1、在OSS控制台创建Bucket，并设置读写权限为“ <span>公共读</span> ”；<br>2、在OSS控制台“图片处理”中关闭原图保护（主要用于对商品图片的缩放处理，如果开启则商品图片可能部分无法访问）；<br>3、在OSS控制台创建Access Key；<br>4、在此页面填写相关配置'
                ],
                'anchor' => [],
            ],
            'aliim' => [
                'code' => 'aliim',
                'title' => '阿里云旺 - 设置',
                'explain' => [
                    '开启阿里云旺，前台商城首页展示客服位置将优先展示阿里云旺',
                    '设置阿里云旺，需手动清除网站首页缓存才可生效'
                ],
                'anchor' => [],
            ],
            'amap' => [
                'code' => 'amap',
                'title' => '高德地图',
                'explain' => [],
                'anchor' => [
                    '高德地图',
                    '百度地图'
                ],
            ],
            'website_login' => [
                'code' => 'website_login',
                'title' => '第三方登录 - 设置',
                'explain' => [
                    '开启第三方登录，此登录方式配置成功后即可使用，否则不能使用',
                ],
                'anchor' => [],
            ],
            'qq_login' => [
                'code' => 'qq_login',
                'title' => '第三方登录 - QQ登录',
                'explain' => [
                    '商城通过QQ互联绑定用户QQ帐号与商城帐号，您需要在“<a class="c-red" target="_blank" href="http://connect.qq.com">QQ互联</a>”进行第三方登录授权',
                ],
                'anchor' => [],
            ],
            'weibo_login' => [
                'code' => 'weibo_login',
                'title' => '第三方登录 - 微博登录',
                'explain' => [
                    '商城通过微博开放平台绑定新浪微博与商城账号，您需要在“<a class="c-red" target="_blank" href="http://open.weibo.com">微博开放平台</a>”进行第三方登录授权'
                ],
                'anchor' => [],
            ],
            'mobile_weibo_login' => [
                'code' => 'mobile_weibo_login',
                'title' => '第三方登录 - 微商城微博登录',
                'explain' => [
                    '商城通过微博开放平台绑定新浪微博与商城账号，您需要在“<a class="c-red" target="_blank" href="http://open.weibo.com">微博开放平台</a>”进行第三方登录授权'
                ],
                'anchor' => [],
            ],
            'pc_weixin_login' => [
                'code' => 'pc_weixin_login',
                'title' => '第三方登录 - PC微信登录',
                'explain' => [
                    '商城通过微信开放平台绑定微信与商城帐号，您需要在“<a class="c-red" target="_blank" href="https://open.weixin.qq.com">微信开放平台</a>”进行第三方登录'
                ],
                'anchor' => [],
            ],
            'mobile_weixin_login' => [
                'code' => 'mobile_weixin_login',
                'title' => '第三方登录 - 微商城微信登录',
                'explain' => [
                    '商城通过微信公众平台绑定微信与商城帐号，您需要在“<a class="c-red" target="_blank" href="https://mp.weixin.qq.com">微信公众平台</a>”进行第三方登录'
                ],
                'anchor' => [],
            ],
            'kdniao' => [
                'code' => 'kdniao',
                'title' => '快递鸟设置 - 设置',
                'explain' => [
                    '快递鸟设置，应用于电子面单中使用，未配置，将导致商家无法使用电子面单',
                    '系统在调取物流信息时将调用快递鸟的“即时查询API”接口获取物流数据',
                    '您可以通过&nbsp;<a href="/site/trackquery" target="_blank" style="color: red;"><b>测试物流查询</b></a>&nbsp;链接测试物流信息查询'
                ],
                'anchor' => [],
            ],

            /*系统-SEO*/
            'seo_index' => [
                'code' => 'seo_index',
                'title' => '首页 - 设置',
                'explain' => [
                    '此界面用于商城首页搜索引擎优化设置',
                    '以下是可用SEO变量：商城名称{site_name}'
                ],
                'anchor' => [],
            ],
            'seo_group_buy' => [
                'code' => 'seo_group_buy',
                'title' => '团购 - 设置',
                'explain' => [
                    '此界面用于商城团购页面搜索引擎优化设置',
                    '以下是可用SEO变量：商城名称{site_name}，活动名称{name}，活动描述{description}'
                ],
                'anchor' => [
                    '团购首页',
                    '团购列表',
                    '团购详情'
                ],
            ],
            'seo_groupon' => [
                'code' => 'seo_groupon',
                'title' => '拼团 - 设置',
                'explain' => [
                    '此界面用于商城拼团页面搜索引擎优化设置',
                    '以下是可用SEO变量：商城名称{site_name}，商品名称{name}，商品关键词{keywords}，商品描述{description}，组团剩余人数{groupon_num}'
                ],
                'anchor' => [
                    '拼团列表',
                    '参团详情',
                    '拼团详情'
                ],
            ],
            'seo_bargain' => [
                'code' => 'seo_bargain',
                'title' => '砍价 - 设置',
                'explain' => [
                    '此界面用于商城砍价搜索引擎优化设置',
                    '以下是可用SEO变量：商城名称{site_name}'
                ],
                'anchor' => [
                    '砍价列表',
                    '砍价详情',
                ],
            ],
            'seo_brand' => [
                'code' => 'seo_brand',
                'title' => '品牌 - 设置',
                'explain' => [
                    '此界面用于商城品牌页面搜索引擎优化设置选项',
                    '以下是可用SEO变量：商城名称{site_name}，品牌名称{name}，所有品牌关键字{keywords}，所有品牌描述{description}'
                ],
                'anchor' => [
                    '品牌列表',
                ],
            ],
            'seo_article' => [
                'code' => 'seo_article',
                'title' => '文章 - 设置',
                'explain' => [
                    '此界面用于商城文章页面搜索引擎优化设置选项',
                    '以下是可用SEO变量：商城名称{site_name}，文章名称{name}，文章关键字{keywords}，文章描述{description}'
                ],
                'anchor' => [
                    '文章列表',
                    '文章详情'
                ],
            ],
            'seo_goods' => [
                'code' => 'seo_goods',
                'title' => '商品 - 设置',
                'explain' => [
                    '此界面用于商城商品页面搜索引擎优化设置选项',
                    '以下是可用SEO变量：商城名称{site_name}，商品名称{name}，商品关键词{keywords}，商品描述{description}'
                ],
                'anchor' => [],
            ],
            'seo_shop' => [
                'code' => 'seo_shop',
                'title' => '店铺 - 设置',
                'explain' => [
                    '此界面用于商城店铺页面搜索引擎优化设置选项',
                    '以下是可用SEO变量：商城名称{site_name}，店铺名称{name}，店铺关键字{keywords}，店铺描述{description}'
                ],
                'anchor' => [
                    '店铺',
                    '店铺街'
                ],
            ],
            'seo_news' => [
                'code' => 'seo_news',
                'title' => '资讯频道 - 设置',
                'explain' => [
                    '此界面用于资讯频道页面搜索引擎优化设置选项',
                    '以下是可用SEO变量：商城名称{site_name}'
                ],
                'anchor' => [
                    '资讯频道首页',
                ],
            ],

            /*商城-设置*/
            'mall' => [
                'code' => 'mall',
                'title' => '商城设置',
                'explain' => [],
                'anchor' => [
                    '商城Logo',
                    '商城信息',
                    '商城协议'
                ],
            ],
            'cash' => [
                'code' => 'cash',
                'title' => '收银系统',
                'explain' => [],
                'anchor' => [],
            ],
            'goods' => [
                'code' => 'goods',
                'title' => '商品设置',
                'explain' => [],
                'anchor' => [
                    '商品审核',
                    '商品价格',
                    '商品列表',
                    '商品详情',
                    '商品视频'
                ],
            ],

            /*商城-交易*/
            'trade' => [
                'code' => 'trade',
                'title' => '交易设置 - 购物',
                'explain' => [
                    '卖家发货后，系统会自动“倒计时”确认收货；如买家或卖家手动延长了收货时间，“倒计时”自动延长',
                    '如买家发起了退款申请，“倒计时”自动停止，直至退款申请取消或者完成后，倒计时将继续进行'
                ],
                'anchor' => [],
            ],
            'evaluate' => [
                'code' => 'evaluate',
                'title' => '交易设置 - 评价',
                'explain' => [],
                'anchor' => [],
            ],
            'order' => [
                'code' => 'order',
                'title' => '交易设置 - 订单',
                'explain' => [],
                'anchor' => [],
            ],

            /*商城-店铺*/
            'open_shop' => [
                'code' => 'open_shop',
                'title' => '开店设置-基本设置',
                'explain' => [],
                'anchor' => [],
            ],
            'shop_apply_banner' => [
                'code' => 'shop_apply_banner',
                'title' => '开店设置-入驻轮播图',
                'explain' => [],
                'anchor' => [],
            ],
            'shop_collect' => [
                'code' => 'shop_collect',
                'title' => '采集控制 - 设置',
                'explain' => [
                    '修改设置后，需清理缓存方可起作用'
                ],
                'anchor' => [],
            ],

            /*商城-会员*/
            'user' => [
                'code' => 'user',
                'title' => '会员设置',
                'explain' => [],
                'anchor' => [
                    '用户基本信息',
                    '用户查看、购买商品权限'
                ],
            ],

            /*商城-分销*/
            'distrib' => [
                'code' => 'distrib',
                'title' => '分销返利设置 - 分销设置',
                'explain' => [
                    '开启推荐分销功能，此功能才能正常运行',
                    '分销商发展下线的3种方式：1. 邀请码，用邀请码绑定分销商与下线会员的上下级关系；2. 推广二维码，扫码绑定分销商与下线会员的上下级关系；3. 推广二维码链接，通过分享此链接绑定分销商与下线会员的上下级关系',
                    '会员想成为分销商需要在申请分销商页面进行提交信息进行申请，请把申请分销商页面的链接放在商城的适当位置供会员点击申请'
                ],
                'anchor' => [
                    '基本信息',
                    '自定义文字',
                    '分销比例设置'
                ],
            ],
            'recommend_reg' => [
                'code' => 'recommend_reg',
                'title' => '分销返利设置 - 推荐注册设置',
                'explain' => [
                    '商城会员可推荐新会员注册，推荐成功后，推荐者可得到奖励',
                    '推荐注册送红包：首先需要平台方创建一个“推荐送红包”类型的平台方红包，系统就会自动发放给推荐者了'
                ],
                'anchor' => [],
            ],

            /*商城-营销*/
            'integral_mall_index_set' => [
                'code' => 'integral_mall_index_set',
                'title' => '营销中心 - 积分商城首页设置',
                'explain' => [
                    '该组幻灯片滚动图片应用于积分商城页面',
                    'pc端图片要求使用910*350像素；手机端要求使用1000*400像素jpg、gif、png格式的图片',
                    '上传图片后请添加格式为“http://网址...”链接地址，设定后将在显示页面中点击幻灯片将以另打开窗口的形式跳转到指定网址'
                ],
                'anchor' => [
                    'PC端图片设置',
                    '手机端图片设置',
                ],
            ],
            'integral_mall_set' => [
                'code' => 'integral_mall_set',
                'title' => '营销中心 - 积分商城设置',
                'explain' => [],
                'anchor' => [],
            ],

            /*商城-装修*/
            'nav_category_site' => [
                'code' => 'nav_category_site',
                'title' => '分类导航设置',
                'explain' => [
                    '是否显示分类导航仅对商城首页起作用'
                ],
                'anchor' => [],
            ],
            'nav_banner_site' => [
                'code' => 'nav_banner_site',
                'title' => '首页焦点图',
                'explain' => [],
                'anchor' => [],
            ],
            'login_bg' => [
                'code' => 'login_bg',
                'title' => '登录注册主题',
                'explain' => [],
                'anchor' => [
                    '前台登录、注册页面设置',
                    '后台登录页面设置',
                    '系统加载动画效果设置'
                ],
            ],
            'mall_top_ad' => [
                'code' => 'mall_top_ad',
                'title' => '商城头部广告',
                'explain' => [],
                'anchor' => [],
            ],
            'mall_bottom_ad' => [
                'code' => 'mall_bottom_ad',
                'title' => '商城底部广告',
                'explain' => [],
                'anchor' => [],
            ],
            'register_bg' => [
                'code' => 'register_bg',
                'title' => '入驻提交页广告',
                'explain' => [],
                'anchor' => [],
            ],
            /*APP-设置*/
            'app_setting' => [
                'code' => 'app_setting',
                'title' => '商店设置 - APP设置',
                'explain' => [
                    'APP状态开启后，用户可以使用APP访问商城',
                    '强制更新：当应用市场的版本比用户当前使用版本高的时候，强制用户更新应用'
                ],
                'anchor' => [
                    '应用设置',
                    '下载设置',
                    '强制更新',
                ],
            ],
            'app_guide' => [
                'code' => 'app_guide',
                'title' => '引导图片 - APP引导图设置',
                'explain' => [
                    '引导图作用：初次安装APP时引导用户进入商城APP首页的引导图片，建议设置2张以上',
                    '进入按钮作用：显示在最后一张引导图片上的按钮，点击可进入APP主页'
                ],
                'anchor' => [],
            ],
            'app_setting_basic' => [
                'code' => 'app_setting_basic',
                'title' => '商店设置 - 基本设置',
                'explain' => [],
                'anchor' => [
                    '用户中心设置'
                ],
            ],
            'app_setting_login' => [
                'code' => 'app_setting_login',
                'title' => '商店设置 - 登录设置',
                'explain' => [],
                'anchor' => [
                    '登录设置'
                ],
            ],
            'app_setting_index' => [
                'code' => 'app_setting_index',
                'title' => '商店设置 - 首页设置',
                'explain' => [],
                'anchor' => [
                    '首页模板设置',
                    '首页客服设置'
                ],
            ],
            /*APP-商家*/
            'app_seller_setting' => [
                'code' => 'app_seller_setting',
                'title' => '商家设置 - APP设置',
                'explain' => [
                    'APP状态开启后，商家可以使用商家APP访问商城卖家中心',
                    '强制更新用途：应用正式上线发布市场后，应用在市场更新更高版本时，方便终端用户更新APP使用'
                ],
                'anchor' => [
                    '应用设置',
                    '强制更新',
                    '个性化'
                ],
            ],
            'app_store_setting' => [
                'code' => 'app_store_setting',
                'title' => '网点设置 - APP网点设置',
                'explain' => [
                    'APP状态开启后，网点店主才可以使用网点APP',
                    '强制更新用途：应用正式上线发布市场后，应用在市场更新更高版本时，方便终端用户更新APP使用'
                ],
                'anchor' => [
                    '应用设置',
                    '强制更新',
                    '个性化'
                ],
            ],

            /*微商城-设置*/
            'mobile_setting_basic' => [
                'code' => 'mobile_setting_basic',
                'title' => '微商城 - 基本设置',
                'explain' => [],
                'anchor' => [
                    '微商城状态',
                    '用户中心设置',
                    '店铺设置'
                ],
            ],
            'mobile_setting_login' => [
                'code' => 'mobile_setting_login',
                'title' => '微商城 - 登录设置',
                'explain' => [],
                'anchor' => [
                    '登录设置',
                    '微信登录设置'
                ],
            ],
            'mobile_setting_index' => [
                'code' => 'mobile_setting_index',
                'title' => '微商城 - 首页设置',
                'explain' => [],
                'anchor' => [
                    '首页模板设置',
                    '首页客服设置',
                    '首页APP下载设置',
                    '首页引导关注微信公众号设置',
                    '首页新订单提醒'
                ],
            ],
            'weixin' => [
                'code' => 'weixin',
                'title' => '微商城 - 微信设置',
                'explain' => [],
                'anchor' => [],
            ],
            'weixin_bind' => [
                'code' => 'weixin_bind',
                'title' => '微商城 - 微信绑定',
                'explain' => [],
                'anchor' => [],
            ],
            'weixin_poster' => [
                'code' => 'weixin_poster',
                'title' => '微商城 - 微信海报设置',
                'explain' => [],
                'anchor' => [],
            ],
            'weixin_programs' => [
                'code' => 'weixin_programs',
                'title' => '微商城 - 微信小程序设置',
                'explain' => [],
                'anchor' => [],
            ],

        ];

        if ($group == '') {
            return $data;
        }

        if (!isset($data[$group])) {
            return false;
        }

        return $data[$group];
    }
}

if (! function_exists('admin_log'))
{
    /**
     * 记录平台后台管理日志
     *
     * @param $log_content
     * @return \App\Repositories\User|bool
     */
    function admin_log($log_content)
    {
        // 检查是否登录
        if (! auth('admin')->check()) {
            return false;
        }
        $insert = [
            'content' => $log_content,
            'admin_name' => auth('admin')->user()->user_name,
            'admin_id' => auth('admin')->id(),
            'ip' => request()->ip(),
            'url' => request()->path()
        ];

        $adminLog = new \App\Repositories\AdminLogRepository();
        $ret = $adminLog->store($insert);

        return $ret;
    }
}


if (! function_exists('image_dir_group'))
{
    /**
     * 获取相册分组
     *
     * @param string $group
     * @return array|bool|mixed
     */
    function image_dir_group($group = '')
    {
        $data = [
            'shop' => '店铺',
            'site' => '站点',
            'backend' => '平台方'
        ];
        if ($group != '') {
            return isset($data[$group]) ? $data[$group] : false;
        }
        return $data;
    }
}

function get_video_url($path = '', $type = '', $isOss = true, $isCover = false)
{
    if (empty($path)) {
        return null;
    }
    if ($isOss) {
        // Oss 视频
        $domain = sysconf('oss_domain');
    } else {
        // 本地视频
        $domain = env('BACKEND_DOMAIN');
    }
    $host = request()->getScheme().'://'.$domain.'/'.sysconf('alioss_root_path').'/';

    $url = $host.ltrim($path, '/');
    if ($isCover) {
        $url .= '!poster.png';
    }
//    dd($url);
    return $url;
}

function get_image_url($path = '', $type = '', $isOss = true, $siteId = 0, $shopId = 0)
{
    if (str_contains($path, 'http')) {
        // url已经包含域名 直接返回
        return $path;
    }

    // 默认图片设置
    if ($type == 'shop_logo') { // 默认店铺logo
        $default = get_image_url(sysconf('default_shop_logo'));
    } elseif ($type == 'shop_image') { // 默认店铺头像头像
        $default = get_image_url(sysconf('default_shop_image'));
    } elseif ($type == 'headimg') { // 默认会员头像
        $default = get_image_url(sysconf('default_user_portrait'));
    } elseif ($type == 'credit_img') { // 店铺信誉
        $default = '';
    } elseif ($type == 'mobile_nav') { // 手机端快捷导航默认图标
        $default = '/assets/d2eace91/images/design/mobile/nav.png';
    } elseif ($type == 'no_default') { // 不需要返回默认图片
        $default = '';
    } elseif ($type == 'goods_image') { // 默认商品图片
        $default = get_image_url(sysconf('default_goods_image'));
    } elseif ($type == 'm_login_bgimg') { // 微信端 登录页面背景图
        $default = '/images/login_top_bg.png';
    }
    else {
        $default = '/assets/d2eace91/images/default/album.gif';
    }
    if (empty($path)) {
        // 如果图片路径为空 返回默认图片 todo
        return $default;
    }

    if ($isOss) {
        // Oss图片
        $domain = sysconf('oss_domain');
    } else {
        // 本地图片
        $domain = env('BACKEND_DOMAIN');
    }
//    if ($siteId) {
//        $host = 'http://'.$domain.'/'.sysconf('alioss_root_path')./*'/site/'.$siteId.*/'/';
//    } elseif ($shopId) {
//        $host = 'http://'.$domain.'/'.sysconf('alioss_root_path').'/shop/'.$shopId.'/';
//    } else {
//        $host = 'http://'.$domain.'/'.sysconf('alioss_root_path').'/';
//    }
    $host = 'http://'.$domain.'/'.sysconf('alioss_root_path').'/';

    $url = $host.ltrim($path, '/');
    return $url;
}


if (!function_exists('array_group_combine'))
{
    /**
     * 二维数组的排列组合
     * 该函数只支持按数组下标排列组合 如按照规格ID对规格的可选值进行排列组合
     * 例如：---------
     * $arr['11'] = ['32GB', '64GB', '128GB'];
     * $arr['12'] = ['白色', '蓝色', '粉红色'];
     * $arr['13'] = ['大号', '中号'];
     * ---------------
     * @param array $array 需要进行排列组合的二维数组
     * @return array|bool
     */
    function array_group_combine($array = [])
    {
        if (empty($array)) {
            return false;
        }
        /*$array['11'] = ['32GB', '64GB', '128GB'];
        $array['12'] = ['白色', '蓝色', '粉红色'];*/
        $combineResult = []; // 排列组合结果
        $combineCount = 1; // 初始化排列组合的数量
        foreach ($array as $key=>$value) {
            $combineCount *= count($value); // 计算排列总的可能性数量
        }
        $repeatTime = $combineCount; // 重循环复次数
        foreach ($array as $combineKey=>$valueList) {
            // $valueList 中的元素在拆分成组合后纵向出现的最大重复次数
            $repeatTime = $repeatTime / count($valueList);
            $startPosition = 1;
            // 开始对每个规格的可选值进行循环
            foreach ($valueList as $attrValue) {
                $tempStartPosition = $startPosition;
                $spaceCount = $combineCount / count($valueList) / $repeatTime;
                for ($j = 1; $j <= $spaceCount; $j++) {
                    for ($i = 0; $i < $repeatTime; $i++) {
                        $combineResult[$tempStartPosition + $i][$combineKey] = $attrValue;
                    }
                    $tempStartPosition += $repeatTime * count($valueList);
                }
                $startPosition += $repeatTime;
            }
        }
        return $combineResult;
    }
}

if (!function_exists('format_bytes')) {
    /**
     * 格式化字节大小
     * @param  number $size      字节数
     * @param  string $delimiter 数字和单位分隔符
     * @return string            格式化后的带单位的大小
     * @author 雲溪荏苒 <290648237@qq.com>
     */
    function format_bytes($size, $delimiter = '') {
        $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
        for ($i = 0; $size >= 1024 && $i < 5; $i++) $size /= 1024;
        return round($size, 2) . $delimiter . $units[$i];
    }
}

if (!function_exists('msubstr')) {
    /**
     * 截取中文字符串
     * 模板调用 {{ msubstr($str,0,20) }}
     * @param $str
     * @param int $start
     * @param int $length
     * @param bool $suffix
     * @param string $charset
     * @return string
     * @author 雲溪荏苒 <290648237@qq.com>
     */
    function msubstr($str, $start, $length, $suffix=true, $charset="utf-8"){
        if(mb_strlen($str,$charset)>$length)
        {
            if(function_exists("mb_substr")){
                if($suffix)
                    return mb_substr($str, $start, $length, $charset)."...";
                else
                    return mb_substr($str, $start, $length, $charset);
            }elseif(function_exists('iconv_substr')) {
                if($suffix)
                    return iconv_substr($str,$start,$length,$charset)."...";
                else
                    return iconv_substr($str,$start,$length,$charset);
            }
            $re['utf-8'] = "/[x01-x7f]|[xc2-xdf][x80-xbf]|[xe0-xef][x80-xbf]{2}|[xf0-xff][x80-xbf]{3}/";
            $re['gb2312'] = "/[x01-x7f]|[xb0-xf7][xa0-xfe]/";
            $re['gbk'] = "/[x01-x7f]|[x81-xfe][x40-xfe]/";
            $re['big5'] = "/[x01-x7f]|[x81-xfe]([x40-x7e]|xa1-xfe])/";
            preg_match_all($re[$charset], $str, $match);
            $slice = join("",array_slice($match[0], $start, $length));
            if($suffix) return $slice."…";
            return $slice;
        }
        else
        {
            return $str;
        }
    }
}

/**
 * 获取阿里云OSS host
 * @return string
 */
function get_oss_host()
{
    $host = 'http://'.sysconf('oss_domain').'/'.sysconf('alioss_root_path').'/';
    return $host;
}

/**
 * 生成32位唯一标识字符串
 *
 * 带分隔符：9689015e-b41b-3b21-9364-fcc3613123b4
 * 无分隔符：be0e4cf2a42f35b38322b09fae17a0dc
 *
 * @param string $separate 分隔符 默认为空
 * @return string
 */
function uuid($separate = '')
{
    $uuid = str_replace('-', $separate, \Faker\Provider\Uuid::uuid());
    return $uuid;
}

/**
 * 生成唯一的随机字符串
 *
 * @return string
 */
function make_uuid()
{
//    1518931658BPLWJE
    // 十位数字（当前时间戳） + 六位字母（A-Z）
    $uuid = time().create_random_str(6);

    return $uuid;
}

/**
 * 生成A-Z之间的随机字符串
 *
 * @param $length
 * @return array|string
 */
function create_random_str($length){
    $str = range('A','Z');
    shuffle($str);
    $str = implode('',array_slice($str,0,$length));
    return $str;
}

/**
 * 分类推荐词类型
 *
 * @param $key
 * @return array|bool|mixed
 */
function nav_words_type($key = '')
{
    $data = [
        0 => '自定义链接',
        1 => '关联商品分类',
        2 => '搜索推荐词',
    ];

    if (isset($data[$key])) {
        return $data[$key];
    }

    if (!empty($key)) {
        return isset($data[$key]) ? $data[$key] : false;
    }
    return $data;
}

/**
 * 链接类型
 *
 * @param string $key
 * @return array|bool|mixed
 */
function link_type($key = '')
{
    $data = [
        0 => '自定义链接',
        1 => '常用链接',
//        2 => '选择商品',
        3 => '店铺主页',
        8 => '文章分类',
        4 => '文章详情',
        5 => '分类商品',
        6 => '团购活动',
        7 => '品牌专题',
        9 => '专题活动',
    ];

    if (isset($data[$key])) {
        return $data[$key];
    }

    if (!empty($key)) {
        return isset($data[$key]) ? $data[$key] : false;
    }
    return $data;
}



/**
 * 导航显示位置
 *
 * @param $key
 * @return array|bool|mixed
 */
function nav_position($key = '')
{
//    if ($key == 0) {
//        return '';
//    }
    $data = [
        1 => '头部',
        2 => '中间',
        3 => '底部',
    ];

    if (isset($data[$key])) {
        return $data[$key];
    }


    if (!empty($key)) {
        return isset($data[$key]) ? $data[$key] : false;
    }
    return $data;
}

/**
 * 导航布局
 *
 * @param $key
 * @return array|bool|mixed
 */
function nav_layout($key = '')
{
    $data = [
        1 => '左侧',
        2 => '右侧',
    ];

    if (isset($data[$key])) {
        return $data[$key];
    }

    if (!empty($key)) {
        return isset($data[$key]) ? $data[$key] : false;
    }
    return $data;
}

/**
 * 获取websocket host
 *
 * @param string $port
 * @return string
 */
function get_ws_url($port = '8181')
{
    $host = env('PUSH_DOMAIN');

    return 'ws://'.$host.':'.$port;
}

function attr_style($key = '')
{
    $data = [
        0 => '多选',
        1 => '单选',
        2 => '文本',
    ];

    if (isset($data[$key])) {
        return $data[$key];
    }

    if (!empty($key)) {
        return isset($data[$key]) ? $data[$key] : false;
    }
    return $data;
}

/**
 * 特殊时间格式化
 *
 * @param $key
 * @return array|bool|mixed
 */
function format_unit($key)
{
    $data = [
        'year' => '年',
        'month' => '个月',
        'day' => '天',
    ];

    if (isset($data[$key])) {
        return $data[$key];
    }

    if (!empty($key)) {
        return isset($data[$key]) ? $data[$key] : false;
    }
    return $data;
}




























if (! function_exists('calc_padding_top'))
{
    /**
     * 微信端 装修页面
     * 计算广告图片的 padding-top 样式属性百分比值
     *
     * @param int $height 图片高度
     * @param int $width 图片宽度
     * @return bool|float|int
     */
    function calc_padding_top($height, $width)
    {
        if (!$width || !$height) {
            return false;
        }
        $padding_top = round(($height/$width), 4)*100;
        return $padding_top;
    }
}

if (! function_exists('calc_width'))
{
    /**
     * 微信端 装修页面
     * 计算广告图片的 width 样式属性百分比值
     *
     * @param int $width 某张图片的宽度
     * @param int $total_width 整个宽度的图片宽度
     * @return bool|float|int
     */
    function calc_width($width, $total_width)
    {
        if (!$width || !$total_width) {
            return false;
        }
        $width_percent = round(($width/$total_width), 4)*100;
        return $width_percent;
    }
}

/**
 * 获得指定分类下的子分类的数组
 *
 * @access  public
 * @param   int     $cat_id     分类的ID
 * @param   int     $selected   当前选中分类的ID
 * @param   boolean $re_type    返回的类型: 值为真时返回下拉列表,否则返回数组
 * @param   int     $level      限定返回的级数。为0时返回所有级数
 * @param   int     $is_show_all 如果为true显示所有分类，如果为false隐藏不可见分类。
 * @return  mixed
 */
function cat_list($cat_id = 0, $selected = 0, $re_type = true, $level = 0, $is_show_all = true)
{
    static $res = NULL;

    if ($res === NULL)
    {
        $data = false; //read_static_cache('cat_pid_releate');
        if ($data === false)
        {
            $categoryTable = 'category';
            $goodsTable = 'goods';
            $goodsCatTable = 'goods_cat';
            $sql = "SELECT c.cat_id, c.cat_name, c.parent_id, c.cat_sort, COUNT(s.cat_id) AS has_children ".
                'FROM ' . $categoryTable . " AS c ".
                "LEFT JOIN " . $categoryTable . " AS s ON s.parent_id=c.cat_id ".
//                "where c.is_virtual= '0' ".
                "GROUP BY c.cat_id ".
                'ORDER BY c.parent_id, c.cat_sort ASC';
            $res = \Illuminate\Support\Facades\DB::select($sql);
//            dd($res);
            $sql = "SELECT cat_id, COUNT(*) AS goods_num " .
                " FROM " . $goodsTable .
                " WHERE is_delete = 0 AND goods_status = 1 " .
                " GROUP BY cat_id";
            $res2 = \Illuminate\Support\Facades\DB::select($sql);


            $sql = "SELECT gc.cat_id, COUNT(*) AS goods_num " .
                " FROM " . $goodsCatTable . " AS gc , " . $goodsTable . " AS g " .
                " WHERE g.goods_id = gc.goods_id AND g.is_delete = 0 AND g.goods_status = 1 " .
                " GROUP BY gc.cat_id";
            $res3 = \Illuminate\Support\Facades\DB::select($sql);

            $newres = array();
            foreach($res2 as $k=>$v)
            {
                $v = (array)$v;
                $newres[$v['cat_id']] = $v['goods_num'];
                foreach($res3 as $ks=>$vs)
                {
                    $vs = (array)$vs;
                    if($v['cat_id'] == $vs['cat_id'])
                    {
                        $newres[$v['cat_id']] = $v['goods_num'] + $vs['goods_num'];
                    }
                }
            }

            foreach($res as $k=>$v)
            {
                $v = (array)$v;
//                $res[$k]['goods_num'] = !empty($newres[$v['cat_id']]) ? $newres[$v['cat_id']] : 0;
                $v['goods_num'] = !empty($newres[$v['cat_id']]) ? $newres[$v['cat_id']] : 0;
            }
            //如果数组过大，不采用静态缓存方式
            if (count($res) <= 1000)
            {
                //write_static_cache('cat_pid_releate', $res);
            }
        }
        else
        {
            $res = $data;
        }
    }

    if (empty($res) == true)
    {
        return $re_type ? '' : array();
    }

    $options = cat_options($cat_id, $res); // 获得指定分类下的子分类的数组

    $children_level = 99999; //大于这个分类的将被删除
    if ($is_show_all == false)
    {
        foreach ($options as $key => $val)
        {
            if ($val['level'] > $children_level)
            {
                unset($options[$key]);
            }
            else
            {
                if ($val['is_show'] == 0)
                {
                    unset($options[$key]);
                    if ($children_level > $val['level'])
                    {
                        $children_level = $val['level']; //标记一下，这样子分类也能删除
                    }
                }
                else
                {
                    $children_level = 99999; //恢复初始值
                }
            }
        }
    }

    /* 截取到指定的缩减级别 */
    if ($level > 0)
    {
        if ($cat_id == 0)
        {
            $end_level = $level;
        }
        else
        {
            $first_item = reset($options); // 获取第一个元素
            $end_level  = $first_item['level'] + $level;
        }

        /* 保留level小于end_level的部分 */
        foreach ($options AS $key => $val)
        {
            if ($val['level'] >= $end_level)
            {
                unset($options[$key]);
            }
        }
    }

    if ($re_type == true)
    {
        $select = '';
        foreach ($options AS $var)
        {
            $select .= '<option value="' . $var['cat_id'] . '" ';
            $select .= ($selected == $var['cat_id']) ? "selected='ture'" : '';
            $select .= '>';
            if ($var['level'] > 0)
            {
                $select .= str_repeat('&nbsp;', $var['level'] * 4);
            }
            $select .= htmlspecialchars(addslashes($var['cat_name']), ENT_QUOTES) . '</option>';
        }

        return $select;
    }
    else
    {
        foreach ($options AS $key => $value)
        {
//            $options[$key]['url'] = build_uri('category', array('cid' => $value['cat_id']), $value['cat_name']);
        }

        return $options;
    }
}

/**
 * 过滤和排序所有分类，返回一个带有缩进级别的数组
 *
 * @access  private
 * @param   int     $cat_id     上级分类ID
 * @param   array   $arr        含有所有分类的数组
 * @param   int     $level      级别
 * @return  mixed
 */
function cat_options($spec_cat_id, $arr)
{
    static $cat_options = array();

    if (isset($cat_options[$spec_cat_id]))
    {
        return $cat_options[$spec_cat_id];
    }

    if (!isset($cat_options[0]))
    {
        $level = $last_cat_id = 0;
        $options = $cat_id_array = $level_array = array();
        $data = false; //read_static_cache('cat_option_static');
        if ($data === false)
        {
            while (!empty($arr))
            {
                foreach ($arr AS $key => $value)
                {
                    $value = (array)$value;
                    $cat_id = $value['cat_id'];
                    if ($level == 0 && $last_cat_id == 0)
                    {
                        if ($value['parent_id'] > 0)
                        {
                            break;
                        }

                        $options[$cat_id]          = $value;
                        $options[$cat_id]['level'] = $level;
                        $options[$cat_id]['id']    = $cat_id;
                        $options[$cat_id]['name']  = $value['cat_name'];
                        unset($arr[$key]);

                        if ($value['has_children'] == 0)
                        {
                            continue;
                        }
                        $last_cat_id  = $cat_id;
                        $cat_id_array = array($cat_id);
                        $level_array[$last_cat_id] = ++$level;
                        continue;
                    }

                    if ($value['parent_id'] == $last_cat_id)
                    {
                        $options[$cat_id]          = $value;
                        $options[$cat_id]['level'] = $level;
                        $options[$cat_id]['id']    = $cat_id;
                        $options[$cat_id]['name']  = $value['cat_name'];
                        unset($arr[$key]);

                        if ($value['has_children'] > 0)
                        {
                            if (end($cat_id_array) != $last_cat_id)
                            {
                                $cat_id_array[] = $last_cat_id;
                            }
                            $last_cat_id    = $cat_id;
                            $cat_id_array[] = $cat_id;
                            $level_array[$last_cat_id] = ++$level;
                        }
                    }
                    elseif ($value['parent_id'] > $last_cat_id)
                    {
                        break;
                    }
                }

                $count = count($cat_id_array);
                if ($count > 1)
                {
                    $last_cat_id = array_pop($cat_id_array);
                }
                elseif ($count == 1)
                {
                    if ($last_cat_id != end($cat_id_array))
                    {
                        $last_cat_id = end($cat_id_array);
                    }
                    else
                    {
                        $level = 0;
                        $last_cat_id = 0;
                        $cat_id_array = array();
                        continue;
                    }
                }

                if ($last_cat_id && isset($level_array[$last_cat_id]))
                {
                    $level = $level_array[$last_cat_id];
                }
                else
                {
                    $level = 0;
                }
            }
            //如果数组过大，不采用静态缓存方式
            if (count($options) <= 2000)
            {
                //write_static_cache('cat_option_static', $options);
            }
        }
        else
        {
            $options = $data;
        }
        $cat_options[0] = $options;
    }
    else
    {
        $options = $cat_options[0];
    }

    if (!$spec_cat_id)
    {
        return $options;
    }
    else
    {
        if (empty($options[$spec_cat_id]))
        {
            return array();
        }

        $spec_cat_id_level = $options[$spec_cat_id]['level'];

        foreach ($options AS $key => $value)
        {
            if ($key != $spec_cat_id)
            {
                unset($options[$key]);
            }
            else
            {
                break;
            }
        }

        $spec_cat_id_array = array();
        foreach ($options AS $key => $value)
        {
            if (($spec_cat_id_level == $value['level'] && $value['cat_id'] != $spec_cat_id) ||
                ($spec_cat_id_level > $value['level']))
            {
                break;
            }
            else
            {
                $spec_cat_id_array[$key] = $value;
            }
        }
        $cat_options[$spec_cat_id] = $spec_cat_id_array;

        return $spec_cat_id_array;
    }
}

///**
// * 根据详情版式位置id获取版式列表
// *
// * @param int $position
// * @return array
// */
//function goods_layout_by_position($position = 0)
//{
//    $condition = [
//        ['shop_id',seller_shop_info()->shop_id],
//        ['position',$position]
//    ];
//    $layout_list = \App\Models\GoodsLayout::where($condition)->select(['layout_id','layout_name', 'position'])->get()->toArray();
//    $layout = [[
//        'layout_id' => "0",
//        'layout_name' => "--不使用--"
//    ]];
//    $data = array_merge($layout, $layout_list);
//    return $data;
//}

///**
// * 获取某个地区的 儿子 孙子  重子重孙 的 id
// *
// * @param string $parent_code
// * @return array|mixed
// */
//function get_region_grandson($parent_code)
//{
//    $GLOBALS['region_grandson'] = [];
//    $GLOBALS['region_id_arr'] = [];
//    // 先把自己的id保存起来
//    $GLOBALS['region_grandson'][] = $parent_code;
//    // 查询所有地区
//    $GLOBALS['region_id_arr'] = \App\Models\Region::where('is_enable',1)->select(['region_id','parent_code'])->pluck('parent_code', 'region_id');
//    // 查询所有儿子
//    $son_id_arr = \App\Models\Region::where('parent_code', $parent_code)->select(['region_id','parent_code'])->pluck('region_id');
//    foreach ($son_id_arr as $k=>$v) {
//        get_region_grandson2($v);
//    }
//    return $GLOBALS['region_grandson'];
//}
//
///**
// * 递归调用找到 重子重孙
// * @param string $parent_code
// */
//function get_region_grandson2($parent_code)
//{
//    $GLOBALS['region_grandson'][] = $parent_code;
//    foreach ($GLOBALS['region_id_arr'] as $k=>$v) {
//        // 找到孙子
//        if ($v == $parent_code) {
//            get_region_grandson2($k); // 继续找孙子
//        }
//    }
//}

/**
 * 获取某个商品分类的 儿子 孙子  重子重孙 的 id
 *
 * @param int $cat_id
 * @return array|mixed
 */
function get_cat_grandson($cat_id)
{
    $GLOBALS['cat_grandson'] = [];
    $GLOBALS['cat_id_arr'] = [];
    // 先把自己的id保存起来
    $GLOBALS['cat_grandson'][] = $cat_id;
    // 查询所有分类
    $GLOBALS['cat_id_arr'] = \App\Models\Category::where('is_show',1)->select(['cat_id','parent_id'])->pluck('parent_id', 'cat_id');
    // 查询所有儿子
    $son_id_arr = \App\Models\Category::where('parent_id', $cat_id)->select(['cat_id','parent_id'])->pluck('cat_id');
    foreach ($son_id_arr as $k=>$v) {
        get_cat_grandson2($v);
    }
    return $GLOBALS['cat_grandson'];
}

/**
 * 递归调用找到 重子重孙
 * @param int $cat_id
 */
function get_cat_grandson2($cat_id)
{
    $GLOBALS['cat_grandson'][] = $cat_id;
    foreach ($GLOBALS['cat_id_arr'] as $k=>$v) {
        // 找到孙子
        if ($v == $cat_id) {
            get_cat_grandson2($k); // 继续找孙子
        }
    }
}

/**
 * 获取某个文章分类的 儿子 孙子  重子重孙 的 id
 *
 * @param int $cat_id
 * @return array|mixed
 */
function get_article_cat_grandson($cat_id)
{
    $GLOBALS['cat_grandson'] = [];
    $GLOBALS['cat_id_arr'] = [];
    // 先把自己的id保存起来
    $GLOBALS['cat_grandson'][] = $cat_id;
    // 查询所有分类
    $GLOBALS['cat_id_arr'] = \App\Models\ArticleCat::where('is_show',1)->select(['cat_id','parent_id'])->pluck('parent_id', 'cat_id');
    // 查询所有儿子
    $son_id_arr = \App\Models\ArticleCat::where('parent_id', $cat_id)->select(['cat_id','parent_id'])->pluck('cat_id');
    foreach ($son_id_arr as $k=>$v) {
        get_article_cat_grandson2($v);
    }
    return $GLOBALS['cat_grandson'];
}

/**
 * 递归调用找到 重子重孙
 * @param int $cat_id
 */
function get_article_cat_grandson2($cat_id)
{
    $GLOBALS['cat_grandson'][] = $cat_id;
    foreach ($GLOBALS['cat_id_arr'] as $k=>$v) {
        // 找到孙子
        if ($v == $cat_id) {
            get_article_cat_grandson2($k); // 继续找孙子
        }
    }
}

/**
 * 将电话号码中间4位用指定字符串替换
 *
 * @param $phone
 * @param string $replace 默认为"****" 可以设置为随机4位大写字母
 * @return null|string|string[]
 */
function hide_tel($phone, $replace = '****')
{
    $IsWhat = preg_match('/(0[0-9]{2,3}[\-]?[2-9][0-9]{6,7}[\-]?[0-9]?)/i',$phone); //固定电话
    if($IsWhat == 1){
        return preg_replace('/(0[0-9]{2,3}[\-]?[2-9])[0-9]{3,4}([0-9]{3}[\-]?[0-9]?)/i','$1'.$replace.'$2',$phone);
    }else{
        return  preg_replace('/(1[358]{1}[0-9])[0-9]{4}([0-9]{4})/i','$1'.$replace.'$2',$phone);
    }
}

/**
 * 将身份证号码中间10位用指定字符串替换
 *
 * @param $id_card
 * @param string $replace
 * @return mixed|string
 */
function hide_id_card($id_card, $replace = '**********')
{
    return strlen($id_card)==15?substr_replace($id_card,"****",4,7):(strlen($id_card)==18?substr_replace($id_card,$replace,4,10):"身份证位数不正常！");
}

/**
 * 隐藏字符串
 *
 * @param $str
 * @param string $replace
 * @param int $start
 * @param int $end
 * @return mixed|string
 */
//function hide_str($str, $replace = '**', $start = 1, $end = -1)
//{
//    $isChinese = preg_match('/^[\x{4e00}-\x{9fa5}]+$/u',$str);
//    if ($isChinese) {
//        $start = $start*2;
//        $end = $end*2;
//    }
//    return empty($str) ? $replace : substr_replace($str, $replace, $start, $end);
//}

/**
 * 只保留字符串首尾字符，隐藏中间用*代替（两个字符时只显示第一个）
 * @param string $user_name 姓名
 * @return string 格式化后的姓名
 */
function substr_cut($user_name){
    if ($user_name == '') {
        return '**';
    }

    $strlen     = mb_strlen($user_name, 'utf-8');
    $firstStr     = mb_substr($user_name, 0, 1, 'utf-8');
    $lastStr     = mb_substr($user_name, -1, 1, 'utf-8');
    return $strlen == 2 ? $firstStr . str_repeat('*', mb_strlen($user_name, 'utf-8') - 1) : $firstStr . str_repeat("*", $strlen - 2) . $lastStr;
}

/**
 * 获取随机字母
 *
 * @param int $length
 * @param bool $isUpper
 * @return string
 */
function get_random_words($length = 4, $isUpper = true)
{
    // 97~122是小写的英文字母65~90是大写的

    $str = '';
    for ($i = 1; $i <= 4; $i++) {
        if ($isUpper) {
            $randWords = rand(68, 90);
        } else {
            $randWords = rand(97, 122);
        }
        $str .=  chr($randWords);
    }
    return $str;
}

/*时间函数*/
if (!function_exists('format_time')) {
    /**
     * 时间戳格式化
     * @param string $time 时间戳
     * @param string $format 输出格式
     * @return false|string
     */
    function format_time($time = '', $format='Y-m-d H:i') {
        return !$time ? '' : date($format, intval($time));
    }
}

if (!function_exists('format_moment')) {
    /**
     * 使用momentjs的时间格式来格式化时间戳
     * @param null $time 时间戳
     * @param string $format momentjs的时间格式
     * @return false|string
     */
    function format_moment($time = null, $format='YYYY-MM-DD HH:mm') {
        $format_map = [
            // 年、月、日
            'YYYY' => 'Y',
            'YY'   => 'y',
//            'Y'    => '',
            'Q'    => 'I',
            'MMMM' => 'F',
            'MMM'  => 'M',
            'MM'   => 'm',
            'M'    => 'n',
            'DDDD' => '',
            'DDD'  => '',
            'DD'   => 'd',
            'D'    => 'j',
            'Do'   => 'jS',
            'X'    => 'U',
            'x'    => 'u',

            // 星期
//            'gggg' => '',
//            'gg' => '',
//            'ww' => '',
//            'w' => '',
            'e'    => 'w',
            'dddd' => 'l',
            'ddd'  => 'D',
            'GGGG' => 'o',
//            'GG' => '',
            'WW' => 'W',
            'W'  => 'W',
            'E'  => 'N',

            // 时、分、秒
            'HH'  => 'H',
            'H'   => 'G',
            'hh'  => 'h',
            'h'   => 'g',
            'A'   => 'A',
            'a'   => 'a',
            'mm'  => 'i',
            'm'   => 'i',
            'ss'  => 's',
            's'   => 's',
//            'SSS' => '[B]',
//            'SS'  => '[B]',
//            'S'   => '[B]',
            'ZZ'  => 'O',
            'Z'   => 'P',
        ];

        // 提取格式
        preg_match_all('/([a-zA-Z]+)/', $format, $matches);
        $replace = [];
        foreach ($matches[1] as $match) {
            $replace[] = isset($format_map[$match]) ? $format_map[$match] : '';
        }

        // 替换成date函数支持的格式
        $format = str_replace($matches[1], $replace, $format);
        $time = $time === null ? time() : intval($time);
        return date($format, $time);
    }
}

/**
 * 时间戳格式化
 * 判断时间间隔，1天内显示多少时间前，1天后天是具体时间
 * @param int $time 格式化时间戳
 * @return string 完整的时间显示
 */
function out_put_time($time){
    $now=time();
    $data=$now-$time;
    if($data < 86400){
        $res_time = time_stamp($time);
    }else{
        $res_time = format_time($time);
    }
    return $res_time;
}


/*计算当前时间与@param的距离 返回 秒 分 时 天 (前)
* @param Time stamp
* @return string
*/
function time_stamp($firstTime){
    $now=time();
    $data=$now-$firstTime;
    if($data < 60){
        $res=$data."秒前";
    }elseif($data > 60 && $data < 3600){
        $res=floor($data/60)."分前";
    }elseif ($data > 3600 && $data < 86400) {
        $res=floor($data/3600)."小时前";
    }elseif ($data > 86400 && $data < 2592000){
        $res=floor($data/86400)."天前";
    }elseif($data > 2592000 && $data < 31536000){
        $res=floor($data/2592000)."个月前";
    }else{
        $res=floor($data/31536000)."年前";
    }
    return $res;
}

/**
 * 正则表达式验证email格式
 *
 * @param string $str 所要验证的邮箱地址
 * @return boolean
 */
function check_is_email($str)
{
    if (!$str) {
        return false;
    }
    return preg_match('#[a-z0-9&\-_.]+@[\w\-_]+([\w\-.]+)?\.[\w\-]+#is', $str) ? true : false;
}

/**
 * 用正则表达式验证手机号码(中国大陆区)
 * @param integer $num 所要验证的手机号
 * @return boolean
 */
function check_is_mobile($num)
{
    if (!$num) {
        return false;
    }
    return preg_match('/^((13|15|18|17|14)\d{9}|(199|198|166)\d{8})$/', $num) ? true : false;
//    return preg_match('#^13[\d]{9}$|14^[0-9]\d{8}|^15[0-9]\d{8}$|^18[0-9]\d{8}$#', $num) ? true : false;
}

/**
 * 获取身份证示例图片
 *
 * @param int $type 0正面图 1背面图 2本人手持身份证正面照
 * @return null
 */
function idcard_demo_image($type = 0)
{
    $images = explode('|', sysconf('idcard_demo_image'));
    if(!isset($images[$type])) {
        return null;
    }
    return get_image_url($images[$type]);
}

/**
 * 根据parent_code 获取上一二级地区名称数组
 *
 * @param $parent_code
 * @return array
 */
function get_parent_region_names($parent_code)
{
    $parent_region_names = [];
    $r1 = \App\Models\Region::where('region_code', $parent_code)->first();
    if (!empty($r1)) {
        $parent_region_names["{$r1->region_code}"] = $r1->region_name;
        $r2 = \App\Models\Region::where('region_code', $r1->parent_code)->first();
        if (!empty($r2)) {
            $parent_region_names["{$r2->region_code}"] = $r2->region_name;
        }
    }
    $rCode = array_reverse(array_keys($parent_region_names));
    $rName = array_reverse(array_values($parent_region_names));
    $rsData = [];
    foreach ($rCode as $key=>$value) {
        $rsData[$rCode[$key]] = $rName[$key];
    }
    return $rsData;
}

/**
 * 根据地区代码字符串获取地区中文字符串
 *
 * @param string $region_code 如：11,01,01
 * @param string $separate 返回地区中文字符串分隔符
 * @return bool
 */
function get_region_names_by_region_code($region_code = '', $separate = '-')
{
    if (empty($region_code)) {
        return '';
    }
//    $region_ids = !empty(explode(',', $region_code)) ? explode(',', $region_code) : [];
//    $region_names = \App\Models\Region::whereIn('region_id', $region_ids)->pluck('region_name')->toArray();
//    $region_names = !empty($region_names) ? implode($separate, $region_names) : '';
//    return $region_names;
    $region_name = array_reverse(get_parent_region_list($region_code));
    $region_name = array_column($region_name, 'region_name');
    $region_names = implode($separate, $region_name);

    return $region_names;
}

/**
 * 获取地区的父地区名称和地区编号
 *
 * @param $parent_code
 * @param bool $isReturnNames
 * @return array
 */
function get_parent_region_list($parent_code, $isReturnNames = false){
    $names = [];
    $list = [];
    if ($parent_code == 0) {
        $where[] = ['parent_code', $parent_code];
    } else {
        if (count(explode('_', $parent_code)) > 0) {
            $parent_code = implode(',', explode('_', $parent_code));
        }
        $where[] = ['region_code', $parent_code];
    }
    $region = \Illuminate\Support\Facades\DB::table('region')->where($where)->first();

    $region_list = [
        'region_code' => $region->region_code,
        'region_name' => $region->region_name
    ];

    array_push($list, $region_list);
    if($region->parent_code != 0){
        $nregion = get_parent_region_list($region->parent_code);
        if(!empty($nregion)){
            $names = array_merge($names, $nregion);
            $list = array_merge($list, $nregion);
        }
    }

    if ($isReturnNames) {
        return $names;
    }
    return $list;
}

/**
 * 判断是否微信浏览器访问
 * @return bool
 */
function is_weixin(){
    if ( strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {
        return true;
    }
    return false;
}

/**
 * 格式化数据运费模板计价方式
 *
 * @param int $valuation
 * @return mixed|string
 */
function format_freight_valuation($valuation = 0)
{
    $data = [
        0 => '件数',
        1 => '重量',
        2 => '体积'
    ];
    if (!isset($data[$valuation])) {
        return '';
    }
    return $data[$valuation];
}

/**
 * 格式化数据订单来源
 *
 * @param int $order_from
 * @return mixed|string
 */
function format_order_from($order_from = 1)
{
    $data = [
        1 => 'PC端',
        2 => 'WAP端',
        3 => 'Android客户端',
        4 => 'iOS客户端',
        5 => '小程序端'
    ];
    if (!isset($data[$order_from])) {
        return '';
    }
    return $data[$order_from];
}

/**
 * 格式化订单状态
 *
 * @param $k
 * @return mixed|string
 */
function format_order_status($k)
{
//    订单状态 0-订单已确认 1-交易成功 2-卖家取消 3-买家取消 4-系统自动取消 10-抢单中
    $data = [
        0 => '订单已确认',
        1 => '交易成功',
        2 => '卖家取消',
        3 => '买家取消',
        4 => '系统自动取消', // 交易关闭
        /*todo 中间有可能还有其他状态*/
        10 => '抢单中'
    ];
    if (!isset($data[$k])) {
        return '';
    }
    return $data[$k];
}

/**
 * 格式化配送状态
 *
 * @param $k
 * @return mixed|string
 */
function format_shipping_status($k)
{
//    配送状态 0-待发货 1-已发货 2-发货中 3-已提交物流系统
    $data = [
        0 => '待发货',
        1 => '已发货',
        2 => '发货中',
        3 => '已提交物流系统',
    ];
    if (!isset($data[$k])) {
        return '';
    }
    return $data[$k];
}

/**
 * 格式化红包类型
 *
 * 红包类型 默认0 1-主动领红包/到店送红包 2-收藏送红包 4-会员送红包 6-注册送红包 9-推荐送红包 10-积分兑换红包
 * @param int $bonus_type
 * @return mixed|string
 */
function format_bonus_type($bonus_type = 0)
{
    $data = [
        1 => '到店送红包',
        2 => '收藏送红包',
        4 => '会员送红包',
        6 => '注册送红包',
        9 => '推荐送红包',
        10 => '积分兑换红包'
    ];
    if (!isset($data[$bonus_type])) {
        return '';
    }
    return $data[$bonus_type];
}

/**
 * 检查订单来源
 *
 * @return int
 */
function check_order_from()
{
    if (is_app('weapp')) { // 微信小程序端访问
        return 5;
    } elseif (is_app('ios')) { // Ios端访问
        return 4;
    } elseif (is_app('android')) { // Android端访问
        return 3;
    } elseif (is_mobile() && !is_app()) { // 手机端访问 针对微信端
        return 2;
    } else { // PC端
        return 1;
    }
}

/**
 * 格式化数据订单配送方式
 *
 * @param int $pickup
 * @return mixed|string
 */
function format_order_pickup($pickup = 0)
{
    $data = [
        0 => '普通配送',
        1 => '上门自提'
    ];
    if (!isset($data[$pickup])) {
        return '';
    }
    return $data[$pickup];
}

/**
 * 格式化数据订单支付方式
 *
 * @param int $pay_type
 * @return mixed|string
 */
function format_pay_type($pay_type = '')
{
    $data = [
        'alipay' => '支付宝',
        'union' => '银联支付',
        'weixin' => '微信支付',
        'balance' => '余额支付',
        'cod' => '货到付款',
    ];
    if (!isset($data[$pay_type])) {
        return '';
    }
    return $data[$pay_type];
}

/**
 * 格式化数据会员注册来源
 * 注册来源 0其他 1PC端 2WAP端 3微信端 4APP端 5后台添加
 * @param int|string $key
 * @return mixed|string
 */
function format_user_reg_from($key = '-1')
{
    $data = [
        0 => '其他',
        1 => 'PC端',
        2 => 'WAP端',
        3 => '微信端',
        4 => 'APP端',
        5 => '后台添加',
    ];
    if ($key != '-1') {
        return isset($data[$key]) ? $data[$key] : '';
    }

    return $data;
}

/**
 * 格式化数据 性别
 * @param string $key
 * @return array|mixed|string
 */
function format_sex($key = '-1')
{
    $data = [
        0 => '保密',
        1 => '男',
        2 => '女',
    ];
    if ($key != '-1') {
        return isset($data[$key]) ? $data[$key] : '';
    }

    return $data;
}

/**
 * 获取购物车图标
 * @return string
 */
function get_cart_image()
{
    if(sysconf('custom_style_enable')) {
        $data = get_image_url(sysconf('cart_image'));
    } else {
        $data = __HTTP__.env('FRONTEND_DOMAIN').'/images/add-cart.jpg';
    }
    return $data;
}

//function mb_unserialize($str) {
//    return preg_replace_callback('#s:(\d+):"(.*?)";#s',function($match){return 's:'.strlen($match[2]).':"'.$match[2].'";';},$str);
//}

function get_mobile_area($mobile){

    if (!check_is_mobile($mobile)) {
        return '';
    }else{
        $phone_json = file_get_contents('http://sp0.baidu.com/8aQDcjqpAAV3otqbppnN2DJv/api.php?query={'.$mobile.'}&resource_id=6004&ie=utf8&oe=utf8&format=json');
        $phone_array = json_decode($phone_json,true);
        $phone_info = array();
        $phone_info['mobile'] = $mobile;
        $phone_info['type'] = $phone_array['data'][0]['type'];
        $phone_info['location'] = $phone_array['data'][0]['prov'].$phone_array['data'][0]['city'];
        return $phone_info;
    }
}

/**
 * 将一维json对象转换为字段拼接字符串
 * 适用于模型中的字段声明
 *
 * @param $object
 * @return string
 */
function object_to_field_str($object)
{
    if (is_string($object)) {
        $object = json_decode($object,true);
    }
    $data = "'".implode("','", array_keys($object))."'";
    return $data;
}

/**
 * 获取平台后台商城应用列表
 *
 * @return array
 */
function get_application_list()
{
    $data = [
        [
            'name' => '促销转化',
            'desc' => '',
            'label' => '',
            'is_disp_block' => false,
            'logo' => '',
            'url' => '',
            'field' => '',
            'type' => 1,
            'child' => [
                [
                    'name' => '红包',
                    'desc' => '向消费者发放平台红包',
                    'label' => '',
                    'is_disp_block' => false,
                    'logo' => 'hb',
                    'url' => '/dashboard/bonus/list',
                    'field' => 'bonus',
                    'type' => 2,
                ],
                [
                    'name' => '团购',
                    'desc' => '监管店铺限时促销活动',
                    'label' => '',
                    'is_disp_block' => false,
                    'logo' => 'tg',
                    'url' => '/dashboard/group-buy/list',
                    'field' => 'group_buy',
                    'type' => 2,
                ],
                [
                    'name' => '搭配套餐',
                    'desc' => '创建商品套餐让消费者购买',
                    'label' => '',
                    'is_disp_block' => false,
                    'logo' => 'dp',
                    'url' => '/dashboard/goods-mix/list',
                    'field' => 'goods_mix',
                    'type' => 2,
                ],
                [
                    'name' => '限时折扣',
                    'desc' => '设置商品限时打折促销',
                    'label' => '',
                    'is_disp_block' => false,
                    'logo' => 'zszk',
                    'url' => '/dashboard/limit-discount/list',
                    'field' => 'limit_discount',
                    'type' => 2,
                ],
                [
                    'name' => '赠品',
                    'desc' => '设置赠品，回馈消费者',
                    'label' => '',
                    'is_disp_block' => false,
                    'logo' => 'zp',
                    'url' => 'javascript:;',
                    'field' => 'gift',
                    'type' => 2,
                ],
                [
                    'name' => '满减/送',
                    'desc' => '设置订单满指定金额享受减免',
                    'label' => '',
                    'is_disp_block' => false,
                    'logo' => 'mj',
                    'url' => '/dashboard/full-cut/list',
                    'field' => 'full_cut',
                    'type' => 2,
                ],
                [
                    'name' => '满件优惠',
                    'desc' => '设置购买指定件享受优惠',
                    'label' => '敬请期待',
                    'is_disp_block' => true,
                    'logo' => 'yh',
                    'url' => 'javascript:;',
                    'field' => 'full_discount',
                    'type' => 2,
                ],
//                [
//                    'name' => '加价购',
//                    'desc' => '设置订单满指定金额加价换购商品',
//                    'label' => '',
//                    'is_disp_block' => false,
//                    'logo' => 'jjg',
//                    'url' => 'javascript:;',
//                    'field' => '',
//                ],
                [
                    'name' => '购物返现',
                    'desc' => '购买商品满足指定条件返部分现金',
                    'label' => '敬请期待',
                    'is_disp_block' => true,
                    'logo' => 'gwfx',
                    'url' => 'javascript:;',
                    'field' => 'buy_back',
                    'type' => 2,
                ],
                [
                    'name' => '订单返现',
                    'desc' => '设置订单满指定金额返部分现金',
                    'label' => '敬请期待',
                    'is_disp_block' => true,
                    'logo' => 'ddf',
                    'url' => 'javascript:;',
                    'field' => '',
                    'type' => 1,
                ],
            ]
        ],
        [
            'name' => '引流裂变',
            'desc' => '',
            'label' => '',
            'is_disp_block' => false,
            'logo' => '',
            'url' => '',
            'field' => '',
            'child' => [
                [
                    'name' => '拼团',
                    'desc' => '引导客户邀请朋友一起拼团购买',
                    'label' => '已购',
                    'is_disp_block' => false,
                    'logo' => 'pt',
                    'url' => '/dashboard/fight-group/list',
                    'field' => 'groupon',
                    'type' => 2,
                ],
                [
                    'name' => '砍价',
                    'desc' => '互动帮砍，拉动粉丝',
                    'label' => '已购',
                    'is_disp_block' => false,
                    'logo' => 'kj',
                    'url' => '/dashboard/bargain/list',
                    'field' => 'bargain',
                    'type' => 2,
                ],
                [
                    'name' => '短信推送',
                    'desc' => '向消费者发送短信消息通知',
                    'label' => '已购',
                    'is_disp_block' => false,
                    'logo' => 'dx',
                    'url' => '/dashboard/sms-group/index',
                    'field' => 'sms_send',
                    'type' => 2,
                ],
                [
                    'name' => '邮件推送',
                    'desc' => '向消费者发送邮件消息通知',
                    'label' => '已购',
                    'is_disp_block' => false,
                    'logo' => 'yj',
                    'url' => '/dashboard/email-group/index',
                    'field' => 'email_send',
                    'type' => 2,
                ],
                [
                    'name' => '微信推送',
                    'desc' => '向消费者发送微信消息通知',
                    'label' => '已购',
                    'is_disp_block' => false,
                    'logo' => 'wx',
                    'url' => '/weixin/push/index?btn=back',
                    'field' => '',
                    'type' => 1,
                ],
                [
                    'name' => '分销',
                    'desc' => '三级分销，爆炸式推广',
                    'label' => '已购',
                    'is_disp_block' => false,
                    'logo' => 'fx',
                    'url' => '/system/config/index?group=distrib',
                    'field' => 'distrib',
                    'type' => 2,
                ],
                [
                    'name' => '直播',
                    'desc' => '直播引流，效果直观',
                    'label' => '',
                    'is_disp_block' => true,
                    'logo' => 'live',
                    'url' => '/dashboard/live/index',
                    'field' => 'live',
                    'type' => 1,
                ],
                [
                    'name' => '预售',
                    'desc' => '预定形式销售',
                    'label' => '',
                    'is_disp_block' => true,
                    'logo' => 'ys',
                    'url' => '/dashboard/pre-sale/index',
                    'field' => 'pre_sale',
                    'type' => 1,
                ],
            ]
        ],
        [
            'name' => '运营插件',
            'desc' => '',
            'label' => '',
            'is_disp_block' => false,
            'logo' => '',
            'url' => '',
            'field' => '',
            'child' => [
                [
                    'name' => '促销专场',
                    'desc' => '迎合各种大型节假日开启促销专场',
                    'label' => '',
                    'is_disp_block' => false,
                    'logo' => 'cx',
                    'url' => '/topic/topic/list',
                    'field' => 'topic',
                    'type' => 2,
                ],
                [
                    'name' => '商超便利超市-自由购',
                    'desc' => '超市现场使用，扫码核销免排队',
                    'label' => '已购',
                    'is_disp_block' => false,
                    'logo' => 'zyg',
                    'url' => '/dashboard/freebuy/desc',
                    'field' => 'free_buy',
                    'type' => 2,
                ],
                [
                    'name' => '堂内点餐',
                    'desc' => '到店扫码方便快捷',
                    'label' => '已购',
                    'is_disp_block' => false,
                    'logo' => 'ddg',
                    'url' => '/dashboard/reachbuy-shops/list',
                    'field' => 'reach_buy',
                    'type' => 2,
                ],
                [
                    'name' => '扫码付',
                    'desc' => '扫码支付',
                    'label' => '已购',
                    'is_disp_block' => false,
                    'logo' => 'smf',
                    'url' => '/dashboard/scan-code/index',
                    'field' => '',
                    'type' => 1,
                ],
                [
                    'name' => '限购',
                    'desc' => '不同等级消费者限制购买',
                    'label' => '',
                    'is_disp_block' => false,
                    'logo' => 'xg',
                    'url' => '/dashboard/purchase/list',
                    'field' => 'purchase',
                    'type' => 1,
                ],
                [
                    'name' => '万能表单',
                    'desc' => '自定义表单文件',
                    'label' => '',
                    'is_disp_block' => false,
                    'logo' => 'wnbd',
                    'url' => '/dashboard/custom-form/list',
                    'field' => 'custom_form',
                    'type' => 1,
                ],
                [
                    'name' => '虚拟商品',
                    'desc' => '服务商品、电子卡券',
                    'label' => '已购',
                    'is_disp_block' => false,
                    'logo' => 'xnsp',
                    'url' => '/trade/virtual-order/list',
                    'field' => 'virtual',
                    'type' => 1,
                ],
            ]
        ],
        [
            'name' => '客情维持',
            'desc' => '',
            'label' => '',
            'is_disp_block' => false,
            'logo' => '',
            'url' => '',
            'field' => '',
            'child' => [
                [
                    'name' => '积分商城',
                    'desc' => '积分兑换商品',
                    'label' => '',
                    'is_disp_block' => false,
                    'logo' => 'jf',
                    'url' => '/dashboard/integral-mall/revision',
                    'field' => 'integralmall',
                    'type' => 2,
                ],
                [
                    'name' => '平台储值卡',
                    'desc' => '平台方向消费者发放储值卡',
                    'label' => '',
                    'is_disp_block' => false,
                    'logo' => 'czk',
                    'url' => '/dashboard/recharge-card-type/list',
                    'field' => '',
                    'type' => 1,
                ],
                [
                    'name' => '店铺购物卡',
                    'desc' => '店铺向会员发放的购物卡',
                    'label' => '',
                    'is_disp_block' => false,
                    'logo' => 'czk',
                    'url' => '/dashboard/store-card-type/list',
                    'field' => 'shop_store_card',
                    'type' => 2,
                ],
                [
                    'name' => '提货券',
                    'desc' => '向消费者发放提货券',
                    'label' => '',
                    'is_disp_block' => false,
                    'logo' => 'lpk',
                    'url' => '/dashboard/gift-card/list',
                    'field' => 'gift_card',
                    'type' => 2,
                ],
                [
                    'name' => '充值有礼',
                    'desc' => '充值翻倍、有礼',
                    'label' => '',
                    'is_disp_block' => false,
                    'logo' => 'czyl',
                    'url' => '/dashboard/recharge-polite/list',
                    'field' => '',
                    'type' => 1,
                ],
//                [
//                    'name' => '抢红包',
//                    'desc' => '抢红包',
//                    'label' => '',
//                    'is_disp_block' => false,
//                    'logo' => 'qhb',
//                    'url' => 'javascript:;',
//                ],
                [
                    'name' => '秒杀',
                    'desc' => '快速抢购引导客户更多消费',
                    'label' => '敬请期待',
                    'is_disp_block' => true,
                    'logo' => 'ms',
                    'url' => 'javascript:;',
                    'field' => '',
                    'type' => 1,
                    'is_hide' => true
                ],
                [
                    'name' => '签到',
                    'desc' => '每日签到领取积分或奖励',
                    'label' => '敬请期待',
                    'is_disp_block' => true,
                    'logo' => 'qd',
                    'url' => 'javascript:;',
                    'field' => 'sign_in',
                    'type' => 2,
                ],
            ]
        ],
        [
            'name' => '经营分析',
            'desc' => '',
            'label' => '',
            'is_disp_block' => false,
            'logo' => '',
            'url' => '',
            'field' => '',
            'child' => [
//                [
//                    'name' => '众筹',
//                    'desc' => '用户打造自己喜欢的产品',
//                    'label' => '已购',
//                    'is_disp_block' => false,
//                    'logo' => 'zc',
//                    'url' => 'javascript:;',
//                ],
                [
                    'name' => '客户分析',
                    'desc' => '平台客户分析及定向营销',
                    'label' => '已购',
                    'is_disp_block' => false,
                    'logo' => 'khfx',
                    'url' => '/dashboard/customer-analysis/index',
                    'field' => 'customer_analysis',
                    'type' => 2,
                ],
                [
                    'name' => '商圈营销',
                    'desc' => '同城电商区域分析',
                    'label' => '已购',
                    'is_disp_block' => false,
                    'logo' => 'sqyx',
                    'url' => '/dashboard/trade-area/list',
                    'field' => 'trade_area',
                    'type' => 2,
                ],
                [
                    'name' => '数据导出',
                    'desc' => '商城商品数据导出',
                    'label' => '已购',
                    'is_disp_block' => false,
                    'logo' => 'sjdc',
                    'url' => '/dashboard/data-export/index',
                    'field' => 'data_import',
                    'type' => 2,
                ],
            ]
        ],
        [
            'name' => '店铺拓展',
            'desc' => '',
            'label' => '',
            'is_disp_block' => false,
            'logo' => '',
            'url' => '',
            'field' => '',
            'child' => [
                [
                    'name' => '预上线店铺',
                    'desc' => '推进商城招商入驻',
                    'label' => '已购',
                    'is_disp_block' => false,
                    'logo' => 'ysx',
                    'url' => '/shop/shop/pre-line-list?is_supply=0',
                    'field' => '',
                    'type' => 1,
                ],
                [
                    'name' => '神码收银',
                    'desc' => '生成直接收款页面和收款码',
                    'label' => '已购',
                    'is_disp_block' => false,
                    'logo' => 'mssy',
                    'url' => '/finance/cashier/stats',
                    'field' => 'god_qrcode',
                    'type' => 2,
                ],
            ]
        ],
        [
            'name' => '销售渠道',
            'desc' => '',
            'label' => '',
            'is_disp_block' => false,
            'logo' => '',
            'url' => '',
            'field' => '',
            'child' => [
                [
                    'name' => '微商城',
                    'desc' => '连接公众号，玩转微信生态',
                    'label' => '已购',
                    'is_disp_block' => false,
                    'logo' => 'wsc',
                    'url' => '/system/config/index?group=weixin',
                    'field' => '',
                    'type' => 1,
                ],
                [
                    'name' => 'WAP端',
                    'desc' => '手机浏览器，玩转电商系统',
                    'label' => '已购',
                    'is_disp_block' => false,
                    'logo' => 'wap',
                    'url' => '/system/config/index?group=mobile_setting_basic',
                    'field' => '',
                    'type' => 1,
                ],
                [
                    'name' => '站点',
                    'desc' => '多城市区域独立经营',
                    'label' => '已购',
                    'is_disp_block' => false,
                    'logo' => 'zd',
                    'url' => '/dashboard/site/index',
                    'field' => '',
                    'type' => 1,
                ],
                [
                    'name' => '批发市场',
                    'desc' => '阶梯价批发售卖商品',
                    'label' => '已购',
                    'is_disp_block' => false,
                    'logo' => 'pfsc',
                    'url' => '/dashboard/market/index',
                    'field' => '',
                    'type' => 1,
                ],
                [
                    'name' => '消费者APP',
                    'desc' => '一款满足消费者线上购物需求的软件',
                    'label' => '已购',
                    'is_disp_block' => false,
                    'logo' => 'xfz-app',
                    'url' => '/system/config/index?group=app_setting',
                    'field' => '',
                    'type' => 1,
                ],
                [
                    'name' => '商家版APP',
                    'desc' => '最实用的商家开店手机助手',
                    'label' => '已购',
                    'is_disp_block' => false,
                    'logo' => 'sjb-app',
                    'url' => '/system/config/index?group=app_seller_setting',
                    'field' => '',
                    'type' => 1,
                ],
                [
                    'name' => '收银台',
                    'desc' => '一站式收银台解决方案',
                    'label' => '已购',
                    'is_disp_block' => false,
                    'logo' => 'syt',
                    'url' => '/dashboard/cashier-desk/index',
                    'field' => 'cashier',
                    'type' => 2,
                ],
                [
                    'name' => '网点',
                    'desc' => '自动接收订单，就近配送',
                    'label' => '',
                    'is_disp_block' => false,
                    'logo' => 'wd',
                    'url' => 'javascript:;',
                    'field' => 'wd',
                    'type' => 1,
                ],
                [
                    'name' => '区域合伙人',
                    'desc' => '区域加盟，扩大推广',
                    'label' => '敬请期待',
                    'is_disp_block' => true,
                    'logo' => 'qyhhw',
                    'url' => 'javascript:;',
                    'field' => '',
                    'type' => 1,
                ],
            ]
        ],

        /*[
            'name' => '互动活动',
            'desc' => '',
            'label' => '',
            'is_disp_block' => false,
            'logo' => '',
            'url' => '',
            'field' => '',
            'child' => [
                [
                    'name' => '刮刮卡',
                    'desc' => '通过刮开卡片进行抽奖的玩法',
                    'label' => '已购',
                    'is_disp_block' => false,
                    'logo' => 'ggk',
                    'url' => '/cash/receipt/index',
                    'field' => '',
                    'type' => 2,
                ],
                [
                    'name' => '幸运大抽奖',
                    'desc' => '常见的转盘式抽奖玩法',
                    'label' => '已购',
                    'is_disp_block' => false,
                    'logo' => 'dcj',
                    'url' => '/cash/receipt/index',
                    'field' => '',
                    'type' => 2,
                ],
                [
                    'name' => '幸运砸蛋',
                    'desc' => '好运砸出来',
                    'label' => '已购',
                    'is_disp_block' => false,
                    'logo' => 'xyzd',
                    'url' => '/cash/receipt/index',
                    'field' => '',
                    'type' => 2,
                ],
                [
                    'name' => '摇一摇',
                    'desc' => '让客户摇一摇，进行抽奖',
                    'label' => '已购',
                    'is_disp_block' => false,
                    'logo' => 'yyy',
                    'url' => '/cash/receipt/index',
                    'field' => '',
                    'type' => 2,
                ],
                [
                    'name' => '水果机',
                    'desc' => '水果方格转盘抽奖',
                    'label' => '已购',
                    'is_disp_block' => false,
                    'logo' => 'sgj',
                    'url' => '/cash/receipt/index',
                    'field' => '',
                    'type' => 2,
                ],
            ]
        ]*/
    ];

    return $data;
}

/**
 * 获取商家后台商城应用列表
 *
 * @return array
 */
function get_shop_application_list()
{
    $data = [
        [
            'name' => '促销转化',
            'desc' => '',
            'label' => '',
            'is_disp_block' => false,
            'logo' => '',
            'url' => '',
            'field' => '',
            'child' => [
                [
                    'name' => '红包',
                    'desc' => '向消费者发放红包',
                    'label' => '',
                    'is_disp_block' => false,
                    'logo' => 'hb',
                    'url' => '/dashboard/bonus/list',
                    'field' => 'bonus',
                ],
                [
                    'name' => '团购',
                    'desc' => '创建限时促销活动',
                    'label' => '',
                    'is_disp_block' => false,
                    'logo' => 'tg',
                    'url' => '/dashboard/group-buy/list',
                    'field' => 'group_buy',
                ],
                [
                    'name' => '搭配套餐',
                    'desc' => '创建商品套餐让消费者购买',
                    'label' => '',
                    'is_disp_block' => false,
                    'logo' => 'dp',
                    'url' => '/dashboard/goods-mix/list',
                    'field' => 'goods_mix',
                ],
                [
                    'name' => '限时折扣',
                    'desc' => '设置商品限时打折促销',
                    'label' => '',
                    'is_disp_block' => false,
                    'logo' => 'zszk',
                    'url' => '/dashboard/limit-discount/list',
                    'field' => 'limit_discount',
                ],
                [
                    'name' => '赠品',
                    'desc' => '设置赠品，回馈消费者',
                    'label' => '',
                    'is_disp_block' => false,
                    'logo' => 'zp',
                    'url' => '/dashboard/gift/list',
                    'field' => 'gift',
                ],
                [
                    'name' => '满减/送',
                    'desc' => '设置订单满指定金额享受减免',
                    'label' => '',
                    'is_disp_block' => false,
                    'logo' => 'mj',
                    'url' => '/dashboard/full-cut/list',
                    'field' => 'full_cut',
                ],
                [
                    'name' => '满件优惠',
                    'desc' => '设置购买指定件享受优惠',
                    'label' => '敬请期待',
                    'is_disp_block' => true,
                    'logo' => 'yh',
                    'url' => 'javascript:;',
                    'field' => 'full_discount',
                ],
                [
                    'name' => '订单返现',
                    'desc' => '购买商品订单满足指定条件返部分现金',
                    'label' => '',
                    'is_disp_block' => false,
                    'logo' => 'gwfx',
                    'url' => '/dashboard/cash-back/list',
                    'field' => 'cash_back',
                ],
//                [
//                    'name' => '签到',
//                    'desc' => '每日签到领取积分或奖励',
//                    'label' => '敬请期待',
//                    'is_disp_block' => true,
//                    'logo' => 'qd',
//                    'url' => 'javascript:;',
//                    'field' => 'sign_in',
//                ],
            ]
        ],
        [
            'name' => '引流裂变',
            'desc' => '',
            'label' => '',
            'is_disp_block' => false,
            'logo' => '',
            'url' => '',
            'field' => '',
            'child' => [
                [
                    'name' => '拼团',
                    'desc' => '引导客户邀请朋友一起拼团购买',
                    'label' => '',
                    'is_disp_block' => false,
                    'logo' => 'pt',
                    'url' => '/dashboard/fight-group/list',
                    'field' => 'groupon',
                ],
                [
                    'name' => '砍价',
                    'desc' => '互动帮砍，拉动粉丝',
                    'label' => '已购',
                    'is_disp_block' => false,
                    'logo' => 'kj',
                    'url' => '/dashboard/bargain/list',
                    'field' => 'bargain',
                ],
                [
                    'name' => '短信推送',
                    'desc' => '向消费者发送短信消息通知',
                    'label' => '',
                    'is_disp_block' => false,
                    'logo' => 'dx',
                    'url' => '/dashboard/sms-set/index',
                    'field' => 'sms_send',
                ],
                [
                    'name' => '邮件推送',
                    'desc' => '向消费者发送邮件消息通知',
                    'label' => '',
                    'is_disp_block' => false,
                    'logo' => 'yj',
                    'url' => '/dashboard/email-group/index',
                    'field' => 'email_send',
                ],
                [
                    'name' => '分销',
                    'desc' => '三级分销，爆炸式推广',
                    'label' => '',
                    'is_disp_block' => false,
                    'logo' => 'fx',
                    'url' => '/dashboard/distrib-goods/list',
                    'field' => 'distrib',
                ],
                [
                    'name' => '直播',
                    'desc' => '直播引流，效果直观',
                    'label' => '',
                    'is_disp_block' => true,
                    'logo' => 'live',
                    'url' => '/dashboard/live/index',
                    'field' => 'live',
                ],
                [
                    'name' => '预售',
                    'desc' => '预定形式销售',
                    'label' => '',
                    'is_disp_block' => false,
                    'logo' => 'ys',
                    'url' => '/dashboard/pre-sale/list',
                    'field' => 'pre_sale',
                ],
            ]
        ],
        [
            'name' => '运营插件',
            'desc' => '',
            'label' => '',
            'is_disp_block' => false,
            'logo' => '',
            'url' => '',
            'field' => '',
            'child' => [
                [
                    'name' => '促销专场',
                    'desc' => '迎合各种大型节假日开启促销专场',
                    'label' => '',
                    'is_disp_block' => false,
                    'logo' => 'cx',
                    'url' => '/topic/topic/list',
                    'field' => 'topic',
                ],
                [
                    'name' => '商超便利超市-自由购',
                    'desc' => '超市现场使用，扫码核销免排队',
                    'label' => '',
                    'is_disp_block' => false,
                    'logo' => 'zyg',
                    'url' => '/dashboard/free-buy/index',
                    'field' => 'free_buy',
                ],
                [
                    'name' => '堂内点餐',
                    'desc' => '到店扫码方便快捷',
                    'label' => '',
                    'is_disp_block' => false,
                    'logo' => 'ddg',
                    'url' => '/dashboard/reachbuy/index',
                    'field' => 'reach_buy',
                ],
                [
                    'name' => '限购',
                    'desc' => '不同等级消费者限制购买',
                    'label' => '',
                    'is_disp_block' => false,
                    'logo' => 'xg',
                    'url' => '/dashboard/purchase/list',
                    'field' => 'purchase',
                ],
                [
                    'name' => '万能表单',
                    'desc' => '自定义表单文件',
                    'label' => '',
                    'is_disp_block' => false,
                    'logo' => 'wnbd',
                    'url' => '/dashboard/custom-form/list',
                    'field' => 'custom_form',
                ],
                [
                    'name' => '虚拟商品',
                    'desc' => '服务商品、电子卡券',
                    'label' => '已购',
                    'is_disp_block' => false,
                    'logo' => 'xnsp',
                    'url' => '/trade/virtual-order/list',
                    'field' => 'virtual',
                ],
            ]
        ],
        [
            'name' => '客情维持',
            'desc' => '',
            'label' => '',
            'is_disp_block' => false,
            'logo' => '',
            'url' => '',
            'field' => '',
            'child' => [
                [
                    'name' => '积分商城',
                    'desc' => '积分兑换商品',
                    'label' => '',
                    'is_disp_block' => false,
                    'logo' => 'jf',
                    'url' => '/dashboard/integral-mall/revision',
                    'field' => 'integralmall',
                ],
                [
                    'name' => '店铺购物卡',
                    'desc' => '向消费者派发的购物卡',
                    'label' => '',
                    'is_disp_block' => false,
                    'logo' => 'czk',
                    'url' => '/dashboard/store-card-type/list',
                    'field' => 'shop_store_card',
                ],
                [
                    'name' => '提货券',
                    'desc' => '向消费者发放提货券',
                    'label' => '',
                    'is_disp_block' => false,
                    'logo' => 'lp',
                    'url' => '/dashboard/gift-card/list',
                    'field' => 'gift_card',
                ],
            ]
        ],
        [
            'name' => '经营分析',
            'desc' => '',
            'label' => '',
            'is_disp_block' => false,
            'logo' => '',
            'url' => '',
            'field' => '',
            'child' => [
                [
                    'name' => '客户分析',
                    'desc' => '店铺客户分析及定向营销',
                    'label' => '',
                    'is_disp_block' => false,
                    'logo' => 'khfx',
                    'url' => '/dashboard/customer-analysis/index',
                    'field' => 'customer-analysis',
                ],
                [
                    'name' => '商圈营销',
                    'desc' => '同城电商区域分析',
                    'label' => '已购',
                    'is_disp_block' => false,
                    'logo' => 'sqyx',
                    'url' => '/dashboard/trade-area/list',
                    'field' => 'trade_area',
                ],
                [
                    'name' => '数据导出',
                    'desc' => '商城商品数据导出',
                    'label' => '已购',
                    'is_disp_block' => false,
                    'logo' => 'sjdc',
                    'url' => '/dashboard/data-export/index',
                    'field' => 'data_import',
                ],
            ]
        ],
        [
            'name' => '店铺拓展',
            'desc' => '',
            'label' => '',
            'is_disp_block' => false,
            'logo' => '',
            'url' => '',
            'field' => '',
            'child' => [
                [
                    'name' => '神码收银',
                    'desc' => '生成直接收款页面和收款码',
                    'label' => '',
                    'is_disp_block' => false,
                    'logo' => 'mssy',
                    'url' => '/dashboard/cashier/list',
                    'field' => 'god_qrcode',
                ],
            ]
        ],
        [
            'name' => '销售渠道',
            'desc' => '',
            'label' => '',
            'is_disp_block' => false,
            'logo' => '',
            'url' => '',
            'field' => '',
            'child' => [
                [
                    'name' => '移动端',
                    'desc' => '连接公众号，玩转微信生态',
                    'label' => '',
                    'is_disp_block' => false,
                    'logo' => 'ydd',
                    'url' => '/shop/weixin-config/index',
                    'field' => 'mobile',
                ],
                [
                    'name' => '网点',
                    'desc' => '自动接收订单，就近配送',
                    'label' => '',
                    'is_disp_block' => false,
                    'logo' => 'wd',
                    'url' => '/store/default/list',
                    'field' => 'wd',
                ],
            ]
        ],

        /*[
            'name' => '互动活动',
            'desc' => '',
            'label' => '',
            'is_disp_block' => false,
            'logo' => '',
            'url' => '',
            'field' => '',
            'is_hide' => true,
            'child' => [
                [
                    'name' => '刮刮卡',
                    'desc' => '通过刮开卡片进行抽奖的玩法',
                    'label' => '已购',
                    'is_disp_block' => false,
                    'logo' => 'ggk',
                    'url' => '/cash/receipt/index',
                    'field' => '',
                ],
                [
                    'name' => '幸运大抽奖',
                    'desc' => '常见的转盘式抽奖玩法',
                    'label' => '已购',
                    'is_disp_block' => false,
                    'logo' => 'dcj',
                    'url' => '/cash/receipt/index',
                    'field' => '',
                ],
                [
                    'name' => '幸运砸蛋',
                    'desc' => '好运砸出来',
                    'label' => '已购',
                    'is_disp_block' => false,
                    'logo' => 'xyzd',
                    'url' => '/cash/receipt/index',
                    'field' => '',
                ],
                [
                    'name' => '摇一摇',
                    'desc' => '让客户摇一摇，进行抽奖',
                    'label' => '已购',
                    'is_disp_block' => false,
                    'logo' => 'yyy',
                    'url' => '/cash/receipt/index',
                    'field' => '',
                ],
                [
                    'name' => '水果机',
                    'desc' => '水果方格转盘抽奖',
                    'label' => '已购',
                    'is_disp_block' => false,
                    'logo' => 'sgj',
                    'url' => '/cash/receipt/index',
                    'field' => '',
                ],
            ]
        ]*/
    ];

    return $data;
}

/**
 * 格式化价格
 *
 * @param int $price 价格
 * @param int $number 小数位数
 * @return string
 */
function format_price($price, $number = 2)
{
    return number_format($price,$number,'.','');
}

/**
 * 将图片地址转换为base64字符串
 *
 * @param $image_file
 * @return string
 */
function base64_encode_image($image_file) {
    $image_info             = getimagesize($image_file);
    $base64_image_content   = "data:{$image_info['mime']};base64," . chunk_split(base64_encode(file_get_contents($image_file)));

    return $base64_image_content;
}

