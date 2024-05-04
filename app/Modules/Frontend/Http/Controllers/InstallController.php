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
// | Date:2024-01-02
// | Description:系统安装
// +----------------------------------------------------------------------

namespace App\Modules\Frontend\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\AdminRepository;
use App\Repositories\Common\LrwRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 *
 * Class InstallController
 * @package App\Modules\Frontend\Http\Controllers
 */
class InstallController extends Controller
{

    /**
     * 系统数据填充
     * @return mixed
     */
    public function seeder(Request $request)
    {
        if (Storage::disk('local')->exists('seeder/install.lock')) {
            return result(-1, null, '系统已安装完成！');
        }
        $username = \request()->get('username') ?? '';
        $password = \request()->get('password') ?? '';
        $app_key = \request()->get('app_key') ?? '';
        if (!$username || !$password) {
            return result(-1, null, '参数缺失！');
        }
        try {
            // 验证授权码
            $empowerRes = (new LrwRepository())->checkEmpower(0, $app_key);
            if (!empty($empowerRes) && $empowerRes['code'] == -1) {
                throw new \Exception($empowerRes['message']);
            }
            Log::info($empowerRes);
            if (empty($empowerRes['data']['auth_code'])) {
                throw new \Exception('授权码校验不通过');
            }
            $app_key = $empowerRes['data']['auth_code'];

            $admin = [
                'username' => $username,
                'password' => $password,
            ];
            Artisan::call('db:seed', ['--force' => true, '--class' => 'DatabaseSeeder']);
            $this->register_admin($admin);

            // 写入授权码
            $activate_time = date('Y-m-d H:i:s');
            (new LrwRepository())->lrwEmpower($app_key, $activate_time);

            return result(0, null, '执行成功');
        } catch (QueryException $e) {
            return result(-1, null, $e->getMessage());
        } catch (\Exception $e) {
            // 删除 .env
            if (File::exists(base_path('.env'))) {
                File::delete(base_path('.env'));
            }
            if (Storage::disk('local')->exists('seeder/install.lock')) {
                Storage::disk('local')->delete('seeder/install.lock');
            }
            cache()->clear();
            return result(-1, null, $e->getMessage());
        }
    }

    /**
     * 创建超级管理员账号
     * @param $db
     * @param $prefix
     * @param $admin
     */
    private function register_admin($admin) {
        // 添加后台管理账号
        $insert = [
            'user_name' => $admin['username'],
            'password' => bcrypt($admin['password']),
            'auth_key' => md5($admin['username']),
            'role_id' => 1
        ];
        $ret = (new AdminRepository())->store($insert);

        if ($ret === false) {
            // fail
            return result(-1, null, '管理员账号设置失败');
        }
    }

}
