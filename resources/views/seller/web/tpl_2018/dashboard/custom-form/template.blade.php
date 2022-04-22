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
    <link rel="stylesheet" href="/assets/d2eace91/fonts/css/font-awesome.min.css?v=20190215"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/jquery-ui.css?v=20190215"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/scrollBar/jquery.mCustomScrollbar.css?v=20190215"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/common.css?v=20190215"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/design/tplsetting.css?v=20190215"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/customform/design.css?v=20190215"/>

    <script src="/assets/d2eace91/js/jquery-1.9.1.min.js?v=20190121"></script>
    <script src="/assets/d2eace91/js/jquery-ui.js?v=20190121"></script>
    <script src="/assets/d2eace91/js/scrollBar/jquery.mCustomScrollbar.js?v=20190121"></script>

</head>
<body style="background-color: #f3f3f3;">
<!--页面头部-->
<div class="module-topBar">
    <div class="module-topBar-inner">
        <a class="topBar-logo">

            <img src="{{ get_image_url(sysconf('seller_center_logo')) }}">

        </a>
    </div>
</div>

<div class="left-template-box">
    <div class="left-template-head">
        <span>模板选择</span>
        <a class="close" style="display: none;"></a>
    </div>

    <div class="">
        <ul class="designTypeBox">
            <li class="selected">
                <a href="javascript:;">报名</a>
            </li>
            <li >
                <a href="javascript:;">登记</a>
            </li>
            <li >
                <a href="javascript:;">预约</a>
            </li>
            <li >
                <a href="javascript:;">调查</a>
            </li>
        </ul>
        <div class="FrMode-container">
            @foreach($tpl_list as $group=>$tpl)
            <div class="FrMode-list" @if($group != 'signup')style="display: none;"@endif>
                <ul>

                    @foreach($tpl as $v)
                    <li class="FrModeItem" data-group="{{ $group }}" data-code="{{ $v->code }}" data-src="{{ $v->preview_image }}">
                        <img class="FrModeItemImg" src="{{ $v->thumb_image }}">
                        <p class="FrModeItemTitle">{{ $v->title }}</p>
                    </li>
                    @endforeach

                </ul>
            </div>
            @endforeach

            <input type="hidden" id="current-template" data-group="" data-code="" data-id="{{ $form_id }}">
        </div>
    </div>
</div>
<div class="template-box">
    <div class="templateWrapper" style="background-color: #E7EBE4; background-attachment: fixed;">
        <img class="templatePage" src="" style="display: none;">
    </div>
    <div class="templateFooter">
        <a href="javascript:void(0);" class="use-template">使用此模板</a>
    </div>
</div>


<div class="clear"></div>
</div>
<script>
    // 模板预览区域
    var $template_wrapper = $('.templateWrapper');
    // 当前的模板
    var $current_template = $('#current-template');
    // 按钮
    var $template_footer = $('.templateFooter');
    var $use_template = $template_footer.find('.use-template');

    $('body').on('click', '.FrModeItem', function() {
        var self = $(this);
        // 切换效果
        $(".FrModeItem").removeClass("selected");
        self.addClass("selected");
        // 显示预览内容
        showPreview(self);
        // 设置选中的内容
        setCurrentTemplate(self);
    });

    /**
     * 左侧预览，显示右侧图片内容
     * param object obj 当前点击的对象
     */
    function showPreview(obj) {
        // 获取预览的链接
        var src = obj.data('src');
        // 设置预览图
        $template_wrapper.find('img').attr('src', src).show();
    }
    /**
     * 设置当前选中的内容
     */
    function setCurrentTemplate(obj) {
        var group = obj.data('group');
        var code = obj.data('code');

        $current_template.attr('data-group', group);
        $current_template.attr('data-code', code);
    }

    // 使用此模板
    $use_template.click(function() {
        var group = $current_template.data('group');
        var code = $current_template.data('code');
        var id = $current_template.data('id');

        window.location.href = 'design?form_id=' + id + '&group=' + group + '&code=' + code;
    });
    // 左侧菜单内容滚动
    $(".FrMode-list").mCustomScrollbar();

    // 左侧模板内容切换tab
    // tab内容
    var $designTypeBox = $('.designTypeBox');
    // 盒子
    var $frModeContainer = $('.FrMode-container');
    // 列表
    var $frModeList = $('.FrMode-list');
    $designTypeBox.on('click', 'a', function() {
        var $self = $(this);
        var index = $self.parent().index();

        // 添加选择样式
        $self.parent().addClass('selected').siblings().removeClass('selected');
        // 显示隐藏对应的内容
        $frModeList.hide().eq(index).show();
    });

    // 进入页面之后，默认第一个被选中
    $frModeContainer.find('.FrMode-list').eq(0).find('li').eq(0).trigger('click');
</script>
</body>
</html>
