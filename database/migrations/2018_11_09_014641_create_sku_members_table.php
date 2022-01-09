<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkuMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sku_member', function (Blueprint $table) {
            /*
             * CREATE TABLE `shop_sku_member` (
                  `sm_id` int(11) NOT NULL AUTO_INCREMENT,
                  `sku_id` int(11) unsigned NOT NULL COMMENT 'SKU编号',
                  `goods_commonid` int(11) NOT NULL COMMENT '商品公共id',
                  `store_id` int(11) NOT NULL COMMENT '店铺编号',
                  `store_rank_id` int(11) NOT NULL COMMENT '店铺会员等级编号',
                  `rank_id` int(11) DEFAULT NULL COMMENT '会员等级id',
                  `goods_price` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '商品价格',
                  `member_type` tinyint(3) NOT NULL DEFAULT '0' COMMENT '优惠类型',
                  `member_value` varchar(100) NOT NULL DEFAULT '0' COMMENT '优惠金额或折扣',
                  `member_data` longtext COMMENT '会员价数据',
                  PRIMARY KEY (`sm_id`)
                ) ENGINE=InnoDB AUTO_INCREMENT=1342 DEFAULT CHARSET=utf8;
            array:4 [
  "jsonData" => array:2 [
    "_token" => "o48TooIHbX1cr5vSBpDAOPQvgjcAagQ6YuVOnlHW"
    "SkuMember" => array:3 [
      "member_type" => "0"
      "member_value" => "2"
      "goods_price" => "45.00"
    ]
  ]
  "member_data" => "undefined_undefined_2,712_6_2,712_7_2,712_8_2,712_21_2,712_46_2,713_6_2,713_7_2,713_8_2,713_21_2,713_46_2,714_6_2,714_7_2,714_8_2,714_21_2,714_46_2,717_6_2,717_7_2,717_8_2,717_21_2,717_46_2,"
  "goods_id" => "128"
  "_csrf" => "o48TooIHbX1cr5vSBpDAOPQvgjcAagQ6YuVOnlHW"
]
             */
            $table->increments('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sku_member');
    }
}
