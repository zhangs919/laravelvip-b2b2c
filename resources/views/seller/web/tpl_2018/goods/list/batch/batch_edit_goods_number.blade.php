<div id="{{ $uuid }}" class="modal-body">
    <form id="form1" class="form-horizontal" name="Goods" action="/goods/list/batch-edit-goods-number?ids={{ $goods_ids }}" method="POST">
        @csrf
        <div class="simple-form-field">
            <div class="form-group">
                <label for="skumember-member_type" class="col-sm-3 w100 control-label">
                    <span class="ng-binding">调整机制：</span>
                </label>
                <div class="col-sm-9">
                    <div class="form-control-box">
                        <input type="hidden" name="Goods[adj_mec]" value="0">
                        <div id="skumember-member_type"  name="Goods[adj_mec]" selection="0">
                            <label class="control-label cur-p m-r-20"><input type="radio" name="Goods[adj_mec]" value="0" checked=""> 累加</label>
                            <label class="control-label cur-p m-r-10"><input type="radio" name="Goods[adj_mec]" value="1"> 覆盖</label>
                        </div>
                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="simple-form-field">
            <div class="form-group">
                <label class="col-sm-3 w100 control-label">库存数量：</label>
                <div class="col-sm-9">
                    <div class="form-control-box">
                        <input class="form-control batch-value m-r-5 w100 start-num" type="number" name="Goods[goods_number]">
                        <!--错误提示模块 star-->
                        <div class="member-handle-error"></div>
                        <!--错误提示模块 end-->
                    </div>
                    <div class="help-block help-block-t">
                        <div class="help-block help-block-t">调整商品sku库存数量</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 提交 -->
        <div class="modal-footer m-t-30 text-c">
            <a id="btn_submit_goods_number" class="btn btn-primary">确认提交</a>
        </div>
        <input type='hidden' id='goods_ids' value={{ $goods_ids }} />
    </form>
