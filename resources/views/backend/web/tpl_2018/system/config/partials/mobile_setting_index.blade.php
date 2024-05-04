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
[{"id": "systemconfigmodel-m_search_shop_range", "name": "SystemConfigModel[m_search_shop_range]", "attribute": "m_search_shop_range", "rules": {"string":true,"messages":{"string":"附近店铺搜索范围必须是一条字符串。"}}},{"id": "systemconfigmodel-m_search_shop_range", "name": "SystemConfigModel[m_search_shop_range]", "attribute": "m_search_shop_range", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"附近店铺搜索范围必须是整数。","max":"附近店铺搜索范围必须不大于9999。"},"max":9999}},{"id": "systemconfigmodel-m_search_shop_range", "name": "SystemConfigModel[m_search_shop_range]", "attribute": "m_search_shop_range", "rules": {"compare":{"operator":">","type":"string","compareValue":0,"skipOnEmpty":1},"messages":{"compare":"附近店铺搜索范围的值必须大于\"0\"。"}}},{"id": "systemconfigmodel-m_goods_list_page_count", "name": "SystemConfigModel[m_goods_list_page_count]", "attribute": "m_goods_list_page_count", "rules": {"string":true,"messages":{"string":"滚动商品加载页数必须是一条字符串。"}}},{"id": "systemconfigmodel-m_goods_list_page_count", "name": "SystemConfigModel[m_goods_list_page_count]", "attribute": "m_goods_list_page_count", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"滚动商品加载页数必须是整数。","max":"滚动商品加载页数必须不大于10。"},"max":10}},{"id": "systemconfigmodel-m_goods_list_page_count", "name": "SystemConfigModel[m_goods_list_page_count]", "attribute": "m_goods_list_page_count", "rules": {"compare":{"operator":">","type":"string","compareValue":0,"skipOnEmpty":1},"messages":{"compare":"滚动商品加载页数的值必须大于\"0\"。"}}},{"id": "systemconfigmodel-m_aliim_icon_show", "name": "SystemConfigModel[m_aliim_icon_show]", "attribute": "m_aliim_icon_show", "rules": {"string":true,"messages":{"string":"是否显示首页云旺客服必须是一条字符串。"}}},{"id": "systemconfigmodel-m_aliim_icon", "name": "SystemConfigModel[m_aliim_icon]", "attribute": "m_aliim_icon", "rules": {"string":true,"messages":{"string":"首页云旺客服图标必须是一条字符串。"}}},{"id": "systemconfigmodel-m_app_download", "name": "SystemConfigModel[m_app_download]", "attribute": "m_app_download", "rules": {"string":true,"messages":{"string":"是否显示首页APP下载必须是一条字符串。"}}},{"id": "systemconfigmodel-m_app_icon", "name": "SystemConfigModel[m_app_icon]", "attribute": "m_app_icon", "rules": {"string":true,"messages":{"string":"首页APP下载图标必须是一条字符串。"}}},]
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