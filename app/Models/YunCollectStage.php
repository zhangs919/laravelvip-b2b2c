<?php

namespace App\Models;

/**
 * 该表的内容暂时已利用缓存技术完成 没有用到此表
 *
 * Class YunCollectStage
 * @package App\Models
 */
class YunCollectStage extends BaseModel
{
    protected $table = 'yun_collect_stage';

    /**
     * ID 第三方ID号[third_id] 商品名称[goods_name] 商品价格[goods_price] 评论数[comment_num]
     *
     * @var array
     */
    protected $fillable = [
        'site_id','shop_id','third_goods_id','goods_name','goods_image','goods_price','comment_num','link_url','collect_status'
    ];

    protected $primaryKey = 'ycs_id';


}
