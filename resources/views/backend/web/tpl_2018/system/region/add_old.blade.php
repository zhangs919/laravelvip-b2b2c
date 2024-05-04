<div class="table-content m-t-10 clearfix">
    <form id="{{ $uuid }}" class="form-horizontal" name="Region" action="/system/region/add?parent_code={{ $parent_code }}" method="post" novalidate="novalidate">
        @csrf
        <!-- 隐藏域 -->
        <input type="hidden" id="region-region_id" class="form-control" name="region_id" value="{{ $info->region_id ?? ''}}">
        <!-- 区域名称 -->
        <div class="simple-form-field">
            <div class="form-group">
                <label for="region-region_name" class="col-sm-4 control-label">
                    <span class="text-danger ng-binding">*</span>
                    <span class="ng-binding">地区名称：</span>
                </label>
                <div class="col-sm-8">
                    <div class="form-control-box">


                        <input type="text" id="region-region_name" class="form-control" name="region_name" value="{{ $info->region_name ?? ''}}">


                    </div>

                    <div class="help-block help-block-t"></div>
                </div>
            </div>
        </div>
        <!-- 上级区域地址 -->
        <div class="simple-form-field">
            <div class="form-group">
                <label for="region-parent_code" class="col-sm-4 control-label">

                    <span class="ng-binding">上级地区代码：</span>
                </label>
                <div class="col-sm-8">
                    <div class="form-control-box">


                        <div class="parent-code">
                            {{--<select class="form-control render-selector">
                                <option value="">-请选择-</option>
                                @foreach($parent_area as $v)
                                    @if(isset($info->parent_code))
                                        <option value="{{ $v->region_code }}" @if($info->parent_code == $v->region_code)selected=""@endif>{{ $v->region_name }}</option>
                                    @else
                                        <option value="{{ $v->region_code }}">{{ $v->region_name }}</option>
                                    @endif
                                @endforeach
                            </select>--}}
                        </div>
                        <input type="hidden" id="region-parent_code" class="form-control" name="parent_code" value="{{ $parent_code }}">


                    </div>

                    <div class="help-block help-block-t"><div class="help-block help-block-t">如果为一级地区，此处不选</div></div>
                </div>
            </div>
        </div>
        <!-- 地区类型 -->
        <div class="simple-form-field">
            <div class="form-group">
                <label for="region-region_type" class="col-sm-4 control-label">

                    <span class="ng-binding">地区类型：</span>
                </label>
                <div class="col-sm-8">
                    <div class="form-control-box">


                        <select id="region-region_type" class="form-control" name="region_type">
                            @foreach($region_type_data as $k=>$v)
                                @if(isset($info->parent_code))
                                    <option value="{{ $k }}" @if($info->region_type == $k)selected=""@endif>{{ $v }}</option>
                                @else
                                    <option value="{{ $k }}">{{ $v }}</option>
                                @endif
                            @endforeach
                        </select>


                    </div>

                    <div class="help-block help-block-t"><div class="help-block help-block-t">用于备注区分地区类型</div></div>
                </div>
            </div>
        </div>
        <!-- 是否启用 -->
        <div class="simple-form-field">
            <div class="form-group">
                <label for="region-is_enable" class="col-sm-4 control-label">

                    <span class="ng-binding">是否启用：</span>
                </label>
                <div class="col-sm-8">
                    <div class="form-control-box">


                        <label class="control-label control-label-switch">
                            <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                <input type="hidden" name="is_enable" value="0">
                                <label>
                                    <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-on bootstrap-switch-id-region-is_enable bootstrap-switch-animate" style="width: 78px;">
                                        <input type="checkbox"
                                               id="region-is_enable"
                                               class="form-control b-n"
                                               name="is_enable" value="1"
                                               checked="" data-on-text="启用"
                                               data-off-text="禁用">
                                    </div>
                                </label>
                            </div>
                        </label>


                    </div>

                    <div class="help-block help-block-t"><div class="help-block help-block-t">启用：商城所有涉及地区的地方即可选择使用；禁用：商城所有涉及地区的地方将不展示禁止地区</div></div>
                </div>
            </div>
        </div>
        <!-- 排序 -->
        <div class="simple-form-field">
            <div class="form-group">
                <label for="region-sort" class="col-sm-4 control-label">

                    <span class="ng-binding">排序：</span>
                </label>
                <div class="col-sm-8">
                    <div class="form-control-box">


                        <input type="text" id="region-sort" class="form-control small" name="sort" value="{{ $info->sort ?? 255 }}">


                    </div>

                    <div class="help-block help-block-t"><div class="help-block help-block-t">控制地区在地区列表中展示顺序，数字范围为0~255，数字越小越靠前</div></div>
                </div>
            </div>
        </div>
        <!-- 审核是否通过 -->
        <div class="simple-form-field">
            <div class="form-group">
                <label for="" class="col-sm-4 control-label">


                </label>
                <div class="col-sm-8">
                    <div class="form-control-box">

                        <input type="button" class="btn btn-primary btn_submit" value="确认提交">

                    </div>

                    <div class="help-block help-block-t"></div>
                </div>
            </div>
        </div>

    </form>
