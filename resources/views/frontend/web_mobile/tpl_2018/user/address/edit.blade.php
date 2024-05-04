@extends('layouts.user_layout')


{{--header_css--}}
@section('header_css')

@stop


@section('content')
    <!-- 地区选择器 -->
    <header class="header-top-nav">
        <div class="header">
            <div class="header-left">
                <a class="sb-back" href="{{ $back_url ?? 'javascript:history.back(-1)' }}" title="返回">
                    <i class="iconfont">&#xe606;</i>
                </a>
            </div>
            <div class="header-middle">收货地址管理</div>
            <div class="header-right">
                <!-- 控制展示更多按钮 -->
                <aside class="show-menu-btn">
                    <div class="show-menu" id="show_more">
                        <a href="javascript:void(0);">
                            <i class="iconfont">&#xe6cd;</i>
                        </a>
                    </div>
                </aside>
            </div>
        </div>
    </header>
    <div class="addressmone1">
        <form id="UserAddressModel" class="form-horizontal" name="UserAddressModel" action="/user/address/edit.html?address_id={{ $address_info->address_id }}&amp;back_url=/user/address.html" method="post">
            @csrf

            <input type="hidden" id="address_lng" class="address_lng" name="UserAddressModel[address_lng]" value="{{ $address_info->address_lng }}">

            <input type="hidden" id="address_lat" class="address_lat" name="UserAddressModel[address_lat]" value="{{ $address_info->address_lat }}">
            <div class="form-group-box">
                <div class="address-info-hd">
                    <!-- 收货人 -->
                    <div class="form-group form-group-spe" >
                        <dl>
                            <dt>
                                <span>收货人：</span>
                            </dt>
                            <dd>
                                <div class="form-control-box">


                                    <input type="text" id="useraddressmodel-consignee" class="consignee" name="UserAddressModel[consignee]" value="{{ $address_info->consignee }}" autocomplete="off" placeholder="你的姓名">


                                </div>

                            </dd>
                        </dl>
                    </div>
                    <div class="invalid"></div>
                    <!-- 联系电话 -->
                    <div class="form-group form-group-spe" >
                        <dl>
                            <dt>
                                <span>手机号码：</span>
                            </dt>
                            <dd>
                                <div class="form-control-box">


                                    <input type="number" id="useraddressmodel-mobile" class="mobile" name="UserAddressModel[mobile]" value="{{ $address_info->mobile }}" autocomplete="off" placeholder="你的手机号" pattern="[0-9]*">


                                </div>

                            </dd>
                        </dl>
                    </div>
                    <div class="invalid"></div>
                </div>
                <div class="address-info-bd">
                    <!-- 收货地址 -->
                    <div class="form-group form-group-spe" >
                        <dl>
                            <dt>
                                <span>收货城市：</span>
                            </dt>
                            <dd>
                                <div class="form-control-box">
                                    <i class="iconfont icon-dizhi2"></i>
                                    <div class="region-chooser-container region-chooser region-box">正在获取当前地区</div>

                                    <input type="hidden" id="region_code" name="UserAddressModel[region_code]">
                                    <span id="region_code_containter" class="select"></span>


                                </div>

                            </dd>
                        </dl>
                    </div>
                    <div class="invalid"></div>
                    <!-- 详细地址 s-->

                    <div class="form-group form-group-spe" >
                        <dl>
                            <dt>
                                <span>获取定位：</span>
                            </dt>
                            <dd>
                                <div class="form-control-box">

                                    <div class="address-detail SZY-POSITION">

                                        {{ $address_info->address_detail }}

                                    </div>
                                    <input type="hidden" id="address_detail" class="form-control" name="UserAddressModel[address_detail]" value="{{ $address_info->address_detail }}" placeholder="输入详细地址">

                                    <!-- <a href="javascript:void(0);" class="btn-finish hide">完成</a> -->


                                </div>

                            </dd>
                        </dl>
                    </div>
                    <div class="invalid"></div>

                    <!-- 门牌号 -->

                    <div class="form-group form-group-spe" >
                        <dl>
                            <dt>
                                <span>详细地址：</span>
                            </dt>
                            <dd>
                                <div class="form-control-box">

                                    <input type="text" id="useraddressmodel-address_house" class="address_house" name="UserAddressModel[address_house]" value="{{ $address_info->address_house }}" placeholder="例：5号楼301室">


                                </div>

                            </dd>
                        </dl>
                    </div>
                    <div class="invalid"></div>
                    <!-- 标签 -->
                    <div class="form-group form-group-spe" >
                        <dl>
                            <dt>
                                <span>标签：</span>
                            </dt>
                            <dd>
                                <div class="form-control-box">


                                    <div class="address-label">
                                        <span class="@if($address_info->address_label == '家') current @endif">家</span>
                                        <span class="@if($address_info->address_label == '公司') current @endif">公司</span>
                                        <span class="label-custom @if(!in_array($address_info->address_label, ['家', '公司']) && $address_info->address_label != '') current @endif">
                                            @if(!in_array($address_info->address_label, ['家', '公司']) && $address_info->address_label != '') <font>{{ $address_info->address_label }}</font> @else <font>自定义</font> @endif
                                            <input type="hidden" id="useraddressmodel-address_label" class="label-custom-input" name="UserAddressModel[address_label]" value="{{ $address_info->address_label }}">
                                        </span>
                                    </div>



                                </div>

                            </dd>
                        </dl>
                    </div>
                    <div class="invalid"></div>
                </div>
            </div>
            <!-- 地区选择代码-->
            <div class="save_btn ok">
                <a class="btn save-btn-only" href="javascript:void(0);" id="btn_validate">确定</a>
            </div>

            <input type="hidden" name="address_id" value="{{ $address_info->address_id }}">

        </form>
    </div>
    <section class="mask-div" style="display: none;"></section>
    <!--地图定位弹出层 显示增加show-->
    <div class="map-popup-layer">
        <div class="search-header">
            <div class="search-left">
                <a href="javascript:close()" class="sb-back" title="返回"></a>
            </div>
            <div class="search-middle width-mid">
                <div class="search-info">
                    <div class="text-box ub">
                        <input type="submit" class="search-icon-submit" value="">
                        <input type="text" class="text" id="map_search" placeholder="搜索小区/大厦/学校等">
                    </div>
                </div>
            </div>
        </div>
        <div class="suggestion-wrap hide"></div>
        <div class="address-fixed-layer"></div>
        <div class="map-con">
            <div id="map_container" class="map-pic-con"></div>
            <div class="map-list">
                <div class="map-list-inner">
                    <ul class="address-list SZY-MOBILE-ADDRESS-LIST">
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        //
    </script>
    <script type="text/javascript">
        //
    </script>
    <!-- 表单验证 -->
    <!-- GPS获取坐标 -->
	<script type="text/javascript">
		window._AMapSecurityConfig = {
			securityJsCode: "{{ sysconf('amap_js_security_code') }}",
		};
	</script>
    <script type="text/javascript" src="https://webapi.amap.com/maps?v=1.4.6&key={{ sysconf('amap_js_key') }}&&plugin=AMap.Scale,AMap.PolyEditor,AMap.Geocoder,AMap.Autocomplete,AMap.PlaceSearch,AMap.InfoWindow,AMap.ToolBar"></script>
    <!-- jweixin -->
    <script src="https://res.wx.qq.com/open/js/jweixin-1.6.0.js"></script>
    <script id="client_rules" type="text">
