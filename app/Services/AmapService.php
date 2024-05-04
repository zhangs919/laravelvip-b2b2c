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
// | Date:2019-7-5
// | Description: Amap SDK
// +----------------------------------------------------------------------

namespace App\Services;


class AmapService
{
    
    /**
     * 生成字符串参数
     * @param array $param 参数
     * @return  string        参数字符串
     */
    public function getStr($param)
    {
        $str = '';
        foreach ($param as $key => $value) {
            $str=$str.$key.'='.$value.'&';
        }
        $str = rtrim($str,'&');
        return $str;
    }


    /**
     * 地理编码
     *
     * 将具体地址信息转换为经纬度
     *
     * @param $address
     * @param string $city
     * @return mixed
     */
    public function action_geocode($address, $city = '')
    {
        $param = [
            'key' => sysconf('amap_web_key'), // 高德地图Web Key
            'address' => $address,
            'city' => $city,
        ];

        $str = $this->getStr($param);
        $result = $this->sendCmd('https://restapi.amap.com/v3/geocode/geo?parameters', $str);
        $result = json_decode($result,true);
        if ($result['count'] == 0) {
            return false;
        }
        if (empty($result['geocodes'][0]['location'])) {
            return false;
        }
        $location = $result['geocodes'][0]['location'];
        $data = explode(',', $location);

        return $data;
    }

    /**
     * 逆地理编码
     *
     * 将具体地址信息转换为经纬度
     *
     * @param $address
     * @param string $location 经纬度坐标 传入内容规则：经度在前，纬度在后，经纬度间以“,”分割，经纬度小数点后不要超过 6 位。
     * @return mixed
     */
    public function action_regeocode($location)
    {
        $param = [
            'key' => sysconf('amap_web_key'), // 高德地图Web Key
            'location' => $location
        ];

        $str = $this->getStr($param);
        $result = $this->sendCmd('https://restapi.amap.com/v3/geocode/regeo?parameters', $str);
        $result = json_decode($result,true);
        if ($result['status'] == 0) {
            return false;
        }
        $data = $result['regeocode']['addressComponent'];

        return $data;
    }
    
    
    /**
     * 发起请求
     * @param  string $url  请求地址
     * @param  string $data 请求数据包
     * @return   string      请求返回数据
     */
    public function sendCmd($url,$data)
    {
        $curl = curl_init(); // 启动一个CURL会话
        curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检测
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2); // 从证书中检查SSL加密算法是否存在
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Expect:')); //解决数据包大不能提交
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
        curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // Post提交的数据包
        curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循
        curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回

        $tmpInfo = curl_exec($curl); // 执行操作
        if (curl_errno($curl)) {
            echo 'Errno'.curl_error($curl);
        }
        curl_close($curl); // 关键CURL会话
        return $tmpInfo; // 返回数据
    }
}