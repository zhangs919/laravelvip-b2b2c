@extends('layouts.base')

@section('header_css')
    <link href="/css/topic_activity.css" rel="stylesheet">
    <link href="/css/template.css" rel="stylesheet">
    <link href="/assets/d2eace91/fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="/assets/d2eace91/css/common.css" rel="stylesheet">
    <link href="/assets/d2eace91/css/customform/design.css" rel="stylesheet">
    <link href="/assets/d2eace91/css/customform/edit.css" rel="stylesheet">

@stop

{{--follow_box 注意此效果只在首页面展示--}}
@section('follow_box')

@stop

@section('style_js')

@stop



@section('content')


    <!-- 内容 -->
    <!--页面头部-->
    <div class="p-t-20 F-main">

        <!--此处为表单设置背景颜色-->
        <!--浏览页是将表单内容中所有编辑按钮和drop-field样式都去掉-->
        <div class="center-form center-main ">

            <div class="top-images">
                <img src="{{ $form_info['global_data']['page_header']['header'] }}" style="width: 100%;">
            </div>

            <div class="center-content ">
                <!--不可删不可移可编辑-->

                <div class="form-title">{{ $form_info['global_data']['page_title']['title'] }}</div>


                <div class="form-desc">{!! $form_info['global_data']['page_desc']['description'] !!}</div>

                <form id="add_form">
                    <!--可删可移可编辑-->
                    <ul id="dropzone" class="ui-sortable">

                        @foreach($form_info['form_data'] as $k=>$form)
                            <li id="c{{ $k }}">
                                <div class="type-content">

                                    {{--根据type switch 判断展示不同的元素--}}
                                    {{--引入万能表单元素--}}
                                    @include('frontend::components.custom-form.form_items')

                                </div>
                            </li>
                        @endforeach

                    </ul>

                    <input type="hidden" name="_csrf" value="{{ csrf_token() }}">

                </form>
                <!--提交按钮不可删不可移可编辑-->
                <div class="form-submit">
                    <a href="javascript:;">提交</a>
                </div>
            </div>
        </div>
        <a class="FshareBtn" title="通过二维码分享此表单"></a>
        <div class="clear"></div>
    </div>
    <div class="form-end" style="display: none;">
        <!--提交成功-->
        <img src="/assets/d2eace91/images/customform/success.png" alt="提交成功" class="end-img">
        <h2 class="end-title">提交成功！</h2>
        <p class="end-desc">我们已收到您的反馈，感谢填写。</p>
        <a href="/shop/{{ $form_info['shop_id'] }}.html" class="btn">返回首页</a>
    </div>
    <!--点击分享-->
    <div class="shareMask">
        <div class="popInnerAnimation">
            <img class="scannerQRCode" src="/customform/form/form-qrcode.html?form_id={{ $form_info['form_id'] }}">
            <div class="scannerGuide">
                <p>扫描二维码，分享给好友</p>
            </div>
        </div>
    </div>
	<script type="text/javascript">
		window._AMapSecurityConfig = {
			securityJsCode: "{{ sysconf('amap_js_security_code') }}",
		};
	</script>
    <script src="//webapi.amap.com/maps?v=1.4.9&key={{ sysconf('amap_js_key') }}"></script>
    <!-- 日期选择器 -->
    <!-- 地址 -->
    <!-- 表单验证 -->
    <!-- 上传组件 -->
    <style type="text/css">
        .layui-layer.layui-layer-page{max-width: 480px;}
    </style>
    <script>
        //
    </script>
    <!-- add -->
    <!-- 上传组件 -->
@stop

