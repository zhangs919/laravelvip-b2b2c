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
// | Date:2018-12-4
// | Description:
// +----------------------------------------------------------------------

namespace App\Models;

/**
 * 活动模型
 *
 * Class Activity
 * @package App\Models
 */
class Activity extends BaseModel
{


    protected $table = 'activity';

    /**
     * ext_info 序列化 数据如:"{\"discount\":{\"2\":{\"reduce_cash\":\"1\"}},\"bonus_list\":null,\"gift_list\":null,\"use_range_check\":\"0\",\"use_range\":\"0\"}"
     *
     * act_type 1-拍卖 2-预售 3-团购
     * 5-积分兑换
     * 6-拼团 8-砍价 10-搭配套餐 11-限时折扣 12-满减送 13-赠品活动
     * 14-直播 15-限购 17-打包一口价
     * 21-第"2"件半价
     *
     * @var array
     */
    protected $fillable = [
        'act_name','act_title','act_type','act_img','start_time','end_time',
        'is_finish','purchase_num','status','is_recommend',
        'create_user_id','shop_id','site_id','ext_info','use_range','sort','reason',
        'act_ext_info'

        /*2-预售*/ // 预售表对活动表 一对一
//        'id','act_id','sku_id','goods_id','cat_id','sale_base','act_price', 'act_stock', 'click_count',
//        'shop_name','goods_name','goods_image','goods_price', 不存表
//        "ext_info": "a:7:{s:13:\"pre_sale_mode\";s:1:\"2\";s:17:\"deliver_time_type\";s:1:\"0\";s:12:\"deliver_time\";s:1:\"3\";s:9:\"act_price\";a:4:{i:1089;s:2:\"12\";i:1090;s:1:\"2\";i:1091;s:1:\"3\";i:1092;s:1:\"5\";}s:13:\"earnest_money\";N;s:10:\"tail_money\";N;s:7:\"sku_ids\";a:4:{i:0;i:1089;i:1;i:1090;i:2;i:1091;i:3;i:1092;}}",
//        "act_ext_info":"a:9:{s:12:"groupon_mode";i:0;s:9:"fight_num";s:1:"3";s:10:"fight_time";s:1:"1";s:15:"fight_time_unit";s:1:"0";s:9:"is_gather";s:1:"1";s:10:"is_imitate";s:1:"0";s:21:"is_commander_discount";s:1:"0";s:18:"discount_over_used";s:3:"0,1";s:12:"groupon_rule";s:538:"1、拼团有效期内达到成团人数，则拼团成功；若在有效期内未达到成团人数，则拼团失败，订单关闭并自动退款；
//2、拼团有效期内，商品已提前售罄，则拼团失败；
//3、高峰期间，同时支付的人数过多，团人数有限制，以接收第三方支付信息时间先后为准，超出该团人数限制的部分用户，则会拼团失败；
//4、拼团失败的订单，系统会自动原路退款至支付账户中，如使用余额支付，则立即退回至余额中；";}"

        /*3-团购*/ // 活动表对商品表 一对多
//          "ext_info": null,

        /*6-拼团*/ // 拼团表对活动表 一对一
//        'id','act_id','sku_id','goods_id','cat_id','sale_base','act_price','act_stock','click_count'
//        "ext_info": "a:5:{s:9:\"fight_num\";s:1:\"3\";s:10:\"fight_time\";s:1:\"2\";s:13:\"discount_mode\";s:1:\"1\";s:14:\"first_discount\";N;s:14:\"discount_price\";s:3:\"0.2\";}",

        /*8-砍价*/ // 砍价表对活动表 一对一
//        'id','act_id','sku_id','goods_id','cat_id','sale_base','act_price','act_stock','click_count'
//        'shop_name','goods_name','goods_image','goods_price', 不存表
//        'act_data', 'part_num','sale_num' 不存表
//        "ext_info": "a:6:{s:12:\"bargain_time\";s:2:\"14\";s:17:\"bargain_min_price\";s:4:\"1.25\";s:17:\"bargain_max_price\";s:4:\"2.35\";s:10:\"is_bargain\";s:1:\"1\";s:15:\"is_help_bargain\";s:1:\"1\";s:14:\"original_price\";s:3:\"198\";}",


        /*10-搭配套餐*/ // 活动表对商品表 一对多
        //"ext_info": "a:3:{s:10:\"price_mode\";s:1:\"0\";s:9:\"act_price\";s:2:\"50\";s:13:\"discount_show\";s:1:\"1\";}",

        /*11-限时折扣*/ // 活动表对商品表 一对多
        // "ext_info": "{\"act_repeat\":\"0\",\"act_label\":\"8888\",\"limit_type\":\"1\",\"limit_num\":\"2\"}",

        /*12-满减送*/ // 活动表对商品表 一对多 全部商品/部分商品
        // "ext_info": "{\"discount\":{\"2\":{\"reduce_cash\":\"1\"}},\"bonus_list\":null,\"gift_list\":null,\"use_range_check\":\"0\",\"use_range\":\"0\"}",

        /*13-赠品活动*/ // 活动表对商品表 一对多
        // "ext_info": "{\"valid_data\":\"2\",\"gift_limit\":\"1\"}"

        // 以下字段动态获取 不存表
//        'shop_name','goods_count'
    ];

    protected $primaryKey = 'act_id';

    /**
     * 一对多关联 活动商品表
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function goodsActivity()
    {
        return $this->hasMany(GoodsActivity::class, 'act_id', 'act_id');
    }

    public function setStartTimeAttribute($value)
    {
        $this->attributes['start_time'] = is_int($value) ? $value : strtotime($value);
    }

    public function getStartTimeAttribute()
    {
        return date('Y-m-d H:i:s', $this->attributes['start_time']);
    }

    public function setEndTimeAttribute($value)
    {
        $this->attributes['end_time'] = is_int($value) ? $value : strtotime($value);
    }

    public function getEndTimeAttribute()
    {
        return date('Y-m-d H:i:s', $this->attributes['end_time']);
    }

    /**
     * 设置活动扩展数据 json_encode
     *
     * @param $value
     */
    public function setExtInfoAttribute($value)
    {
        $this->attributes['ext_info'] = json_encode($value);
    }

    /**
     * 获取活动扩展数据 json_decode
     *
     * @return mixed
     */
    public function getExtInfoAttribute()
    {
        return json_decode($this->attributes['ext_info'],true);
    }

    /**
     * 设置活动扩展数据 json_encode
     *
     * @param $value
     */
    public function setActExtInfoAttribute($value)
    {
        $this->attributes['act_ext_info'] = json_encode($value);
    }

    /**
     * 获取活动扩展数据 json_decode
     *
     * @return mixed
     */
    public function getActExtInfoAttribute()
    {
        return json_decode($this->attributes['act_ext_info'],true);
    }
}
