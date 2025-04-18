<?php

namespace App\Api\Foundation\Controllers;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{


//    protected $user;

    public function __construct()
    {
        $this->user = auth('sanctum')->user();
    }

    //成功返回
    public function success($data = [], $message = "数据获取成功", $extra = [])
    {
        $this->parseNull($data);
        return result(0, $data, $message, $extra);
    }


    //失败返回
    public function error($message = "fail",$code = 1, $data = [])
    {
        return result($code, $data, $message);
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