<!DOCTYPE html>
<!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]-->
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title>{{ $title }}</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta name="renderer" content="webkit" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}">
    <link rel="stylesheet" href="/assets/d2eace91/fonts/css/font-awesome.min.css?v=20190315"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/jquery-ui.css?v=20190315"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/scrollBar/jquery.mCustomScrollbar.css?v=20190315"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/common.css?v=20190315"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/customform/design.css?v=20190315"/>
    <script src="/assets/d2eace91/js/jquery-1.9.1.min.js?v=20190121"></script>
    <script src="/assets/d2eace91/js/jquery-ui.js?v=20190121"></script>
    <script src="/assets/d2eace91/js/scrollBar/jquery.mCustomScrollbar.js?v=20190121"></script>
    <script src="/assets/d2eace91/js/jquery.superslide.2.1.1.js?v=20190121"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=20190121"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=20190121"></script>
    <link rel="stylesheet" href="/assets/d2eace91/css/customform/edit.css?v=20190315"/>
</head>
<!--接收所修改的背景颜色及背景图片-->
<body class="bg-fixed" style="@if($form_info['global_data']['page_header']['bodybg_type'] == 1) background: {{ $form_info['global_data']['page_header']['bodybg'] }}@else background-image: url('{{ $form_info['global_data']['page_header']['bodybg'] }}');@endif" >
<!--页面头部-->
<div class="p-t-20 F-main">
    <!--此处为表单设置背景颜色-->
    <!--浏览页是将表单内容中所有编辑按钮和drop-field样式都去掉-->
    <div class="center-form center-main ">

        <div class="top-images">
            <img src="{{ $form_info['global_data']['page_header']['header'] ?? '/assets/d2eace91/images/customform/design/top-default.jpg' }}" style="width: 100%;">
        </div>

        <div class="center-content ">
            <!--不可删不可移可编辑-->

            <div class="form-title">{{ $form_info['global_data']['page_title']['title'] ?? '模板标题' }}</div>


            <div class="form-desc">{!! $form_info['global_data']['page_desc']['description'] ?? '模板描述' !!}</div>

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
            <!--提交按钮不可删不可移可编辑-->
            <div class="form-submit">
                <a href="javascript:;">提交</a>
            </div>
        </div>
    </div>
    <!-- <a class="FshareBtn" title="通过二维码分享此表单"></a> -->
    <div class="clear"></div>
</div>
<!--点击分享-->
<!-- <div class="shareMask">
    <div class="popInnerAnimation">
                    <img class="scannerQRCode" src="/dashboard/custom-form/form-qrcode.html?form_id=2">
        <div class="scannerGuide">
            <p>扫描二维码，分享给好友</p>
        </div>
    </div>
