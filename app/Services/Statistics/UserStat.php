<?php


namespace App\Services\Statistics;


use Illuminate\Support\Facades\Redis;

/**
 * 用户统计相关
 * Class UserStat
 * @package App\Services\Statistics
 */
class UserStat
{
    const KEY = "new_reg_";

    /**
     * 新用户增加
     * @param $user_id
     * @return mixed
     */
    public static function incr($user_id)
    {
        return Redis::setbit(self::KEY.date('Ymd'), $user_id, 1);
    }


    /**
     * 获取最近10天用户增长数据
     * @return array
     */
    public static function getRecentTenDays(): array
    {
        $data = [];
        for ($i = 10; $i > 0; $i--) {
            $data['x'][] = date("m月d日",strtotime("-$i day"));
            $data['y'][] = Redis::bitcount(self::KEY.date("Ymd",strtotime("-$i day")));
        }
        return $data;
    }
}