</div>
<!-- 验证规则 -->
<script id="client_rules" type="text">
[{"id": "goods-cat_id1", "name": "Goods[cat_id1]", "attribute": "cat_id1", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Cat Id1必须是整数。"}}},{"id": "goods-cat_id2", "name": "Goods[cat_id2]", "attribute": "cat_id2", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Cat Id2必须是整数。"}}},{"id": "goods-cat_id3", "name": "Goods[cat_id3]", "attribute": "cat_id3", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Cat Id3必须是整数。"}}},{"id": "goods-pricing_mode", "name": "Goods[pricing_mode]", "attribute": "pricing_mode", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"计价方式必须是整数。"}}},{"id": "goods-goods_unit", "name": "Goods[goods_unit]", "attribute": "goods_unit", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品单位必须是整数。"}}},{"id": "goods-is_cross_border", "name": "Goods[is_cross_border]", "attribute": "is_cross_border", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否跨境商品必须是整数。"}}},{"id": "goods-shipper_id", "name": "Goods[shipper_id]", "attribute": "shipper_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Shipper Id必须是整数。"}}},{"id": "goods-sku_mode", "name": "Goods[sku_mode]", "attribute": "sku_mode", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Sku Mode必须是整数。"}}},{"id": "goods-is_pickup", "name": "Goods[is_pickup]", "attribute": "is_pickup", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Is Pickup必须是整数。"}}},{"id": "goods-is_common_package", "name": "Goods[is_common_package]", "attribute": "is_common_package", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Is Common Package必须是整数。"}}},{"id": "goods-pickup_timeout", "name": "Goods[pickup_timeout]", "attribute": "pickup_timeout", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品自提超时期限必须是整数。"}}},{"id": "goods-pickup_timeout_type", "name": "Goods[pickup_timeout_type]", "attribute": "pickup_timeout_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Pickup Timeout Type必须是整数。"}}},{"id": "goods-filter_attr_ids", "name": "Goods[filter_attr_ids]", "attribute": "filter_attr_ids", "rules": {"string":true,"messages":{"string":"Filter Attr Ids必须是一条字符串。"}}},{"id": "goods-filter_attr_vids", "name": "Goods[filter_attr_vids]", "attribute": "filter_attr_vids", "rules": {"string":true,"messages":{"string":"Filter Attr Vids必须是一条字符串。"}}},{"id": "goods-goods_stockcode", "name": "Goods[goods_stockcode]", "attribute": "goods_stockcode", "rules": {"string":true,"messages":{"string":"商品库位码必须是一条字符串。"}}},{"id": "goods-goods_name", "name": "Goods[goods_name]", "attribute": "goods_name", "rules": {"required":true,"messages":{"required":"商品名称不能为空。"}}},{"id": "goods-cat_id", "name": "Goods[cat_id]", "attribute": "cat_id", "rules": {"required":true,"messages":{"required":"商品分类不能为空。"}}},{"id": "goods-shop_id", "name": "Goods[shop_id]", "attribute": "shop_id", "rules": {"required":true,"messages":{"required":"店铺ID不能为空。"}}},{"id": "goods-goods_price", "name": "Goods[goods_price]", "attribute": "goods_price", "rules": {"required":true,"messages":{"required":"店铺价不能为空。"}}},{"id": "goods-goods_number", "name": "Goods[goods_number]", "attribute": "goods_number", "rules": {"required":true,"messages":{"required":"商品库存不能为空。"}}},{"id": "goods-add_time", "name": "Goods[add_time]", "attribute": "add_time", "rules": {"required":true,"messages":{"required":"商品发布时间不能为空。"}}},{"id": "goods-last_time", "name": "Goods[last_time]", "attribute": "last_time", "rules": {"required":true,"messages":{"required":"最后一次更新时间不能为空。"}}},{"id": "goods-freight_id", "name": "Goods[freight_id]", "attribute": "freight_id", "rules": {"required":true,"messages":{"required":"运费模板不能为空。"}}},{"id": "goods-sku_open", "name": "Goods[sku_open]", "attribute": "sku_open", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Sku Open必须是整数。"}}},{"id": "goods-prop_open", "name": "Goods[prop_open]", "attribute": "prop_open", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Prop Open必须是整数。"}}},{"id": "goods-sku_id", "name": "Goods[sku_id]", "attribute": "sku_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Sku Id必须是整数。"}}},{"id": "goods-cat_id", "name": "Goods[cat_id]", "attribute": "cat_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品分类必须是整数。"}}},{"id": "goods-shop_id", "name": "Goods[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"店铺ID必须是整数。"}}},{"id": "goods-invoice_type", "name": "Goods[invoice_type]", "attribute": "invoice_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"发票必须是整数。"}}},{"id": "goods-is_repair", "name": "Goods[is_repair]", "attribute": "is_repair", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"保修必须是整数。"}}},{"id": "goods-user_discount", "name": "Goods[user_discount]", "attribute": "user_discount", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"会员打折必须是整数。"}}},{"id": "goods-stock_mode", "name": "Goods[stock_mode]", "attribute": "stock_mode", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"库存计数必须是整数。"}}},{"id": "goods-goods_number", "name": "Goods[goods_number]", "attribute": "goods_number", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品库存必须是整数。"}}},{"id": "goods-warn_number", "name": "Goods[warn_number]", "attribute": "warn_number", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"库存警告数量必须是整数。"}}},{"id": "goods-brand_id", "name": "Goods[brand_id]", "attribute": "brand_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"品牌必须是整数。"}}},{"id": "goods-top_layout_id", "name": "Goods[top_layout_id]", "attribute": "top_layout_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品顶部模板编号必须是整数。"}}},{"id": "goods-bottom_layout_id", "name": "Goods[bottom_layout_id]", "attribute": "bottom_layout_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品底部模板编号必须是整数。"}}},{"id": "goods-packing_layout_id", "name": "Goods[packing_layout_id]", "attribute": "packing_layout_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Packing Layout Id必须是整数。"}}},{"id": "goods-service_layout_id", "name": "Goods[service_layout_id]", "attribute": "service_layout_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Service Layout Id必须是整数。"}}},{"id": "goods-click_count", "name": "Goods[click_count]", "attribute": "click_count", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品浏览次数必须是整数。"}}},{"id": "goods-goods_audit", "name": "Goods[goods_audit]", "attribute": "goods_audit", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"审核是否通过必须是整数。"}}},{"id": "goods-goods_status", "name": "Goods[goods_status]", "attribute": "goods_status", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品状态必须是整数。"}}},{"id": "goods-is_delete", "name": "Goods[is_delete]", "attribute": "is_delete", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否已删除必须是整数。"}}},{"id": "goods-is_virtual", "name": "Goods[is_virtual]", "attribute": "is_virtual", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"虚拟商品必须是整数。"}}},{"id": "goods-is_best", "name": "Goods[is_best]", "attribute": "is_best", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否精品必须是整数。"}}},{"id": "goods-is_new", "name": "Goods[is_new]", "attribute": "is_new", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否新品必须是整数。"}}},{"id": "goods-is_hot", "name": "Goods[is_hot]", "attribute": "is_hot", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否热卖必须是整数。"}}},{"id": "goods-is_promote", "name": "Goods[is_promote]", "attribute": "is_promote", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否促销必须是整数。"}}},{"id": "goods-supplier_id", "name": "Goods[supplier_id]", "attribute": "supplier_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"供货商ID必须是整数。"}}},{"id": "goods-freight_id", "name": "Goods[freight_id]", "attribute": "freight_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"运费模板必须是整数。"}}},{"id": "goods-goods_sort", "name": "Goods[goods_sort]", "attribute": "goods_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。"}}},{"id": "goods-audit_time", "name": "Goods[audit_time]", "attribute": "audit_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Audit Time必须是整数。"}}},{"id": "goods-add_time", "name": "Goods[add_time]", "attribute": "add_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品发布时间必须是整数。"}}},{"id": "goods-last_time", "name": "Goods[last_time]", "attribute": "last_time", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"最后一次更新时间必须是整数。"}}},{"id": "goods-comment_num", "name": "Goods[comment_num]", "attribute": "comment_num", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品评论次数必须是整数。"}}},{"id": "goods-sale_num", "name": "Goods[sale_num]", "attribute": "sale_num", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品销售数量必须是整数。"}}},{"id": "goods-collect_num", "name": "Goods[collect_num]", "attribute": "collect_num", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品收藏数量必须是整数。"}}},{"id": "goods-sales_model", "name": "Goods[sales_model]", "attribute": "sales_model", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"销售模式必须是整数。"}}},{"id": "goods-erp_goods_id", "name": "Goods[erp_goods_id]", "attribute": "erp_goods_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Erp Goods Id必须是整数。"}}},{"id": "goods-is_sync_price", "name": "Goods[is_sync_price]", "attribute": "is_sync_price", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Is Sync Price必须是整数。"}}},{"id": "goods-is_sync_stock", "name": "Goods[is_sync_stock]", "attribute": "is_sync_stock", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Is Sync Stock必须是整数。"}}},{"id": "goods-goods_mode", "name": "Goods[goods_mode]", "attribute": "goods_mode", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品类别必须是整数。"}}},{"id": "goods-cs_dg_id", "name": "Goods[cs_dg_id]", "attribute": "cs_dg_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Cs Dg Id必须是整数。"}}},{"id": "goods-cover_image", "name": "Goods[cover_image]", "attribute": "cover_image", "rules": {"string":true,"messages":{"string":"封面图片必须是一条字符串。"}}},{"id": "goods-goods_images", "name": "Goods[goods_images]", "attribute": "goods_images", "rules": {"string":true,"messages":{"string":"Goods Images必须是一条字符串。"}}},{"id": "goods-button_name", "name": "Goods[button_name]", "attribute": "button_name", "rules": {"string":true,"messages":{"string":"按钮名称必须是一条字符串。"}}},{"id": "goods-button_url", "name": "Goods[button_url]", "attribute": "button_url", "rules": {"string":true,"messages":{"string":"按钮链接必须是一条字符串。"}}},{"id": "goods-goods_price", "name": "Goods[goods_price]", "attribute": "goods_price", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"店铺价必须是一个数字。","decimal":"店铺价必须是一个不大于2位小数的数字。","min":"店铺价必须不小于0。","max":"店铺价必须不大于9999999。"},"decimal":2,"min":0,"max":9999999}},{"id": "goods-market_price", "name": "Goods[market_price]", "attribute": "market_price", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"市场价必须是一个数字。","decimal":"市场价必须是一个不大于2位小数的数字。","min":"市场价必须不小于0。","max":"市场价必须不大于9999999。"},"decimal":2,"min":0,"max":9999999}},{"id": "goods-goods_sort", "name": "Goods[goods_sort]", "attribute": "goods_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于9999。"},"min":0,"max":9999}},{"id": "goods-warn_number", "name": "Goods[warn_number]", "attribute": "warn_number", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"库存警告数量必须是整数。","min":"库存警告数量必须不小于0。"},"min":0}},{"id": "goods-pickup_timeout", "name": "Goods[pickup_timeout]", "attribute": "pickup_timeout", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品自提超时期限必须是整数。","min":"商品自提超时期限必须不小于0。"},"min":0}},{"id": "goods-goods_number", "name": "Goods[goods_number]", "attribute": "goods_number", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"商品库存必须是整数。","min":"商品库存必须不小于0。","max":"商品库存必须不大于999999999。"},"min":0,"max":999999999}},{"id": "goods-cost_price", "name": "Goods[cost_price]", "attribute": "cost_price", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"成本价必须是一个数字。","decimal":"成本价必须是一个不大于2位小数的数字。","min":"成本价必须不小于0。","max":"成本价必须不大于9999999。"},"decimal":2,"min":0,"max":9999999}},{"id": "goods-mobile_price", "name": "Goods[mobile_price]", "attribute": "mobile_price", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"移动端专项价必须是一个数字。","decimal":"移动端专项价必须是一个不大于2位小数的数字。","min":"移动端专项价必须不小于0。","max":"移动端专项价必须不大于9999999。"},"decimal":2,"min":0,"max":9999999}},{"id": "goods-pc_desc", "name": "Goods[pc_desc]", "attribute": "pc_desc", "rules": {"string":true,"messages":{"string":"商品电脑端描述必须是一条字符串。"}}},{"id": "goods-mobile_desc", "name": "Goods[mobile_desc]", "attribute": "mobile_desc", "rules": {"string":true,"messages":{"string":"商品手机端描述必须是一条字符串。"}}},{"id": "goods-contract_ids", "name": "Goods[contract_ids]", "attribute": "contract_ids", "rules": {"string":true,"messages":{"string":"保障服务必须是一条字符串。"}}},{"id": "goods-goods_name", "name": "Goods[goods_name]", "attribute": "goods_name", "rules": {"string":true,"messages":{"string":"商品名称必须是一条字符串。","minlength":"商品名称应该包含至少1个字符。","maxlength":"商品名称只能包含至多100个字符。"},"minlength":1,"maxlength":100}},{"id": "goods-goods_subname", "name": "Goods[goods_subname]", "attribute": "goods_subname", "rules": {"string":true,"messages":{"string":"商品卖点必须是一条字符串。","maxlength":"商品卖点只能包含至多255个字符。"},"maxlength":255}},{"id": "goods-goods_image", "name": "Goods[goods_image]", "attribute": "goods_image", "rules": {"string":true,"messages":{"string":"商品主图必须是一条字符串。","maxlength":"商品主图只能包含至多255个字符。"},"maxlength":255}},{"id": "goods-goods_video", "name": "Goods[goods_video]", "attribute": "goods_video", "rules": {"string":true,"messages":{"string":"主图视频必须是一条字符串。","maxlength":"主图视频只能包含至多255个字符。"},"maxlength":255}},{"id": "goods-keywords", "name": "Goods[keywords]", "attribute": "keywords", "rules": {"string":true,"messages":{"string":"关键词必须是一条字符串。","maxlength":"关键词只能包含至多255个字符。"},"maxlength":255}},{"id": "goods-goods_info", "name": "Goods[goods_info]", "attribute": "goods_info", "rules": {"string":true,"messages":{"string":"商品简介必须是一条字符串。","maxlength":"商品简介只能包含至多255个字符。"},"maxlength":255}},{"id": "goods-goods_reason", "name": "Goods[goods_reason]", "attribute": "goods_reason", "rules": {"string":true,"messages":{"string":"下架的原因必须是一条字符串。","maxlength":"下架的原因只能包含至多255个字符。"},"maxlength":255}},{"id": "goods-goods_volume", "name": "Goods[goods_volume]", "attribute": "goods_volume", "rules": {"string":true,"messages":{"string":"物流体积(m3)必须是一条字符串。","maxlength":"物流体积(m3)只能包含至多255个字符。"},"maxlength":255}},{"id": "goods-goods_weight", "name": "Goods[goods_weight]", "attribute": "goods_weight", "rules": {"string":true,"messages":{"string":"物流重量(Kg)必须是一条字符串。","maxlength":"物流重量(Kg)只能包含至多255个字符。"},"maxlength":255}},{"id": "goods-goods_remark", "name": "Goods[goods_remark]", "attribute": "goods_remark", "rules": {"string":true,"messages":{"string":"商品备注必须是一条字符串。","maxlength":"商品备注只能包含至多255个字符。"},"maxlength":255}},{"id": "goods-goods_sn", "name": "Goods[goods_sn]", "attribute": "goods_sn", "rules": {"string":true,"messages":{"string":"商品货号必须是一条字符串。","maxlength":"商品货号只能包含至多60个字符。"},"maxlength":60}},{"id": "goods-goods_barcode", "name": "Goods[goods_barcode]", "attribute": "goods_barcode", "rules": {"string":true,"messages":{"string":"商品条形码必须是一条字符串。","maxlength":"商品条形码只能包含至多1,500个字符。"},"maxlength":1500}},{"id": "goods-invoice_type", "name": "Goods[invoice_type]", "attribute": "invoice_type", "rules": {"in":{"range":["0","1","2","3"]},"messages":{"in":"发票是无效的。"}}},{"id": "goods-is_repair", "name": "Goods[is_repair]", "attribute": "is_repair", "rules": {"in":{"range":["0","1"]},"messages":{"in":"保修是无效的。"}}},{"id": "goods-user_discount", "name": "Goods[user_discount]", "attribute": "user_discount", "rules": {"in":{"range":["0","1"]},"messages":{"in":"会员打折是无效的。"}}},{"id": "goods-stock_mode", "name": "Goods[stock_mode]", "attribute": "stock_mode", "rules": {"in":{"range":["0","1","2"]},"messages":{"in":"库存计数是无效的。"}}},{"id": "goods-goods_status", "name": "Goods[goods_status]", "attribute": "goods_status", "rules": {"in":{"range":["-1","0","1","2"]},"messages":{"in":"商品状态是无效的。"}}},{"id": "goods-goods_freight_type", "name": "Goods[goods_freight_type]", "attribute": "goods_freight_type", "rules": {"in":{"range":["0","1","2"]},"messages":{"in":"运费设置是无效的。"}}},{"id": "goods-goods_freight_fee", "name": "Goods[goods_freight_fee]", "attribute": "goods_freight_fee", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"商品固定运费必须是一个数字。","decimal":"商品固定运费必须是一个不大于2位小数的数字。","min":"商品固定运费必须不小于0。","max":"商品固定运费必须不大于9999999。"},"decimal":2,"min":0,"max":9999999}},{"id": "goods-goods_name", "name": "Goods[goods_name]", "attribute": "goods_name", "rules": {"string":true,"messages":{"string":"商品名称必须是一条字符串。","match":"商品名称中含有非法字符"},"match":{"pattern":/<|>|<script|<img|<svg|alert|prompt|cookie|@eval|@ini_set|@set_time_limit|\$_SERVER|@set_magic_quotes_runtime/,"not":true}}},{"id": "goods-goods_subname", "name": "Goods[goods_subname]", "attribute": "goods_subname", "rules": {"string":true,"messages":{"string":"商品卖点必须是一条字符串。","match":"商品卖点中含有非法字符"},"match":{"pattern":/<|>|<script|<img|<svg|alert|prompt|cookie|@eval|@ini_set|@set_time_limit|\$_SERVER|@set_magic_quotes_runtime/,"not":true}}},{"id": "goods-goods_info", "name": "Goods[goods_info]", "attribute": "goods_info", "rules": {"string":true,"messages":{"string":"商品简介必须是一条字符串。","match":"商品简介中含有非法字符"},"match":{"pattern":/<|>|<script|<img|<svg|alert|prompt|cookie|@eval|@ini_set|@set_time_limit|\$_SERVER|@set_magic_quotes_runtime/,"not":true}}},{"id": "goods-remark", "name": "Goods[remark]", "attribute": "remark", "rules": {"string":true,"messages":{"string":"Remark必须是一条字符串。","match":"Remark中含有非法字符"},"match":{"pattern":/<|>|<script|<img|<svg|alert|prompt|cookie|@eval|@ini_set|@set_time_limit|\$_SERVER|@set_magic_quotes_runtime/,"not":true}}},{"id": "goods-pc_desc", "name": "Goods[pc_desc]", "attribute": "pc_desc", "rules": {"string":true,"messages":{"string":"商品电脑端描述必须是一条字符串。"}}},{"id": "goods-mobile_desc", "name": "Goods[mobile_desc]", "attribute": "mobile_desc", "rules": {"string":true,"messages":{"string":"商品手机端描述必须是一条字符串。"}}}]
</script>
<script type="text/javascript">
    //
</script>
<script>

    function start_number_callback(element, value) {
        var member_type = $("#{{ $uuid }}").find('input[name="SkuMember[member_type]"]:checked ').val();
        if ($(element).val().length == 0) {
            return true;
        }
        if (member_type == 0) {
            if ($(element).val() * $(element).data('goods_price') < 0.1) {
                $(element).data("msg", '折扣后的金额不能小于0.01元');
                return false;
            } else if ($(element).val() >= 10) {
                $(element).data("msg", '折扣后的金额不能大于正常售价');
                return false;
            } else {
                return true;
            }
        } else if (member_type == 1) {
            if ($(element).val() * 100 >= $(element).data('goods_price') * 100) {
                $(element).data("msg", '最大减价金额必须小于正常售价');
                return false;
            } else if ($(element).val() < 0) {
                $(element).data("msg", '设置的减价金额不能小于0.01元');
                return false;
            } else {
                return true;
            }
        } else if (member_type == 2) {
            console.info($(element).val());
            if ($(element).val() * 100 < 1) {
                $(element).data("msg", '指定的会员价不能小于0.01元');
                return false;
            } else if ($(element).val() * 100 > $(element).data('goods_price') * 100) {
                $(element).data("msg", '指定的会员价必须小于正常售价');
                return false;
            } else {
                return true;
            }
        }
    }
    var validator = null;
    $().ready(function() {
        /**
         * 初始化validator默认值
         */
        var _errorPlacement = $.validator.defaults.errorPlacement;
        var _success = $.validator.defaults.success;
        $.validator.setDefaults({
            errorPlacement: function(error, element) {
                var error_id = $(error).attr("id");
                var error_msg = $(error).text();
                var element_id = $(error).attr("for");
                if (!error_msg && error_msg == "") {
                    return;
                }
                if ($(element).parents(".member-container").find(".member-handle-error").find("div").size() == 0) {
                    $(".member-handle-error").html("<div class='form-control-warning error m-t-10'></div>");
                }
                var error_dom = $("<p id='"+error_id+"'><i class='fa fa-times-circle'></i><span class='error-msg'>" + error_msg + "</span></p>");
                $("#{{ $uuid }}").find(".member-handle-error").find("div").append(error_dom);
            },
// 失去焦点验证
            onfocusout: function(element) {
                $(element).valid();
            },
// 成功后移除错误提示
            success: function(error, element) {
                var error_id = $(error).attr("id");
                var error_msg = $(error).text();
                var element_id = $(error).attr("for");
                var sku = $(this).data('sku_id');
                var rank = $(this).data('rank_id');
                if ($(element).parents(".member-container").size() > 0) {
                    $("#{{ $uuid }}").find("[id='" + error_id + sku + rank + "']").remove();
                }
                if ($(element).parents(".member-container").find(".member-handle-error").find("p").size() == 0) {
                    $("#{{ $uuid }}").find('.form-control-warning').remove();
//$(element).parents(".member-container").find(".member-handle-error").find("div").remove();
                }
                _success.call(this, error, element);
            }
        });
        var validator = $("#form1").validate();
// 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#client_rules").html());

//提交
        $("#{{ $uuid }}").find("#btn_submit_goods_number").click(function() {

            $.loading.start();

            var data = $("#form1").serializeJson();
            var goods_ids = $("#goods_ids").val();

            $.post("/goods/list/batch-edit-goods-number", {
                data:data,
                goods_ids:goods_ids
            }, function(result) {
                if (result.code == 0) {
// 关闭对话框
                    $("#{{ $uuid }}").parents(".layui-layer").find(".layui-layer-close").click();
// 显示信息
                    $.msg(result.message, {
                        time: 1500
                    }, function() {
                        if (typeof (tablelist) != "undefined" && tablelist) {
                            tablelist.load();
                        } else {
                            $.go('/goods/list');
                        }
                    });
                } else {
                    $.msg(result.message, {
                        time: 5000
                    });
                }
            }, "json").always(function() {
                $.loading.stop();
            });

        });
//批量设置
        $("#{{ $uuid }}").find(".batch-submit").click(function() {
            var rank_id = $('.rank-select option:selected').val();//选中的值
            var batch_value = $(".batch-value").val();

            if (!batch_value) {
                return;
            }
            if (rank_id == 0) {
                $("#{{ $uuid }}").find(".start-num").each(function() {
                    $(this).val(batch_value);
                });
            } else {
                $("#{{ $uuid }}").find(".start-num").each(function() {
                    if ($(this).data('rank_id') == rank_id) {
                        $(this).val(batch_value);
                    }
                });
            }
            var is_valid = true;

            var member_data = '';
            $("#{{ $uuid }}").find(".start-num").each(function() {
                if (rank_id == 0) {
                    member_data += $(this).data('sku_id') + '_' + $(this).data('rank_id') + '_' + $(this).val() + ',';
                    if ($(this).valid() == false) {
                        is_valid = false;
                    }
                } else {
                    if ($(this).data('rank_id') == rank_id) {
                        member_data += $(this).data('sku_id') + '_' + $(this).data('rank_id') + '_' + $(this).val() + ',';
                        if ($(this).valid() == false) {
                            is_valid = false;
                        }
                    }
                }
            });

            /* if (!is_valid || !validator.form()) {
            return;
            } */

        });
//清空
        $("#{{ $uuid }}").find(".clear-all").click(function() {
            $("#{{ $uuid }}").find(".start-num").each(function() {
                $(this).val('');
            });
        });
    });

    //
</script>