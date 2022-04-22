<?php

namespace App;

use App\Models\BaseModel;



class LibGoods extends BaseModel
{
    protected $table = 'lib_goods';

    protected $primaryKey = 'goods_id';

    /**
     * 与Goods表差不多
     *
     * mobile_desc [0=>['content'=>'图片,'type'=>1],0=>['content'=>'文字','type'=>0]]
     * @var array
     */
    protected $fillable = [
//        'cat_id','lib_cat_id','goods_name','goods_subname','keywords','brand_id','goods_price','market_price','cost_price','goods_sn'
//        ,'goods_barcode','goods_image','goods_video','pc_desc','mobile_desc','goods_status'
    ];
}
