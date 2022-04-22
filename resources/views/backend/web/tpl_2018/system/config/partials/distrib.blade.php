<!-- 表单验证 -->
<script src="/assets/d2eace91/js/validate/jquery.validate.js?v=1.2"></script>
<script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.2"></script>
<script src="/assets/d2eace91/js/validate/messages_zh.js?v=1.2"></script> <script src="/assets/d2eace91/js/pic/imgPreview.js?v=1.2"></script>
<!-- 验证规则 -->
<script id="client_rules" type="text">
	[{"id": "systemconfigmodel-is_distrib", "name": "SystemConfigModel[is_distrib]", "attribute": "is_distrib", "rules": {"string":true,"messages":{"string":"是否开启推荐分销必须是一条字符串。"}}},{"id": "systemconfigmodel-is_distributor_audit", "name": "SystemConfigModel[is_distributor_audit]", "attribute": "is_distributor_audit", "rules": {"string":true,"messages":{"string":"分销商申请是否需要审核必须是一条字符串。"}}},{"id": "systemconfigmodel-distributor_condition", "name": "SystemConfigModel[distributor_condition]", "attribute": "distributor_condition", "rules": {"string":true,"messages":{"string":"成为分销商的必备条件必须是一条字符串。"}}},{"id": "systemconfigmodel-distrib_order_money", "name": "SystemConfigModel[distrib_order_money]", "attribute": "distrib_order_money", "rules": {"string":true,"messages":{"string":"订单金额必须是一条字符串。"}}},{"id": "systemconfigmodel-distrib_order_money", "name": "SystemConfigModel[distrib_order_money]", "attribute": "distrib_order_money", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"订单金额必须是一个数字。","min":"订单金额必须不小于1。","max":"订单金额必须不大于99999。"},"min":1,"max":99999}},{"id": "systemconfigmodel-distrib_order_money", "name": "SystemConfigModel[distrib_order_money]", "attribute": "distrib_order_money", "rules": {"match":{"pattern":/^[0-9]+(.[0-9]{1,2})?$/,"not":false,"skipOnEmpty":1},"messages":{"match":"请输入整数或小数点后2位的数字"}}},{"id": "systemconfigmodel-distrib_order_count", "name": "SystemConfigModel[distrib_order_count]", "attribute": "distrib_order_count", "rules": {"string":true,"messages":{"string":"成交笔数必须是一条字符串。"}}},{"id": "systemconfigmodel-distrib_order_count", "name": "SystemConfigModel[distrib_order_count]", "attribute": "distrib_order_count", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"成交笔数必须是整数。","min":"成交笔数必须不小于1。"},"min":1}},{"id": "systemconfigmodel-is_invite_code", "name": "SystemConfigModel[is_invite_code]", "attribute": "is_invite_code", "rules": {"string":true,"messages":{"string":"是否开启邀请码必须是一条字符串。"}}},{"id": "systemconfigmodel-distrib_reserve_money", "name": "SystemConfigModel[distrib_reserve_money]", "attribute": "distrib_reserve_money", "rules": {"string":true,"messages":{"string":"分销账户预留金额必须是一条字符串。"}}},{"id": "systemconfigmodel-distrib_reserve_money", "name": "SystemConfigModel[distrib_reserve_money]", "attribute": "distrib_reserve_money", "rules": {"required":true,"messages":{"required":"分销账户预留金额不能为空。"}}},{"id": "systemconfigmodel-distrib_reserve_money", "name": "SystemConfigModel[distrib_reserve_money]", "attribute": "distrib_reserve_money", "rules": {"number":{"pattern":"/^\\s*[-+]?[0-9]*\\.?[0-9]+([eE][-+]?[0-9]+)?\\s*$/"},"messages":{"number":"分销账户预留金额必须是一个数字。","min":"分销账户预留金额必须不小于0。","max":"分销账户预留金额必须不大于99999。"},"min":0,"max":99999}},{"id": "systemconfigmodel-distrib_reserve_money", "name": "SystemConfigModel[distrib_reserve_money]", "attribute": "distrib_reserve_money", "rules": {"match":{"pattern":/^[0-9]+(.[0-9]{1,2})?$/,"not":false,"skipOnEmpty":1},"messages":{"match":"请输入整数或小数点后2位的数字"}}},{"id": "systemconfigmodel-distrib_rebate_type", "name": "SystemConfigModel[distrib_rebate_type]", "attribute": "distrib_rebate_type", "rules": {"string":true,"messages":{"string":"返利方式必须是一条字符串。"}}},{"id": "systemconfigmodel-distrib_text", "name": "SystemConfigModel[distrib_text]", "attribute": "distrib_text", "rules": {"string":true,"messages":{"string":"分销必须是一条字符串。"}}},{"id": "systemconfigmodel-distrib_text", "name": "SystemConfigModel[distrib_text]", "attribute": "distrib_text", "rules": {"string":true,"messages":{"string":"分销必须是一条字符串。","maxlength":"分销只能包含至多4个字符。"},"maxlength":4}},{"id": "systemconfigmodel-distributor_text", "name": "SystemConfigModel[distributor_text]", "attribute": "distributor_text", "rules": {"string":true,"messages":{"string":"分销商必须是一条字符串。"}}},{"id": "systemconfigmodel-distributor_text", "name": "SystemConfigModel[distributor_text]", "attribute": "distributor_text", "rules": {"string":true,"messages":{"string":"分销商必须是一条字符串。","maxlength":"分销商只能包含至多5个字符。"},"maxlength":5}},{"id": "systemconfigmodel-share_hint", "name": "SystemConfigModel[share_hint]", "attribute": "share_hint", "rules": {"string":true,"messages":{"string":"推广页面提示语必须是一条字符串。"}}},{"id": "systemconfigmodel-share_hint", "name": "SystemConfigModel[share_hint]", "attribute": "share_hint", "rules": {"string":true,"messages":{"string":"推广页面提示语必须是一条字符串。","maxlength":"推广页面提示语只能包含至多15个字符。"},"maxlength":15}},{"id": "systemconfigmodel-is_distrib_goods_audit", "name": "SystemConfigModel[is_distrib_goods_audit]", "attribute": "is_distrib_goods_audit", "rules": {"string":true,"messages":{"string":"发布分销商品是否需要审核必须是一条字符串。"}}},]
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
        checkRankValue();
        sort();
        initClass();
        var validator = $("#SystemConfigModel").validate();
        // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#client_rules").html());
        $("#btn_submit").click(function() {
            if (!validator.form()) {
                return false;
            }
            var rank_values = 0;
            var is_valid = true;
            $(".rank-value").each(function() {
                if (Number($(this).val() <= 0)) {
                    is_valid = false;
                }
                rank_values += Number($(this).val());
            });
            if (is_valid == false) {
                $.msg("请输入正确的返利百分比！");
                return false;
            }
            if (rank_values > 100) {
                $.msg("分佣比例不能超过100！");
                return false;
            }
            $("#SystemConfigModel").submit();
        });

        $("body").on('click', '#set_rank i', function() {
            if ($(this).hasClass("fa-minus-circle")) {
                $(this).parent().parent().parent().remove();
            } else if ($(this).hasClass("fa-plus-circle")) {
                $('#set_rank').append($('#copy_source').html());
            }
            initClass();
            sort();
            checkRankValue();
        });

        function sort() {
            $(".rank-level").each(function(index) {
                $(this).find(".level").html(index + 1);
            });
        }

        function checkRankValue() {
            var rank_values = 0;
            $(".rank-value").each(function() {
                rank_values += Number($(this).val());
            });
            $("#systemconfigmodel-distrib_rank_value").val(rank_values);
        }

        function initClass() {
            var count = $("#set_rank i").size();
            $("#set_rank i").addClass("fa-minus-circle");
            $("#set_rank i").removeClass("fa-plus-circle");
            if (count < 3) {
                $("#set_rank i").first().addClass("fa-plus-circle");
                $("#set_rank i").first().removeClass("fa-minus-circle");
            }
        }
    });
</script>