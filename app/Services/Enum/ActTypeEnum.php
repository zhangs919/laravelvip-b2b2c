<?php


namespace App\Services\Enum;

/**
 * 活动类型枚举类
 *
 * Class ActTypeEnum
 * @package App\Services\Enum
 */
class ActTypeEnum
{
    const ACT_TYPE_AUCTION = 1; // 拍卖
    const ACT_TYPE_PRE_SALE = 2; // 预售
    const ACT_TYPE_GROUP_BUY = 3; // 团购
    const ACT_TYPE_EXCHANGE = 5; // 积分兑换
    const ACT_TYPE_FIGHT_GROUP = 6; // 拼团
    const ACT_TYPE_BARGAIN = 8; // 砍价
    const ACT_TYPE_GOODS_MIX = 10; // 搭配套餐
    const ACT_TYPE_LIMIT_DISCOUNT = 11; // 限时折扣
    const ACT_TYPE_FULLCUT = 12; // 满减送
    const ACT_TYPE_GIFT = 13; // 赠品活动
    const ACT_TYPE_LIVE = 14; // 直播
    const ACT_TYPE_PURCHASE = 15; // 限购
    const ACT_TYPE_FIXED_PRICE = 17; // 打包一口价
    const ACT_TYPE_SECOND_HALF_PRICE = 21; // 第"2"件半价
}