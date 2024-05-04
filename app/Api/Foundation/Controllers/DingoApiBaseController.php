<?php

namespace App\Api\Foundation\Controllers;

use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;

class DingoApiBaseController extends Controller
{

    use Helpers;

    protected $user;

    public function __construct()
    {
        $this->user = auth('api')->user();
    }

    //成功返回
    public function success($data = null, $message = "数据获取成功", $extra = [])
    {
        $this->parseNull($data);
        $result = [
            "code" => 200,
            "message" => $message,
            "data" => $data,
        ];
        if (!empty($extra)) { // 数组追加
            foreach ($extra as $k=>$v) {
                $result[$k] = $v;
            }
        }

        return $this->response->array($result);
    }


    //失败返回
    public function error($code = "422", $data = null, $message = "fail")
    {
        $result = [
            "code" => $code,
            "message" => $message,
            "data" => $data
        ];
        return $this->response->array($result);
    }

    //如果返回的数据中有 null 则那其值修改为空 （安卓和IOS 对null型的数据不友好，会报错）
    private function parseNull(&$data)
    {
        if (is_array($data)) {
            foreach ($data as &$v) {
                $this->parseNull($v);
            }
        } else {
            if (is_null($data)) {
                $data = "";
            }
        }
    }

}