@extends('layouts.design_layout_v3')

@section('header_js')


@stop

@section('content')

    <!-- 装修js -->
    <script src="/assets/d2eace91/js/jquery.design.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/jquery-ui.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/design/TouchSlide.1.1.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/design/bubbleup.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/design/index_tab.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/design/jquery-hdscroll.js?v=20180813"></script>
    <link rel="stylesheet" href="/assets/d2eace91/css/design/mobile/design.css?v=20180702"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/design/moduleEditTool.css?v=20180702"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180702"/> <link rel="stylesheet" href="/assets/d2eace91/css/design/mobile/tplsetting.css?v=20180702"/>
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/evol-colorpicker/css/evol.colorpicker.css?v=20180702"/>
    <script src="/assets/d2eace91/js/jquery-ui.js?v=20180813"></script>
    <script src="/assets/d2eace91/bootstrap/evol-colorpicker/js/evol.colorpicker.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=20180813"></script>
    <link rel="stylesheet" href="/assets/d2eace91/css/design/mobile/swiper.min.css?v=20180702"/>
    <script src="/assets/d2eace91/js/design/swiper.jquery.min.js?v=20180813"></script>
    <!--前台css-->
    <link rel="stylesheet" href="/assets/d2eace91/css/design/mobile/public.css?v=20180702"/>
    <link rel="stylesheet" href="http://m.b2b2c.yunmall.68mall.com/css/dianpu.css?v=20180702"/>
    <link rel="stylesheet" href="http://m.b2b2c.yunmall.68mall.com/css/shop_header.css?v=20180702"/>
    <!--整站改色 _start-->
    <link rel="stylesheet" href="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/css/custom/m_site-color-style-0.css?v=20180702" id="site_style"/>
    <!--整站改色 _end-->
    <!--顶部topbar-->
    <div class="module-topBar">

        <div class="module-topBar-inner">
            <a class="topBar-logo">
                <img src="{{ get_image_url(sysconf('seller_center_logo')) }}" />
            </a>
            <div class="topBar-navbar-r">
                <div class="topBar-navbar">
                    <a class="SZY-WEB-STATIC" href="javascript:void(0);" data-value="1">
                        <div class="topBar-button">
                            <span class="title">关闭静态页面</span>
                        </div>
                    </a>
                </div>

                <div class="top-set-btn displayMode">
                    <a href="/design/tpl-setting/setup?page=shop" class="set-btn" title="电脑端装修">
                        <span class="icon se-btn-pc"></span>
                        电脑端装修
                    </a>

                    <a href="javascript:void(0)" class="set-btn active" title="微商城装修">
                        <span class="icon se-btn-weixin"></span>
                        微商城装修
                    </a>


                    <a href="/design/tpl-setting/setup?page=app_shop" class="set-btn" title="APP端装修">
                        <span class="icon se-btn-app"></span>
                        APP端装修
                    </a>


                </div>
                <div class="page-operation-btns">
                    <a class="page-btn page-preview-btn SZY-TPL-BACKUP" href="javascript:void(0);">模板备份</a>
                    <a class="page-btn page-preview-btn SZY-TPL-USE" data-id="1" href="javascript:void(0);">使用备份</a>
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
                                <a href="javascript:;" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_banner.png">
                                </a>
                                <a href="javascript:;" class="panelModuleTitle" title="轮播广告">轮播广告</a>
                            </li>

                            <li class="drag" id="0" data-code="m_ad_s1" style="z-index: 3">
                                <a href="javascript:;" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_ad_s1.png">
                                </a>
                                <a href="javascript:;" class="panelModuleTitle" title="广告版式一">广告版式一</a>
                            </li>

                            <li class="drag" id="0" data-code="m_ad_s2" style="z-index: 3">
                                <a href="javascript:;" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_ad_s2.png">
                                </a>
                                <a href="javascript:;" class="panelModuleTitle" title="广告版式二">广告版式二</a>
                            </li>

                            <li class="drag" id="0" data-code="m_ad_s3" style="z-index: 3">
                                <a href="javascript:;" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_ad_s3.png">
                                </a>
                                <a href="javascript:;" class="panelModuleTitle" title="广告版式三">广告版式三</a>
                            </li>

                            <li class="drag" id="0" data-code="m_ad_s4" style="z-index: 3">
                                <a href="javascript:;" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_ad_s4.png">
                                </a>
                                <a href="javascript:;" class="panelModuleTitle" title="广告版式四">广告版式四</a>
                            </li>

                        </ul>

                    </fieldset>
                </div>



                <div class="panelItemContainer" id="panelItme2">
                    <fieldset class="panelItemBox">

                        <legend>商品模板</legend>
                        <ul class="panelModuleIconContainer">

                            <li class="drag" id="0" data-code="m_goods_floor_s1" style="z-index: 3">
                                <a href="javascript:;" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_goods_floor_s1.png">
                                </a>
                                <a href="javascript:;" class="panelModuleTitle" title="楼层版式一">楼层版式一</a>
                            </li>

                            <li class="drag" id="0" data-code="m_goods_floor_s2" style="z-index: 3">
                                <a href="javascript:;" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_goods_floor_s2.png">
                                </a>
                                <a href="javascript:;" class="panelModuleTitle" title="楼层版式二">楼层版式二</a>
                            </li>

                            <li class="drag" id="0" data-code="m_goods_promotion" style="z-index: 3">
                                <a href="javascript:;" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_goods_promotion.png">
                                </a>
                                <a href="javascript:;" class="panelModuleTitle" title="楼层版式三">楼层版式三</a>
                            </li>

                        </ul>

                    </fieldset>
                </div>



                <div class="panelItemContainer" id="panelItme3">
                    <fieldset class="panelItemBox">

                        <legend>通用模板</legend>
                        <ul class="panelModuleIconContainer">

                            <li class="drag" id="0" data-code="m_goods_title_s1" style="z-index: 3">
                                <a href="javascript:;" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_goods_title_s1.png">
                                </a>
                                <a href="javascript:;" class="panelModuleTitle" title="标题版式一">标题版式一</a>
                            </li>

                            <li class="drag" id="0" data-code="m_ad_title_s1" style="z-index: 3">
                                <a href="javascript:;" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_ad_title_s1.png">
                                </a>
                                <a href="javascript:;" class="panelModuleTitle" title="标题版式二">标题版式二</a>
                            </li>

                            <li class="drag" id="0" data-code="m_ad_title_s2" style="z-index: 3">
                                <a href="javascript:;" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_ad_title_s2.png">
                                </a>
                                <a href="javascript:;" class="panelModuleTitle" title="标题版式三">标题版式三</a>
                            </li>

                            <li class="drag" id="0" data-code="m_nav_s1" style="z-index: 3">
                                <a href="javascript:;" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_nav_s1.png">
                                </a>
                                <a href="javascript:;" class="panelModuleTitle" title="导航版式一">导航版式一</a>
                            </li>

                            <li class="drag" id="0" data-code="m_nav_s2" style="z-index: 3">
                                <a href="javascript:;" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_nav_s2.png">
                                </a>
                                <a href="javascript:;" class="panelModuleTitle" title="导航版式二">导航版式二</a>
                            </li>

                            <li class="drag" id="0" data-code="m_blank_line" style="z-index: 3">
                                <a href="javascript:;" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_blank_line.png">
                                </a>
                                <a href="javascript:;" class="panelModuleTitle" title="空白分割条">空白分割条</a>
                            </li>

                            <li class="drag" id="0" data-code="m_custom_s1" style="z-index: 3">
                                <a href="javascript:;" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_custom_s1.png">
                                </a>
                                <a href="javascript:;" class="panelModuleTitle" title="自定义模板">自定义模板</a>
                            </li>

                            <li class="drag" id="0" data-code="m_tab_s1" style="z-index: 3">
                                <a href="javascript:;" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_tab_s1.png">
                                </a>
                                <a href="javascript:;" class="panelModuleTitle" title="选项卡模板">选项卡模板</a>
                            </li>

                            <li class="drag" id="0" data-code="m_video" style="z-index: 3">
                                <a href="javascript:;" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_video.png">
                                </a>
                                <a href="javascript:;" class="panelModuleTitle" title="视频模板">视频模板</a>
                            </li>

                        </ul>

                    </fieldset>
                </div>



                <div class="panelItemContainer" id="panelItme4">
                    <fieldset class="panelItemBox">

                        <legend>分页模板</legend>
                        <ul class="panelModuleIconContainer">

                            <li class="drag" id="0" data-code="m_goods_list" style="z-index: 3">
                                <a href="javascript:;" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_goods_list.png">
                                </a>
                                <a href="javascript:;" class="panelModuleTitle" title="滚动商品">滚动商品</a>
                            </li>

                        </ul>

                    </fieldset>
                </div>





                <div class="panelItemContainer" id="panelItme6">
                    <fieldset class="panelItemBox">

                        <legend>资讯模板</legend>
                        <ul class="panelModuleIconContainer">

                            <li class="drag" id="0" data-code="m_news_s1" style="z-index: 3">
                                <a href="javascript:;" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_news_s1.png">
                                </a>
                                <a href="javascript:;" class="panelModuleTitle" title="资讯版式一">资讯版式一</a>
                            </li>

                            <li class="drag" id="0" data-code="m_news_s2" style="z-index: 3">
                                <a href="javascript:;" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_news_s2.png">
                                </a>
                                <a href="javascript:;" class="panelModuleTitle" title="资讯版式二">资讯版式二</a>
                            </li>

                        </ul>

                    </fieldset>
                </div>





                <div class="panelItemContainer" id="panelItme8">
                    <fieldset class="panelItemBox">

                        <legend>营销模板</legend>
                        <ul class="panelModuleIconContainer">

                            <li class="drag" id="0" data-code="m_activity_s1" style="z-index: 3">
                                <a href="javascript:;" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_activity_s1.png">
                                </a>
                                <a href="javascript:;" class="panelModuleTitle" title="团购活动">团购活动</a>
                            </li>

                            <li class="drag" id="0" data-code="m_activity_s2" style="z-index: 3">
                                <a href="javascript:;" class="panelModuleIcon">
                                    <img src="/assets/d2eace91/images/design/icon/0/m_activity_s2.png">
                                </a>
                                <a href="javascript:;" class="panelModuleTitle" title="拼团活动">拼团活动</a>
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

                    <!-- 引用头文件 -->
                    <div class="SZY-SHOP-HEADER">
                        <a href="javascript:void(0)" class="SZY-SET-HEAD shop-header-selector content-selector" data-url='/shop/config/index.html?group=m_shop_header' data-title='店铺头部设置'></a>

                        <div class="shop-top-box shop-top-con1">
                            <div class="shop-top-bg">

                                <img src="{{ get_image_url($shop_info->shop_sign_m) }}">

                            </div>
                            <header class="header">
                                <div class="header-bcak-bar">
                                    <a class="sb-back" href="javascript:history.back(-1)" title="返回"></a>
                                </div>
                                <!-- 如果有自由购功能，给下面标签添加class,'header-middle-freebuy' -->
                                <div class="header-middle-box header-middle-freebuy SZY-SHOP-HEADER">
                                    <div class="header-middle-con">
                                        <form name="searchForm" method="get" action="/shop/1/list">
                                            <div class="header-search">
                                                <i class="search-icon"></i>
                                                <input type="text" name="keyword" value="" class="search-input" placeholder="搜索店铺内商品">
                                            </div>
                                        </form>
                                        <a href="/freebuy/scan/1.html" class="freebuy-scan hide" title="扫码">
                                        </a>
                                    </div>
                                </div>
                                <!-- 如果有自由购功能，给下面标签添加class,'header-right-freebuy'，然后扫码的a标签显示 -->
                                <div class="header-right-bar">
                                    <aside class="top_bar">
                                        <div class="show-menu" id="show_more">
                                            <a href="javascript:void(0);"></a>
                                        </div>
                                    </aside>
                                </div>
                            </header>
                            <div class="shop-info">
                                <div class="shop-logo">
                                    <img src="{{ get_image_url($shop_info->shop_logo, 'shop_logo') }}" alt="{{ $shop_info->shop_name }}">
                                </div>

                                <div class="shop-collect-btn SZY-SHOP-IS-COLLENT" data-shop_id="{{ $shop_info->shop_id }}">
                                    <i class="iconfont">&#xe615;</i>
                                    <span>收藏</span>
                                </div>
                                <div class="shop-info-right">
                                    <div class="shop-name">{{ $shop_info->shop_name }}</div>

                                    <div class="shop-notice">
                                        <em>公告</em>
                                        <ul class="SZY-SHOP-ARTICLE">
                                            <li>
                                                <a href="javascript:void(0)">{!! $shop_info->detail_introduce !!}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="shop-nav clearfix">
                            <ul class="nav-ul">
                                <li class="current">
                                    <a href="javascript:void(0)">
                                        <i class="iconfont">&#xe601;</i>
                                        <span>店铺首页</span>
                                    </a>
                                </li>
                                <li >
                                    <a href="javascript:void(0)">
                                        <i class="SZY-SHOP-GOODS-COUNT">0</i>
                                        <span>全部商品</span>
                                    </a>
                                </li>
                                <li >
                                    <a href="javascript:void(0)">
                                        <i class="SZY-SHOP-BONUS-COUNT">0</i>
                                        <span>店铺红包</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="SZY-TEMPLATE-MAIN-CONTAINER dropzone"></div>
                    <!--底部菜单 start-->
                    <div style="height: 45px;"></div>
                    <div class="shop-footer">
                        <div class="shop-footer-l">

                            <a href="javascript:void(0)" class="content-selector SZY-TPL-SETTING" data-url="/design/navigation/list.html?nav_page=m_shop&nav_position=3" data-title="导航设置">
                                <i class="fa fa-edit"></i>
                                编辑
                            </a>



                            <a href="{{ route('mobile_shop_home', ['shop_id'=>$shop_info->shop_id]) }}">
                                <i class="shop-nav-icon"></i>
                                <span>首页</span>
                            </a>

                        </div>
                        <ul>
                            <!---->
                            <li class="goods-category ">
                                <a href="javascript:void(0)">
				<span>
					<i class="shop-index"></i>
					<div class="loader-img">
						<div></div>
					</div>
					商品分类
				</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('mobile_shop_info', ['shop_id'=>$shop_info->shop_id]) }}">
				<span>
					<i class="shop-index"></i>
					店铺详情
				</span>
                                </a>
                            </li>

                            <!-- -->
                            <li>
                                <a href="/bonus/list/1.html">
				<span>
					<i class="shop-index"></i>
					店铺红包
				</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                    <div class="classify-content SZY-SHOP-CATEGORY-LIST hide"></div>
                </div>
                <div class="special-footer"></div>
            </div>
        </div>

        <div class="mobile_design_right">
            <div class="design_right_box">
                <ul class="designSidebar">
                    <li class="mobiTemColumn active">
                        <a>模板助手</a>
                    </li>

                    <li class="mobiTemColumn">
                        <a>主题</a>
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
                                <td>是否开启</td>
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

                        <li class="SZY-THEME-TPL current" data-id="62" data-img="http://68dsw.oss-cn-beijing.aliyuncs.com/images/backend/gallery/2018/04/03/15227278320832.png">
						<span class="template_select_bg">
							<img src="http://68dsw.oss-cn-beijing.aliyuncs.com/images/backend/gallery/2018/04/03/15227278320832.png">
						</span>
                            <span class="template_select_name">外卖风格</span>
                            <div class="mask-div"></div>
                            <a href="javascript:;" class="template_select_handle"></a>
                        </li>

                        <li class="SZY-THEME-TPL " data-id="71" data-img="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/shop/1/gallery/2018/11/24/15430445485896.jpg">
						<span class="template_select_bg">
							<img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/shop/1/gallery/2018/11/24/15430445485896.jpg">
						</span>
                            <span class="template_select_name">主题风格</span>
                            <div class="mask-div"></div>
                            <a href="javascript:;" class="template_select_handle"></a>
                        </li>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/design/tplsetting_mobile.js?v=20180813"></script>
    <script type="text/javascript">
        //初始化数据
        var chk_value =[];
        var data = [];
        var data_m = {};
        var page = "m_shop";
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
                    $handle.append($('<a class="upMove-btn" href="javascript:;"><div class="selector-box"><div class="arrow"></div><i class="fa fa-arrow-circle-o-up"></i>上移</div></a>'));
                    $handle.append($('<a class="downMove-btn" href="javascript:;"><div class="selector-box"><div class="arrow"></div><i class="fa fa-arrow-circle-o-down"></i>下移</div></a>'));
                    $handle.append($('<a class="hide-btn" href="javascript:;"><div class="selector-box"><div class="arrow"></div><i class="' + is_valid_class + '"></i>' + value.format_is_valid + '</div></a>'));
                    $handle.append($('<a class="deletes-btn" href="javascript:;""><div class="selector-box"><div class="arrow"></div><i class="fa fa-trash-o"></i>删除</div></a>'));
                    $el.append($handle);
                    $(".SZY-TEMPLATE-NAV-CONTAINER").append($el);
                }else{
                    var $handle = $('<div class="operateEdit"></div>');
                    $handle.append($('<a class="decor-btn upMove-btn"><div class="selector-box"><div class="arrow"></div><i class="fa fa-arrow-circle-o-up"></i>上移</div></a>').click(function () { setSortTpls(value.uid,'up'); }));
                    $handle.append($('<a class="decor-btn downMove-btn"><div class="selector-box"><div class="arrow"></div><i class="fa fa-arrow-circle-o-down"></i>下移</div></a>').click(function () { setSortTpls(value.uid,'down'); }));
                    $handle.append($('<a class="decor-btn '+is_eye_valid_class+'"><div class="selector-box"><div class="arrow"></div><i class="' + is_valid_class + '"></i>' + value.format_is_valid + '</div></a>').click(function () { setIsValidTpls(value.uid); }));
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
        $(function(){
            $('.top-set-btn').click(function(){
                if($(this).find('.set-btn-box').hasClass('hide')){
                    $(this).find('.set-btn-box').removeClass('hide');
                }else{
                    $(this).find('.set-btn-box').addClass('hide')
                }
            });

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
                $.open({
                    type: 2,
                    area: ['1120px', '610px'],
                    btn: true,
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
                            ajaxRender(page, tpl, container);
                        }
                    }
                });
            });

            $('body').on('click','.SZY-SET-HEAD',function(){
                var url = $(this).data('url');
                var title = $(this).data('title');
                var tpl = $(this).data('tpl');
                $.get(url,{ is_layer:1 },function(result){
                    if(result.code == 0){
                        $.open({
                            type: 1,
                            area: ['800px', '550px'],
                            btn: true,
                            btn: ['确认','取消'],
                            btnAlign: 'c',
                            fix: true,
                            maxmin: true,
                            title: title,
                            content: result.data,
                            yes:function(index, layero){
                                layero.find('#btn_submit').trigger("click");
                            }
                        });
                    }else{
                        $.msg(result.message);
                    }
                },'json');
            });

            $('body').on('click','.SZY-THEME-TPL',function(){
                var id = $(this).data("id");
                var img = $(this).data('img');
                var is_current = $(this).hasClass('current');
                var msg = '确定使用此主题模板吗？ 注意：此操作不可恢复！';
                if(is_current){
                    msg = '确定取消此主题模板吗？ 注意：此操作不可恢复！';
                }
                $.confirm(msg, function() {
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
                        }
                    });
                });
            });

            $('body').on('click','.SZY-WEB-STATIC',function(){
                var target = $(this);
                var value = $(target).data('value');
                var text = '';
                if(value == 1){
                    text = '关闭静态页面？';
                }else{
                    text = '开启静态页面？';
                }
                $.confirm("确定"+text, function() {
                    $.post('set-static',{
                        code: page
                    },function(result){
                        $.msg(result.message);
                        $(target).data('value' ,result.data);
                        if(result.data == 1){
                            $(target).find('.title').html('关闭静态页面');
                        }else{
                            $(target).find('.title').html('开启静态页面');
                        }
                    },'json');
                });
            });
        });
    </script>

@stop