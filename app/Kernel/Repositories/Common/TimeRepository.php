<?php

namespace App\Kernel\Repositories\Common;


use DateTime;
use DateTimeZone;

/**
 * Class TimeRepository
 * @package App\Kernel\Repositories\Common
 */
class TimeRepository
{
    /**
     * 获得当前格林威治时间的时间戳
     * @return int
     */
    public static function getGmTime()
    {
//        $date = new DateTime('now', new DateTimeZone('UTC'));
//        return $date->getTimestamp(); // 北京时间
//        date_default_timezone_set(self::getServerTimezone());
        return time();
//        return strtotime(gmdate("Y-m-d H:i:s")) + 8*3600; // 格林威治时间+8小时=北京时间
    }

    /**
     * 获得服务器的时区
     * @return string
     */
    public static function getServerTimezone()
    {
        return date_default_timezone_get();
    }

    /**
     * 生成一个用户自定义时区日期的GMT时间戳
     * @param null $hour
     * @param null $minute
     * @param null $second
     * @param null $month
     * @param null $day
     * @param null $year
     */
    public static function getLocalMktime($hour = null, $minute = null, $second = null, $month = null, $day = null, $year = null)
    {

    }

    public static function getLocalDate($format, $time = null)
    {
        return date($format, $time);
    }

    public static function getGmstrTime($str)
    {

    }

    public static function getLocalStrtoTime($str)
    {
        return strtotime($str);
    }

    public static function getLocalGettime($timestamp = null)
    {

    }

    public static function getLocalGetDate($timestamp = null)
    {

    }

    public static function getCalDaysInMonth($calendar, $month, $year)
    {
        return cal_days_in_month($calendar, $month, $year);
    }

    public static function getCacheTime($date = 1)
    {

    }

    public static function getMdate($time = 0)
    {

    }

    public static function getBuyDate($time = 0)
    {

    }

    /**
     * @param string $date
     * @param string[] $arr_week
     * @return mixed
     */
    public static function transitionDate($date = '', $arr_week = ["日", "一", "二", "三", "四", "五", "六"]): string
    {
        //强制转换日期格式
        $date_str=date('Y-m-d',strtotime($date));
        //封装成数组
        $arr=explode("-", $date_str);
        //参数赋值
        //年
        $year=$arr[0];
        //月，输出2位整型，不够2位右对齐
        $month=sprintf('%02d',$arr[1]);
        //日，输出2位整型，不够2位右对齐
        $day=sprintf('%02d',$arr[2]);
        //时分秒默认赋值为0；
        $hour = $minute = $second = 0;
        //转换成时间戳
        $strap = mktime($hour,$minute,$second,$month,$day,$year);
        //获取数字型星期几
        $number_wk=date("w",$strap);
        //获取数字对应的星期
        return $arr_week[$number_wk];
    }

    public static function timePeriod($period = 0, $pros_cons = '-', $number = 0)
    {

    }

}
