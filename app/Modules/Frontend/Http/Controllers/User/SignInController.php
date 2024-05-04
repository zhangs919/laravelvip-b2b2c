<?php

namespace App\Modules\Frontend\Http\Controllers\User;

use App\Modules\Base\Http\Controllers\UserCenter;
use Illuminate\Http\Request;

class SignInController extends UserCenter
{

    public function __construct()
    {
        parent::__construct();


    }

    public function info(Request $request)
    {
        // 获取数据
        $auto = $request->get('auto',0); // 是否自动签到

        $seo_title = '签到有礼！开启您的签到之旅~';
        $seo_description = '签到光荣榜，钜惠立享';
        $seo_image = request()->getScheme().'://'.config('lrw.mobile_domain').'/images/sign_icon.png';

        $continue_sign_in = 1; // 连续签到 天数
        $addup_sign_in = 1; // 累计签到 天数
        $show_cycle_days = null;
        // 签到日期数组 [{"y":2019,"m":9,"d":20}]
        $date_array = [
            [
                'y'=>2019,
                'm'=>9,
                'd'=>19
            ],
            [
                'y'=>2019,
                'm'=>9,
                'd'=>20
            ],
        ];
        $js_date = json_encode($date_array);
        $today_is_sign_in = true; // 今日是否已签到过
        $day_award = [
            'points'=>'1积分'
        ];
        // 连续签到可领取奖励列表
        $cycle_days_list = [
            3 => json_encode([
                1=>3,
                'points'=>'3积分'
            ]),
            7 => json_encode([
                1=>5,
                'points'=>'5积分'
            ])
        ];
        $sign_in_title = '签到';
        $sign_in_rule = [
            "1.每日签到可以获得日签奖励，在单个周期内连续签到可以获得连签奖励，同1个周期内最多可领取1次；\r",
            "2.每日最多可签到1次，断签则会重新计算连签天数；\r",
            "3.活动以及奖励最终解释权归商家所有。",
        ];
        $sign_in_back_pic = '';// 签到背景图
        $sign_in_back_color = ''; //签到背景颜色
        $start_time = "2019.10.14";
        $end_time = "2019.10.20";
        $is_push_message = false;
        $auto_signin = $auto;

        $compact = compact('seo_title','seo_description','seo_image','continue_sign_in',
            'addup_sign_in','show_cycle_days','js_date','today_is_sign_in','day_award','cycle_days_list',
            'sign_in_title','sign_in_rule','sign_in_back_pic','sign_in_back_color','start_time','end_time','is_push_message','auto_signin');
        $webData = []; // web端（pc、mobile）数据对象
        $data = [
            'app_prefix_data' => [
                'continue_sign_in' => $continue_sign_in,
                'addup_sign_in' => $addup_sign_in,
                'show_cycle_days' => $show_cycle_days,
                'js_date' => $js_date,
                'today_is_sign_in' => $today_is_sign_in,
                'day_award' => $day_award,
                'cycle_days_list' =>$cycle_days_list,
                'sign_in_title' => $sign_in_title,
                'sign_in_rule' => $sign_in_rule,
                'sign_in_back_pic' => $sign_in_back_pic,
                'sign_in_back_color' => $sign_in_back_color,
                'start_time' => $start_time,
                'end_time' => $end_time,
                'is_push_message' => $is_push_message,
                'auto_signin' => $auto_signin,
            ],
            'app_suffix_data' => [],
            'web_data' => $webData,
            'compact_data' => $compact,
            'tpl_view' => 'user.sign-in.info'
        ];
        $this->setData($data); // 设置数据
        return $this->displayData(); // 模板渲染及APP客户端返回数据
    }

    /**
     * 开始签到
     *
     * @param Request $request
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Throwable
     */
    public function go(Request $request)
    {
        // 判断今天是否已签到
        $todaySignIned = true;
        if ($todaySignIned) {
            return result(-1, null, '今天已经签到！');
        }

        $compact = compact(''); // todo
        $render = view('user.sign-in.go', $compact)->render();
        return result(0, $render, '签到成功');
    }


}