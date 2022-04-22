<!DOCTYPE html>
<!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]-->
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title>{{ $seo_title ?? '乐融沃B2B2C商城演示站' }}</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta name="keywords" content="222" />
    <meta name="description" content="aa" />
    <meta name="renderer" content="webkit" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="stylesheet" href="/assets/d2eace91/fonts/css/font-awesome.min.css?v=201900316"/>
    <link rel="stylesheet" href="/css/common.css?v=201900316"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/customform/design_mobile.css?v=201900316"/>
    <script src="/assets/d2eace91/js/jquery-1.9.1.min.js?v=20190121"></script>
    <script src="/assets/d2eace91/js/jquery.superslide.2.1.1.js?v=20190121"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=20190121"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=20190121"></script>
    <link rel="stylesheet" href="/css/mobiscroll.custom-3.0.0-beta.min.css?v=201900316"/>
    <script src="/js/mobiscroll.custom-3.0.0-beta.min.js?v=20190121"></script>
    <link rel="stylesheet" href="/assets/d2eace91/css/customform/m_edit.css?v=201900316"/>
    <!--接收所修改的背景颜色及背景图片-->
<body class="{{ $body_class ?? ''}}" {{ $body_style ?? ''}} >
<!--页面头部-->
<div class="p-t-20 F-main">
    <!--此处为表单设置背景颜色-->
    <!--浏览页是将表单内容中所有编辑按钮和drop-field样式都去掉-->
    <div class="center-form center-main">
        <div class="top-images">
            <img src="{{ $form_info['global_data']['page_header']['header'] }}" style="width: 100%;">
        </div>
        <div class="center-content">
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
                                @include('frontend.web.tpl_2018.components.custom-form.form_items')

                            </div>
                        </li>
                    @endforeach


                </ul>

                {{ csrf_field() }}

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
<script src="//webapi.amap.com/maps?v=1.4.9&key={{ sysconf('amap_js_key') }}"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<!-- 地址 -->
<script src="/assets/d2eace91/js/jquery.region.js?v=20190121"></script>
<!-- 表单验证 -->
<script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20190121"></script>
<script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20190121"></script>
<script src="/assets/d2eace91/js/validate/messages_zh.js?v=20190121"></script>
<script src="/assets/d2eace91/js/upload/jquery.ajaxfileupload.js?v=20190221"></script>
<script src="/assets/d2eace91/js/jquery.widget.js?v=20190221"></script>
<script>
    var form_id = {{ $form_info['form_id'] }};
    // 存储的表单数据
    var form_datas = {!! json_encode($form_info['form_data']) !!};
    var global_datas = {!! json_encode($form_info['global_data']) !!};
    var data = {
        form_datas: JSON.stringify(form_datas),
        global_datas: JSON.stringify(global_datas)
    };
    var wx_title = '{{ $form_info['form_title'] }}';
    var wx_desc = '{!! $form_info['form_desc'] !!}';
    var wx_img = '{{ get_image_url($form_info['share_image']) }}';

    // 日期级别
    var time_level = {
        // 年月日
        "0": {
            dateFormat: 'yy-mm-dd'
        },
        // 年月日时分秒
        "1": {
            dateFormat: 'yy-mm-dd',
            timeWheels: 'h:ii:ss',
            timeFormat: 'hh:ii:ss',
            dateWheels: 'yymmdd',
        }
    };

    // 下拉地址setting
    var selector_setting = {
        value: '',
        sale_scope: 0,
        widget_class: 'render-selector',
        select_class: "m-t-5",
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

                // 获取当前组件对象
                var obj = getComponentObj(index);
                // 获取当前时间级别
                var level = component.time_level;
                // input组件让其成为显示日期弹窗的组件
                var o_scroll = obj.find('.datetimepicker');
                // 将设置的值存储的内容
                // var o_input = o_scroll.parent().find('.time_val');
                // 默认设置
                var default_time_setting = {
                    theme: 'mobiscroll',
                    lang: 'zh',
                    display: 'center',
                    dateFormat: 'yy-mm-dd',
                    onSet:function(data){
                        var set_data = data.valueText;
                        o_scroll.val(set_data);
                        // o_input.val(Date.parse(new Date(set_data))/1000);
                    }
                };
                // 合并设置
                $.extend(default_time_setting, time_level[level]);
                // 当前的年份
                var currYear = new Date().getFullYear();
                // 日期组件的默认值
                var default_value = o_scroll.val();
                if (default_value) {
                    // 默认时间
                    var defaultDate = new Date(default_value);
                    // 正确的时间才可以被设置
                    if (typeof defaultDate === 'object')
                    {
                        default_time_setting.defaultValue = new Date(default_value);
                    }
                }
                // 时分秒要使用 datetime函数
                if (level == 1)
                {
                    o_scroll.mobiscroll().datetime(default_time_setting);
                } else{
                    o_scroll.mobiscroll().date(default_time_setting);
                }
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

    function isWeiXin(){
        // window.navigator.userAgent属性包含了浏览器类型、版本、操作系统类型、浏览器引擎类型等信息，这个属性可以用来判断浏览器类型
        var ua = window.navigator.userAgent.toLowerCase();
        // 通过正则表达式匹配ua中是否含有MicroMessenger字符串
        if(ua.match(/MicroMessenger/i) == 'micromessenger'){
            return true;
        }else{
            return false;
        }
    }
    var url = location.href.split('#')[0];


    //获取微信配置信息
    if (isWeiXin()) {
        $.ajax({
            url: "/index/information/get-weixinconfig.html",
            data: {
                url: url
            },
            dataType: 'json',
            success: function(result) {
                if (result.code == 0) {
                    wx.config({
                        debug: false,
                        appId: result.data.appId,
                        timestamp: result.data.timestamp,
                        nonceStr: result.data.nonceStr,
                        signature: result.data.signature,
                        jsApiList: [
                            // 所有要调用的 API 都要加到这个列表中
                            "onMenuShareTimeline", "onMenuShareAppMessage"]
                    });

                    wx.ready(function() {
                        // 分享给朋友
                        wx.onMenuShareAppMessage({
                            title: wx_title, // 标题
                            desc: wx_desc, // 描述
                            imgUrl: wx_img, // 分享的图标
                            link: url,
                            fail: function(res) {
                                alert(JSON.stringify(res));
                            }
                        });

                        // 分享到朋友圈
                        wx.onMenuShareTimeline({
                            title: wx_title, // 标题
                            desc: wx_desc, // 描述
                            imgUrl: wx_img, // 分享的图标
                            link: url,
                            fail: function(res) {
                                alert(JSON.stringify(res));
                            }
                        });
                    });
                }
            }
        });
    }
    //ali oss上传路径
    var aliUrl = '/site/alioss.html';
</script>

<!-- add -->
<!-- 上传组件 -->
<script src="/assets/d2eace91/js/customform/upload/lib/plupload-2.1.2/js/plupload.full.min.js?v=20190221"></script>

<script src="/assets/d2eace91/js/customform/upload/upload.js?v=20190221"></script>

<script src="/assets/d2eace91/js/customform/add.js?v=20190221"></script>
</body>
</html>
