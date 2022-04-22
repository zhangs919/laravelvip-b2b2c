@extends('layouts.base')

@section('header_js')
    <script src="/assets/d2eace91/js/jquery.cookie.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=20180813"></script>
@stop

{{--follow_box 注意此效果只在首页面展示--}}
@section('follow_box')

@stop

@section('style_js')
    <!--页面css/js-->

    <script src="/js/index.js?v=20180813"></script>
    <script src="/js/tabs.js?v=20180813"></script>
    <script src="/js/bubbleup.js?v=20180813"></script>
    <script src="/js/jquery.hiSlider.js?v=20180813"></script>
    <script src="/js/index_tab.js?v=20180813"></script>
    <script src="/js/jump.js?v=20180813"></script>
    <script src="/js/nav.js?v=20180813"></script>
@stop



@section('content')


    <!-- 内容 -->
    <script type="text/javascript" src="http://webapi.amap.com/maps?v=1.3&key={{ sysconf('amap_js_key') }}"></script>
    <script type="text/javascript" src="http://cache.amap.com/lbs/static/addToolbar.js"></script>
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
    <!-- css -->
    <link rel="stylesheet" href="/css/goods.css?v=20180702"/>
    <!-- 自提详情 _start -->
    <div class="w1210">
        <div class="pickup-box">
            <div class="pickup-left">
                <img src="{{ get_image_url($info->pickup_images) }}" alt="{{ $info->pickup_name }}" class="logistics-img" />
            </div>
            <div class="pickup-right">
                <h2>{{ $info->pickup_name }}</h2>
                <p class="logistics-address" title="{{ $info->pickup_address }}">
                    <i></i>
                    {{ $info->pickup_address }}
                </p>


                <div class="logistics-map">
                    <div class="simple-form-field">
                        <div class="form-group">
                            <div class="col-sm-5">
                                <div class="form-control-box">
                                    <div id="container" style="margin-bottom: 5px; width: 700px; height: 400px; border: 1px solid #D7D7D7; overflow: hidden;"></div>
                                    <div id="panel"></div>
                                    <br />
                                    <input class="form-control ipt m-r-20" type="hidden" id="address_lng" name="SelfPickup[address_lng]" value="{{ $info->address_lng }}" readonly="readonly" />
                                    <input class="form-control ipt" type="hidden" id="address_lat" name="SelfPickup[address_lat]" value="{{ $info->address_lat }}" readonly="readonly" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $().ready(function() {

            var x = "{{ $info->address_lng }}";
            var y = "{{ $info->address_lat }}";
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
            /* 	AMap.event.addListener(map, 'click', function(e) {
                    var x = e.lnglat.getLng();
                    var y = e.lnglat.getLat();
                    lnglatXY = new AMap.LngLat(x, y);
                    regeocoder();
                    $("#panel").hide();
                    $("#address_lng").val(x);
                    $("#address_lat").val(y);
                }); */

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
                    draggable: false,
                    cursor: 'move',
                    raiseOnDrag: true
                });
                marker.setMap(map); // 在地图上添加点
                map.setFitView();
                map.setZoomAndCenter(zoom, center);

                // 移动坐标点位置
                /* 	marker.on('mouseup', function(e) {
                        var x = e.lnglat.getLng();
                        var y = e.lnglat.getLat();
                        lnglatXY = new AMap.LngLat(x, y);
                        regeocoder();
                        $("#panel").hide();
                        $("#address_lng").val(x);
                        $("#address_lat").val(y);
                    }); */
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
    <!-- 自提详情 _end-->

@stop