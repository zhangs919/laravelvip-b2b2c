<div class="simple-form-field" >
    <div class="form-group">
        <label for="weixinmenu-appid" class="col-sm-4 control-label">
            <span class="text-danger ng-binding">*</span>
            <span class="ng-binding">小程序的appid：</span>
        </label>
        <div class="col-sm-8">
            <div class="form-control-box">
                <input type="text" id="weixinmenu-appid" class="form-control" name="WeixinMenu[appid]" value="{{ $model['appid'] ?? '' }}">
            </div>
            <div class="help-block help-block-t"><div class="help-block help-block-t">小程序的appid（仅认证公众号可配置）</div></div>
        </div>
    </div>
</div>
<div class="simple-form-field" >
    <div class="form-group">
        <label for="weixinmenu-pagepath" class="col-sm-4 control-label">
            <span class="text-danger ng-binding">*</span>
            <span class="ng-binding">小程序的页面路径：</span>
        </label>
        <div class="col-sm-8">
            <div class="form-control-box">
                <input type="text" id="weixinmenu-pagepath" class="form-control" name="WeixinMenu[pagepath]" value="{{ $model['pagepath'] ?? '' }}">
            </div>
            <div class="help-block help-block-t"><div class="help-block help-block-t">小程序的页面路径，例：pages/index/index</div></div>
        </div>
    </div>
</div>
<div class="simple-form-field" >
    <div class="form-group">
        <label for="weixinmenu-menu_link" class="col-sm-4 control-label">
            <span class="text-danger ng-binding">*</span>
            <span class="ng-binding">备用页面链接：</span>
        </label>
        <div class="col-sm-8">
            <div class="form-control-box">
                <input type="text" id="weixinmenu-menu_link" class="form-control" name="WeixinMenu[menu_link]" value="{{ $model['menu_link'] ?? '' }}">
            </div>
            <div class="help-block help-block-t"><div class="help-block help-block-t">不支持小程序的老版本客户端将打开本连链接</div></div>
        </div>
    </div>
</div>
<!-- 验证规则 -->
<script id="client_rules" type="text">
[{"id": "weixinmenu-menu_name", "name": "WeixinMenu[menu_name]", "attribute": "menu_name", "rules": {"required":true,"messages":{"required":"菜单名称不能为空。"}}},{"id": "weixinmenu-parent_id", "name": "WeixinMenu[parent_id]", "attribute": "parent_id", "rules": {"required":true,"messages":{"required":"上级菜单不能为空。"}}},{"id": "weixinmenu-menu_type", "name": "WeixinMenu[menu_type]", "attribute": "menu_type", "rules": {"required":true,"messages":{"required":"菜单类型不能为空。"}}},{"id": "weixinmenu-menu_sort", "name": "WeixinMenu[menu_sort]", "attribute": "menu_sort", "rules": {"required":true,"messages":{"required":"排序不能为空。"}}},{"id": "weixinmenu-appid", "name": "WeixinMenu[appid]", "attribute": "appid", "rules": {"required":true,"messages":{"required":"小程序的appid不能为空。"}}},{"id": "weixinmenu-pagepath", "name": "WeixinMenu[pagepath]", "attribute": "pagepath", "rules": {"required":true,"messages":{"required":"小程序的页面路径不能为空。"}}},{"id": "weixinmenu-menu_link", "name": "WeixinMenu[menu_link]", "attribute": "menu_link", "rules": {"required":true,"messages":{"required":"备用页面链接不能为空。"}}},{"id": "weixinmenu-menu_link", "name": "WeixinMenu[menu_link]", "attribute": "menu_link", "rules": {"url":{"pattern":/^(http|https):\/\/(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+)(?::\d{1,5})?(?:$|[?\/#])/i,"enableIDN":false,"skipOnEmpty":1},"messages":{"url":"备用页面链接不是一条有效的URL。"}}},{"id": "weixinmenu-is_auto_login", "name": "WeixinMenu[is_auto_login]", "attribute": "is_auto_login", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否自动登录必须是整数。"}}},{"id": "weixinmenu-menu_title", "name": "WeixinMenu[menu_title]", "attribute": "menu_title", "rules": {"string":true,"messages":{"string":"标题必须是一条字符串。","maxlength":"标题只能包含至多40个字符。"},"maxlength":40}},{"id": "weixinmenu-menu_desc", "name": "WeixinMenu[menu_desc]", "attribute": "menu_desc", "rules": {"string":true,"messages":{"string":"描述必须是一条字符串。","maxlength":"描述只能包含至多255个字符。"},"maxlength":255}},{"id": "weixinmenu-appid", "name": "WeixinMenu[appid]", "attribute": "appid", "rules": {"string":true,"messages":{"string":"小程序的appid必须是一条字符串。","maxlength":"小程序的appid只能包含至多255个字符。"},"maxlength":255}},{"id": "weixinmenu-pagepath", "name": "WeixinMenu[pagepath]", "attribute": "pagepath", "rules": {"string":true,"messages":{"string":"小程序的页面路径必须是一条字符串。","maxlength":"小程序的页面路径只能包含至多255个字符。"},"maxlength":255}},{"id": "weixinmenu-parent_id", "name": "WeixinMenu[parent_id]", "attribute": "parent_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"上级菜单必须是整数。"}}},{"id": "weixinmenu-menu_type", "name": "WeixinMenu[menu_type]", "attribute": "menu_type", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"菜单类型必须是整数。"}}},{"id": "weixinmenu-menu_sort", "name": "WeixinMenu[menu_sort]", "attribute": "menu_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。"}}},{"id": "weixinmenu-menu_name", "name": "WeixinMenu[menu_name]", "attribute": "menu_name", "rules": {"string":true,"messages":{"string":"菜单名称必须是一条字符串。","maxlength":"菜单名称只能包含至多5个字符。"},"maxlength":5}},{"id": "weixinmenu-menu_sort", "name": "WeixinMenu[menu_sort]", "attribute": "menu_sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于255。"},"min":0,"max":255}},]
</script>
<script type="text/javascript">
    //
</script>
<script src="/assets/d2eace91/min/js/validate.min.js?v=20200805"></script>
<script src="/assets/d2eace91/min/js/upload.min.js?v=20200805"></script>
<script>

    $().ready(function() {
        var validator = $("#WeixinMenu").validate();
// 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#client_rules").html());

        $('.bootstrap-switch [type="checkbox"]').bootstrapSwitch({
            radioAllOff: true,
            onSwitchChange: function(event, state) {
                $(event.target).prop("checked", state);
                $(event.target).change();
            }
        });

        $("#menu_img_container").imagegroup({
            host: '{{ get_oss_host() }}',
            size: 1,
            values: ["{{ $model['menu_img'] ?? '' }}"],
            callback: function(data) {
                $("#weixinmenu-menu_img").val(data.path);
            },
            remove: function(value, values) {
                $("#weixinmenu-menu_img").val('');
            }
        });

        $("[data-switch-toggle]").on("click", function() {
            var type = $(this).data("switch-toggle");
            return $("#switch-" + type).bootstrapSwitch("toggle" + type.charAt(0).toUpperCase() + type.slice(1));
        });
    });

    //
</script>