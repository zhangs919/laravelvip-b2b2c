{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-10 clearfix">
        <form id="{{ $uuid }}" class="form-horizontal" name="Region" action="/system/region/add?parent_code={{ $parent_code }}" method="post">
            @csrf
            <!-- 隐藏域 -->
            <input type="hidden" id="region-region_id" class="form-control" name="region_id" value="{{ $info->region_id ?? ''}}">
            <!-- 区域名称 -->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="region-region_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">地区名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="region-region_name" class="form-control" name="region_name" value="{{ $info->region_name ?? ''}}">

                            <input type="button" id="btn_search_region_name" class="btn btn-primary" value="搜索">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

            @if(isset($info->region_id))
                <!-- 区域代码 -->
                    <div class="simple-form-field">
                        <div class="form-group">
                            <label for="region-region_code" class="col-sm-4 control-label">
                                <span class="text-danger ng-binding">*</span>
                                <span class="ng-binding">地区代码：</span>
                            </label>
                            <div class="col-sm-8">
                                <div class="form-control-box">


                                    <input type="text" id="region-region_code" class="form-control" name="region_code" value="{{ $info->region_code }}" readonly="">
                                    <span class="region-code-info" style="display: none;">
			<i class="fa fa-warning m-l-5" style="vertical-align: initial; color: #FF9F24;"></i>
			<span class="content"></span>
		</span>


                                </div>

                                <div class="help-block help-block-t"></div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- 上级区域地址 -->
                @if(!isset($info->region_id))
                <div class="simple-form-field" >
                    <div class="form-group">
                        <label for="region-parent_code" class="col-sm-4 control-label">

                            <span class="ng-binding">上级地区：</span>
                        </label>
                        <div class="col-sm-8">
                            <div class="form-control-box">


                                <div class="parent-code"></div>
                                <input type="hidden" id="region-parent_code" class="form-control" name="parent_code" value="{{ $parent_code }}">


                            </div>

                            <div class="help-block help-block-t">
                                <div class="help-block help-block-t">如果为一级地区，此处不选；上级地区将会限制地区位置的搜索和定位</div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                    <div class="simple-form-field">
                        <div class="form-group">
                            <label for="region-parent_code" class="col-sm-4 control-label">

                                <span class="ng-binding">上级地区：</span>
                            </label>
                            <div class="col-sm-8">
                                <div class="form-control-box">


                                    <label class="control-label">@if($info->level == 1) 无 @else{{ $info->parent_region_name }}@endif</label>
                                    <span class="parent-code-info" style="display: none;">
                                        <i class="fa fa-warning m-l-5" style="vertical-align: initial; color: #FF9F24;"></i>
                                        <span class="content"></span>
                                    </span>


                                </div>

                                <div class="help-block help-block-t">
                                    @if($info->level == 1)
                                        <div class="help-block help-block-t">当前地区为第一级，无上级地区；上级地区将会限制地区位置的搜索和定位</div>
                                    @else
                                        <div class="help-block help-block-t">如果为一级地区，此处不选；上级地区将会限制地区位置的搜索和定位</div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            <!-- 地区类型 -->
            <div class="simple-form-field" >
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

                <!-- 地区位置-->
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="region-center" class="col-sm-4 control-label">

                        <span class="ng-binding">地区位置：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="hidden" id="region-center" class="form-control region-center" name="center" value="{{ $info->center ?? '' }}" readonly="readonly" style="width: 150px;">

                            <input type="text" id="address_detail" class="form-control" placeholder="请输入地区名称关键词" style="width: 250px;">

                            <input type="button" id="btn_search" class="btn btn-primary" value="搜索">

                            <div class="address-picker m-t-10">
                                <div id="map_container" class="amap-container"></div>
                                <p class="map-footer" style="display: none;">
                                    <a href="javascript:;" class="save-map">保存位置</a>
                                    <a href="javascript:;" class="back-map">回原位置</a>
                                </p>
                            </div>

                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">地区所在中心位置的经纬度，便于将地区与同城运费模板的规划范围进行匹配</div></div>
                    </div>
                </div>
            </div>
            <!-- 排序 -->
            <div class="simple-form-field" >
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
            <div class="simple-form-field" >
                <div class="form-group">
                    <label for="" class="col-sm-4 control-label">


                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <input type="button" class="btn btn-primary btn_submit" value="确认提交" />

                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>

        </form>
    </div>


@stop

{{--script page元素内--}}
@section('script')
    <!-- AJAX加载后的初始化 -->
    <script src="/assets/d2eace91/js/common.js?v=20180726"></script>
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20180726"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180726"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20180726"></script>
    <!-- 地区选择器 -->
    <script src="/assets/d2eace91/js/jquery.region.js?v=20180726"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20180726"></script>
    <!-- 高德地图 -->
	<script type="text/javascript">
		window._AMapSecurityConfig = {
			securityJsCode: "{{ sysconf('amap_js_security_code') }}",
		};
	</script>
    <script type="text/javascript" src="//webapi.amap.com/maps?v=1.4.15&key={{ sysconf('amap_js_key') }}&&plugin=AMap.Scale,AMap.PolyEditor,AMap.Geocoder,AMap.Autocomplete,AMap.PlaceSearch,AMap.InfoWindow,AMap.ToolBar"></script>
    @if(!isset($info->region_id))
        <!-- 验证规则 -->
        <script id="client_rules_{{ $uuid }}" type="text">
[{"id": "region-region_name", "name": "Region[region_name]", "attribute": "region_name", "rules": {"required":true,"messages":{"required":"地区名称不能为空。"}}},{"id": "region-region_code", "name": "Region[region_code]", "attribute": "region_code", "rules": {"required":true,"messages":{"required":"地区代码不能为空。"}}},{"id": "region-sort", "name": "Region[sort]", "attribute": "sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。"}}},{"id": "region-level", "name": "Region[level]", "attribute": "level", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"级别必须是整数。"}}},{"id": "region-is_enable", "name": "Region[is_enable]", "attribute": "is_enable", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否启用必须是整数。"}}},{"id": "region-is_enable", "name": "Region[is_enable]", "attribute": "is_enable", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否启用必须是整数。"}}},{"id": "region-region_name", "name": "Region[region_name]", "attribute": "region_name", "rules": {"string":true,"messages":{"string":"地区名称必须是一条字符串。","maxlength":"地区名称只能包含至多30个字符。"},"maxlength":30}},{"id": "region-region_code", "name": "Region[region_code]", "attribute": "region_code", "rules": {"string":true,"messages":{"string":"地区代码必须是一条字符串。","maxlength":"地区代码只能包含至多30个字符。"},"maxlength":30}},{"id": "region-parent_code", "name": "Region[parent_code]", "attribute": "parent_code", "rules": {"string":true,"messages":{"string":"上级地区代码必须是一条字符串。","maxlength":"上级地区代码只能包含至多30个字符。"},"maxlength":30}},{"id": "region-region_type", "name": "Region[region_type]", "attribute": "region_type", "rules": {"string":true,"messages":{"string":"地区类型必须是一条字符串。","maxlength":"地区类型只能包含至多90个字符。"},"maxlength":90}},{"id": "region-center", "name": "Region[center]", "attribute": "center", "rules": {"string":true,"messages":{"string":"地区经纬度必须是一条字符串。","maxlength":"地区经纬度只能包含至多180个字符。"},"maxlength":180}},{"id": "region-city_code", "name": "Region[city_code]", "attribute": "city_code", "rules": {"string":true,"messages":{"string":"地区邮政编码必须是一条字符串。","maxlength":"地区邮政编码只能包含至多11个字符。"},"maxlength":11}},{"id": "region-sort", "name": "Region[sort]", "attribute": "sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于255。"},"min":0,"max":255}},{"id": "region-region_code", "name": "Region[region_code]", "attribute": "region_code", "rules": {"ajax":{"url":"/system/region/client-validate","model":"Y29tbW9uXG1vZGVsc1xSZWdpb24=","attribute":"region_code","params":[{"Region[region_id]":null},{"Region[region_code]":{"selector":"[name='region_code']"}}]},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},]
</script>
        <script type="text/javascript">
            var regionselector = null;
            var regionselector_init = true;
            var regionselector_reload = false;
            var regionselector_change = false;
            var region_level = 3;
        </script>
        <script type="text/javascript">
            $().ready(function() {
                // 初始化地区代码
                regionselector = $("#{{ $uuid }}").find(".parent-code").regionselector({
                    select_class: 'form-control',
                    value: '{{ $parent_code }}',
                    check_all: false,
                    change: function(value, names, is_last, data) {
                        $("#1534954053H09WMk").find("[name='parent_code']").val(value);
                        // 动态指定城市
                        if (addresspicker) {
                            addresspicker.setCity(value.split(",", 3).join(""));
                        }
                        // 设置地区类型
                        if (names.length == 0) {
                            $("#region-region_type").val("province");
                        } else if (names.length == 1) {
                            $("#region-region_type").val("city");
                        } else if (names.length == 2) {
                            $("#region-region_type").val("district");
                        } else {
                            $("#region-region_type").val("street");
                        }

                        // 地区级别
                        region_level = names.length;

                        if (regionselector_reload) {
                            regionselector_reload = false;
                            return;
                        }

                        if (regionselector_init) {
                            regionselector_init = false;
                            return;
                        }

                        if (addresspicker && data.center) {
                            regionselector_change = true;
                            addresspicker.map.setCenter(data.center.split(","));
                        }
                    }
                });
            });
        </script>
        <script type="text/javascript">
            var addresspicker = null;
            var address_exist = false;
            var address_adcode = null;
            var validator = null;
            $().ready(function() {

                //

                //
                var position = "{{ $parent_region_name }}";
                //

                // 地址选择器
                addresspicker = $("#map_container").addresspicker({
                    // 当前位置
                    position: position,
                    // 自动提示
                    input: "address_detail",
                    // 当前地区编码
                    city: "" == "" ? null : "",
                    // 不支持底部按钮栏
                    footer_enable: false,
                    // 提示信息回调
                    win_content_callback: function(infoWindow, content, is_address, data) {

                        if (data.adcode) {

                            address_adcode = data.adcode;

                            //

                            if (regionselector) {
                                if (regionselector_change == false) {
                                    // 获取当前等级的地区代码
                                    var region_code = this.toRegionCode(address_adcode, region_level);
                                    // 地区变化则重新加载
                                    if (region_code != regionselector.value) {
                                        // 重新加载
                                        regionselector_reload = true;
                                        regionselector.value = region_code;
                                        regionselector.reload(region_code);
                                    }
                                } else {
                                    regionselector_change = false;
                                }
                            }

                            //

                        } else {
                            address_adcode = null;
                        }

                        // 记录地址是否存在
                        address_exist = is_address;
                        // 显示内容
                        if (!is_address) {
                            infoWindow.setContent("<font color='#FF7C00'>" + content + "</font>");
                        } else {
                            var color = $("#btn_save").css("background-color");
                            infoWindow.setContent("当前位置：<label style='color: #ff4500;'>" + content + "</label>");
                        }
                    },
                    input_callback: function(e) {
                        if (e.poi) {
                            // 地址存在
                            address_exist = true;
                            // 记录地区编码
                            address_adcode = e.poi.adcode;
                        } else {
                            // 地址不存在
                            address_exist = false;
                            // 记录地区编码
                            address_adcode = null;
                        }
                    }
                });

                $("#btn_search").click(function() {
                    var address = $("#address_detail").val();
                    if ($.trim(address) == "") {
                        $("#address_detail").focus();
                        $.msg("地址关键词不能为空！");
                        return;
                    }
                    addresspicker.search(address, addresspicker.city, function(result) {
                        if (result.poiList && result.poiList.pois[0]) {
                            // 地址存在
                            address_exist = true;
                            // 获取地区编码
                            address_adcode = result.poiList.pois[0].adcode;
                        } else {
                            // 地址不存在
                            address_exist = false;
                            // 记录地区编码
                            address_adcode = null;
                        }
                    });
                });

                $("#btn_search_region_name").click(function() {
                    var address = $("#region-region_name").val();
                    if ($.trim(address) == "") {
                        $("#region-region_name").focus();
                        $.msg("地区名称不能为空！");
                        return;
                    }
                    addresspicker.search(address, addresspicker.city, function(result) {
                        if (result.poiList && result.poiList.pois[0]) {
                            // 地址存在
                            address_exist = true;
                            // 获取地区编码
                            address_adcode = result.poiList.pois[0].adcode;
                        } else {
                            // 地址不存在
                            address_exist = false;
                            // 记录地区编码
                            address_adcode = null;
                        }
                    });
                });

                validator = $("#{{ $uuid }}").validate();
                // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
                $.validator.addRules($("#client_rules_{{ $uuid }}").html(), {
                    attribute: "id"
                });
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

                    function submit() {
                        // 获取地图位置
                        if (address_error == false && address_exist == true && address_adcode != null && addresspicker.map) {
                            var location = addresspicker.map.getCenter();
                            data.center = location.lng + "," + location.lat;
                        }

                        $.post(url, data, function(result) {
                            if (result.code == 0) {
                                $.msg(result.message, {
                                    time: 1500
                                }, function() {
                                    $.go();
                                });
                            } else {
                                $.msg(result.message, {
                                    time: 5000
                                });
                            }
                        }, "json").always(function() {
                            $.loading.stop();
                        });
                    }

                    if (addresspicker) {
                        if (address_adcode && (address_adcode == addresspicker.city || address_adcode.indexOf(addresspicker.city) === 0)) {
                            address_error = false;
                        } else {
                            address_error = true;
                        }
                    } else {
                        address_error = false;
                    }

                    if (address_adcode == null) {
                        $.confirm("您尚未选择一个有效的地区位，将无法获取到地区位置，是否继续提交地区信息？", {
                            title: '警告',
                            btn: ['继续提交', '返回修改']
                        }, function() {
                            submit();
                        });
                    } else if (address_error == true) {
                        $.confirm("您在选择的上级地区与地图上所选位置不匹配，将无法获取到地区位置，是否继续提交地区信息？", {
                            title: '警告',
                            btn: ['继续提交', '返回修改']
                        }, function() {
                            submit();
                        });
                    } else if (address_exist == false) {
                        $.confirm("地区位置不正确，将无法获取到地区位置，是否继续提交地区信息？", {
                            title: '警告',
                            btn: ['继续提交', '返回修改']
                        }, function() {
                            submit();
                        });
                    } else {
                        submit();
                    }
                });
            });
        </script>
    @else
        <!-- 验证规则 -->
        <script id="client_rules_{{ $uuid }}" type="text">
