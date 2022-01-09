@extends('layouts.design_layout_v3')

@section('header_js')

    <!-- 图片缓载js -->
    <script src="/assets/d2eace91/js/jquery.lazyload.js?v=20180418"></script>
    <!-- 装修js -->
    <script src="/assets/d2eace91/js/jquery.design.js?v=20180418"></script>
    <!--选色插件-->
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/evol-colorpicker/css/evol.colorpicker.css?v=1.6"/>
    <script src="/assets/d2eace91/js/jquery-ui.js?v=20180418"></script>
    <script src="/assets/d2eace91/bootstrap/evol-colorpicker/js/evol.colorpicker.js?v=20180418"></script>
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=20180418"></script>
    <link rel="stylesheet" href="/assets/d2eace91/css/design/moduleEditTool.css?v=1.6"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.6"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/design/mobile/swiper.min.css?v=1.6"/>
    <script src="/assets/d2eace91/js/design/swiper.jquery.min.js?v=20180418"></script>

@stop

@section('content')
    <script src="/assets/d2eace91/js/design/TouchSlide.1.1.js?v=20180418"></script>
    <script src="/assets/d2eace91/js/design/bubbleup.js?v=20180418"></script>
    <script src="/assets/d2eace91/js/design/index_tab.js?v=20180418"></script>
    <script src="/assets/d2eace91/js/design/jquery-hdscroll.js?v=20180418"></script>
    <link rel="stylesheet" href="/assets/d2eace91/css/design/mobile/public.css?v=1.6"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/design/mobile/index.css?v=1.6"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/design/mobile/design.css?v=1.6"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/design/mobile/tplsetting.css?v=1.6"/>
    <!--整站改色 _start-->
    @if(sysconf('custom_style_enable') == 1)
        {{-- todo 暂时不确定移动端是否能整站改色 暂时注释掉 --}}
        {{--<link rel="stylesheet" href="/mobile/css/custom/site-color-style-0.css?v=1.6" id="site_style"/>--}}
        <link rel="stylesheet" href="/mobile/css/color-style.css?v=1.6" id="site_style"/>
    @else
        <link rel="stylesheet" href="/mobile/css/color-style.css?v=1.6" id="site_style"/>
    @endif
    <!-- GPS获取坐标 -->
    <script type="text/javascript" src="http://webapi.amap.com/maps?v=1.3&key={{ sysconf('amap_web_key') }}"></script>
    <script src="/assets/d2eace91/js/geolocation/amap.js?v=20180418"></script>



    <!--顶部topbar-->
    <div class="module-topBar">

        <div class="module-topBar-inner">
            <a class="topBar-logo">
                <img src="http://68dsw.oss-cn-beijing.aliyuncs.com/demo/system/config/website/backend_logo_0.png" />
            </a>
            <div class="page-title">
                <label>首页</label>
                <span></span>
            </div>
            <div class="topBar-navbar">
                <a class="SZY-SITE-STYLE" href="javascript:void(0);" data-group="app_site_style">
                    <div class="topBar-button">
                        <span class="title">自定义风格</span>
                    </div>
                </a>
            </div>
            <div class="topBar-navbar-r">
                <div class="top-set-btn displayMode">
                    <a href="/design/tpl-setting/setup?page=site" class="set-btn" title="电脑端装修">
                        <span class="icon se-btn-pc"></span>
                        <span class="title">电脑端装修</span>
                    </a>

                    <a href="/design/tpl-setting/setup?page=m_site" class="set-btn " title="微商城装修">
                        <span class="icon se-btn-weixin"></span>
                        <span class="title">微商城装修</span>
                    </a>


                    <a href="javascript:void(0);" class="set-btn active" title="APP端装修">
                        <span class="icon se-btn-app"></span>
                        <span class="title">APP端装修</span>
                    </a>

                </div>
                <div class="page-operation-btns">
                    <a class="page-btn page-preview-btn SZY-TPL-BACKUP" href="javascript:void(0);">模板备份</a>
                    <a class="page-btn page-preview-btn SZY-TPL-USE" href="javascript:void(0);">使用备份</a>
                    <a class="page-btn page-preview-btn SZY-TPL-RELEASE" href="javascript:void(0);">发布 </a>
                </div>
                <div class="other-more">
                    <a class="icon pg-hd">
                        <span></span>
                    </a>
                    <div class="more-set" style="display: none;">
                        <span class="top-dropdown-bg"></span>
                        <ul>
                            <li>
                                <a class="other-help" target="_blank" href="http://help.68mall.com/">
                                    <i></i>
                                    帮助中心
                                </a>
                            </li>
                            <li>
                                <a class="other-exit">
                                    <i></i>
                                    退出设计
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="mobile_design_container">
        <!--左侧start-->
        <div class="mobile_design_left">
            <div class="panelMenuContainer">模块列表</div>
            <div class="panelContentContainer">


                <div class="panelItemContainer" id="panelItme1">
                    <fieldset class="panelItemBox">

                        <legend>广告模板</legend>
                        <ul class="panelModuleIconContainer">

                            <li class="drag" id="0" data-code="m_banner" style="z-index: 3">
                                <a href="javascript:void(0);" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_banner.png">
                                </a>
                                <a href="javascript:void(0);" class="panelModuleTitle" title="轮播广告">轮播广告</a>
                            </li>

                            <li class="drag" id="0" data-code="m_ad_s1" style="z-index: 3">
                                <a href="javascript:void(0);" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_ad_s1.png">
                                </a>
                                <a href="javascript:void(0);" class="panelModuleTitle" title="广告版式一">广告版式一</a>
                            </li>

                            <li class="drag" id="0" data-code="m_ad_s2" style="z-index: 3">
                                <a href="javascript:void(0);" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_ad_s2.png">
                                </a>
                                <a href="javascript:void(0);" class="panelModuleTitle" title="广告版式二">广告版式二</a>
                            </li>

                            <li class="drag" id="0" data-code="m_ad_s4" style="z-index: 3">
                                <a href="javascript:void(0);" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_ad_s4.png">
                                </a>
                                <a href="javascript:void(0);" class="panelModuleTitle" title="广告版式四">广告版式四</a>
                            </li>

                            <li class="drag" id="0" data-code="m_ad_s5" style="z-index: 3">
                                <a href="javascript:void(0);" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_ad_s5.png">
                                </a>
                                <a href="javascript:void(0);" class="panelModuleTitle" title="悬浮广告">悬浮广告</a>
                            </li>

                        </ul>

                    </fieldset>
                </div>



                <div class="panelItemContainer" id="panelItme2">
                    <fieldset class="panelItemBox">

                        <legend>商品模板</legend>
                        <ul class="panelModuleIconContainer">

                            <li class="drag" id="0" data-code="m_goods_floor_s1" style="z-index: 3">
                                <a href="javascript:void(0);" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_goods_floor_s1.png">
                                </a>
                                <a href="javascript:void(0);" class="panelModuleTitle" title="楼层版式一">楼层版式一</a>
                            </li>

                            <li class="drag" id="0" data-code="m_goods_floor_s2" style="z-index: 3">
                                <a href="javascript:void(0);" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_goods_floor_s2.png">
                                </a>
                                <a href="javascript:void(0);" class="panelModuleTitle" title="楼层版式二">楼层版式二</a>
                            </li>

                            <li class="drag" id="0" data-code="m_goods_promotion" style="z-index: 3">
                                <a href="javascript:void(0);" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_goods_promotion.png">
                                </a>
                                <a href="javascript:void(0);" class="panelModuleTitle" title="楼层版式三">楼层版式三</a>
                            </li>

                        </ul>

                    </fieldset>
                </div>



                <div class="panelItemContainer" id="panelItme3">
                    <fieldset class="panelItemBox">

                        <legend>通用模板</legend>
                        <ul class="panelModuleIconContainer">

                            <li class="drag" id="0" data-code="m_goods_title_s1" style="z-index: 3">
                                <a href="javascript:void(0);" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_goods_title_s1.png">
                                </a>
                                <a href="javascript:void(0);" class="panelModuleTitle" title="标题版式一">标题版式一</a>
                            </li>

                            <li class="drag" id="0" data-code="m_ad_title_s1" style="z-index: 3">
                                <a href="javascript:void(0);" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_ad_title_s1.png">
                                </a>
                                <a href="javascript:void(0);" class="panelModuleTitle" title="标题版式二">标题版式二</a>
                            </li>

                            <li class="drag" id="0" data-code="m_ad_title_s2" style="z-index: 3">
                                <a href="javascript:void(0);" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_ad_title_s2.png">
                                </a>
                                <a href="javascript:void(0);" class="panelModuleTitle" title="标题版式三">标题版式三</a>
                            </li>

                            <li class="drag" id="0" data-code="m_nav_s1" style="z-index: 3">
                                <a href="javascript:void(0);" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_nav_s1.png">
                                </a>
                                <a href="javascript:void(0);" class="panelModuleTitle" title="导航版式一">导航版式一</a>
                            </li>

                            <li class="drag" id="0" data-code="m_nav_s2" style="z-index: 3">
                                <a href="javascript:void(0);" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_nav_s2.png">
                                </a>
                                <a href="javascript:void(0);" class="panelModuleTitle" title="导航板式二">导航板式二</a>
                            </li>

                            <li class="drag" id="0" data-code="m_article" style="z-index: 3">
                                <a href="javascript:void(0);" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_article.png">
                                </a>
                                <a href="javascript:void(0);" class="panelModuleTitle" title="商城公告">商城公告</a>
                            </li>

                            <li class="drag" id="0" data-code="m_article_s2" style="z-index: 3">
                                <a href="javascript:void(0);" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_article_s2.png">
                                </a>
                                <a href="javascript:void(0);" class="panelModuleTitle" title="自定义公告">自定义公告</a>
                            </li>

                            <li class="drag" id="0" data-code="m_blank_line" style="z-index: 3">
                                <a href="javascript:void(0);" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_blank_line.png">
                                </a>
                                <a href="javascript:void(0);" class="panelModuleTitle" title="空白分割条">空白分割条</a>
                            </li>

                            <li class="drag" id="0" data-code="m_shop_street" style="z-index: 3">
                                <a href="javascript:void(0);" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_shop_street.png">
                                </a>
                                <a href="javascript:void(0);" class="panelModuleTitle" title="店铺版式一">店铺版式一</a>
                            </li>

                        </ul>

                    </fieldset>
                </div>



                <div class="panelItemContainer" id="panelItme4">
                    <fieldset class="panelItemBox">

                        <legend>分页模板</legend>
                        <ul class="panelModuleIconContainer">

                            <li class="drag" id="0" data-code="m_goods_list" style="z-index: 3">
                                <a href="javascript:void(0);" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_goods_list.png">
                                </a>
                                <a href="javascript:void(0);" class="panelModuleTitle" title="滚动商品">滚动商品</a>
                            </li>

                            <li class="drag" id="0" data-code="m_near_shop" style="z-index: 3">
                                <a href="javascript:void(0);" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_near_shop.png">
                                </a>
                                <a href="javascript:void(0);" class="panelModuleTitle" title="附近店铺">附近店铺</a>
                            </li>

                        </ul>

                    </fieldset>
                </div>











            </div>
        </div>
        <div class="leftSide">
            <div class="leftSideCenter">模块列表</div>
        </div>
        <!--左侧end-->
        <!--右侧start-->

        <div class="mobile_design_center">
            <div class="mobile_list">
                <div class="special-top"></div>
                <div class="special-item">
                    <header class="header app-bg-color">
                        <a href="javascript:void(0)" class="content-selector SZY-TPL-SETTING" data-url='/system/config/index.html?group=app_setting_header' data-modal="1" data-title='头部设置'>
                            <i class="fa fa-edit"></i>
                            编辑
                        </a>
                        <div class="search-box-cover" style="opacity: 0;"></div>
                        <div class="search-box">
                            <div class="search-tb">
                                <div class="nav_left">
                                    <em class="top_left ub_img"></em>
                                    <span class="bottom_nav">分类</span>
                                </div>
                                <div class="box-search">
                                    <a class="react" href="#">
                                        <i class="icon-search iconfont">&#xe600;</i>
                                        <span class="single-line"> 请输入要搜索的关键字 </span>
                                    </a>
                                </div>
                                <div class="nav_right">
                                    <em class="top_right ub_img">
                                        <i class="message_num">10</i>
                                    </em>
                                    <span class="bottom_nav">消息</span>
                                </div>
                            </div>
                        </div>
                    </header>
                    <div style="height: 50px; line-height: 50px;"></div>
                    <div class="SZY-TEMPLATE-MAIN-CONTAINER dropzone"></div>
                    <!--底部菜单 start-->
                    <div class="SZY-TPL-FOOTER footer-nav-box"><!--底部菜单 start-->
                        <script src="http://m.b2b2c.yunmall.68mall.com/js/custom_js.js?v=20180418"></script> <link rel="stylesheet" href="http://m.b2b2c.yunmall.68mall.com/css/custom_css.css?v=1.6"/>
                        <div style="height: 48px; line-height: 48px; clear: both; display:none;"></div>
                        <div class="footer-nav">

                            <a href="javascript:void(0)" class="content-selector SZY-TPL-SETTING" data-url='/design/navigation/list.html?nav_page=app&nav_position=3' data-title='导航设置' data-tpl='@frontend/web_mobile/modules/library/site_footer_menu.tpl' data-container='.SZY-TPL-FOOTER'>
                                <i class="fa fa-edit"></i>
                                编辑
                            </a>




                            请添加导航

                        </div>
                    </div>
                    <!--底部菜单 end-->

                    <a href="#" id="back-to-top" class="gotop">
                        <img src="/assets/d2eace91/images/design/mobile/topup.png">
                    </a>
                </div>
                <div class="special-footer"></div>
            </div>
        </div>
        <script>
            $(document).ready(function(){
                //首先将#back-to-top隐藏
                $("#back-to-top").show();
                $(function () {
                    $("#back-to-top").click(function(){
                        $('body,html').animate(
                            {
                                scrollTop:0
                            }
                            ,600);
                        return false;
                    });
                });
            });
        </script>
        <div class="mobile_design_right">
            <div class="design_right_box">
                <ul class="designSidebar">
                    <li class="mobiTemColumn active">
                        <a>模板助手</a>
                    </li>

                </ul>
                <div class="design_right_body">
                    <!--模块设置-->
                    <div class="template_set design_right_child">
                        <table id="mobile_helper">
                            <thead class="template_set_top">
                            <tr height="40">
                                <td class="w30"></td>
                                <td>模块名称</td>
                                <td>是否显示</td>
                                <td>操作</td>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                            <tr height="40">
                                <td class="tcheck w30">
                                    <input class="checkBox table-list-checkbox all-checkbox" value="" type="checkbox">
                                </td>
                                <td colspan="3">
                                    <div class="pull-left">
                                        <a href="javascript:void(0)" class="batch-delete">批量删除</a>
                                        <a href="javascript:void(0)" class="batch-valid" data-value="1">批量显示</a>
                                        <a href="javascript:void(0)" class="batch-valid" data-value="0">批量隐藏</a>
                                    </div>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="template_select design_right_child" style="display: none">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/assets/d2eace91/js/jquery-ui.js?v=20180418"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180418"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20180418"></script>
    <script src="/assets/d2eace91/js/design/tplsetting_mobile.js?v=20180418"></script>
    <script type="text/javascript">
        //初始化数据
        var chk_value =[];
        var data = [];
        var data_m = {};
        var page = "app";
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
                var $handle = $('<div class="operateEdit"></div>');
                $handle.append($('<a class="decor-btn upMove-btn"><div class="selector-box"><div class="arrow"></div><i class="fa fa-arrow-circle-o-up"></i>上移</div></a>').click(function () { setSortTpls(value.uid,'up'); }));
                $handle.append($('<a class="decor-btn downMove-btn"><div class="selector-box"><div class="arrow"></div><i class="fa fa-arrow-circle-o-down"></i>下移</div></a>').click(function () { setSortTpls(value.uid,'down'); }));
                $handle.append($('<a class="decor-btn '+is_eye_valid_class+'"><div class="selector-box"><div class="arrow"></div><i class="' + is_valid_class + '"></i>' + value.format_is_valid + '</div></a>').click(function () { setIsValidTpls(value.uid); }));
                $handle.append($('<a class="decor-btn deletes-btn"><div class="selector-box"><div class="arrow"></div><i class="fa fa-trash-o"></i>删除</div></a>').click(function () { delTpls(value.uid); }));
                $el.append($handle);
                $('.SZY-TEMPLATE-MAIN-CONTAINER').append($el);
            });
            $.loading.stop();
            getHelper('');
            //图片缓载
            $.imgloading.loading();
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
        $('.panelContentContainer').mCustomScrollbar();
        $('.design_right_body').mCustomScrollbar();
        $('.panelContentContainer').mCustomScrollbar('scrollTo', 'top');
        $('.designSidebar li').click(function(){
            $(this).addClass("active").siblings().removeClass('active');
            $(this).parents('.design_right_box').find(".design_right_child").hide().eq($(this).index()).show();
        });
        $(".other-more").click(function() {
            $(".more-set").slideToggle(100);

        }).mouseleave(function() {
            $(".more-set").hide();
        });
    </script>


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

        });
    </script>

@stop