{{--底部js--}}
@section('footer_js')
    <script src="/assets/d2eace91/js/jquery.superslide.2.1.1.js"></script>
    <script src="/js/index.js"></script>
    <script src="/js/tabs.js"></script>
    <script src="/js/bubbleup.js"></script>
    <script src="/js/jquery.hiSlider.js"></script>
    <script src="/js/index_tab.js"></script>
    <script src="/js/jump.js"></script>
    <script src="/js/nav.js"></script>
    <script src="/assets/d2eace91/js/jquery.cookie.js"></script>
    <script src="/assets/d2eace91/js/layer/layer.js"></script>
    <script src="/assets/d2eace91/js/jquery.method.js"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js"></script>
    <script src="/js/common.js"></script>
    <script src="/assets/d2eace91/js/jquery.lazyload.js"></script>
    <script src="/js/topic.js"></script>
    <script src="/js/tabs.js"></script>
    <script src="/js/index_tab.js"></script>
    <script src="/js/jquery.fly.min.js"></script>
    <script src="/assets/d2eace91/js/szy.cart.js"></script>
    <script src="/js/requestAnimationFrame.js"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.js"></script>
    <script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js"></script>
    <script src="/assets/d2eace91/js/jquery.region.js"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.js"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js"></script>
    <script src="/assets/d2eace91/js/common.js"></script>
    <script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js"></script>
    <script src="/assets/d2eace91/js/customform/upload/lib/plupload-2.1.2/js/plupload.full.min.js"></script>
    <script src="/assets/d2eace91/js/customform/upload/upload.js"></script>
    <script src="/assets/d2eace91/js/customform/add.js"></script>
    <script>
        var form_id = {{ $form_info['form_id'] }};
        // 存储的表单数据
        var form_datas = {!! json_encode($form_info['form_data']) !!};
        var global_datas = {!! json_encode($form_info['global_data']) !!};
        var data = {
            form_datas: JSON.stringify(form_datas),
            global_datas: JSON.stringify(global_datas)
        };
        var map;
        // 日期级别
        var time_level = {
            // 年月日
            "0": {
                startView: 2,
                minView: 2,
                maxView: 4,
                format: "yyyy-mm-dd"
            },
            // 年月日时分秒
            "1": {
                startView: 2,
                minView: 0,
                maxView: 4,
                format: "yyyy-mm-dd hh:ii:ss"
            }
        };
        // 下拉地址setting
        var selector_setting = {
            value: '',
            sale_scope: 0,
            widget_class: 'render-selector',
            select_class: "m-r-5",
            // 在将组件添加到页面之后就会被调用
            // element是当前select的对象
            select_callback: function(element) {
                var o_region_container = this.container;
                // var o_region_container = element.closest('.region_container');
                // 检测当前select数量的个数, 因为可能会有更多级, 只保留3级联动
                var len = o_region_container.find('.render-selector').length;
                if (len > 2) {
                    o_region_container.find('.render-selector:gt(2)').remove();
                }
            },
            change: function(element, text, is_last) {
                var o_region_container = this.container;
                // 将标识写到 .question-conent 上
                var $questionConent = o_region_container.closest('.question-conent');
                // element是code值，如11,01,02
                var elements = element.split(',');
                // 获取隐藏域对象
                var o_address = o_region_container.nextAll('.full_address:eq(0)');
                if (elements.length == 3 || is_last) {
                    // 所有的文本内容 传递code不传text
                    // var address_text = text.join('');
                    var address_text = element;
                    // 获取详细地址内容
                    var detail = $.trim(o_region_container.next('.form-group').find('.address_detail').val());
                    if (detail != '') {
                        address_text += ' ' + detail;
                        o_address.val(address_text);
                    } else {
                        o_address.val('');
                    }
                    // 设置标识
                    $questionConent.data('last', 1);

                } else {
                    o_address.val('');
                    // 设置标识
                    $questionConent.data('last', 0);
                }
            }
        }

        /**
         * 初始化地图内容
         * @param int index 组件的位置索引
         * @param string type 组件的类型
         */
        function initPreviewComponents(index, type, component) {
            switch (type) {
                // 时间
                case "time":
                    // ----- 默认时间插件 ----- //
                    var default_time_setting = {
                        language: 'zh-CN',
                        weekStart: 1,
                        todayBtn: 1,
                        autoclose: 1,
                        todayHighlight: 1,
                        startView: 2,
                        forceParse: 1,
                        showMeridian: 1,
                        minView: 2,
                        maxView: 4,
                        format: "yyyy-mm-dd"
                    };
                    // 获取当前组件对象
                    var obj = getComponentObj(index);
                    // 获取当前时间级别
                    var level = component.time_level;
                    $.extend(default_time_setting, time_level[level]);
                    obj.find('.datetimepicker').datetimepicker(default_time_setting);
                    break;
                // 地图
                case "static_map":
                    // 获取地图的经纬度
                    var lat = component.location.lat;
                    var lng = component.location.lng;
                    var marker_text = component.place;
                    // 获取地图的缩放 zoom
                    var zoom = component.zoom;
                    zoom = parseInt(zoom);

                    // 初始化地图数据
                    var map = new AMap.Map('map_container_' + index, {
                        viewMode: '2D',
                        zoom: zoom,
                        scrollWheel: true,
                        resizeEnable: true,
                        dragEnable: true,
                        center: [lng, lat], // 地图中心点
                    });
                    // 初始化点标注
                    var marker = new AMap.Marker({
                        position: [lng, lat],
                        // 小图标的高度是 19 * 33
                        offset: new AMap.Pixel(-10, -33),
                    });
                    // 标注打开内容
                    marker.on('click', function() {
                        openMapWindowInfo(marker_text, map, this);
                    });
                    // 将点添加到地图上
                    map.add(marker);
                    // 打开窗体信息
                    openMapWindowInfo(marker_text, map, marker);
                    break;
                case 'address':
                    // ----- 地区级联插件 ----- //
                    var obj = getComponentObj(index);
                    var o_region_container = obj.find('.region_container');

                    if (selector_setting) {
                        selector_setting.value = component.address.address_code;
                        o_region_container.regionselector(selector_setting);
                    }
                    break;
            }
        }
        //ali oss上传路径
        var aliUrl = '/site/alioss.html';
    </script>

@stop
