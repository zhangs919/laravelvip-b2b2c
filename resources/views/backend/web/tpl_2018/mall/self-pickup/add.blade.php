{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
	<script type="text/javascript">
		window._AMapSecurityConfig = {
			securityJsCode: "{{ sysconf('amap_js_security_code') }}",
		};
	</script>
    <script type="text/javascript" src="//webapi.amap.com/maps?v=1.4.15&key={{ sysconf('amap_js_key') }}"></script>
    <script type="text/javascript" src="//cache.amap.com/lbs/static/addToolbar.js"></script>
    <style type="text/css">
        #panel {
            position: absolute;
            background-color: white;
            max-height: 90%;
            overflow-y: auto;
            top: 10px;
            right: 10px;
            width: 280px;
        }
    </style>
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="table-content m-t-30 clearfix">
        <form id="form1" class="form-horizontal" name="SelfPickup" action="/mall/self-pickup/add" method="POST" novalidate="novalidate">
            @csrf
            <!-- 隐藏域 -->
            <input type="hidden" id="selfpickup-pickup_id" class="form-control" name="SelfPickup[pickup_id]" value="{{ $info->pickup_id ?? '' }}">
            <!-- 自提点名称-->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="selfpickup-pickup_name" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">自提点名称：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="selfpickup-pickup_name" class="form-control" name="SelfPickup[pickup_name]" value="{{ $info->pickup_name ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">不超过20个字</div></div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">联系地址：</span>
                    </label>
                    <div class="col-sm-8">
                        <div id="form-control-box">
                            <div id="region_container"></div>
                            <input type="hidden" id="region_code" name="SelfPickup[region_code]" value="{{ $info->region_code ?? '' }}">
                            <input type="hidden" id="region_name" value="{{ $info->region_name ?? '' }}">
                            <input type="hidden" id="load" value="0">
                        </div>
                    </div>
                </div>
            </div>
            <!-- 详细地址  -->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="selfpickup-pickup_address" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">详细地址：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="selfpickup-pickup_address" class="form-control valid address" name="SelfPickup[pickup_address]" value="{{ $info->pickup_address ?? '' }}">
                            <input type="button" class="btn btn-primary" id="map_search" name="map_search" value="搜索地图">

                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">地图定位：</span>
                    </label>
                    <div class="col-sm-5">
                        <div class="form-control-box">
                            <div id="container" style="margin-bottom: 5px; width: 700px; height: 400px; border: 1px solid rgb(215, 215, 215); overflow: hidden; position: relative; background: rgb(252, 249, 242); cursor: url(&quot;//webapi.amap.com/theme/v1.3/openhand.cur&quot;), default;" class="amap-container">
                                {{--<object style="display: block; position: absolute; top: 0; left: 0; height: 100%; width: 100%; overflow: hidden; pointer-events: none; z-index: -1;" type="text/html" data="about:blank"></object><div class="amap-maps"><div class="amap-drags" style=""><div class="amap-layers" style="transform: translateZ(0px);"><div class="amap-markers" style="position: absolute; z-index: 120; top: 199px; left: 349px;"></div><canvas class="amap-layer" width="698" height="398" style="position: absolute; z-index: 0; top: 0px; left: 0px; height: 398px; width: 698px;"></canvas><canvas class="amap-labels" draggable="false" style="position: absolute; z-index: 99; height: 398px; width: 698px; top: 0px; left: 0px;" width="698" height="398"></canvas></div><div class="amap-overlays" style=""></div></div></div><div style="display: none;"></div><div class="amap-controls"><div class="amap-toolbar" style="left: 10px; top: 10px; visibility: visible;"><div class="amap-pancontrol" style="position: relative; display: block;"><div class="amap-pan-left"></div><div class="amap-pan-top"></div><div class="amap-pan-right"></div><div class="amap-pan-bottom"></div></div><div class="amap-locate" style="position: relative; left: 17px; display: block;"></div><div class="amap-zoomcontrol" style="position: relative; left: 14px;"><div class="amap-zoom-plus"></div><div class="amap-zoom-ruler" style="display: block;"><div class="amap-zoom-mask" style="height: 45px;"></div><div class="amap-zoom-cursor" style="top: 45px;"></div><div class="amap-zoom-labels"><div class="amap-zoom-label-street"></div><div class="amap-zoom-label-city"></div><div class="amap-zoom-label-province"></div><div class="amap-zoom-label-country"></div></div></div><div class="amap-zoom-minus"></div></div></div><div class="amap-indoormap-floorbar-control" style="display: none;"></div></div><a class="amap-logo" href="http://gaode.com" target="_blank"><img src="http://webapi.amap.com/theme/v1.3/autonavi.png"></a><div class="amap-copyright" style="display: none;"><!--v1.3.28--> © 2018 AutoNavi <span class="amap-mcode">- GS(2016)710号</span></div>--}}
                            </div>
                            <div id="panel"></div>
                            <div class="help-block help-block-t">您可通过移动蓝点来设置您店铺的精确位置，双击地图可查看更精确的地区</div>
                            <br>
                            经度：
                            <input class="form-control ipt m-r-20" type="text" id="address_lng" name="SelfPickup[address_lng]" value="{{ $info->address_lng ?? '' }}" readonly="readonly">
                            纬度：
                            <input class="form-control ipt" type="text" id="address_lat" name="SelfPickup[address_lat]" value="{{ $info->address_lat ?? '' }}" readonly="readonly">
                        </div>
                    </div>
                </div>
            </div>
            <!-- 联系电话-->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="selfpickup-pickup_tel" class="col-sm-4 control-label">

                        <span class="ng-binding">联系电话：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <input type="text" id="selfpickup-pickup_tel" class="form-control" name="SelfPickup[pickup_tel]" value="{{ $info->pickup_tel ?? '' }}">


                        </div>

                        <div class="help-block help-block-t"></div>
                    </div>
                </div>
            </div>
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="text4" class="col-sm-4 control-label">
                        <span class="text-danger ng-binding">*</span>
                        <span class="ng-binding">自提点照片：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="imagegroup_container pull-left">
                            {{--<ul class="image-group"><li class="image-group-button" data-label-index="0" title="点击并选择上传的图片"><div class="image-group-bg"></div></li></ul>--}}
                        </div>
                        <input type="hidden" id="imgpath" class="form-control" name="SelfPickup[pickup_images]" value="{{ $info->pickup_images ?? '' }}" placeholder="">
                        <span class="help-block help-block-t">建议上传300*200像素的图片</span>
                    </div>

                </div>
            </div>
            <!-- 是否显示-->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="selfpickup-is_show" class="col-sm-4 control-label">

                        <span class="ng-binding">是否显示：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">

                            <label class="control-label control-label-switch">
                                <div class="switch bootstrap-switch bootstrap-switch-mini sm-nav-switch">
                                    <input type="hidden" name="SelfPickup[is_show]" value="0">
                                    <label>
                                        @if(isset($info->is_show))
                                            <input type="checkbox" id="selfpickup-is_show" class="form-control b-n"
                                                   name="SelfPickup[is_show]" value="1" @if($info->is_show == 1)checked @endif data-on-text="是"
                                                   data-off-text="否">
                                        @else
                                            <input type="checkbox" id="selfpickup-is_show" class="form-control b-n"
                                                   name="SelfPickup[is_show]" value="1" checked data-on-text="是"
                                                   data-off-text="否">
                                        @endif
                                    </label>
                                </div>
                            </label>

                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">是，消费者前台结算时能选择此自提点；否，自提点不在前台结算页面展示</div></div>
                    </div>
                </div>
            </div>
            <!-- 商家推荐-->
            <div class="simple-form-field">
                <div class="form-group">
                    <label for="selfpickup-pickup_desc" class="col-sm-4 control-label">

                        <span class="ng-binding">商家推荐：</span>
                    </label>
                    <div class="col-sm-8">
                        <div class="form-control-box">


                            <textarea id="selfpickup-pickup_desc" class="form-control" name="SelfPickup[pickup_desc]" rows="5">{!! $info->pickup_desc ?? '' !!}</textarea>


                        </div>

                        <div class="help-block help-block-t"><div class="help-block help-block-t">描述自提点的活动或相关备注（最多200字）</div></div>
                    </div>
                </div>
            </div>
            <!-- 确认提交 -->
            <div class="bottom-btn p-b-30">
                <input type="button" id="btn_submit" value="确认提交" class="btn btn-primary btn-lg">
            </div>

        </form>
    </div>

@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block page元素同级下面--}}
@section('extra_html')

