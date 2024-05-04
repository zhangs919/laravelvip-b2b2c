<?php

namespace App\Kernel\Repositories\Common;


use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

/**
 * Class LrwRepository
 * @package App\Kernel\Repositories\Common
 */
class LrwRepository
{
    /**
     * 格式化商品价格
     *
     * @param int $price
     * @param bool $change_price false-默认保留两位，true-根据商店设置控制处理小数点位数
     * @param bool $format false-不带价格符号，true-带价格符号
     */
    public static function getPriceFormat($price = 0, $change_price = true, $format = true)
    {
        return $price;
    }

    /**
     * @param float $float
     * @return float
     */
    public static function changeFloat(float $float = 0)
    {
        return number_format($float, 2, '.', '');
    }

    /**
     * 生成授权证书
     * @param string $app_key 注：app_key 是在安装系统时输入提交生成授权证书用，为确保app_key安全，不会将app_key存储到数据库中。
     * @param string $activate_time 激活时间
     */
    public static function lrwEmpower(string $app_key, string $activate_time)
    {
        $checkRes = self::checkEmpower(0, $app_key);
        if ($checkRes['code'] == 0) {
            Storage::disk('local')->put('certs/lrw_public_key.pem', $app_key);
            $data = "乐融沃 https://www.laravelvip.com/ \r\n 安装时间：" . $activate_time;
            Storage::disk('local')->put('seeder/install.lock', $data);
        }
    }

    /**
     * 验证系统是否购买商业授权
     *
     * @param int $from 0-安装页面 1-商城页面
     * @param string $auth_code
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public static function checkEmpower($from = 0, $auth_code = '')
    {
        try {
            $cache_id = CACHE_KEY_MALL_AUTH[0];
            if ($auth_info = cache()->get($cache_id)) {
                // 存在缓存 判断域名授权是否到期
                if (strtotime($auth_info['valid_at']) < time()) {
                    // 已过期
                    throw new \Exception('授权码已过期');
                }
                return arr_result(0, $auth_info, '验证通过');
            } else {
                // 请求乐融沃官网接口验证域名是否商业授权
                $domain = config('lrw.root_domain');
                if ($from == 1) {
                    $auth_code = Storage::disk('local')->get('certs/lrw_public_key.pem'); // 授权码 购买授权后 官网提供
                    if (!$auth_code) {
                        throw new \Exception('请先获取授权码');
                    }
                }
                $lrw_url = config('lrw.upgrade_server') . "/update/check-auth";
                $post = [
                    'name' => config('app.name'),
                    'domain' => $domain,
                    'auth_code' => $auth_code
                ];
                $res = Http::post($lrw_url, $post);
                if ($res->status() != 200) {
                    throw new \Exception('请求失败');
                }
                $res = json_decode($res->body(), true);
                if ($res['code'] == -1) {
                    throw new \Exception($res['message']);
                }

                // 验证通过 存储授权信息
                cache()->put($cache_id, $res['data'], CACHE_KEY_MALL_AUTH[1]);
                return arr_result(0, ['auth_code' => $res['data']['auth_code']], '验证通过');
            }
        } catch (\Exception $e) {
            return arr_result(-1, null, $e->getMessage());
        }


    }

    /**
     * 对 MYSQL LIKE 的内容进行转义
     * @param $str
     */
    public static function mysqlLikeQuote($str)
    {
        return strtr($str, ["\\\\" => "\\\\\\\\", '_' => '\_', '%' => '\%', "\'" => "\\\\\'"]);
    }
}
