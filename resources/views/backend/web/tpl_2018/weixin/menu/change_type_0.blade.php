<!-- 菜单命令 -->
<div class="simple-form-field">
    <div class="form-group">
        <label for="weixinmenu-menu_command" class="col-sm-4 control-label">
            <span class="ng-binding">菜单命令：</span>
        </label>
        <div class="col-sm-8">
            <div class="form-control-box">
                <select id="weixinmenu-menu_command" class="form-control w150" name="WeixinMenu[menu_command]">
                    <option value="" @if(@$model['menu_command'] == ''){{ 'selected' }}@endif>不绑定</option>
                    <option value="info" @if(@$model['menu_command'] == 'info'){{ 'selected' }}@endif>个人信息</option>
                    <option value="wdzh" @if(@$model['menu_command'] == 'wdzh'){{ 'selected' }}@endif>我的账户</option>
                    <option value="ddcx" @if(@$model['menu_command'] == 'ddcx'){{ 'selected' }}@endif>订单查询</option>
                    <option value="kefu" @if(@$model['menu_command'] == 'kefu'){{ 'selected' }}@endif>微信客服</option>
                </select>
            </div>
            <div class="help-block help-block-t"></div>
        </div>
    </div>
</div>

<!-- 验证规则 -->
<script id="client_rules" type="text">
[{"id": "weixinmenu-menu_name", "name": "WeixinMenu[menu_name]", "attribute": "menu_name", "rules": {"required":true,"messages":{"required":"菜单名称不能为空。"}}},{"id": "weixinmenu-parent_id", "name": "WeixinMenu[parent_id]", "attribute": "parent_id", "rules": {"required":true,"messages":{"required":"上级菜单不能为空。"}}},{"id": "weixinmenu-menu_type", "name": "WeixinMenu[menu_type]", "attribute": "menu_type", "rules": {"required":true,"messages":{"required":"菜单类型不能为空。"}}},{"id": "weixinmenu-menu_sort", "name": "WeixinMenu[menu_sort]", "attribute": "menu_sort", "rules": {"required":true,"messages":{"required":"排序不能为空。"}}},{"id": "weixinmenu-menu_value", "name": "WeixinMenu[menu_value]", "attribute": "menu_value", "rules": {"required":true,"messages":{"required":"链接地址不能为空。"}}},{"id": "weixinmenu-menu_value", "name": "WeixinMenu[menu_value]", "attribute": "menu_value", "rules": {"url":{"pattern":/^(http|https):\/\/(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+)(?::\d{1,5})?(?:$|[?\/#])/i,"enableIDN":false,"skipOnEmpty":1},"messages":{"url":"链接地址不是一条有效的URL。"}}},{"id": "weixinmenu-menu_link", "name": "WeixinMenu[menu_link]", "attribute": "menu_link", "rules": {"url":{"pattern":/^(http|https):\/\/(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+)(?::\d{1,5})?(?:$|[?\/#])/i,"enableIDN":false,"skipOnEmpty":1},"messages":{"url":"链接地址不是一条有效的URL。"}}},{"id": "weixinmenu-is_auto_login", "name": "WeixinMenu[is_auto_login]", "attribute": "is_auto_login", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否自动登录必须是整数。"}}},{"id": "weixinmenu-menu_title", "name": "WeixinMenu[menu_title]", "attribute": "menu_title", "rules": {"string":true,"messages":{"string":"标题必须是一条字符串。","maxlength":"标题只能包含至多40个字符。"},"maxlength":40}},{"id": "weixinmenu-menu_desc", "name": "WeixinMenu[menu_desc]", "attribute": "menu_desc", "rules": {"string":true,"messages":{"string":"描述必须是一条字符串。","maxlength":"描述只能包含至多255个字符。"},"maxlength":255}},{"id": "weixinmenu-appid", "name": "WeixinMenu[appid]", "attribute": "appid", "rules": {"string":true,"messages":{"string":"小程序的appid必须是一条字符串。","maxlength":"小程序的appid只能包含至多255个字符。"},"maxlength":255}},{"id": "weixinmenu-pagepath", "name": "WeixinMenu[pagepath]", "attribute": "pagepath", "rules": {"string":true,"messages":{"string":"小程序的页面路径必须是一条字符串。","maxlength":"小程序的页面路径只能包含至多255个字符。"},"maxlength":255}},{"id": "weixinmenu-parent_id", "name": "WeixinMenu[parent_id]", "attribute": "parent_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"上级菜单必须是整数。"}}},{"id": "weixinmenu-menu_type", "name": "WeixinMenu[menu_type]", "attribute": "menu_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"菜单类型必须是整数。"}}},{"id": "weixinmenu-menu_sort", "name": "WeixinMenu[menu_sort]", "attribute": "menu_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。"}}},{"id": "weixinmenu-menu_name", "name": "WeixinMenu[menu_name]", "attribute": "menu_name", "rules": {"string":true,"messages":{"string":"菜单名称必须是一条字符串。","maxlength":"菜单名称只能包含至多5个字符。"},"maxlength":5}},{"id": "weixinmenu-menu_sort", "name": "WeixinMenu[menu_sort]", "attribute": "menu_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于255。"},"min":0,"max":255}},]

</script>
<script type="text/javascript">
    //
</script>
<script src="/assets/d2eace91/min/js/validate.min.js?v=20200805"></script>
<script src="/assets/d2eace91/min/js/upload.min.js?v=20200805"></script>
<script>

    $().ready(function () {
        var validator = $("#WeixinMenu").validate();
// 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#client_rules").html());

        $('.bootstrap-switch [type="checkbox"]').bootstrapSwitch({
            radioAllOff: true,
            onSwitchChange: function (event, state) {
                $(event.target).prop("checked", state);
                $(event.target).change();
            }
        });

        $("#menu_img_container").imagegroup({
            host: '{{ get_oss_host() }}',
            size: 1,
            values: ["{{ $model['menu_img'] ?? '' }}"],
            callback: function (data) {
                $("#weixinmenu-menu_img").val(data.path);
            },
            remove: function (value, values) {
                $("#weixinmenu-menu_img").val('');
            }
        });

        $("[data-switch-toggle]").on("click", function () {
            var type = $(this).data("switch-toggle");
            return $("#switch-" + type).bootstrapSwitch("toggle" + type.charAt(0).toUpperCase() + type.slice(1));
        });
    });

    //
</script>