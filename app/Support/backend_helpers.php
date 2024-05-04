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
// | Description: 后端助手函数
// +----------------------------------------------------------------------



/**
 * 加密函数
 *
 * @param string $txt 需要加密的字符串
 * @param string $key 密钥
 * @return string 返回加密结果
 */
if (!function_exists("backend_encrypt")) {

    function backend_encrypt($txt, $key = ''){
        if (empty($txt)) return $txt;
        if (empty($key)) $key = md5(MD5_KEY);
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_.";
        $ikey ="-x6g6ZWm2G9g_vr0Bo.pOq3kRIxsZ6rm";
        $nh1 = rand(0,64);
        $nh2 = rand(0,64);
        $nh3 = rand(0,64);

        // php 7.4不支持
//        $ch1 = $chars{$nh1};
//        $ch2 = $chars{$nh2};
//        $ch3 = $chars{$nh3};

        $ch1 = $chars[$nh1];
        $ch2 = $chars[$nh2];
        $ch3 = $chars[$nh3];

        $nhnum = $nh1 + $nh2 + $nh3;
        $knum = 0;$i = 0;
        while(isset($key[$i])) $knum +=ord($key[$i++]);
        $mdKey = substr(md5(md5(md5($key.$ch1).$ch2.$ikey).$ch3),$nhnum%8,$knum%8 + 16);
        $txt = base64_encode(time().'_'.$txt);
        $txt = str_replace(array('+','/','='),array('-','_','.'),$txt);
        $tmp = '';
        $j=0;$k = 0;
        $tlen = strlen($txt);
        $klen = strlen($mdKey);
        for ($i=0; $i<$tlen; $i++) {
            $k = $k == $klen ? 0 : $k;
            $j = ($nhnum+strpos($chars,$txt[$i])+ord($mdKey[$k++]))%64;
            $tmp .= $chars[$j];
        }
        $tmplen = strlen($tmp);
        $tmp = substr_replace($tmp,$ch3,$nh2 % ++$tmplen,0);
        $tmp = substr_replace($tmp,$ch2,$nh1 % ++$tmplen,0);
        $tmp = substr_replace($tmp,$ch1,$knum % ++$tmplen,0);
        return $tmp;
    }

}


/**
 * 解密函数
 *
 * @param string $txt 需要解密的字符串
 * @param string $key 密匙
 * @return string 字符串类型的返回结果
 */
if (!function_exists("backend_decrypt")) {

    function backend_decrypt($txt, $key = '', $ttl = 0){
        if (empty($txt)) return $txt;
        if (empty($key)) $key = md5(MD5_KEY);

        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_.";
        $ikey ="-x6g6ZWm2G9g_vr0Bo.pOq3kRIxsZ6rm";
        $knum = 0;$i = 0;
        $tlen = @strlen($txt);
        while(isset($key[$i])) $knum +=ord($key[$i++]);
        $ch1 = @$txt[$knum % $tlen];
        $nh1 = strpos($chars,$ch1);
        $txt = @substr_replace($txt,'',$knum % $tlen--,1);
        $ch2 = @$txt[$nh1 % $tlen];
        $nh2 = @strpos($chars,$ch2);
        $txt = @substr_replace($txt,'',$nh1 % $tlen--,1);
        $ch3 = @$txt[$nh2 % $tlen];
        $nh3 = @strpos($chars,$ch3);
        $txt = @substr_replace($txt,'',$nh2 % $tlen--,1);
        $nhnum = $nh1 + $nh2 + $nh3;
        $mdKey = substr(md5(md5(md5($key.$ch1).$ch2.$ikey).$ch3),$nhnum % 8,$knum % 8 + 16);
        $tmp = '';
        $j=0; $k = 0;
        $tlen = @strlen($txt);
        $klen = @strlen($mdKey);
        for ($i=0; $i<$tlen; $i++) {
            $k = $k == $klen ? 0 : $k;
            $j = strpos($chars,$txt[$i])-$nhnum - ord($mdKey[$k++]);
            while ($j<0) $j+=64;
            $tmp .= $chars[$j];
        }
        $tmp = str_replace(array('-','_','.'),array('+','/','='),$tmp);
        $tmp = trim(base64_decode($tmp));

        if (preg_match("/\d{10}_/s",substr($tmp,0,11))){
            if ($ttl > 0 && (time() - substr($tmp,0,11) > $ttl)){
                $tmp = null;
            }else{
                $tmp = substr($tmp,11);
            }
        }
        return $tmp;
    }

}

/**
 * 平台方后台验证操作权限
 *
 * @param string $request_route
 * @return array|bool
 */
