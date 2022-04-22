@extends('layouts.design_layout_v3')

@section('header_js')

    <!-- 图片缓载js -->
    <script src="/assets/d2eace91/js/jquery.lazyload.js?v=1.2"></script>
    <!-- 装修js -->
    <script src="/assets/d2eace91/js/jquery.design.js?v=1.2"></script>
    <!--选色插件-->
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/evol-colorpicker/css/evol.colorpicker.css?v=1.2"/>
    <script src="/assets/d2eace91/js/jquery-ui.js?v=1.2"></script>
    <script src="/assets/d2eace91/bootstrap/evol-colorpicker/js/evol.colorpicker.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=1.2"></script>
    <link rel="stylesheet" href="/assets/d2eace91/css/design/moduleEditTool.css?v=1.6"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.6"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/design/mobile/swiper.min.css?v=1.6"/>
    <script src="/assets/d2eace91/js/design/swiper.jquery.min.js?v=1.6"></script>

@stop

@section('content')

    <!-- 加载图标库 -->
    <link rel="stylesheet" href="/assets/d2eace91/iconfont/iconfont.css?v=1.6"/>

    <!--页面css/js-->
    <script src="http://{{ env('FRONTEND_DOMAIN') }}/js/jump.js?v=20180418"></script>

    <!-- 公共css -->
    <link rel="stylesheet" href="http://{{ env('FRONTEND_DOMAIN') }}/css/common.css?v=1.6"/>

    <link rel="stylesheet" href="http://{{ env('FRONTEND_DOMAIN') }}/css/index.css?v=1.6"/>
    <link rel="stylesheet" href="http://{{ env('FRONTEND_DOMAIN') }}/css/news.css?v=1.6"/>
    <link rel="stylesheet" href="http://{{ env('FRONTEND_DOMAIN') }}/css/template.css?v=20180702"/>


    <!-- 风格样式 -->
    <!--整站改色 _start-->
    @if(sysconf('custom_style_enable') == 1)
        <link rel="stylesheet" href="http://{{ env('FRONTEND_DOMAIN') }}/css/custom/site-color-style-0.css?v=1.6" id="site_style"/>
    @else
        <link rel="stylesheet" href="http://{{ env('FRONTEND_DOMAIN') }}/css/color-style.css?v=1.6" id="site_style"/>
    @endif
    <!--整站改色 _end-->

    <link rel="stylesheet" href="/assets/d2eace91/css/design/tplsetting.css?v=1.6"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/design/design.css?v=1.6"/>



    <!--顶部topbar-->
    <div class="module-topBar">

        <div class="module-topBar-inner">
            <a class="topBar-logo"> <img src="{{ get_image_url(sysconf('backend_logo')) }}" /></a>
            <div class="page-title">
                <label>资讯频道装修</label>
                <span></span>
            </div>
            <div class="page-title-nav" style="display: none">
                <span class="top-dropdown-bg"></span>
                <div class="bv-header">
                    <h5>页面管理</h5>
                    <span class="bv-header-close">×</span>
                </div>
                <div class="bv-container">
                    <ul>
                        <!--为选中的li加selected样式-->
                        <li class="" data-url="/design/tpl-setting/setup?page=site">
                            <div class="menu-list-item">
                                <i class="page-bgimage"></i>
                                商城首页装修
                                <div class="set-btn">
                                    <span class="arrow">›</span>
                                </div>
                            </div>
                        </li>


                        <li class="selected" data-url="/design/tpl-setting/setup?page=news">
                            <div class="menu-list-item">
                                <i class="page-bgimage"></i>
                                资讯频道装修
                                <div class="set-btn">
                                    <span class="arrow">›</span>
                                </div>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="topBar-navbar">
                <a class="SZY-TPL-SETTING" href="javascript:void(0);" data-url="/system/config/index?group=news_setting" data-title="资讯频道设置" data-modal="1">
                    <div class="topBar-button">
                        <span class="title">资讯频道设置</span>
                    </div>
                </a>
            </div>

            <div class="topBar-navbar-r">
                <div class="top-set-btn displayMode">
                    <a class="set-btn active" href="javascript:void(0);" title="电脑端装修">
                        <span class="icon se-btn-pc"></span>
                        <span class="title">电脑端装修</span>
                    </a>

                    <a href="/design/tpl-setting/setup?page=m_news" class="set-btn" title="手机端装修">
                        <span class="icon se-btn-app"></span>
                        <span class="title">手机端装修</span>
                    </a>

                </div>
                <div class="page-operation-btns">
                    <a class="page-btn page-preview-btn SZY-TPL-BACKUP" href="javascript:void(0);">模板备份</a>
                    <a class="page-btn page-preview-btn SZY-TPL-USE" href="javascript:void(0);">使用备份</a>
                    <a class="page-btn page-preview-btn SZY-TPL-RELEASE" href="javascript:void(0);"> 发布 </a>
                </div>
                <div class="other-more">
                    <a class="icon pg-hd"><span></span></a>
                    <div class="more-set" style="display: none;">
                        <span class="top-dropdown-bg"></span>
                        <ul>
                            <li>
                                <a class="other-help" target="_blank" href="http://help.68mall.com/"><i></i>帮助中心</a>
                            </li>
                            <li>
                                <a class="other-exit"><i></i>退出设计</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--模块内容-->
    <div class="module-main unfold template-one"  style="padding-bottom:100px;">
        <div class="SZY-TPL-HEADER">
            <!-- 引入头部文件 -->
            @include('frontend.web.modules.library.news_index_nav')
        </div>
        <!-- 数据模块 -->
        <div class="SZY-TEMPLATE-MAIN-CONTAINER dropzone"></div>

        <!--鼠标放在页面显示的存放位置样式-->
        <div class="position-box" style="display: none">
            <span class="text-c">放在这里</span>
        </div>
    </div>

    <!-- 右侧浮动内容 Begin -->
    <div class="helper-fixed">
        <div class="helper-icon">
		<span>
			<i class="fa fa-send-o"></i>
			模板助手
		</span>
        </div>
        <div id="helper_tool" class="helper-wrap">
            <div class="help-header">
                模板助手
                <i class="fa fa-times-circle"></i>
            </div>
            <div class="panel-group" id="accordion">
                <div id="helper_tool_nav" class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                模板导航（
                                <em class="count">0</em>
                                ）
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <ul class="list">
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- 右侧浮动内容 End -->
    <!--左侧模板展示浮动-->
    <div class="panelIconContainer">
        <div class="floatPanelIconBox ">
            <a class="floatPanel-addNewModule SZY-SITE-TEMPLET">
                <i></i>
                <span>模板</span>
            </a>
            <a class="floatPanel_setSiteStyle SZY-SITE-STYLE hide">
                <i></i>
                <span>样式</span>
            </a>
        </div>
        <div class="floatPanel" style="display: none;">
            <div class="floatPanelNav">
                <ul>


                    <li>
                        <a href="javascript:void(0);" data-key='1'>广告模板</a>
                    </li>





                    <li>
                        <a href="javascript:void(0);" data-key='3'>通用模板</a>
                    </li>







                    <li>
                        <a href="javascript:void(0);" data-key='6'>资讯模板</a>
                    </li>






                </ul>
            </div>
            <div class="panelContentContainer">

                <div class="panelItem-box panelItem-box1">
                    <div class="panelModuleTitle">
                        <h3>常用设计</h3>
                        <p>找到需要的设计拖动到内容区域</p>
                        <a class="closeFunPanel">×</a>
                    </div>
                    <div class="panelItemContainer">
                        <!--模板列表-->
                        <div class="panelItemContent">

                            <ul>

                                <li class="drag" id="0" data-code="ad_one_column">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/ad_one_column.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="一栏广告">一栏广告</a>
                                </li>

                                <li class="drag" id="0" data-code="ad_five_column">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/ad_five_column.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="五栏广告">五栏广告</a>
                                </li>

                                <li class="drag" id="0" data-code="ad_six_column">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/ad_six_column.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="六栏广告">六栏广告</a>
                                </li>

                                <li class="drag" id="0" data-code="ad_groups">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/ad_groups.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="广告组">广告组</a>
                                </li>

                                <li class="drag" id="0" data-code="shop_floor_ad1">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/shop_floor_ad1.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="2-2栏广告">2-2栏广告</a>
                                </li>

                                <li class="drag" id="0" data-code="shop_floor_ad2">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/shop_floor_ad2.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="分层广告">分层广告</a>
                                </li>

                                <li class="drag" id="0" data-code="shop_floor_category_ad1">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/shop_floor_category_ad1.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="七栏广告">七栏广告</a>
                                </li>

                                <li class="drag" id="0" data-code="shop_floor_category_ad2">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/shop_floor_category_ad2.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="1-7栏广告">1-7栏广告</a>
                                </li>

                            </ul>

                        </div>
                    </div>
                </div>

                <div class="panelItem-box panelItem-box2">
                    <div class="panelModuleTitle">
                        <h3>常用设计</h3>
                        <p>找到需要的设计拖动到内容区域</p>
                        <a class="closeFunPanel">×</a>
                    </div>
                    <div class="panelItemContainer">
                        <!--模板列表-->
                        <div class="panelItemContent">

                        </div>
                    </div>
                </div>

                <div class="panelItem-box panelItem-box3">
                    <div class="panelModuleTitle">
                        <h3>常用设计</h3>
                        <p>找到需要的设计拖动到内容区域</p>
                        <a class="closeFunPanel">×</a>
                    </div>
                    <div class="panelItemContainer">
                        <!--模板列表-->
                        <div class="panelItemContent">

                            <ul>

                                <li class="drag" id="0" data-code="custom_s1">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/custom_s1.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="自定义模板">自定义模板</a>
                                </li>

                                <li class="drag" id="0" data-code="lc_title_s1">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/lc_title_s1.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="标题版式一">标题版式一</a>
                                </li>

                            </ul>

                        </div>
                    </div>
                </div>

                <div class="panelItem-box panelItem-box4">
                    <div class="panelModuleTitle">
                        <h3>常用设计</h3>
                        <p>找到需要的设计拖动到内容区域</p>
                        <a class="closeFunPanel">×</a>
                    </div>
                    <div class="panelItemContainer">
                        <!--模板列表-->
                        <div class="panelItemContent">

                        </div>
                    </div>
                </div>

                <div class="panelItem-box panelItem-box5">
                    <div class="panelModuleTitle">
                        <h3>常用设计</h3>
                        <p>找到需要的设计拖动到内容区域</p>
                        <a class="closeFunPanel">×</a>
                    </div>
                    <div class="panelItemContainer">
                        <!--模板列表-->
                        <div class="panelItemContent">

                        </div>
                    </div>
                </div>

                <div class="panelItem-box panelItem-box6">
                    <div class="panelModuleTitle">
                        <h3>常用设计</h3>
                        <p>找到需要的设计拖动到内容区域</p>
                        <a class="closeFunPanel">×</a>
                    </div>
                    <div class="panelItemContainer">
                        <!--模板列表-->
                        <div class="panelItemContent">

                            <ul>

                                <li class="drag" id="0" data-code="news_s1">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/news_s1.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="资讯版式一">资讯版式一</a>
                                </li>

                                <li class="drag" id="0" data-code="news_s2">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/news_s2.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="资讯版式二">资讯版式二</a>
                                </li>

                                <li class="drag" id="0" data-code="news_s3">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/news_s3.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="资讯版式三">资讯版式三</a>
                                </li>

                            </ul>

                        </div>
                    </div>
                </div>

                <div class="panelItem-box panelItem-box7">
                    <div class="panelModuleTitle">
                        <h3>常用设计</h3>
                        <p>找到需要的设计拖动到内容区域</p>
                        <a class="closeFunPanel">×</a>
                    </div>
                    <div class="panelItemContainer">
                        <!--模板列表-->
                        <div class="panelItemContent">

                        </div>
                    </div>
                </div>

                <div class="panelItem-box panelItem-box8">
                    <div class="panelModuleTitle">
                        <h3>常用设计</h3>
                        <p>找到需要的设计拖动到内容区域</p>
                        <a class="closeFunPanel">×</a>
                    </div>
                    <div class="panelItemContainer">
                        <!--模板列表-->
                        <div class="panelItemContent">

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="/assets/d2eace91/js/jquery-ui.js?v=20180418"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180418"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20180418"></script>
    <script src="/assets/d2eace91/js/design/tplsetting.js?v=20180418"></script>
    <script type="text/javascript">
        //初始化数据
        var chk_value =[];
        var data = [];
        var data_m = {};
        var page = "news";
        var NAV_CAT_TPL = "5";
        //加载数据
        $(function(){
            $.loading.start();

            $.each({!! $jsonData !!}, function(index, value) {
                var $el = $(value.file);
                var is_valid_class = '';
                var is_eye_valid_class = '';
                if(value.is_valid>0){
                    is_valid_class = 'fa fa-check-circle-o';
                    is_eye_valid_class = 'hide-btn';
                }else{
                    is_valid_class = 'fa fa-times-circle-o';
                    is_eye_valid_class = 'show-btn';
                }

                if(value.type == '5')
                {
                    var $handle = $('<div class="operateEdit"></div>');

                    $handle.append($('<a class="decor-btn sort-tpls upMove-btn"  data-uid="'+value.uid+'"  data-sort="up"><div class="selector-box"><div class="arrow"></div><i class="fa fa-arrow-circle-o-up"></i>上移</div></a>'));
                    $handle.append($('<a class="decor-btn sort-tpls downMove-btn" data-uid="'+value.uid+'" data-sort="down"><div class="selector-box"><div class="arrow"></div><i class="fa fa-arrow-circle-o-down"></i>下移</div></a>'));
                    $handle.append($('<a class="decor-btn is-valid-tpls hide-btn"  data-uid="'+value.uid+'"><div class="selector-box"><div class="arrow"></div><i class="'+is_valid_class+'"></i>隐藏</div></a>'));
                    $handle.append($('<a class="decor-btn del-tpls deletes-btn"  data-uid="'+value.uid+'"><div class="selector-box"><div class="arrow"></div><i class="fa fa-trash-o"></i>删除</div></a>'));
                    $el.append($handle);
                    $(".SZY-TEMPLATE-NAV-CONTAINER").append($el);
                }else{

                    var $handle = $('<div class="operateEdit"></div>');

                    $handle.append($('<a class="decor-btn upMove-btn"><div class="selector-box"><div class="arrow"></div><i class="fa fa-arrow-circle-o-up"></i>上移</div></a>').click(function () { setSortTpls(value.uid,'up'); }));
                    $handle.append($('<a class="decor-btn downMove-btn"><div class="selector-box"><div class="arrow"></div><i class="fa fa-arrow-circle-o-down"></i>下移</div></a>').click(function () { setSortTpls(value.uid,'down'); }));
                    $handle.append($('<a class="decor-btn '+is_eye_valid_class+'"><div class="selector-box"><div class="arrow"></div><i class="'+is_valid_class+'"></i>'+value.format_is_valid+'</div></a>').click(function () { setIsValidTpls(value.uid); }));
                    $handle.append($('<a class="decor-btn deletes-btn"><div class="selector-box"><div class="arrow"></div><i class="fa fa-trash-o"></i>删除</div></a>').click(function () { delTpls(value.uid); }));
                    $el.append($handle);
                    $('.SZY-TEMPLATE-MAIN-CONTAINER').append($el);
                }
            });
            $.loading.stop();
            getHelper();
            //图片缓载
            $.imgloading.loading();
        });

    </script>

    <script type="text/javascript">
        /*********外边js start**********/
        $().ready(function() {

            $("#show_nav").click(function(){
                var $nav = $(".SZY-TPL-HEADER");
                if($nav.css('display')=='none'){
                    $nav.slideDown();
                    $(this).text('隐藏导航');
                }else{
                    $nav.slideUp();
                    $(this).text('显示导航');
                }
            });
        });
    </script>

    <script language="javascript">
        // 退出设计器
        $("body").on('click', '.other-exit', function() {
            layer.confirm('您确定要退出设计器吗？', {
                btn: ['确定','取消']
            }, function(){
                window.opener=null;
                window.open('','_self');
                window.close();
            }, function(){
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".panelItemContent ").mCustomScrollbar();
            $(".panel-collapse .panel-body").mCustomScrollbar();
            /*左侧浮动切换*/
            function change_tabs(a,b,c){
                $(a).click(function(){
                    var k = $(this).find('a').data('key');
                    var name = $(this).find('a').text();
                    $(this).addClass(c).siblings().removeClass(c);
                    var d = b+k;
                    $(b).hide();
                    $(d).find('h3').text(name);
                    $(d).show();
                });
            }
            change_tabs(".floatPanelNav li",".panelContentContainer .panelItem-box",'active');

            $('.floatPanelNav li').eq(0).click();
        });

        $('body').on('click','.SZY-SITE-TEMPLET',function() {
            $(".floatPanel").show();
            $(".floatPanelIconBox").hide();
        });
        $('body').on('click','.closeFunPanel',function() {
            $(".floatPanelIconBox").show();
            $(".floatPanel").hide();
        });
        $(".other-more").click(function() {
            $(".more-set").slideToggle(100);
        }).mouseleave(function() {
            $(".more-set").hide();
        });
    </script>


    <script src="http://{{ env('FRONTEND_DOMAIN') }}/js/news.js?v=20180418"></script>

@stop

@section('outside_body_script')


    <script type="text/javascript">
        /*********外边js start**********/
        $().ready(function() {
            $(".colorPicker").colorpicker();
            // 顶部导航展示形式切换
            $('#foldSidebar').click(function() {
                if ($('.module-main').hasClass('unfold')) {
                    $('.module-main').addClass('fold').removeClass('unfold');
                    $('.quickDress').removeClass('hide');
                    $('#foldSidebar').addClass('styleDesignArrowUp').removeClass('styleDesignArrowDown');
                } else {
                    $('.module-main').addClass('unfold').removeClass('fold');
                    $('.quickDress').addClass('hide');
                    $('#foldSidebar').addClass('styleDesignArrowDown').removeClass('styleDesignArrowUp');
                }
            });
            $('.topBar-navbar a').click(function() {
                $('.module-main').addClass('fold').removeClass('unfold');
                $('.quickDress').removeClass('hide');
                $('#foldSidebar').addClass('styleDesignArrowUp').removeClass('styleDesignArrowDown');

            });
            //隐藏下拉导航
            function hiddenNavbar(){
                $('.module-main').addClass('unfold').removeClass('fold');
                $('.quickDress').addClass('hide');
                $('#foldSidebar').addClass('styleDesignArrowUp').removeClass('styleDesignArrowDown');
            }
            /*鼠标滑过切换tab*/
            function change_tabs(a, b, c) {
                $(a).click(function() {
                    $(this).addClass(c).siblings().removeClass(c);
                    $(b).eq($(this).data('key')-1).show().siblings().hide();
                })
            }
            change_tabs(".topBar-navbar a", ".quickDress .panel", 'active');
            //切换不同页面装修
            $('.top-set-btn').click(function(){
                if($(this).find('.set-btn-box').hasClass('hide')){
                    $(this).find('.set-btn-box').removeClass('hide');
                }else{
                    $(this).find('.set-btn-box').addClass('hide')
                }
            });
            $(".top-set-btn").mouseleave (function(){
                $(this).find('.set-btn-box').addClass('hide')
            });
        });

    </script>

    <script type="text/javascript">
        $(function(){
            $('body').on('click','.SZY-TPL-SELECTOR',function(){
                try{
                    if(hiddenNavbar&&typeof(hiddenNavbar)=="function"){
                        hiddenNavbar();
                    }
                }catch(e){

                }
                var this_obj = $(this);
                delay_till_last(this_obj.uid, function() {
                    //构造数据
                    $.designselector(this_obj);
                }, 300);
            });

            $('body').on('click','.SZY-TPL-SETTING',function(){
                var uid = $(this).data('uid');
                var url = $(this).data('url');
                var title = $(this).data('title');
                var tpl = $(this).data('tpl');
                var container = $(this).data('container');
                if($(this).data('modal') && $(this).data('modal') == '1'){
                    $.loading.start();
                    modal = $.modal($(this));
                    if (modal) {
                        modal.show();
                        $.loading.stop();
                    } else {
                        modal = $.modal({
                            title: title,
                            trigger: $(this),
                            ajax: {
                                url: url,
                            },

                        });
                    }
                }else{
                    $.open({
                        type: 2,
                        area: ['1100px', '610px'],
                        //btn: true,
                        fix: true,
                        maxmin: true,
                        title: title,
                        content: url,
                        end: function(result) {
                            if(uid != undefined){
                                refreshTpl(page, uid);
                            }else{
                                //window.location.reload();
                                //刷新
                                if(tpl){
                                    ajaxRender(page, tpl, container);
                                }else{
                                    window.location.reload();
                                }
                            }
                        }
                    });
                }
            });

            $('body').on('click','.SZY-THEME-TPL',function(){
                var id = $(this).data("id");
                $.confirm("确定使用此主题模板吗？ 注意：此操作不可恢复！", function() {
                    $.loading.start();
                    $.ajax({
                        url: '/site/tpl-backup',
                        dataType: 'json',
                        data: {
                            action: 'usetpl',
                            id: id,
                            topic_id: topic_id
                        },
                        success: function(result) {
                            $.msg(result.message,{
                                time:2000
                            },function(){
                                window.location.reload();
                            });
                            //refreshTpl(page);
                        }
                    });
                });
            });

            //选择页面显示隐藏js
            $('.page-title').click(function() {
                $('.page-title-nav').show();
            });
            $('.bv-header-close').click(function() {
                $('.page-title-nav').hide();
            });
            $('.bv-container li').click(function(){
                $.go($(this).data('url'));
            });

        });
    </script>

@stop