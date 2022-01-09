<!-- 表单验证 -->
<script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180702"></script>
<script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180702"></script>
<script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180702"></script>
<!-- AJAX上传+图片预览 -->
<script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=20180702"></script>
<script src="/assets/d2eace91/js/pic/imgPreview.js?v=20180702"></script>
<script src="/assets/d2eace91/js/jquery.widget.js?v=20180702"></script>
<!-- 验证规则 -->
<script id="client_rules" type="text">
[{"id": "shopconfigmodel-shop_index_topic", "name": "ShopConfigModel[shop_index_topic]", "attribute": "shop_index_topic", "rules": {"string":true,"messages":{"string":"专题页编号必须是一条字符串。"}}},{"id": "shopconfigmodel-shop_index_topic", "name": "ShopConfigModel[shop_index_topic]", "attribute": "shop_index_topic", "rules": {"required":true,"messages":{"required":"设置专题页为店铺首页时专题页不能为空！"}}},{"id": "shopconfigmodel-shop_index", "name": "ShopConfigModel[shop_index]", "attribute": "shop_index", "rules": {"string":true,"messages":{"string":"店铺首页必须是一条字符串。"}}},{"id": "shopconfigmodel-goods_list_show_mode", "name": "ShopConfigModel[goods_list_show_mode]", "attribute": "goods_list_show_mode", "rules": {"string":true,"messages":{"string":"商品列表展示方式必须是一条字符串。"}}},]
</script>





<script type="text/javascript">
    $().ready(function() {

        var validator = $("#ShopConfigModel").validate();
        // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#client_rules").html());
        $("#btn_submit").click(function() {
            validator.form();
            if (!validator.form()) {
                return;
            }
            $.loading.start();
            $("#ShopConfigModel").submit();
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
                // host: "http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/",
                host: "{{ get_oss_host() }}",
                size: size,
                mode: mode,
                labels: labels,
                options: options,
                values: value.split("|"),
                // 改变事件
                change: function(values, type){
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