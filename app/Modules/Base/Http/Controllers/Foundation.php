<?php

namespace App\Modules\Base\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Foundation extends Controller
{
    public function __construct()
    {
        $HTTP_HOST = $_SERVER['HTTP_HOST'] . ($_SERVER['SERVER_PORT'] == 80 ? '' : ":" . $_SERVER['SERVER_PORT']);
        define('__HOST__', (request()->isSecure() ? 'https://' : 'http://') . $HTTP_HOST);
        define('__HTTP__', request()->isSecure() ? 'https://' : 'http://');
//        define('__STATIC__', config('TMPL_PARSE_STRING.__STATIC__'));
//        define('__PUBLIC__', config('TMPL_PARSE_STRING.__PUBLIC__'));
//        define('__TPL__', config('TMPL_PARSE_STRING.__TPL__'));


//        $this->load_helper('common'); // 引入公共函数

    }

//    protected function load_helper($files = array(), $type = 'base')
//    {
//        if (!is_array($files)) {
//            $files = array(
//                $files
//            );
//        }
////        $base_path = $type == 'app' ? MODULE_BASE_PATH : BASE_PATH;
//        foreach ($files as $vo) {
//            $helper = app_path('Helpers' . DIRECTORY_SEPARATOR . $vo . '_helper.php');
//            if (file_exists($helper)) {
//                require_once $helper;
//            }
//        }
//    }

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