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
[{"id": "systemconfigmodel-alioss_enable", "name": "SystemConfigModel[alioss_enable]", "attribute": "alioss_enable", "rules": {"string":true,"messages":{"string":"是否开启必须是一条字符串。"}}},{"id": "systemconfigmodel-alioss_bucket_name", "name": "SystemConfigModel[alioss_bucket_name]", "attribute": "alioss_bucket_name", "rules": {"string":true,"messages":{"string":"Bucket名称必须是一条字符串。"}}},{"id": "systemconfigmodel-alioss_access_key_id", "name": "SystemConfigModel[alioss_access_key_id]", "attribute": "alioss_access_key_id", "rules": {"string":true,"messages":{"string":"AccessKeyID必须是一条字符串。"}}},{"id": "systemconfigmodel-alioss_access_key_secret", "name": "SystemConfigModel[alioss_access_key_secret]", "attribute": "alioss_access_key_secret", "rules": {"string":true,"messages":{"string":"AccessKeySecret必须是一条字符串。"}}},{"id": "systemconfigmodel-alioss_root_path", "name": "SystemConfigModel[alioss_root_path]", "attribute": "alioss_root_path", "rules": {"string":true,"messages":{"string":"图片存储根目录必须是一条字符串。"}}},{"id": "systemconfigmodel-alioss_domain", "name": "SystemConfigModel[alioss_domain]", "attribute": "alioss_domain", "rules": {"string":true,"messages":{"string":"自定义绑定域名必须是一条字符串。"}}},{"id": "systemconfigmodel-alioss_bucket_region", "name": "SystemConfigModel[alioss_bucket_region]", "attribute": "alioss_bucket_region", "rules": {"string":true,"messages":{"string":"所属地区必须是一条字符串。"}}},]
</script>

<script id="region_domains" type="text">
{{--[{"name":"\u534e\u4e1c2(\u4e0a\u6d77)","domain":"oss-cn-shanghai.aliyuncs.com","internal_domain":"oss-cn-shanghai-internal.aliyuncs.com","image_domain":"img-cn-shanghai.aliyuncs.com"},{"name":"\u534e\u53171(\u9752\u5c9b)","domain":"oss-cn-qingdao.aliyuncs.com","internal_domain":"oss-cn-qingdao-internal.aliyuncs.com","image_domain":"img-cn-qingdao.aliyuncs.com"},{"name":"\u534e\u53172(\u5317\u4eac)","domain":"oss-cn-beijing.aliyuncs.com","internal_domain":"oss-cn-beijing-internal.aliyuncs.com","image_domain":"img-cn-beijing.aliyuncs.com"},{"name":"\u534e\u4e1c1(\u676d\u5dde)","domain":"oss-cn-hangzhou.aliyuncs.com","internal_domain":"oss-cn-hangzhou-internal.aliyuncs.com","image_domain":"img-cn-hangzhou.aliyuncs.com"},{"name":"\u534e\u53571(\u6df1\u5733)","domain":"oss-cn-shenzhen.aliyuncs.com","internal_domain":"oss-cn-shenzhen-internal.aliyuncs.com","image_domain":"img-cn-shenzhen.aliyuncs.com"},{"name":"\u9999\u6e2f","domain":"oss-cn-hongkong.aliyuncs.com","internal_domain":"oss-cn-hongkong-internal.aliyuncs.com","image_domain":"img-cn-hongkong.aliyuncs.com"},{"name":"\u4e9a\u6d32(\u65b0\u52a0\u5761)","domain":"oss-ap-southeast-1.aliyuncs.com","internal_domain":"oss-ap-southeast-1-internal.aliyuncs.com","image_domain":"img-ap-southeast-1.aliyuncs.com"},{"name":"\u7f8e\u897f1(\u7f8e\u56fd\u7845\u8c37)","domain":"oss-us-west-1.aliyuncs.com","internal_domain":"oss-us-west-1-internal.aliyuncs.com","image_domain":"img-us-west-1.aliyuncs.com"},{"name":"\u7f8e\u4e1c1(\u7f8e\u56fd\u5f17\u5409\u5c3c\u4e9a)","domain":"oss-us-east-1.aliyuncs.com","internal_domain":"oss-us-east-1-internal.aliyuncs.com","image_domain":"img-us-east-1.aliyuncs.com"}]--}}
    [{"name":"西南1(成都)","domain":"oss-cn-chengdu.aliyuncs.com","internal_domain":"oss-cn-chengdu-internal.aliyuncs.com","image_domain":"img-cn-chengdu.aliyuncs.com"},{"name":"华东2(上海)","domain":"oss-cn-shanghai.aliyuncs.com","internal_domain":"oss-cn-shanghai-internal.aliyuncs.com","image_domain":"img-cn-shanghai.aliyuncs.com"},{"name":"华北1(青岛)","domain":"oss-cn-qingdao.aliyuncs.com","internal_domain":"oss-cn-qingdao-internal.aliyuncs.com","image_domain":"img-cn-qingdao.aliyuncs.com"},{"name":"华北2(北京)","domain":"oss-cn-beijing.aliyuncs.com","internal_domain":"oss-cn-beijing-internal.aliyuncs.com","image_domain":"img-cn-beijing.aliyuncs.com"},{"name":"华东1(杭州)","domain":"oss-cn-hangzhou.aliyuncs.com","internal_domain":"oss-cn-hangzhou-internal.aliyuncs.com","image_domain":"img-cn-hangzhou.aliyuncs.com"},{"name":"华南1(深圳)","domain":"oss-cn-shenzhen.aliyuncs.com","internal_domain":"oss-cn-shenzhen-internal.aliyuncs.com","image_domain":"img-cn-shenzhen.aliyuncs.com"},{"name":"香港","domain":"oss-cn-hongkong.aliyuncs.com","internal_domain":"oss-cn-hongkong-internal.aliyuncs.com","image_domain":"img-cn-hongkong.aliyuncs.com"},{"name":"亚洲(新加坡)","domain":"oss-ap-southeast-1.aliyuncs.com","internal_domain":"oss-ap-southeast-1-internal.aliyuncs.com","image_domain":"img-ap-southeast-1.aliyuncs.com"},{"name":"美西1(美国硅谷)","domain":"oss-us-west-1.aliyuncs.com","internal_domain":"oss-us-west-1-internal.aliyuncs.com","image_domain":"img-us-west-1.aliyuncs.com"},{"name":"美东1(美国弗吉尼亚)","domain":"oss-us-east-1.aliyuncs.com","internal_domain":"oss-us-east-1-internal.aliyuncs.com","image_domain":"img-us-east-1.aliyuncs.com"}]
