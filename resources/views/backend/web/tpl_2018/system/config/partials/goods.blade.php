<!-- 表单验证 -->
<script src="/assets/d2eace91/js/validate/jquery.validate.js?v=1.2"></script>
<script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.2"></script>
<script src="/assets/d2eace91/js/validate/messages_zh.js?v=1.2"></script>
<!-- AJAX上传+图片预览 -->
<script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=1.2"></script>
<script src="/assets/d2eace91/js/pic/imgPreview.js?v=1.2"></script>
<script src="/assets/d2eace91/js/jquery.widget.js?v=1.2"></script>
<!-- 验证规则 -->
<script id="client_rules" type="text">
[{"id": "systemconfigmodel-audit_self_shop_goods", "name": "SystemConfigModel[audit_self_shop_goods]", "attribute": "audit_self_shop_goods", "rules": {"string":true,"messages":{"string":"自营店铺商品是否需要审核必须是一条字符串。"}}},{"id": "systemconfigmodel-audit_other_shop_goods", "name": "SystemConfigModel[audit_other_shop_goods]", "attribute": "audit_other_shop_goods", "rules": {"string":true,"messages":{"string":"入驻店铺商品是否需要审核必须是一条字符串。"}}},{"id": "systemconfigmodel-goods_price_format", "name": "SystemConfigModel[goods_price_format]", "attribute": "goods_price_format", "rules": {"string":true,"messages":{"string":"商品价格显示格式必须是一条字符串。"}}},{"id": "systemconfigmodel-goods_price_format", "name": "SystemConfigModel[goods_price_format]", "attribute": "goods_price_format", "rules": {"match":{"pattern":/\{0\}/,"not":false,"skipOnEmpty":1},"messages":{"match":"商品价格显示格式必须包含价格占位符“&#123;0&#125;”"}}},{"id": "systemconfigmodel-price_show_rule", "name": "SystemConfigModel[price_show_rule]", "attribute": "price_show_rule", "rules": {"string":true,"messages":{"string":"商品价格显示规则必须是一条字符串。"}}},{"id": "systemconfigmodel-goods_list_count", "name": "SystemConfigModel[goods_list_count]", "attribute": "goods_list_count", "rules": {"string":true,"messages":{"string":"列表页面显示商品数量必须是一条字符串。"}}},{"id": "systemconfigmodel-goods_list_count", "name": "SystemConfigModel[goods_list_count]", "attribute": "goods_list_count", "rules": {"required":true,"messages":{"required":"列表页面显示商品数量不能为空。"}}},{"id": "systemconfigmodel-goods_list_count", "name": "SystemConfigModel[goods_list_count]", "attribute": "goods_list_count", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"列表页面显示商品数量必须是整数。","min":"列表页面显示商品数量必须不小于0。","max":"列表页面显示商品数量必须不大于100。"},"min":0,"max":100}},{"id": "systemconfigmodel-goods_list_cache", "name": "SystemConfigModel[goods_list_cache]", "attribute": "goods_list_cache", "rules": {"string":true,"messages":{"string":"列表页面查询缓存必须是一条字符串。"}}},{"id": "systemconfigmodel-goods_list_cache", "name": "SystemConfigModel[goods_list_cache]", "attribute": "goods_list_cache", "rules": {"required":true,"messages":{"required":"列表页面查询缓存不能为空。"}}},{"id": "systemconfigmodel-goods_list_cache", "name": "SystemConfigModel[goods_list_cache]", "attribute": "goods_list_cache", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"列表页面查询缓存必须是整数。","min":"列表页面查询缓存必须不小于60。"},"min":60}},{"id": "systemconfigmodel-goods_list_filter_count", "name": "SystemConfigModel[goods_list_filter_count]", "attribute": "goods_list_filter_count", "rules": {"string":true,"messages":{"string":"列表页面筛选条件默认展示数量必须是一条字符串。"}}},{"id": "systemconfigmodel-goods_list_filter_count", "name": "SystemConfigModel[goods_list_filter_count]", "attribute": "goods_list_filter_count", "rules": {"required":true,"messages":{"required":"列表页面筛选条件默认展示数量不能为空。"}}},{"id": "systemconfigmodel-goods_list_filter_count", "name": "SystemConfigModel[goods_list_filter_count]", "attribute": "goods_list_filter_count", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"列表页面筛选条件默认展示数量必须是整数。","min":"列表页面筛选条件默认展示数量必须不小于0。"},"min":0}},{"id": "systemconfigmodel-sort_order_type", "name": "SystemConfigModel[sort_order_type]", "attribute": "sort_order_type", "rules": {"string":true,"messages":{"string":"商品列表页面默认排序类型必须是一条字符串。"}}},{"id": "systemconfigmodel-sort_order_method", "name": "SystemConfigModel[sort_order_method]", "attribute": "sort_order_method", "rules": {"string":true,"messages":{"string":"商品列表页面默认排序方式必须是一条字符串。"}}},{"id": "systemconfigmodel-sort_order_method", "name": "SystemConfigModel[sort_order_method]", "attribute": "sort_order_method", "rules": {"required":true,"messages":{"required":"商品列表页面默认排序方式不能为空。"}}},{"id": "systemconfigmodel-goods_show_sale_number", "name": "SystemConfigModel[goods_show_sale_number]", "attribute": "goods_show_sale_number", "rules": {"string":true,"messages":{"string":"是否显示商品销量必须是一条字符串。"}}},{"id": "systemconfigmodel-goods_list_show_style", "name": "SystemConfigModel[goods_list_show_style]", "attribute": "goods_list_show_style", "rules": {"string":true,"messages":{"string":"商品列表页显示样式必须是一条字符串。"}}},{"id": "systemconfigmodel-goods_info_freight", "name": "SystemConfigModel[goods_info_freight]", "attribute": "goods_info_freight", "rules": {"string":true,"messages":{"string":"商品详情页运费模式必须是一条字符串。"}}},{"id": "systemconfigmodel-goods_info_show_stock", "name": "SystemConfigModel[goods_info_show_stock]", "attribute": "goods_info_show_stock", "rules": {"string":true,"messages":{"string":"是否显示商品详情页库存必须是一条字符串。"}}},{"id": "systemconfigmodel-goods_info_pickup", "name": "SystemConfigModel[goods_info_pickup]", "attribute": "goods_info_pickup", "rules": {"string":true,"messages":{"string":"是否显示商品详情页自提点必须是一条字符串。"}}},{"id": "systemconfigmodel-goods_info_show_collect", "name": "SystemConfigModel[goods_info_show_collect]", "attribute": "goods_info_show_collect", "rules": {"string":true,"messages":{"string":"是否显示商品收藏人气必须是一条字符串。"}}},{"id": "systemconfigmodel-shop_show_collect", "name": "SystemConfigModel[shop_show_collect]", "attribute": "shop_show_collect", "rules": {"string":true,"messages":{"string":"是否显示店铺收藏人气必须是一条字符串。"}}},{"id": "systemconfigmodel-goods_video_enable", "name": "SystemConfigModel[goods_video_enable]", "attribute": "goods_video_enable", "rules": {"string":true,"messages":{"string":"是否开启商品主图视频必须是一条字符串。"}}},{"id": "systemconfigmodel-goods_video_min_duration", "name": "SystemConfigModel[goods_video_min_duration]", "attribute": "goods_video_min_duration", "rules": {"string":true,"messages":{"string":"主图视频最小时长必须是一条字符串。"}}},{"id": "systemconfigmodel-goods_video_min_duration", "name": "SystemConfigModel[goods_video_min_duration]", "attribute": "goods_video_min_duration", "rules": {"required":true,"messages":{"required":"主图视频最小时长不能为空。"}}},{"id": "systemconfigmodel-goods_video_min_duration", "name": "SystemConfigModel[goods_video_min_duration]", "attribute": "goods_video_min_duration", "rules": {"compare":{"operator":"<","type":"number","compareAttribute":"systemconfigmodel-goods_video_max_duration","skipOnEmpty":1},"messages":{"compare":"主图视频最小时长的值必须小于\"主图视频最大时长\"。"}}},{"id": "systemconfigmodel-goods_video_min_duration", "name": "SystemConfigModel[goods_video_min_duration]", "attribute": "goods_video_min_duration", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"主图视频最小时长必须是整数。","min":"主图视频最小时长必须不小于0。"},"min":0}},{"id": "systemconfigmodel-goods_video_max_duration", "name": "SystemConfigModel[goods_video_max_duration]", "attribute": "goods_video_max_duration", "rules": {"string":true,"messages":{"string":"主图视频时长必须是一条字符串。"}}},{"id": "systemconfigmodel-goods_video_max_duration", "name": "SystemConfigModel[goods_video_max_duration]", "attribute": "goods_video_max_duration", "rules": {"required":true,"messages":{"required":"主图视频时长不能为空。"}}},{"id": "systemconfigmodel-goods_video_max_duration", "name": "SystemConfigModel[goods_video_max_duration]", "attribute": "goods_video_max_duration", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"主图视频时长必须是整数。","min":"主图视频时长必须不小于0。"},"min":0}},{"id": "systemconfigmodel-goods_video_article", "name": "SystemConfigModel[goods_video_article]", "attribute": "goods_video_article", "rules": {"string":true,"messages":{"string":"主图视频规则文章必须是一条字符串。"}}},{"id": "systemconfigmodel-goods_video_article", "name": "SystemConfigModel[goods_video_article]", "attribute": "goods_video_article", "rules": {"url":{"pattern":/^(http|https):\/\/(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+)(?::\d{1,5})?(?:$|[?\/#])/i,"enableIDN":false,"skipOnEmpty":1},"messages":{"url":"主图视频规则文章不是一条有效的URL。"}}},]
</script>




<script type="text/javascript">
    $().ready(function() {
        var validator = $("#SystemConfigModel").validate();
        // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#client_rules").html());
        $("#btn_submit").click(function() {
            validator.form();
            if (!validator.form()) {
                return;
            }
            $.loading.start();
            $("#SystemConfigModel").submit();
            /**
             var data = $("#SystemConfigModel").serializeJson();
             $.post('/system/config/index', data, function(result) {
				if (result.code == 0) {
					$.msg(result.message, {
						icon: 1
					});
				} else {
					$.alert(result.message, {
						icon: 2
					});
				}
			}, "json");
             **/
        });

        $(".szy-imagegroup").each(function() {
            var id = $(this).data("id");
            var size = $(this).data("size");
            var mode = $(this).data("mode");
            var labels = $(this).data("labels");
            var target = $("#" + id);
            var value = $(target).val() ;
            var options = $(this).data("options") ? $(this).data("options") : [];
            $(this).imagegroup({
                host: "{{ get_oss_host() }}",
                size: size,
                mode: mode,
                labels: labels,
                options: options,
                gallery: true,
                values: value.split("|"),
                // 回调函数
                callback: function(data) {
                    var values = this.values;
                    if (!values) {
                        values = [];
                    }
                    values = values.join("|");
                    target.val(values);
                },
                // 移除的回调函数
                remove: function(value, values) {
                    var values = this.values;
                    if (!values) {
                        values = [];
                    }
                    values = values.join("|");
                    target.val(values);
                }
            });
        });

        $(".szy-videogroup").each(function() {
            var id = $(this).data("id");
            var size = $(this).data("size");
            var mode = $(this).data("mode");
            var labels = $(this).data("labels");

            var target = $("#" + id);
            var value = $(target).val() ;

            var options = $(this).data("options") ? $(this).data("options") : [];

            $(this).videogroup({
                host: "{{ get_oss_host() }}",
                size: size,
                mode: mode,
                labels: labels,
                options: options,
                values: value.split("|"),
                // 回调函数
                callback: function(data) {
                    var values = this.values;
                    if (!values) {
                        values = [];
                    }
                    values = values.join("|");
                    target.val(values);
                },
                // 移除的回调函数
                remove: function(value, values) {
                    var values = this.values;
                    if (!values) {
                        values = [];
                    }
                    values = values.join("|");
                    target.val(values);
                }
            });
        });
    });
</script>