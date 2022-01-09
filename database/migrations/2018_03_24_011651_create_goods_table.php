<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('goods_id');
            $table->char('goods_name', 60)->comment('商品名称');
            $table->unsignedInteger('cat_id')->comment('商品分类');
            $table->unsignedInteger('cat_id1')->default(0)->comment('商品一级分类');
            $table->unsignedInteger('cat_id2')->default(0)->comment('商品二级分类');
            $table->unsignedInteger('cat_id3')->default(0)->comment('商品三级分类');
            $table->unsignedInteger('shop_id')->default(0)->comment('店铺ID');
            $table->unsignedTinyInteger('sku_open')->default(0)->comment('Sku Open'); // todo
            $table->unsignedInteger('sku_id')->default(0)->comment('Sku Id'); // todo 前台默认获取的sku_id
            $table->char('goods_subname', 140)->nullable()->comment('商品卖点');
            $table->decimal('goods_price',10,2)->default('0.00')->comment('店铺价');
            $table->decimal('market_price',10,2)->default('0.00')->comment('市场价');
            $table->decimal('cost_price',10,2)->default('0.00')->comment('成本价');
            $table->decimal('mobile_price',10,2)->default('0.00')->comment('移动端专项价');
            $table->unsignedInteger('give_integral')->default(0)->comment('赠送积分');
            $table->unsignedInteger('goods_number')->default(0)->comment('商品库存');
            $table->unsignedInteger('warn_number')->default(0)->comment('库存警告数量');
            $table->char('goods_sn', 60)->nullable()->comment('商品货号');
            $table->longText('goods_barcode')->nullable()->comment('商品条形码 支持一品多码，多个条形码之间用逗号分隔');
            $table->string('goods_image')->nullable()->comment('商品主图');
            $table->longText('goods_images')->nullable()->comment('商品图片');
            $table->string('goods_video')->nullable()->comment('主图视频');
            $table->unsignedInteger('brand_id')->default(0)->comment('商品品牌');
            $table->longText('pc_desc')->nullable()->comment('商品电脑端描述');
            $table->longText('mobile_desc')->nullable()->comment('商品手机端描述');
            $table->unsignedSmallInteger('top_layout_id')->default(0)->comment('顶部模板');
            $table->unsignedSmallInteger('bottom_layout_id')->default(0)->comment('底部模板');
            $table->unsignedSmallInteger('packing_layout_id')->default(0)->comment('包装清单版式');
            $table->unsignedSmallInteger('service_layout_id')->default(0)->comment('售后保证版式');
            $table->unsignedInteger('click_count')->default(0)->comment('商品浏览次数');
            $table->string('keywords')->nullable()->comment('关键词');
            $table->string('goods_info')->nullable()->comment('商品简介');
            $table->tinyInteger('invoice_type')->default(0)->comment('发票类型 默认 0 0无 1增值税普通发票 2增值税专用发票 3增值税普通发票 和 增值税专用发票选择“无”则将不提供发票');
            $table->boolean('is_repair')->default(0)->comment('是否保修');
            $table->tinyInteger('user_discount')->default(0)->comment('会员打折');
            $table->tinyInteger('stock_mode')->default(0)->comment('库存计数 0拍下减库存 1付款减库存 2出库减库存');
            $table->unsignedInteger('comment_num')->default(0)->comment('商品评论次数');
            $table->unsignedInteger('sale_num')->default(0)->comment('商品销售数量');
            $table->unsignedInteger('collect_num')->default(0)->comment('商品收藏数量');
            $table->boolean('goods_audit')->default(0)->comment('审核是否通过');
            $table->tinyInteger('goods_status')->default(0)->comment('商品状态 默认1 0定时发布 1立即发布 2放入仓库');
            $table->string('goods_reason')->nullable()->comment('Goods Reason');
            $table->boolean('is_delete')->default(0)->comment('是否已删除');
            $table->boolean('is_virtual')->default(0)->comment('是否虚拟商品');
            $table->boolean('is_best')->default(0)->comment('是否精品');
            $table->boolean('is_new')->default(0)->comment('是否新品');
            $table->boolean('is_hot')->default(0)->comment('是否热卖');
            $table->boolean('is_promote')->default(0)->comment('是否促销');
            $table->string('contract_ids')->nullable()->comment('保障服务');
            $table->unsignedInteger('supplier_id')->default(0)->comment('供货商ID');
            $table->unsignedSmallInteger('freight_id')->default(0)->comment('运费模板');
            $table->tinyInteger('goods_freight_type')->default(0)->comment('运费设置');
            $table->decimal('goods_freight_fee',10,2)->default('0.00')->comment('固定运费');
            $table->string('goods_stockcode')->nullable()->comment('商品库位码');
            $table->string('goods_volume')->nullable()->comment('物流体积(m3)');
            $table->string('goods_weight')->nullable()->comment('物流重量(Kg)');
            $table->text('goods_remark')->nullable()->comment('商品备注 序列化存储');
            $table->unsignedInteger('goods_sort')->default(255)->comment('商品排序');
            $table->unsignedInteger('add_time')->default(0)->comment('商品发布时间');
            $table->unsignedInteger('last_time')->default(0)->comment('最后一次更新时间');
            $table->unsignedInteger('audit_time')->default(0)->comment('商品审核时间');
            $table->text('edit_items')->nullable()->comment('更多商品编辑项'); // 该字段是什么作用???
            $table->unsignedInteger('act_id')->default(0)->comment('活动id 默认0 0无活动');
            $table->unsignedInteger('goods_moq')->default(0)->comment('最小起订量');
            $table->unsignedInteger('lib_goods_id')->default(0)->comment('商品库商品id');
            $table->longText('other_attrs')->nullable()->comment('店铺自定义属性');
            $table->string('filter_attr_ids')->nullable()->comment('商品属性ids'); // todo 是否有用
            $table->string('filter_attr_vids')->nullable()->comment('商品属性值ids'); // todo 是否有用
            $table->char('button_name', 60)->nullable()->comment('按钮名称'); // todo
            $table->char('button_url', 200)->nullable()->comment('按钮链接'); // todo
            $table->unsignedInteger('pricing_mode')->default(0)->comment('计价方式 默认0 0计件 1计重');
            $table->unsignedInteger('goods_unit')->nullable()->comment('商品单位');
            $table->unsignedInteger('goods_tag')->default(0)->comment('商品标签');
            $table->tinyInteger('sales_model')->default(0)->comment('销售模式 默认0 0零售 1批发');
            $table->string('order_act_id')->nullable()->comment('order act id');
            $table->unsignedInteger('goods_mode')->default(0)->comment('商品类别 默认0 0实物商品（物流发货） 1电子卡券（无需物流） 2服务商品（无需物流）');

            $table->text('ext_info')->nullable()->comment('扩展字段信息'); // todo 不确定存储哪些信息
            $table->text('remark')->nullable()->comment('备注信息'); // todo 不确定存储什么备注
            $table->string('shop_cat_ids')->nullable()->comment('店铺内商品分类'); // todo 暂时这样存储店铺内分类id信息

            $table->string('other_cat_ids')->nullable()->comment('扩展分类');
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
        Schema::dropIfExists('goods');
    }
}
