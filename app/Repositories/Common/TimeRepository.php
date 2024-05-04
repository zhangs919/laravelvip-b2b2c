<?php

namespace App\Repositories\Common;

use App\Kernel\Repositories\Common\TimeRepository as Base;


/**
 * Class TimeRepository
 * @method static getGmTime() 获得当前格林威治时间的时间戳
 * @method static getServerTimezone() 获得服务器的时区
 * @method static getLocalMktime($hour = null, $minute = null, $second = null, $month = null, $day = null, $year = null) 生成一个用户自定义时区日期的GMT时间戳
 * @method static getLocalDate($format, $time = null) 将GMT时间戳格式化为用户自定义时区日期
 * @method static getGmstrTime($str) 转换字符串形式的时间表达式为GMT时间戳
 * @method static getLocalStrtoTime($str) 将一个用户自定义时区的日期转为GMT时间戳
 * @method static getLocalGettime($timestamp = null) 获得用户所在时区指定的时间戳
 * @method static getLocalGetDate($timestamp = null) 获得用户所在时区指定的日期和时间信息
 * @method static getCalDaysInMonth($calendar, $month, $year) cal_days_in_month PHP系统自带的函数
 * @method static getCacheTime($date = 1) 缓存时间
 * @method static getMdate($time = 0) 格式化时间函数
 * @method static getBuyDate($time = 0) 转换时间戳的具体时间
 * @method static transitionDate($date = '', $arr_week = ["日", "一", "二", "三", "四", "五", "六"]) 获取指定年月日是星期几
 * @method static timePeriod($period = 0, $pros_cons = '-', $number = 0) 时间周期--时间戳[1:一年|2:半年|3:三个月|4:一个月|5:半个月|6:一周|7:$number-自定义年数|8:$number-自定义月数|9:$number-自定义天数|10:$number-自定义小时数|11:$number-自定义分钟数]
 * @package App\Repositories\Common
 */
class TimeRepository extends Base
{

}