</script>
<script type="text/javascript">
    $().ready(function() {
        //悬浮显示上下步骤按钮
        window.onscroll = function() {
            $(window).scroll(function() {
                var scrollTop = $(document).scrollTop();
                var height = $(".page").height();
                var wHeight = $(window).height();
                if (scrollTop > (height - wHeight)) {
                    $(".bottom-btn").removeClass("bottom-btn-fixed");
                } else {
                    $(".bottom-btn").addClass("bottom-btn-fixed");
                }
            });

        };
        var region_domains = $.parseJSON($("#region_domains").html());

        var validator = $("#SystemConfigModel").validate();
        // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#client_rules").html());

        var alioss_enable = "0";
        var elements = $("#SystemConfigModel").find(":text").not("#systemconfigmodel-alioss_domain,#systemconfigmodel-alioss_root_path");

        if (alioss_enable == "1") {
            $(elements).attr("data-rule-required", true);
        }

        $("#btn_submit").click(function() {
            if (!validator.form()) {
                return;
            }

            $.loading.start();
            $("#SystemConfigModel").submit();
        });

        $(".szy-imagegroup").each(function() {
            var id = $(this).data("id");
            var size = $(this).data("size");

            var target = $("#" + id);
            var value = $(target).val();

            $(this).imagegroup({
                host: "{{ get_oss_host() }}",
                size: size,
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

        $("#systemconfigmodel-alioss_bucket_region").find(":radio").change(function() {
            if (region_domains[$(this).val()]) {
                var region_domain = region_domains[$(this).val()];

                var bucket_name = $("#systemconfigmodel-alioss_bucket_name").val();

                $("#oss_domain").html(bucket_name + "." + region_domain.domain);
                $("#oss_internal_domain").html(bucket_name + "." + region_domain.internal_domain);
                $("#oss_image_domain").html(bucket_name + "." + region_domain.image_domain);
            }
        });

        $("#systemconfigmodel-alioss_bucket_name").keyup(function() {
            var bucket_name = $(this).val();

            var value = $("#systemconfigmodel-alioss_bucket_region").find(":radio:checked").val();

            var region_domain = region_domains[value];

            if (region_domain) {
                $("#oss_domain").html(bucket_name + "." + region_domain.domain);
                $("#oss_internal_domain").html(bucket_name + "." + region_domain.internal_domain);
                $("#oss_image_domain").html(bucket_name + "." + region_domain.image_domain);
            }
        });

        $('#systemconfigmodel-alioss_enable').on('switchChange.bootstrapSwitch', function(e, checked) {
            validator = $("#SystemConfigModel").validate();

            if (checked) {
                $(elements).attr("data-rule-required", true);
            } else {
                $(elements).attr("data-rule-required", false);
                $(elements).each(function() {
                    $.validator.clearError(this);
                });
            }
        });

    });
</script>