</div>
<!-- AJAX加载后的初始化 -->
<script src="/assets/d2eace91/js/common.js?v=1.2"></script>
<!-- 验证规则 -->
<script id="client_rules_{{ $uuid }}" type="text">
@if(!isset($info->region_id))
    [{"id": "region-region_name", "name": "Region[region_name]", "attribute": "region_name", "rules": {"required":true,"messages":{"required":"地区名称不能为空。"}}},{"id": "region-region_code", "name": "Region[region_code]", "attribute": "region_code", "rules": {"required":true,"messages":{"required":"地区代码不能为空。"}}},{"id": "region-sort", "name": "Region[sort]", "attribute": "sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。"}}},{"id": "region-level", "name": "Region[level]", "attribute": "level", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"级别必须是整数。"}}},{"id": "region-is_enable", "name": "Region[is_enable]", "attribute": "is_enable", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否启用必须是整数。"}}},{"id": "region-is_enable", "name": "Region[is_enable]", "attribute": "is_enable", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否启用必须是整数。"}}},{"id": "region-region_name", "name": "Region[region_name]", "attribute": "region_name", "rules": {"string":true,"messages":{"string":"地区名称必须是一条字符串。","maxlength":"地区名称只能包含至多30个字符。"},"maxlength":30}},{"id": "region-region_code", "name": "Region[region_code]", "attribute": "region_code", "rules": {"string":true,"messages":{"string":"地区代码必须是一条字符串。","maxlength":"地区代码只能包含至多30个字符。"},"maxlength":30}},{"id": "region-parent_code", "name": "Region[parent_code]", "attribute": "parent_code", "rules": {"string":true,"messages":{"string":"上级地区代码必须是一条字符串。","maxlength":"上级地区代码只能包含至多30个字符。"},"maxlength":30}},{"id": "region-sort", "name": "Region[sort]", "attribute": "sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于255。"},"min":0,"max":255}},]
@else
    [{"id": "region-region_name", "name": "Region[region_name]", "attribute": "region_name", "rules": {"required":true,"messages":{"required":"地区名称不能为空。"}}},{"id": "region-region_code", "name": "Region[region_code]", "attribute": "region_code", "rules": {"required":true,"messages":{"required":"地区代码不能为空。"}}},{"id": "region-sort", "name": "Region[sort]", "attribute": "sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。"}}},{"id": "region-level", "name": "Region[level]", "attribute": "level", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"级别必须是整数。"}}},{"id": "region-is_enable", "name": "Region[is_enable]", "attribute": "is_enable", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否启用必须是整数。"}}},{"id": "region-is_enable", "name": "Region[is_enable]", "attribute": "is_enable", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否启用必须是整数。"}}},{"id": "region-region_name", "name": "Region[region_name]", "attribute": "region_name", "rules": {"string":true,"messages":{"string":"地区名称必须是一条字符串。","maxlength":"地区名称只能包含至多30个字符。"},"maxlength":30}},{"id": "region-region_code", "name": "Region[region_code]", "attribute": "region_code", "rules": {"string":true,"messages":{"string":"地区代码必须是一条字符串。","maxlength":"地区代码只能包含至多30个字符。"},"maxlength":30}},{"id": "region-parent_code", "name": "Region[parent_code]", "attribute": "parent_code", "rules": {"string":true,"messages":{"string":"上级地区代码必须是一条字符串。","maxlength":"上级地区代码只能包含至多30个字符。"},"maxlength":30}},{"id": "region-region_type", "name": "Region[region_type]", "attribute": "region_type", "rules": {"string":true,"messages":{"string":"地区类型必须是一条字符串。","maxlength":"地区类型只能包含至多90个字符。"},"maxlength":90}},{"id": "region-center", "name": "Region[center]", "attribute": "center", "rules": {"string":true,"messages":{"string":"地区经纬度必须是一条字符串。","maxlength":"地区经纬度只能包含至多180个字符。"},"maxlength":180}},{"id": "region-city_code", "name": "Region[city_code]", "attribute": "city_code", "rules": {"string":true,"messages":{"string":"地区邮政编码必须是一条字符串。","maxlength":"地区邮政编码只能包含至多11个字符。"},"maxlength":11}},{"id": "region-sort", "name": "Region[sort]", "attribute": "sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于255。"},"min":0,"max":255}},{"id": "region-region_code", "name": "Region[region_code]", "attribute": "region_code", "rules": {"ajax":{"url":"/system/region/client-validate","model":"Y29tbW9uXG1vZGVsc1xSZWdpb24=","attribute":"region_code","params":[{"Region[region_id]":1},{"Region[region_code]":{"selector":"[name='region_code']"}}]},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},]
@endif
</script>
<script type="text/javascript">
    $().ready(function() {
        // 初始化地区代码
        var regionselector = $("#{{ $uuid }}").find(".parent-code").regionselector({
            select_class: 'form-control',
            value: '{{ $parent_code }}',
            check_all: false,
            change: function(value, name, names) {
                $("#{{ $uuid }}").find("[name='parent_code']").val(value);
            }
        });
    });
</script>
<script type="text/javascript">
    $().ready(function() {
        var validator = $("#{{ $uuid }}").validate();
        // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
        $.validator.addRules($("#client_rules_{{ $uuid }}").html());
        // 提交
        $("#{{ $uuid }}").find(".btn_submit").click(function() {
            if (!validator.form()) {
                return;
            }
            //加载提示
            $.loading.start();
            //清空文件
            var url = $("#{{ $uuid }}").attr("action")
            var data = $("#{{ $uuid }}").serializeJson();

            $.post(url, data, function(result) {
                $.loading.stop();
                if (result.code == 0) {
                    $.msg(result.message);
                    window.location.reload();
                } else {
                    $.msg(result.message, {
                        time: 5000
                    });
                }
            }, "json");
        });
    });
</script>