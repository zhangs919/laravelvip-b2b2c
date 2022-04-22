<?php

namespace App\Http\Controllers;

use App\Repositories\UpgradeRepository;


/**
 * 程序升级 控制器代码（包含客户端及服务端代码，后面要分离出来）
 * 添加路由：Route::get('/check_version', 'UpgradeController@checkVersion'); // 检查版本 此方法写到程序版本更新服务器上 检查客户端版本信息
 *          Route::get('/upgrade_log', 'UpgradeController@upgradeLog'); // 检查版本 此方法写到程序版本更新服务器上 记录客户端更新日志
 *          Route::get('/one_key_upgrade', 'UpgradeController@OneKeyUpgrade'); // 检查版本 此方法写到客户端
 * Class UpgradeController
 * @package App\Http\Controllers
 */
class UpgradeController extends Controller
{
    /**
     * 析构函数
     */
    function __construct() {
        @ini_set('memory_limit', '1024M'); // 设置内存大小
        @ini_set("max_execution_time", "0"); // 请求超时时间 0 为不限时
        @ini_set('default_socket_timeout', 3600); // 设置 file_get_contents 请求超时时间 官方的说明，似乎没有不限时间的选项，也就是不能填0，你如果填0，那么socket就会立即返回失败，
    }
    /**
     * 一键升级
     * 客户端升级代码
     *
     */
    public function OneKeyUpgrade(){
        // sleep(3);
        $upgrade = new UpgradeRepository();
        $msg = $upgrade->OneKeyUpgrade(); //升级包消息
        exit("$msg");
    }


//    /**
//     * 程序服务端 代码
//     * 检查客户端版本号
//     *
//     * @return \Illuminate\Http\JsonResponse
//     */
//    public function checkVersion(Request $request)
//    {
//        $v = $request->get('v');
//        // 对比客户端版本与服务器端最新版本 如果低于最新版本 则返回更新包信息 否则 返回 您的系统已经是最新版本信息。
////        return response()->json(['status'=>0,'msg'=>'你反馈的bug已收到,谢谢反馈!','data'=>'success']);
//        $down_url = 'http://laravel.cc/upgrade/upgrade.zip';
//        $file_md5 = md5_file($down_url);
//        return response()->json(['status'=>1,'msg'=>'','down_url'=>$down_url,'file_md5' => $file_md5]);
//    }
//
//    /**
//     * 程序服务端 代码
//     * 当客户端程序升级完成 服务端对该客户端升级过程作记录日志
//     *
//     * @return \Illuminate\Http\JsonResponse
//     */
//    public function upgradeLog()
//    {
//        return response()->json(['status'=>1,'msg'=>'升级成功！','data'=>'success']);
//    }

}