</div> -->
<script src="//webapi.amap.com/maps?v=1.4.9&key={{ sysconf('amap_js_key') }}"></script>
<!-- 日期选择器 -->
<script src="/assets/d2eace91/bootstrap/datetimepicker/js/bootstrap-datetimepicker.js?v=20190121"></script>
<script src="/assets/d2eace91/bootstrap/datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js?v=20190121"></script>
<!-- 地址 -->
<script src="/assets/d2eace91/js/jquery.region.js?v=20190121"></script>
<!-- 表单验证 -->
<script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20190121"></script>
<script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20190121"></script>
<script src="/assets/d2eace91/js/validate/messages_zh.js?v=20190121"></script>
<script>
    // 存储的表单数据
    var form_datas = {!! json_encode($form_info['form_data']) !!};
    var global_datas = {!! json_encode($form_info['global_data']) !!};

    // 未来要提交的数据
    var data = {
        form_datas: JSON.stringify(form_datas),
        global_datas: JSON.stringify(global_datas)
    };

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
            var o_region_container = element.closest('.region_container');
            // 检测当前select数量的个数, 因为可能会有更多级, 只保留3级联动
            var len = o_region_container.find('.render-selector').length;
            if (len > 2) {
                o_region_container.find('.render-selector:gt(2)').remove();
            }
        }
    }
    // 遍历日期组件
    if (form_datas) {
        var form_datas_len = form_datas.length;
        for (var i = 0; i < form_datas_len; i++) {
            // 获取当前组件的数据内容
            var component = form_datas[i];
            // 获取当前组件的类型
            var type = component.type;
            // 初始化组件对应的数据
            initPreviewComponents(i, type, component);
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
                    scrollWheel: false,
                    resizeEnable: true,
                    dragEnable: false,
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
    /**
     * 获取索引获取当前ID
     * @param int index 当前组件的索引顺序
     */
    function getComponentID(index) {
        return 'c' + index;
    }
    /**
     * 获取组件对象
     * @param int index 当前组件的索引顺序
     */
    function getComponentObj(index) {
        var id = getComponentID(index);
        return $('#'+id);
    }

    /**
     * 获取组件的name 规则是 组件类型_组件索引
     * @param int index 组件所在索引
     * @param object data 组件的数据
     */
    function getComponentName(index, data)
    {
        var type = data.type;
        return type + '_' + index;
    }

    // 数据进行提交
    $('.form-submit').find('a').click(function() {
        $.loading.start();
        $.post('/dashboard/custom-form/design.html?form_id={{ $form_info['form_id'] }}', data, function(res) {
            if (res.code == 0) {
                $.msg(res.message, {
                    time: 1500
                }, function() {
                    $.go('/dashboard/custom-form/list.html');
                });
            } else {
                $.msg(res.message);
            }
        }, 'JSON').always(function() {
            $.loading.stop();
        });
    });

    // 所有的校验的集合
    var validates = {};
    // 整数
    var pattern_int = /^\d+$/;
    // 身份证
    var pattern_cardnum = /(^d15$)|(^d17([0-9]|X)$)/;

    // 整数
    function isInt(val)
    {
        return pattern_int.test(val)
    }
    // 身份证
    function isCardNum(val)
    {
        return 	pattern_cardnum.test(val);
    }


    /**
     * 根据type，获取对应的校验内容
     * @paran object data 组件的设置的内容
     */
    function typeOfValidate(type, data, index)
    {
        // 组件类型
        var component_type = data.type;
        // 组件名称
        var component_name = getComponentName(index, data);
        // 校验的规则
        var validate = {
        };

        var rules = {

        };
        var messages = {

        };

        // 数字默认要输入数字
        if (component_type === 'number')
        {
            rules.digits = true;
        }

        // 是否必填
        var v_required = data.v_unique;
        if (v_required && v_required == 1)
        {
            rules.required = true;
        }

        // 最少多少字
        var v_minlength = data.v_minlength;
        var v_minlength_con = data.v_minlength_con;
        // 最多多少字
        var v_maxlength = data.v_maxlength;
        var v_maxlength_con = data.v_maxlength_con;
        // 最多最少填写多少字，且必须是数字
        if (v_minlength && v_minlength == 1 && v_minlength_con && isInt(v_minlength_con))
        {
            rules.minlength = parseInt(v_minlength_con);
        }
        if (v_maxlength && v_maxlength == 1 && v_maxlength_con && isInt(v_maxlength_con))
        {
            rules.maxlength =  parseInt(v_maxlength_con);
        }
        // 但是最多必须要大于最少
        if (v_minlength == 1 && isInt(v_minlength_con) && v_minlength == 1 && isInt(v_minlength_con) && v_minlength_con > v_minlength_con)
        {
            // 如果最小 > 最大 不合法数字，则去除此校验
            delete rules.maxlength;
            delete rules.minlength;
        }
        // 身份证验证
        var v_resident_cardnum = data.v_resident_cardnum;
        if (v_resident_cardnum && v_resident_cardnum == 1)
        {
            rules.isCardNum = true;
        }

        // 自定义出错内容
        var v_error_customer = data.v_error_customer;
        var v_error_customer_con = data.v_error_customer_con;
        if (v_error_customer && v_error_customer == 1 &&  v_error_customer_con != '')
        {

            messages.maxlength = v_error_customer_con;
            messages.minlength = v_error_customer_con;
        }

        validate[component_name] = {};
        validate[component_name]['rules'] = rules;
        validate[component_name]['messages'] =  messages;
        return validate;

    }
    // 单项选择，多项选择，时间，下拉框，网址，必填项， 自定义出错，手机【自身验证】，邮箱【自身验证】，地址【全验证】，微信，qq，微博，
    // 去除不能和已有数据重复 v_unique

    jQuery.validator.addMethod("isCardNum", function(value, element, param) {
        return isCardNum(value);
    }, $.validator.format("请输入正确身份证号码"));

    /* //分享二维码
    $(".FshareBtn").click(function() {
        $(".shareMask").addClass("show");
        $(".F-main").addClass("form-disabled");
    });
    $(".shareMask").click(function() {
        $(".shareMask").removeClass("show");
        $(".F-main").removeClass("form-disabled");
    }); */
    /**
     * 打开信息窗体
     */
    function openMapWindowInfo(text, map, marker) {
        if (text != "")
        {
            // 构建信息窗体中显示的内容
            var info = [];
            info.push("<div style='font-size:12px;'>" + text + "</div>");
            infoWindow = new AMap.InfoWindow({
                offset: new AMap.Pixel(2, -25),
                content: info.join("<br/>")  // 使用默认信息窗体框样式，显示信息内容
            });
            infoWindow.open(map, marker.getPosition());
        }
    }
</script>
</body>
</html>