@stop

{{--helper_tool--}}
@section('helper_tool')

@stop

{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer script page元素同级下面--}}
@section('footer_script')
    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=1.2"></script>
    <!-- 在线文本编辑器 -->
    <script src="/assets/d2eace91/js/editor/kindeditor-all.min.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/editor/lang/zh_CN.js?v=1.2"></script>
    <!-- 创建KindEditor的脚本 必须设置editor_id属性，editor_id为文本域的ID属性 -->

    <script type="text/javascript">
        KindEditor.ready(function(K) {

            var extraFileUploadParams = [];
            extraFileUploadParams['CP6ZNQ_YUNMALL_LARAVELVIP_COM_BACKEND_PHPSESSID'] = '239ake8n3e2sb93j1c0c0ijgt1';

            window.editor = K.create('#detail_introduce', {
                width: '100%',
                height: '450px',
                items: ['source', '|', 'fullscreen', 'undo', 'redo', 'print', 'cut', 'copy', 'paste', 'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright', 'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript', 'superscript', '|', 'selectall', 'clearhtml', 'quickformat', '|', 'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'flash', 'media', 'table', 'hr', 'emoticons', 'link', 'unlink', '|', 'about'],
                themesPath: "/assets/d2eace91/js/editor/themes/",
                cssPath: "/assets/d2eace91/js/editor/themes/default/default.css",
                uploadJson: "/site/upload-image",
                extraFileUploadParams: extraFileUploadParams,
                allowImageUpload: true,
                allowFlashUpload: false,
                allowMediaUpload: false,
                allowFileManager: true,
                syncType: "form",
                // 设置粘贴类型，0:禁止粘贴, 1:纯文本粘贴, 2:HTML粘贴
                pasteType: 2,
                afterCreate: function() {
                    var self = this;
                    self.sync();
                },
                afterChange: function() {
                    var self = this;
                    self.sync();
                },
                afterBlur: function() {
                    var self = this;
                    self.sync();
                }
            });
        });
    </script>
    <!-- AJAX上传+图片预览 -->
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=1.2"></script>

    <!-- 地区选择 -->
    <script src="/assets/d2eace91/js/jquery.region.js?v=1.2"></script>
    <!-- 验证规则 -->
    <script id="client_rules" type="text">
        [{"id": "selfpickup-pickup_name", "name": "SelfPickup[pickup_name]", "attribute": "pickup_name", "rules": {"required":true,"messages":{"required":"自提点名称不能为空。"}}},{"id": "selfpickup-region_code", "name": "SelfPickup[region_code]", "attribute": "region_code", "rules": {"required":true,"messages":{"required":"自提点地址不能为空。"}}},{"id": "selfpickup-pickup_address", "name": "SelfPickup[pickup_address]", "attribute": "pickup_address", "rules": {"required":true,"messages":{"required":"详细地址不能为空。"}}},{"id": "selfpickup-pickup_images", "name": "SelfPickup[pickup_images]", "attribute": "pickup_images", "rules": {"required":true,"messages":{"required":"自提点图片不能为空。"}}},{"id": "selfpickup-shop_id", "name": "SelfPickup[shop_id]", "attribute": "shop_id", "rules": {"required":true,"messages":{"required":"Shop ID不能为空。"}}},{"id": "selfpickup-shop_id", "name": "SelfPickup[shop_id]", "attribute": "shop_id", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Shop ID必须是整数。"}}},{"id": "selfpickup-is_show", "name": "SelfPickup[is_show]", "attribute": "is_show", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"是否显示必须是整数。"}}},{"id": "selfpickup-sort", "name": "SelfPickup[sort]", "attribute": "sort", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Sort必须是整数。"}}},{"id": "selfpickup-is_delete", "name": "SelfPickup[is_delete]", "attribute": "is_delete", "rules": {"integer":{"pattern":"/^\\s*[+-]?\\d+\\s*$/"},"messages":{"integer":"Is Delete必须是整数。"}}},{"id": "selfpickup-address_lng", "name": "SelfPickup[address_lng]", "attribute": "address_lng", "rules": {"required":true,"messages":{"required":"经纬度不能为空。"}}},{"id": "selfpickup-address_lat", "name": "SelfPickup[address_lat]", "attribute": "address_lat", "rules": {"required":true,"messages":{"required":"经纬度不能为空。"}}},{"id": "selfpickup-pickup_tel", "name": "SelfPickup[pickup_tel]", "attribute": "pickup_tel", "rules": {"match":{"pattern":/^((0\d{2,3}-\d{7,8})|(1[35784]\d{9}))$/,"not":false,"skipOnEmpty":1},"messages":{"match":"请输入正确的手机或座机号码，座机号码格式：XXXX-XXXXXXX。"}}},{"id": "selfpickup-pickup_name", "name": "SelfPickup[pickup_name]", "attribute": "pickup_name", "rules": {"string":true,"messages":{"string":"自提点名称必须是一条字符串。","maxlength":"自提点名称只能包含至多20个字符。"},"maxlength":20}},{"id": "selfpickup-region_code", "name": "SelfPickup[region_code]", "attribute": "region_code", "rules": {"string":true,"messages":{"string":"自提点地址必须是一条字符串。","maxlength":"自提点地址只能包含至多20个字符。"},"maxlength":20}},{"id": "selfpickup-pickup_address", "name": "SelfPickup[pickup_address]", "attribute": "pickup_address", "rules": {"string":true,"messages":{"string":"详细地址必须是一条字符串。","maxlength":"详细地址只能包含至多255个字符。"},"maxlength":255}},{"id": "selfpickup-address_lng", "name": "SelfPickup[address_lng]", "attribute": "address_lng", "rules": {"string":true,"messages":{"string":"经度必须是一条字符串。","maxlength":"经度只能包含至多60个字符。"},"maxlength":60}},{"id": "selfpickup-address_lat", "name": "SelfPickup[address_lat]", "attribute": "address_lat", "rules": {"string":true,"messages":{"string":"纬度必须是一条字符串。","maxlength":"纬度只能包含至多60个字符。"},"maxlength":60}},{"id": "selfpickup-pickup_tel", "name": "SelfPickup[pickup_tel]", "attribute": "pickup_tel", "rules": {"string":true,"messages":{"string":"联系电话必须是一条字符串。","maxlength":"联系电话只能包含至多15个字符。"},"maxlength":15}},{"id": "selfpickup-pickup_images", "name": "SelfPickup[pickup_images]", "attribute": "pickup_images", "rules": {"string":true,"messages":{"string":"自提点图片必须是一条字符串。","maxlength":"自提点图片只能包含至多500个字符。"},"maxlength":500}},{"id": "selfpickup-pickup_desc", "name": "SelfPickup[pickup_desc]", "attribute": "pickup_desc", "rules": {"string":true,"messages":{"string":"商家推荐必须是一条字符串。","maxlength":"商家推荐只能包含至多200个字符。"},"maxlength":200}},]
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

            $("#region_container").regionselector({
                value: '{{ $info->region_code ?? '' }}',
                select_class: 'form-control',
                change: function(value, names, is_last) {
                    if (value == '') {
                        var values = this.values();
                        if (values.length > 0) {
                            value = values[values.length - 1].region_code;
                        }
                    }
                    $("#region_code").val(value);
                    $("#region_name").val(names);
                    $("#region_code").data("is_last", is_last);
                    $("#region_code").valid();
                }
            });

            var validator = $("#form1").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                //加载提示
                $.loading.start();

                var url = $("#form1").attr("action");
                var data = $("#form1").serializeJson();
                $.post(url, data, function(result) {
                    $.loading.stop();
                    if (result.code == 0) {
                        $.msg(result.message, function() {
                            $.loading.start();
                            $.go('list');
                        });
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "json");

            });
        });
    </script>
    <script type="text/javascript">
        $().ready(function() {

            $(".imagegroup_container").each(function() {

                var imagegorup = $(this).imagegroup({
                    host: "{{ get_oss_host() }}",
                    size: 1,
                    values: ["{{ $info->pickup_images ?? '' }}"],
                    callback: function(data) {
                        $("#imgpath").val(this.values);
                    },
                    remove: function(value, values) {
                        $("#imgpath").val(this.values);
                    }
                });
            });

            var x = $("#address_lng").val();
            var y = $("#address_lat").val();
            if (x == "" || y == "") {
                x = 0;
                y = 0;
                var lnglatXY = new AMap.LngLat(x, y);
                var map = new AMap.Map("container", {
                    resizeEnable: true,
                    doubleClickZoom: false,
                    zoom: 13
                });
            } else {
                var lnglatXY = new AMap.LngLat(x, y);
                var map = new AMap.Map("container", {
                    resizeEnable: true,
                    doubleClickZoom: false,
                    zoom: 15,
                    center: lnglatXY
                });
            }
            map.plugin(["AMap.ToolBar"], function() {
                // 加载工具条
                var tool = new AMap.ToolBar();
                map.addControl(tool);
            });
            var marker;
            var geocoder;
            regeocoder();
            $("#map_search").click(function() {
                $("#panel").show();
                AMap.service(["AMap.PlaceSearch"], function() {
                    // 构造地点查询类
                    var placeSearch = new AMap.PlaceSearch({
                        pageSize: 6,
                        map: map,
                        panel: "panel"
                    });
                    var array = $("#region_name").val().split(",");
                    var keyword = array.join("");
                    var keyword = keyword + $("#selfpickup-pickup_address").val();
                    // 关键字查询
                    placeSearch.search(keyword);
                });
            });
            // 点击地图改变坐标点位置
            AMap.event.addListener(map, 'click', function(e) {
                var x = e.lnglat.getLng();
                var y = e.lnglat.getLat();
                lnglatXY = new AMap.LngLat(x, y);
                regeocoder();
                $("#panel").hide();
                $("#address_lng").val(x);
                $("#address_lat").val(y);
            });

            // 逆地理编码
            function regeocoder() {
                // 加载地理编码插件
                map.plugin(["AMap.Geocoder"], function() {
                    geocoder = new AMap.Geocoder({
                        radius: 1000, // 以已知坐标为中心点，radius为半径，返回范围内兴趣点和道路信息
                        extensions: "base" //返回地址描述以及附近兴趣点和道路信息，默认"base"
                    });

                    // 返回地理编码结果
                    AMap.event.addListener(geocoder, "complete", geocoder_callBack);
                    // 逆地理编码
                    geocoder.getAddress(lnglatXY);
                });

                var zoom = map.getZoom();
                var center = map.getCenter();
                map.clearMap();
                // 加点
                marker = new AMap.Marker({
                    position: lnglatXY,
                    draggable: true,
                    cursor: 'move',
                    raiseOnDrag: true
                });
                marker.setMap(map); // 在地图上添加点
                map.setFitView();
                map.setZoomAndCenter(zoom, center);

                // 移动坐标点位置
                marker.on('mouseup', function(e) {
                    var x = e.lnglat.getLng();
                    var y = e.lnglat.getLat();
                    lnglatXY = new AMap.LngLat(x, y);
                    regeocoder();
                    $("#panel").hide();
                    $("#address_lng").val(x);
                    $("#address_lat").val(y);
                });
            }

            function geocoder_callBack(data) {
                if ($("#load").val() == 1) {
                    $("#load").val(0);
                    openInfo($("#selfpickup-pickup_address").val());
                } else {
                    var address = data.regeocode.formattedAddress;
                    var array = $("#region_name").val().split(","); // 返回地址描述
                    for (var i = 0; i < array.length; i++) {
                        address = address.replace(array[i], '');
                    }
                    address = address.replace('省', '');
                    address = address.replace('市', '');
                    $("#selfpickup-pickup_address").val(address);
                    openInfo(address);
                }
            }

            // 在指定位置打开信息窗体
            function openInfo(address) {
                if (address == "") {
                    return;
                }
                // 构建信息窗体中显示的内容
                var info = [];
                info.push("<div>地址：" + address + "</div>");
                infoWindow = new AMap.InfoWindow({
                    content: info.join("<br/>"),
                    offset: new AMap.Pixel(0, -30)
                });
                infoWindow.open(map, marker.getPosition());
            }

            // 回车搜索
            $("#selfpickup-pickup_address").keypress(function(e) {
                if (event.keyCode == 13) {
                    $("#map_search").click();
                }
            });

        });
    </script>
@stop

{{--outside body script--}}
@section('outside_body_script')

@stop
