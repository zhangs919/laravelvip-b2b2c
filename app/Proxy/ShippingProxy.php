<?php

namespace App\Proxy;

use GuzzleHttp\Client;
use Illuminate\Support\Carbon;

/**
 * Class ShippingProxy
 * @package App\Proxy
 */
class ShippingProxy
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * ShippingProxy constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * 快递跟踪
     * @param string $com
     * @param string $num
     * @return array|bool|\Illuminate\Cache\CacheManager|mixed
     * @throws \Exception
     */
    public function getExpress($com = '', $num = '')
    {
        $key = config('services.kd100.key');

        if (empty($key)) {
            return $this->basic($com, $num);
        } else {
            return $this->advanced($com, $num);
        }
    }

    /**
     * 商业接口，数据来自快递100
     * @param string $com
     * @param string $num
     * @return array
     * @throws \Exception
     */
    protected function advanced($com = '', $num = '')
    {
        // 接口配置
        $url = 'http://poll.kuaidi100.com/poll/query.do';
        $key = config('services.kd100.key');
        $customer = config('services.kd100.customer');

        // 请求参数
        $post_data["customer"] = $customer;
        $post_data["param"] = '{"com":"' . $com . '","num":"' . $num . '"}';
        $post_data["sign"] = strtoupper(md5($post_data["param"] . $key . $post_data["customer"]));

        // 缓存优先，否则请求API获取数据
        $cache_id = md5($url .'?'. http_build_query($post_data, '', '&'));
        $result = cache($cache_id);
        if (is_null($result)) {
            $response = $this->client->post($url, ['form_params' => $post_data]);
            $content = str_replace("\"", '"', $response->getBody()->getContents());
            $result = json_decode($content, true);
            cache([$cache_id => $result], Carbon::now()->addHours(1));
        }

        // 返回数据
        if (isset($result['status']) && $result['status'] === '200') {
            return ['error' => 0, 'data' => $result['data']];
        } else {
            return ['error' => 1, 'data' => $result['message']];
        }
    }

    /**
     * 免费接口，数据来自百度应用
     * @param string $com
     * @param string $num
     * @return bool|\Illuminate\Cache\CacheManager|mixed
     * @throws \Exception
     */
    protected function basic($com = '', $num = '')
    {
        if (config('app.env') == 'local') { // 本地环境不请求接口
            return ['error' => 0, 'data' => []];
        }
        // 接口配置
        $url = 'aHR0cHM6Ly9zcDAuYmFpZHUuY29tLzlfUTRzalc5MVFoM290cWJwcG5OMkRKdi9wYWUvY2hhbm5lbC9kYXRhL2FzeW5jcXVyeT9hcHBpZD00MDAxJmNvbT0lcyZudT0lcw==';
        $url = sprintf(base64_decode($url), $com, $num);

        // 缓存优先，否则请求API获取数据
        $cache_id = md5($url);
        $result = cache($cache_id);
        if (is_null($result)) {
            $response = $this->client->get($url, $this->defaultOptions());
            $res = json_decode($response->getBody()->getContents(), true);

            // 格式化数据
            $context = [];
            if (isset($res['data']['info']['context'])) {
                $context = $res['data']['info']['context'];
                foreach ($context as $k => $v) {
                    $context[$k]['time'] = date('Y-m-d H:i:s', $v['time']);
                    $context[$k]['context'] = $v['desc'];
                    unset($context[$k]['desc']);
                }
            }

            // 组装数据
            $result = [
                'error_code' => $res['error_code'] ?? '',
                'msg' => $res['msg'] ?? '',
                'data' => $context,
            ];

            cache([$cache_id => $result], Carbon::now()->addHours(1));
        }

        // 返回数据
        if (isset($result['error_code']) && $result['error_code'] === '0') {
            return ['error' => 0, 'data' => $result['data']];
        } else {
            return ['error' => 1, 'data' => $result['msg']];
        }
    }

    /**
     * 默认参数
     * @return array
     */
    protected function defaultOptions()
    {
        return [
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.' . time(),
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                'Accept-Encoding' => 'gzip, deflate, br',
                'Accept-Language' => 'zh-CN,zh;q=0.9,en;q=0.8,zh-TW;q=0.7',
                'Cache-Control' => 'no-cache',
                'Connection' => 'keep-alive',
                'Cookie' => 'BAIDUID=751A380F4F4F8FB7F348EB4E64E9FACF:FG=1', // TODO 获取BAIDUID
                'Host' => 'sp0.baidu.com',
                'Pragma' => 'no-cache',
                'Upgrade-Insecure-Requests' => '1',
            ]
        ];
    }
}