[{"id": "region-region_name", "name": "Region[region_name]", "attribute": "region_name", "rules": {"required":true,"messages":{"required":"地区名称不能为空。"}}},{"id": "region-region_code", "name": "Region[region_code]", "attribute": "region_code", "rules": {"required":true,"messages":{"required":"地区代码不能为空。"}}},{"id": "region-sort", "name": "Region[sort]", "attribute": "sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。"}}},{"id": "region-level", "name": "Region[level]", "attribute": "level", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"级别必须是整数。"}}},{"id": "region-is_enable", "name": "Region[is_enable]", "attribute": "is_enable", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否启用必须是整数。"}}},{"id": "region-is_enable", "name": "Region[is_enable]", "attribute": "is_enable", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否启用必须是整数。"}}},{"id": "region-region_name", "name": "Region[region_name]", "attribute": "region_name", "rules": {"string":true,"messages":{"string":"地区名称必须是一条字符串。","maxlength":"地区名称只能包含至多30个字符。"},"maxlength":30}},{"id": "region-region_code", "name": "Region[region_code]", "attribute": "region_code", "rules": {"string":true,"messages":{"string":"地区代码必须是一条字符串。","maxlength":"地区代码只能包含至多30个字符。"},"maxlength":30}},{"id": "region-parent_code", "name": "Region[parent_code]", "attribute": "parent_code", "rules": {"string":true,"messages":{"string":"上级地区代码必须是一条字符串。","maxlength":"上级地区代码只能包含至多30个字符。"},"maxlength":30}},{"id": "region-region_type", "name": "Region[region_type]", "attribute": "region_type", "rules": {"string":true,"messages":{"string":"地区类型必须是一条字符串。","maxlength":"地区类型只能包含至多90个字符。"},"maxlength":90}},{"id": "region-center", "name": "Region[center]", "attribute": "center", "rules": {"string":true,"messages":{"string":"地区经纬度必须是一条字符串。","maxlength":"地区经纬度只能包含至多180个字符。"},"maxlength":180}},{"id": "region-city_code", "name": "Region[city_code]", "attribute": "city_code", "rules": {"string":true,"messages":{"string":"地区邮政编码必须是一条字符串。","maxlength":"地区邮政编码只能包含至多11个字符。"},"maxlength":11}},{"id": "region-sort", "name": "Region[sort]", "attribute": "sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"排序必须是整数。","min":"排序必须不小于0。","max":"排序必须不大于255。"},"min":0,"max":255}},{"id": "region-region_code", "name": "Region[region_code]", "attribute": "region_code", "rules": {"ajax":{"url":"/system/region/client-validate","model":"Y29tbW9uXG1vZGVsc1xSZWdpb24=","attribute":"region_code","params":[{"Region[region_id]":"{{ $info->region_id }}"},{"Region[region_code]":{"selector":"[name='region_code']"}}]},"messages":{"ajax":"{attribute}\"{value}\"已经被占用了。"}}},]
</script>
        <script type="text/javascript">
            var regionselector = null;
            var regionselector_init = true;
            var regionselector_reload = false;
            var regionselector_change = false;
            var region_level = {{ $info->level }};
        </script>
        <script type="text/javascript">
            var addresspicker = null;
            var address_exist = false;
            var address_adcode = null;
            var validator = null;
            $().ready(function() {

                //
                region_level = parseInt("{{ $info->level - 1 }}");
                if (region_level == 0) {
                    $("#region-region_type").val("province");
                } else if (region_level == 1) {
                    $("#region-region_type").val("city");
                } else if (region_level == 2) {
                    $("#region-region_type").val("district");
                } else {
                    $("#region-region_type").val("street");
                }
                //

                //
                var position = {
                    lng: "{{ $info->lng }}",
                    lat: "{{ $info->lat }}"
                };
                //

                // 地址选择器
                addresspicker = $("#map_container").addresspicker({
                    // 当前位置
                    position: position,
                    // 自动提示
                    input: "address_detail",
                    // 当前地区编码
                    city: "{{ $info->region_id }}" == "" ? null : "{{ $info->parent_code_str }}",
                    // 不支持底部按钮栏
                    footer_enable: false,
                    // 提示信息回调
                    win_content_callback: function(infoWindow, content, is_address, data) {

                        if (data.adcode) {

                            address_adcode = data.adcode;

                            //

                            var region_code = this.toRegionCode(address_adcode, region_level + 1);

                            if (region_code != "{{ $info->region_code }}") {
                                $(".region-code-info").show().find(".content").html("地图中的地区代码[" + region_code + "]与当前地区代码不匹配，请检查地区是否定位正确！如果需要地图中的位置请重新创建一个地区！");
                            } else {
                                $(".region-code-info").hide();
                            }

                            //

                        } else {
                            address_adcode = null;
                        }

                        // 记录地址是否存在
                        address_exist = is_address;
                        // 显示内容
                        if (!is_address) {
                            infoWindow.setContent("<font color='#FF7C00'>" + content + "</font>");
                        } else {
                            var color = $("#btn_save").css("background-color");
                            infoWindow.setContent("当前位置：<label style='color: #ff4500;'>" + content + "</label>");
                        }
                    },
                    input_callback: function(e) {
                        if (e.poi) {
                            // 地址存在
                            address_exist = true;
                            // 记录地区编码
                            address_adcode = e.poi.adcode;
                        } else {
                            // 地址不存在
                            address_exist = false;
                            // 记录地区编码
                            address_adcode = null;
                        }
                    }
                });

                $("#btn_search").click(function() {
                    var address = $("#address_detail").val();
                    if ($.trim(address) == "") {
                        $("#address_detail").focus();
                        $.msg("地址关键词不能为空！");
                        return;
                    }
                    addresspicker.search(address, addresspicker.city, function(result) {
                        if (result.poiList && result.poiList.pois[0]) {
                            // 地址存在
                            address_exist = true;
                            // 获取地区编码
                            address_adcode = result.poiList.pois[0].adcode;
                        } else {
                            // 地址不存在
                            address_exist = false;
                            // 记录地区编码
                            address_adcode = null;
                        }
                    });
                });

                $("#btn_search_region_name").click(function() {
                    var address = $("#region-region_name").val();
                    if ($.trim(address) == "") {
                        $("#region-region_name").focus();
                        $.msg("地区名称不能为空！");
                        return;
                    }
                    addresspicker.search(address, addresspicker.city, function(result) {
                        if (result.poiList && result.poiList.pois[0]) {
                            // 地址存在
                            address_exist = true;
                            // 获取地区编码
                            address_adcode = result.poiList.pois[0].adcode;
                        } else {
                            // 地址不存在
                            address_exist = false;
                            // 记录地区编码
                            address_adcode = null;
                        }
                    });
                });

                validator = $("#{{ $uuid }}").validate();
                // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
                $.validator.addRules($("#client_rules_{{ $uuid }}").html(), {
                    attribute: "id"
                });
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

                    function submit() {
                        // 获取地图位置
                        if (address_error == false && address_exist == true && address_adcode != null && addresspicker.map) {
                            var location = addresspicker.map.getCenter();
                            data.center = location.lng + "," + location.lat;
                        }

                        $.post(url, data, function(result) {
                            if (result.code == 0) {
                                $.msg(result.message, {
                                    time: 1500
                                }, function() {
                                    $.go();
                                });
                            } else {
                                $.msg(result.message, {
                                    time: 5000
                                });
                            }
                        }, "json").always(function() {
                            $.loading.stop();
                        });
                    }

                    if (addresspicker) {
                        if (address_adcode && (address_adcode == addresspicker.city || address_adcode.indexOf(addresspicker.city) === 0)) {
                            address_error = false;
                        } else {
                            address_error = true;
                        }
                    } else {
                        address_error = false;
                    }

                    if (address_adcode == null) {
                        $.confirm("您尚未选择一个有效的地区位，将无法获取到地区位置，是否继续提交地区信息？", {
                            title: '警告',
                            btn: ['继续提交', '返回修改']
                        }, function() {
                            submit();
                        });
                    } else if (address_error == true) {
                        $.confirm("您在选择的上级地区与地图上所选位置不匹配，将无法获取到地区位置，是否继续提交地区信息？", {
                            title: '警告',
                            btn: ['继续提交', '返回修改']
                        }, function() {
                            submit();
                        });
                    } else if (address_exist == false) {
                        $.confirm("地区位置不正确，将无法获取到地区位置，是否继续提交地区信息？", {
                            title: '警告',
                            btn: ['继续提交', '返回修改']
                        }, function() {
                            submit();
                        });
                    } else {
                        submit();
                    }
                });
            });
        </script>
    @endif

@stop

{{--自定义css样式 page元素内--}}
@section('style_css')

@stop

{{--extra html block page元素同级下面--}}
@section('extra_html')

@stop

{{--footer script page元素同级下面--}}
@section('footer_script')

@stop

{{--outside body script--}}
@section('outside_body_script')

@stop