[{"id": "useraddressmodel-region_code", "name": "UserAddressModel[region_code]", "attribute": "region_code", "rules": {"required":true,"messages":{"required":"收货城市不能为空。"}}},{"id": "useraddressmodel-user_id", "name": "UserAddressModel[user_id]", "attribute": "user_id", "rules": {"required":true,"messages":{"required":"用户ID不能为空。"}}},{"id": "useraddressmodel-consignee", "name": "UserAddressModel[consignee]", "attribute": "consignee", "rules": {"required":true,"messages":{"required":"收货人不能为空。"}}},{"id": "useraddressmodel-address_detail", "name": "UserAddressModel[address_detail]", "attribute": "address_detail", "rules": {"required":true,"messages":{"required":"详细地址不能为空。"}}},{"id": "useraddressmodel-mobile", "name": "UserAddressModel[mobile]", "attribute": "mobile", "rules": {"required":true,"messages":{"required":"手机号码不能为空。"}}},{"id": "useraddressmodel-user_id", "name": "UserAddressModel[user_id]", "attribute": "user_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"用户ID必须是整数。"}}},{"id": "useraddressmodel-real", "name": "UserAddressModel[real]", "attribute": "real", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否实名认证必须是整数。"}}},{"id": "useraddressmodel-address_name", "name": "UserAddressModel[address_name]", "attribute": "address_name", "rules": {"string":true,"messages":{"string":"地址别名必须是一条字符串。","maxlength":"地址别名只能包含至多60个字符。","match":"地址别名中含有非法字符"},"maxlength":60,"match":{"pattern":/<|>|<script|<img|<svg|alert|prompt|cookie|@eval|@ini_set|@set_time_limit|\$_SERVER|@set_magic_quotes_runtime/,"not":true}}},{"id": "useraddressmodel-email", "name": "UserAddressModel[email]", "attribute": "email", "rules": {"string":true,"messages":{"string":"邮件地址必须是一条字符串。","maxlength":"邮件地址只能包含至多60个字符。","match":"邮件地址中含有非法字符"},"maxlength":60,"match":{"pattern":/<|>|<script|<img|<svg|alert|prompt|cookie|@eval|@ini_set|@set_time_limit|\$_SERVER|@set_magic_quotes_runtime/,"not":true}}},{"id": "useraddressmodel-address_lng", "name": "UserAddressModel[address_lng]", "attribute": "address_lng", "rules": {"string":true,"messages":{"string":"地址经度必须是一条字符串。","maxlength":"地址经度只能包含至多60个字符。","match":"地址经度中含有非法字符"},"maxlength":60,"match":{"pattern":/<|>|<script|<img|<svg|alert|prompt|cookie|@eval|@ini_set|@set_time_limit|\$_SERVER|@set_magic_quotes_runtime/,"not":true}}},{"id": "useraddressmodel-address_lat", "name": "UserAddressModel[address_lat]", "attribute": "address_lat", "rules": {"string":true,"messages":{"string":"地址纬度必须是一条字符串。","maxlength":"地址纬度只能包含至多60个字符。","match":"地址纬度中含有非法字符"},"maxlength":60,"match":{"pattern":/<|>|<script|<img|<svg|alert|prompt|cookie|@eval|@ini_set|@set_time_limit|\$_SERVER|@set_magic_quotes_runtime/,"not":true}}},{"id": "useraddressmodel-consignee", "name": "UserAddressModel[consignee]", "attribute": "consignee", "rules": {"string":true,"messages":{"string":"收货人必须是一条字符串。","maxlength":"收货人只能包含至多30个字符。","match":"收货人中含有非法字符"},"maxlength":30,"match":{"pattern":/<|>|<script|<img|<svg|alert|prompt|cookie|@eval|@ini_set|@set_time_limit|\$_SERVER|@set_magic_quotes_runtime/,"not":true}}},{"id": "useraddressmodel-mobile", "name": "UserAddressModel[mobile]", "attribute": "mobile", "rules": {"string":true,"messages":{"string":"手机号码必须是一条字符串。","maxlength":"手机号码只能包含至多20个字符。"},"maxlength":20}},{"id": "useraddressmodel-tel", "name": "UserAddressModel[tel]", "attribute": "tel", "rules": {"string":true,"messages":{"string":"固定电话必须是一条字符串。","maxlength":"固定电话只能包含至多20个字符。"},"maxlength":20}},{"id": "useraddressmodel-region_code", "name": "UserAddressModel[region_code]", "attribute": "region_code", "rules": {"string":true,"messages":{"string":"收货城市必须是一条字符串。","maxlength":"收货城市只能包含至多255个字符。"},"maxlength":255}},{"id": "useraddressmodel-card_id", "name": "UserAddressModel[card_id]", "attribute": "card_id", "rules": {"string":true,"messages":{"string":"身份证号必须是一条字符串。","maxlength":"身份证号只能包含至多255个字符。"},"maxlength":255}},{"id": "useraddressmodel-address_detail", "name": "UserAddressModel[address_detail]", "attribute": "address_detail", "rules": {"string":true,"messages":{"string":"详细地址必须是一条字符串。","maxlength":"详细地址只能包含至多50个字符。","match":"详细地址中含有非法字符"},"maxlength":50,"match":{"pattern":/<|>|<script|<img|<svg|alert|prompt|cookie|@eval|@ini_set|@set_time_limit|\$_SERVER|@set_magic_quotes_runtime/,"not":true}}},{"id": "useraddressmodel-address_house", "name": "UserAddressModel[address_house]", "attribute": "address_house", "rules": {"string":true,"messages":{"string":"门牌号必须是一条字符串。","maxlength":"门牌号只能包含至多50个字符。","match":"门牌号中含有非法字符"},"maxlength":50,"match":{"pattern":/<|>|<script|<img|<svg|alert|prompt|cookie|@eval|@ini_set|@set_time_limit|\$_SERVER|@set_magic_quotes_runtime/,"not":true}}},{"id": "useraddressmodel-zipcode", "name": "UserAddressModel[zipcode]", "attribute": "zipcode", "rules": {"string":true,"messages":{"string":"邮编必须是一条字符串。","maxlength":"邮编只能包含至多6个字符。","match":"邮编中含有非法字符"},"maxlength":6,"match":{"pattern":/<|>|<script|<img|<svg|alert|prompt|cookie|@eval|@ini_set|@set_time_limit|\$_SERVER|@set_magic_quotes_runtime/,"not":true}}},{"id": "useraddressmodel-address_label", "name": "UserAddressModel[address_label]", "attribute": "address_label", "rules": {"string":true,"messages":{"string":"标签必须是一条字符串。","maxlength":"标签只能包含至多5个字符。","match":"标签中含有非法字符"},"maxlength":5,"match":{"pattern":/<|>|<script|<img|<svg|alert|prompt|cookie|@eval|@ini_set|@set_time_limit|\$_SERVER|@set_magic_quotes_runtime/,"not":true}}},{"id": "useraddressmodel-mobile", "name": "UserAddressModel[mobile]", "attribute": "mobile", "rules": {"match":{"pattern":/^((13|15|18|17|14)\d{9}|(199|198|166|191|167)\d{8})$/,"not":false,"skipOnEmpty":1},"messages":{"match":"手机号码是无效的。"}}},{"id": "useraddressmodel-tel", "name": "UserAddressModel[tel]", "attribute": "tel", "rules": {"match":{"pattern":/^0[0-9]{2,3}-[0-9]{7,8}$/,"not":false,"skipOnEmpty":1},"messages":{"match":"固定电话是无效的。"}}},{"id": "useraddressmodel-email", "name": "UserAddressModel[email]", "attribute": "email", "rules": {"email":{"pattern":/^[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/,"fullPattern":/^[^@]*<[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&'*+\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?>$/,"allowName":false,"enableIDN":false,"skipOnEmpty":1},"messages":{"email":"邮件地址不是有效的邮箱地址。"}}},{"id": "useraddressmodel-zipcode", "name": "UserAddressModel[zipcode]", "attribute": "zipcode", "rules": {"match":{"pattern":/^[0-9]{6}$/,"not":false,"skipOnEmpty":1},"messages":{"match":"邮编是无效的。"}}},{"id": "useraddressmodel-region_code", "name": "UserAddressModel[region_code]", "attribute": "region_code", "rules": {"region":{"min":3},"messages":{"region":"收货城市 请选择到区/县"}}},]
</script>
    <script type="text/javascript">
        //
    </script>
    {{--引入右上角菜单--}}
    @include('layouts.partials.right_top_menu')

    <!-- 积分消息 -->
    <!-- 消息提醒 -->
    <script type="text/javascript">
        //
    </script>
    <!-- 第三方流量统计 -->
    <div style="display: none;"></div>
    <!-- 底部 _end-->
    <div style="height: 54px; line-height: 54px" class="handle-spacing"></div>
    <script src="/assets/d2eace91/min/js/core.min.js"></script>
    <script src="/js/app.frontend.mobile.min.js"></script>
    <script src="/js/user.js"></script>
    <script src="/js/address.js"></script>
    <script src="/js/center.js"></script>
    <script src="/js/jquery.fly.min.js"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js"></script>
    <script src="/assets/d2eace91/js/jquery.region.mobile.js"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js"></script>
    <script src="/assets/d2eace91/js/geolocation/amap.js"></script>
    <script src="/assets/d2eace91/min/js/validate.min.js"></script>
    <script src="/assets/d2eace91/min/js/message.min.js"></script>
    <script>
        var mapHeight=($('.map-list').offset().top-45)/2-48;
        var mapWidth=$('.map-list').offset().left/2+50;
        $('.address-fixed-layer').css({
            "top":mapHeight,
            "left":mapWidth,
        });
        //
        //地址添加成功提示
        function TipsShow() {
            $(".tip_layer").removeClass('hide').addClass('show');
            setTimeout(function() {
                TipsHide();
            }, 3000);
        }
        function TipsHide() {
            $(".tip_layer").removeClass('show').addClass('hide');
        }
        //
        $().ready(function() {
            var address_selected = false;
            var validator = $("#UserAddressModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#close_adr_btn").click(function() {
                $.go("/user/address.html");
            });
            var adcode = 0;
            var region_code_item = '';
            var position = null;
            var city_code = '';
            var address_region_code  = '0';
            var addresspicker = null;
            var regionselector = null;
            //
            position = {
                lng: "{{ $address_info->address_lng }}",
                lat: "{{ $address_info->address_lat }}"
            };
            city_code = "5301";
            addresspicker = $("#map_container").addresspicker({
                // 当前位置
                position: position,
                search_loading: false,
                open_window: false,
                market_label: true,
                // 自动提示
                input: "map_search",
                // 当前地区编码
                city: city_code,
                // 定位当前位置
                geolocation_callback: function(data, region_code, address) {
                    if ("1112" == "") {
                        // 重新加载
                        $('#address_lng').val(data.position.lng);
                        $('#address_lat').val(data.position.lat);
                        // 重新加载
                        if (regionselector && region_code_item != region_code) {
                            regionselector.is_loading = true;
                            regionselector.value = region_code;
                            regionselector.is_reload = true;
                            regionselector.reload();
                            region_code_item = region_code;
                        }
                    }
                },
                // 选择自动提示的信息搜索后
                input_callback: function(e) {
                    if (e.poi.location) {
                        this.searchNearBy([e.poi.location.lng, e.poi.location.lat], 1000);
                        $('#address_lng').val(e.poi.location.lng);
                        $('#address_lat').val(e.poi.location.lat);
                        $('.address-detail').html(e.poi.name);
                        $('#address_detail').val(e.poi.name);
                        addresspicker.getRegionCode(e.poi.location, function(region_code, region_name) {
                            // 重新加载
                            if (regionselector) {
                                regionselector.value = region_code;
                                regionselector.is_reload = true;
                                regionselector.reload();
                            }
                        });
                        $('.map-popup-layer').removeClass('show');
                        $('.suggestion-wrap').addClass('hide');
                        address_selected = true;
                    }else{
                        $.msg('地址坐标错误!');
                        $('.map-popup-layer').addClass('show');
                        $('.suggestion-wrap').addClass('hide');
                    }
                },
            });
            address_region_code = '53,01,03';
            regionselector = $(".region-chooser-container").regionchooser({
                value: address_region_code,
                sale_cope: 0,
                list_show: true,
                change: function(value, names, is_last) {
                    if (this.is_reload) {
                        this.is_reload = false;
                    }
                    if (names == '' || !names) {
                        $.msg('所选地区不在地区列表中，请联系系统管理员', {
                            time: 5000
                        });
                    } else {
                        $("#region_code").val(value);
                        $("#region_code").data("is_last", is_last);
                        $("#region_code").valid();
                    }
                    if (value != '0') {
                        adcode = value.split(",", 3).join("");
                    }
                    // 设置文字
                    this.setLabel($.trim(names.join(" ")));
                },
                show_callback: function() {
                },
                hide_callback: function() {
                }
            });
            //
            $(".confirm-btn").off("click");
            $('body').on('click','.confirm-btn',function(){
                $('#address_lng').val(addresspicker.position.lng);
                $('#address_lat').val(addresspicker.position.lat);
                $('.address-detail').html(addresspicker.label_name);
                $('#address_detail').val(addresspicker.label_name);
                addresspicker.searchNearBy($('#address_detail').val(),addresspicker.marker.getPosition(), 1000);
                addresspicker.getRegionCode(addresspicker.marker.getPosition(), function(region_code, region_name) {
                    // 重新加载
                    if (regionselector && region_code_item != region_code) {
                        regionselector.value = region_code;
                        regionselector.is_reload = true;
                        regionselector.reload();
                        region_code_item = region_code;
                    }
                });
                $('.map-popup-layer').removeClass('show');
                address_selected = true;
            });
            $("#map_search").focus(function() {
                //$('.width-mid').addClass('init-status');
                $('.suggestion-wrap').removeClass('hide');
            });
            var waiting = false;
            $("#btn_validate").click(function() {
                if (!validator.form()) {
                    return false;
                }
                if (address_selected == false && addresspicker) {
                    map = addresspicker.map;
                    $("#address_lng").val(map.getCenter().lng);
                    $("#address_lat").val(map.getCenter().lat);
                }
                var data = $("#UserAddressModel").serializeJson();
                var action = $("#UserAddressModel").attr('action');
                $.loading.start();
                $.post(action, data, function(result) {
                    if (result.code == 0) {
                        $.msg(result.message,{
                            icon_type: 1
                        },function(){
                            $.go('/user/address.html');
                        });
                    } else {
                        $.msg(result.message);
                    }
                    $.loading.stop();
                }, "json");
            });
            // 选择地区
            $('body').on('click', '.address-list li', function() {
                $('#address_lng').val($(this).data('lng'));
                $('#address_lat').val($(this).data('lat'));
                $('.address-detail').html($(this).data('name'));
                $('#address_detail').val($(this).data('name'));
                addresspicker.addMarker([$(this).data('lng'), $(this).data('lat')]);
                addresspicker.getRegionCode([$(this).data('lng'), $(this).data('lat')], function(region_code, region_name) {
                    // 重新加载
                    if (regionselector && region_code_item != region_code) {
                        regionselector.value = region_code;
                        regionselector.is_reload = true;
                        regionselector.reload();
                        region_code_item = region_code;
                    }
                });
                $('.map-popup-layer').removeClass('show');
                address_selected = true;
            });
            // 显示地图控件
            $('.SZY-POSITION').click(function() {
                if(addresspicker == null){
                    return;
                }
                $('.SZY-MOBILE-ADDRESS-LIST').html('<div class="more-loader-spinner"><div class="is-loading"><div class="loader-img"><div></div></div><a class="get-more">数据加载中...</a></div></div>');
                $('.map-popup-layer').addClass('show');
                if(adcode == 0){
                    adcode = address_region_code.split(",", 3).join("");
                }
                addresspicker.searchNearBy($('#address_detail').val(),addresspicker.marker.getPosition(), 1000, adcode);
            });
            $('.cancel-btn').click(function() {
                $('#address_search').val('');
                $('.map-popup-layer').addClass('show');
            });
            $('.search-left .sb-back').click(function() {
                close();
            })
            function close() {
                $('.map-popup-layer').removeClass('show');
                $('.suggestion-wrap').addClass('hide');
            }
            //input验证
            $("input").watch();
            $('.address-label span').click(function(){
                if($(this).index() < 2){
                    $('#useraddressmodel-address_label').val($(this).text());
                    $('.address-label span').eq(2).find('font').html('自定义');
                    $('.address-label span').eq(2).find('input').attr('type','hidden');
                }else{
                    var t = $(this).find('input').val();
                    $(this).find('input').val('');
                    $(this).find('font').html('');
                    $(this).find('input').attr('type','text');
                    if(t != '' && t != '家' && t != '公司'){
                        $(this).find('input').focus().val(t);
                    }else{
                        $(this).find('input').focus();
                    }
                }
                $(this).addClass('current').siblings().removeClass('current');
            });
            $('#useraddressmodel-address_label').blur(function(){
                if($(this).val() != ''){
                    $(this).parent().find('font').html($(this).val());
                }else{
                    $(this).parent().find('font').html('自定义');
                }
                $(this).attr('type','hidden');
            });
            $('.address-fixed-layer').click(function(){
                if($('body').find('.SZY-MOBILE-ADDRESS-LIST li[class="current"]').length > 0){
                    $('body').find('.SZY-MOBILE-ADDRESS-LIST li[class="current"]').click();
                }else{
                    $('body').find('.SZY-MOBILE-ADDRESS-LIST li').eq(0).click();
                }
            });
        });
        //
        $().ready(function () {
            WS_AddPoint({
                user_id: '{{ $user_info['user_id'] ?? 0 }}',
                url: "{{ get_ws_url('7272') }}",
                type: "add_point_set"
            });
        });

        function addPoint(ob) {
            if (ob != null && ob != 'undefined') {
                if (ob.point && ob.point > 0 && ob.user_id && ob.user_id == '{{ $user_info['user_id'] ?? 0 }}') {
                    $.intergal({
                        point: ob.point,
                        name: '积分'
                    });
                }
            }
        }
        //
    </script>
@stop