function backend_auth($request_route = '', $check_ajax = false) {
    $admin_info = auth('admin')->user();

    //解析权限组权限
    $role_auth_codes = unserialize(backend_decrypt($admin_info->adminRole->auth_codes, MD5_KEY)) ?: [];
    // 解析管理员额外权限
    $admin_auth_codes = unserialize(backend_decrypt($admin_info->auth_codes, $admin_info->auth_key)) ?: [];
    $auth_codes = array_merge($role_auth_codes, $admin_auth_codes);

    if ($request_route == '') {
        $request_route = request()->route()->action['as'];
    }

    if (empty($auth_codes)) {
        $auth_codes = [];
    }

    if ($admin_info->admin_id != 1 && !empty($request_route) && !in_array($request_route, $auth_codes) && \request()->getPathInfo() != '/') {
        // 超级管理员不验证权限
        // 无访问权限 通过路由来判断是否有权限 admin_node表中routes字段存储该权限节点路由地址即可
        if (request()->ajax() && $check_ajax) {
            // ajax 请求 返回json
            return result(-1, '', NO_OPERATE_AUTH);
        }

        return false;
    }

    return true;
}

function backend_menu() {
    $cache_id = CACHE_KEY_ADMIN_MENU[0];
    if ($menus = cache()->get($cache_id)) {
        return $menus;
    }

    $menus = \App\Models\AdminMenu::where('is_show', 1)->get()->toArray();
    $tree = new \App\Services\Tree();
    $menus = $tree->list_to_tree($menus, 'id','pid', 'child');
    foreach ($menus as $key=>$menu) {
        if ($menu['pid'] != 0) {
            unset($menus[$key]);
        }
    }
    $menus = array_values($menus);
    cache()->put($cache_id, $menus, CACHE_KEY_ADMIN_MENU[1]);
    return $menus;
}

function get_backend_active_menus() {
//    $lastmenus = cookie('lastmenus'); // data-menus=mall|mall-setting|mall-setting-message
    $lastmenus = !empty($_COOKIE['lastmenus']) ? $_COOKIE['lastmenus'] : null;

    $active_url = '';
    $lastmenus_arr = [];
    if (empty($lastmenus)) {
        if (request()->getPathInfo() == '/') {
            $active_url = '/index/index/index';
        } else {
            $active_url = request()->getRequestUri();
        }
    } else {
        $lastmenus_arr = explode('|', $lastmenus);
    }

    $menus = backend_menu();
    $arr2 = $arr3 = [];
    $active_menus = [];
    foreach ($menus as $menu) {
        if (!empty($menu['child'])) {
            foreach ($menu['child'] as $menu2) {
                $arr2[] = $menu2;
                if (!empty($menu2['child'])) {
                    foreach ($menu2['child'] as $menu3) {
                        $arr3[] = $menu3;
                        if (!empty($lastmenus) && $lastmenus_arr[2] == $menu3['name']) {
                            $active_url = $menu3['url'];
                        }
                        if ($active_url == $menu3['url']) {
                            $active_menus = [
                                $menu['name'],
                                $menu2['name'],
                                $menu3['name'],
                            ];
                        }
                    }
                }
            }
        }
    }
    return [$active_url, $active_menus];
}

/**
 * 自定义函数递归的复制带有多级子目录的目录
 * 递归复制文件夹
 * @param string $src 原目录
 * @param string $dst 复制到的目录
 */
//参数说明：
//自定义函数递归的复制带有多级子目录的目录
function recurse_copy($src, $dst)
{
    $now = time();
    $dir = opendir($src);
    @mkdir($dst);

    while (false !== $file = readdir($dir)) {
        if (($file != '.') && ($file != '..')) {
            if (is_dir($src . '/' . $file)) {
                recurse_copy($src . '/' . $file, $dst . '/' . $file);
            }
            else {
                if (file_exists($dst . DIRECTORY_SEPARATOR . $file)) {
                    if (!is_writeable($dst . DIRECTORY_SEPARATOR . $file)) {
                        exit($dst . DIRECTORY_SEPARATOR . $file . '不可写');
                    }
                    @unlink($dst . DIRECTORY_SEPARATOR . $file);
                }
                if (file_exists($dst . DIRECTORY_SEPARATOR . $file)) {
                    @unlink($dst . DIRECTORY_SEPARATOR . $file);
                }
                $copyrt = copy($src . DIRECTORY_SEPARATOR . $file, $dst . DIRECTORY_SEPARATOR . $file);
                if (!$copyrt) {
                    echo 'copy ' . $dst . DIRECTORY_SEPARATOR . $file . ' failed<br>';
                }
            }
        }
    }
    closedir($dir);
}

// 递归删除文件夹
function delFile($path,$delDir = FALSE) {
    if(!is_dir($path))
        return FALSE;
    $handle = @opendir($path);
    if ($handle) {
        while (false !== ( $item = readdir($handle) )) {
            if ($item != "." && $item != "..")
                is_dir("$path/$item") ? delFile("$path/$item", $delDir) : unlink("$path/$item");
        }
        closedir($handle);
        if ($delDir) return rmdir($path);
    }else {
        if (file_exists($path)) {
            return unlink($path);
        } else {
            return FALSE;
        }
    }
}
