@extends('layouts.design_layout_v3')

@section('header_js')


@stop

@section('content')

    <!--页面css/js-->
    <script src="/assets/d2eace91/js/design/shop_index.js?v=20180813"></script>
    <!-- 公共css -->
    <link rel="stylesheet" href="http://www.b2b2c.yunmall.68mall.com/css/common.css?v=20180702"/>
    <link rel="stylesheet" href="http://www.b2b2c.yunmall.68mall.com/css/shop_index.css?v=20180702"/>
    <link rel="stylesheet" href="http://www.b2b2c.yunmall.68mall.com/css/topic_activity.css?v=20180702"/>
    <link rel="stylesheet" href="http://www.b2b2c.yunmall.68mall.com/css/template.css?v=20180702"/>
    <link rel="stylesheet" href="http://www.b2b2c.yunmall.68mall.com/css/color-style.css?v=20180702"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20180702"/>
    <!-- 装修js -->
    <script src="/assets/d2eace91/js/jquery.design.js?v=20180813"></script>
    <!-- 装修css -->
    <link rel="stylesheet" href="/assets/d2eace91/css/design/tplsetting.css?v=20180702"/>
    <link rel="stylesheet" href="/assets/d2eace91/css/design/design.css?v=20180702"/>
    <script src="/assets/d2eace91/js/design/bubbleup.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/design/index_tab.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/design/jump.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/design/common.js?v=20180813"></script>
    <!--选色插件-->
    <link rel="stylesheet" href="/assets/d2eace91/bootstrap/evol-colorpicker/css/evol.colorpicker.css?v=20180702"/>
    <script src="/assets/d2eace91/js/jquery-ui.js?v=20180813"></script>
    <script src="/assets/d2eace91/bootstrap/evol-colorpicker/js/evol.colorpicker.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/pic/imgPreview.js?v=20180813"></script>
    <link rel="stylesheet" href="/assets/d2eace91/css/design/moduleEditTool.css?v=20180702"/>


    <!--顶部topbar-->
    <div class="module-topBar">

        <div class="module-topBar-inner">
            <a class="topBar-logo">
                <img src="{{ get_image_url(sysconf('seller_center_logo')) }}" />
            </a>

            <div class="topBar-navbar">
                <a href="javascript:void(0);" class="SZY-TOPIC-BACKGROUND-IMAGE">
                    <div class="topBar-button">
                        <span class="title">背景设置</span>
                    </div>
                </a>
            </div>

            <div class="topBar-navbar-r">
                <div class="top-set-btn displayMode">
                    <a class="set-btn active" href="javascript:void(0);" title="电脑端装修">
                        <span class="icon se-btn-pc"></span>
                        <span class="title">电脑端装修</span>
                    </a>

                    <a href="/design/tpl-setting/setup?page=m_topic&topic_id=1" class="set-btn" title="微商城装修">
                        <span class="icon se-btn-weixin"></span>
                        <span class="title">微商城端装修</span>
                    </a>


                    <a href="/design/tpl-setting/setup?page=app_topic&topic_id=1" class="set-btn" title="APP装修">
                        <span class="icon se-btn-app"></span>
                        <span class="title">APP端装修</span>
                    </a>

                </div>
                <div class="page-operation-btns">
                    <a class="page-btn page-preview-btn" id="show_nav" href="javascript:void(0);">隐藏导航</a>
                    <a class="page-btn page-preview-btn SZY-TPL-BACKUP" href="javascript:void(0);">模板备份</a>
                    <a class="page-btn page-preview-btn SZY-TPL-USE" data-id="1" href="javascript:void(0);">使用备份</a>
                    <a class="page-btn page-preview-btn SZY-TPL-RELEASE" href="javascript:void(0);"> 发布 </a>
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

    <!--模块内容-->
    <div class="module-main unfold template-one" style="padding-bottom: 100px;">
        <!-- 顶部导航模块_start -->
        <div id="NAVIGATIONTPL">
            <!-- 引入头部 -->
            <!-- 引入头部文件 -->
            <script src="/frontend/js/index.js?v=20180813"></script>
            <script src="/frontend/js/tabs.js?v=20180813"></script>
            <script src="/frontend/js/bubbleup.js?v=20180813"></script>
            <script src="/frontend/js/jquery.hiSlider.js?v=20180813"></script>
            <script src="/frontend/js/index_tab.js?v=20180813"></script>
            <script src="/frontend/js/jump.js?v=20180813"></script>
            <script src="/frontend/js/nav.js?v=20180813"></script>


            <div class="header">
                <div class="w1210 clearfix">
                    <div class="logo-info">
                        <a href="{{ route('pc_home') }}" class="logo">

                            <img src="{{ get_image_url(sysconf('mall_logo')) }}" />

                        </a>
                    </div>
                    <div class="shop-info">
                        <div class="shop">
                            <div class="shop-name ">
                                <a href="{{ route('pc_shop_home', ['shop_id'=>$shop_info->shop_id]) }}" title="{{ $shop_info->shop_name }}">{{ $shop_info->shop_name }}</a>
                            </div>


                        </div>
                        <div class="shop-main">

                            <div class="shop-score-box">
                                <div class="shop-score-item">
                                    <div class="shop-score-title">描 述</div>
                                    <div class="score color">
                                        <span>4.70</span>
                                    </div>
                                </div>
                                <div class="shop-score-item">
                                    <div class="shop-score-title">服 务</div>
                                    <div class="score color">
                                        <span>3.00</span>
                                    </div>
                                </div>
                                <div class="shop-score-item">
                                    <div class="shop-score-title">发 货</div>
                                    <div class="score color">
                                        <span>3.00</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <a class="slogo-triangle">
                            <i class="icon-triangle"></i>
                        </a>
                        <div class="extra-info">
                            <div class="hd">
                                <p class="shop-collect">
                                    <a href="{{ route('pc_shop_home', ['shop_id'=>$shop_info->shop_id]) }}" title="{{ $shop_info->shop_name }}" class="shop-logo">
                                        <img src="{{ get_image_url($shop_info->shop_logo, 'shop_logo') }}">
                                    </a>
                                    <a href="javascript:void(0);" onClick="toggleShop(1,this)" class="collect-btn bg-color">收藏本店</a>
                                </p>
                                <p class="collect-count" style="display: none;">
                                    <em id="collect-count">0</em>
                                </p>
                                <p class="collect-tip" style="display: none;">收藏</p>
                                <!-- 店铺二维码 _start -->
                                <p class="shop-qr-code">
                                    <img src="https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=" alt="店铺二维码" />
                                </p>
                                <!-- 店铺二维码 end -->
                            </div>
                            <div class="bd">

                                <div class="shop-rate">
                                    <h4>店铺动态评分</h4>
                                    <ul>
                                        <li>
                                            描述相符：
                                            <a target="_blank" href="javascript:void(0);">
                                                <em class="count color" title="">4.70</em>
                                            </a>
                                        </li>
                                        <li>
                                            服务态度：
                                            <a target="_blank" href="javascript:void(0);">
                                                <em class="count color" title="">3.00</em>
                                            </a>
                                        </li>
                                        <li>
                                            发货速度：
                                            <a target="_blank" href="javascript:void(0);">
                                                <em class="count color" title="">3.00</em>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="extend ">
                                    <h4 class="extend-title">店铺服务</h4>
                                    <ul>
                                        <li>
                                            <label>店铺掌柜：</label>
                                            <div class="extend-right">
                                                <a href="http://www.b2b2c.yunmall.68mall.com/shop/1.html" class="color">121</a>
                                            </div>
                                        </li>


                                        <li>
                                            <label>开店时长：</label>
                                            <div class="extend-right">
                                                <span class="duration-time">1年</span>
                                            </div>
                                        </li>

                                        <li class="locus">
                                            <label>所在地：</label>
                                            <div class="extend-right">
                                                <span>北京市 北京市 东城区 新世界大酒店</span>
                                            </div>
                                        </li>


                                        <li>
                                            <label>工商执照：</label>
                                            <div class="extend-right">


                                                <a id="" href="http://www.b2b2c.yunmall.68mall.com/shop/index/license.html?id=1&code=special_aptitude" target="_blank">
                                                    <img src="/images/national_emblem_light2.png" width="20" height="22" border="0" alt="特殊行业资质" />
                                                </a>

                                            </div>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--
                    <div class="mobile-shop">
                        <div class="mobile-qr-code">
                            <span>手机逛</span>
                            <i class="qr-code"></i>
                        </div>
                        <a href="javascript:void(0);" class="arrow">
                            <i class="down-up"></i>
                        </a>
                        <div class="mobile-qr-code-box">
                            <img width="140" height="140" src="" />
                            <p>扫一扫，手机逛起来</p>
                        </div>
                    </div>
                     -->
                    <div class="search">
                        <form class="search-form" method="get" name="" id="search-form" action="{{ route('pc_shop_search', ['shop_id' => $shop_info->shop_id]) }}" onSubmit="">
                            <!-- <input type='hidden' name='type' id="searchtype" value=""> -->
                            <div class="search-info">
                                <div class="search-box">
                                    <div class="search-box-con">
                                        <input class="search-box-input" name="keyword" id="keyword" tabindex="9" autocomplete="off" value="" onFocus="if( this.value=='请输入关键词'){ this.value=''; }else{ this.value=this.value; }" onBlur="if(this.value=='')this.value='请输入关键词'" type="text">
                                    </div>
                                </div>
                                <input type="button" onclick="search_all()" value="搜全站" class="button bg-color">
                            </div>
                            <input type="button" onclick="search_me()" value="搜本店" class="button button-spe">
                        </form>
                        <ul class="hot-query">
                            <!-- 默认搜索词 -->

                            <li class="first">
                                <a href="/search.html?keyword=沃噔" title="沃噔">沃噔</a>
                            </li>

                            <li >
                                <a href="/search.html?keyword=沃噔" title="沃噔">沃噔</a>
                            </li>

                            <li >
                                <a href="/search.html?keyword=沃噔" title="沃噔">沃噔</a>
                            </li>

                            <li >
                                <a href="/search.html?keyword=沃噔" title="沃噔">沃噔</a>
                            </li>

                            <li >
                                <a href="/search.html?keyword=本地热卖" title="本地热卖">本地热卖</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <!-- 右侧客服 _start-->
            <!-- 右侧客服_end -->

            <div class="layout">





                <div class="shop-menu" style='background-color:#9bbb59;'>
                    <div class="shop-menu-box">
                        <ul class="shop-menu-left">
                            <li>
                                <a href="http://www.b2b2c.yunmall.68mall.com/shop/1.html" target="">首页</a>
                            </li>
                            <li class="all-category">
                                <a href="http://www.b2b2c.yunmall.68mall.com/shop-list-1.html" target="">
                                    全部分类
                                    <span class="arrow"></span>
                                </a>
                                <div class="all-category-coupon">

                                    <!-- 获取店铺内商品分类 -->





                                    <dl>
                                        <dt>
                                            <a href="http://www.b2b2c.yunmall.68mall.com/shop-list-1-0.html" target="_blank">全部商品 ></a>
                                        </dt>
                                        <dd>
                                            <ul>


                                            </ul>
                                        </dd>
                                    </dl>


                                    <dl>
                                        <dt>
                                            <a href="http://www.b2b2c.yunmall.68mall.com/shop-list-1-549.html" target="_blank">货品类型 ></a>
                                        </dt>
                                        <dd>
                                            <ul>


                                                <li>
                                                    <a href="http://www.b2b2c.yunmall.68mall.com/shop-list-1-560.html" target="_blank">广货</a>
                                                </li>



                                                <li>
                                                    <a href="http://www.b2b2c.yunmall.68mall.com/shop-list-1-561.html" target="_blank">杭货</a>
                                                </li>



                                                <li>
                                                    <a href="http://www.b2b2c.yunmall.68mall.com/shop-list-1-562.html" target="_blank">欧货</a>
                                                </li>



                                                <li>
                                                    <a href="http://www.b2b2c.yunmall.68mall.com/shop-list-1-563.html" target="_blank">韩货</a>
                                                </li>











                                            </ul>
                                        </dd>
                                    </dl>


                                    <dl>
                                        <dt>
                                            <a href="http://www.b2b2c.yunmall.68mall.com/shop-list-1-552.html" target="_blank">月份波段 ></a>
                                        </dt>
                                        <dd>
                                            <ul>


                                                <li>
                                                    <a href="http://www.b2b2c.yunmall.68mall.com/shop-list-1-553.html" target="_blank">2018.5月第二波段</a>
                                                </li>



                                                <li>
                                                    <a href="http://www.b2b2c.yunmall.68mall.com/shop-list-1-564.html" target="_blank">2018.5月第三波段</a>
                                                </li>



                                                <li>
                                                    <a href="http://www.b2b2c.yunmall.68mall.com/shop-list-1-565.html" target="_blank">2018.5月第四波段</a>
                                                </li>



                                                <li>
                                                    <a href="http://www.b2b2c.yunmall.68mall.com/shop-list-1-566.html" target="_blank">2018.6月第一波段</a>
                                                </li>



                                                <li>
                                                    <a href="http://www.b2b2c.yunmall.68mall.com/shop-list-1-567.html" target="_blank">2018.6月第二波段</a>
                                                </li>














                                                <li>
                                                    <a href="http://www.b2b2c.yunmall.68mall.com/shop-list-1-552.html" target="_blank">查看更多 ></a>
                                                </li>




                                            </ul>
                                        </dd>
                                    </dl>


                                    <dl>
                                        <dt>
                                            <a href="http://www.b2b2c.yunmall.68mall.com/shop-list-1-555.html" target="_blank">家饰家品 ></a>
                                        </dt>
                                        <dd>
                                            <ul>


                                                <li>
                                                    <a href="http://www.b2b2c.yunmall.68mall.com/shop-list-1-568.html" target="_blank">灯具类</a>
                                                </li>



                                                <li>
                                                    <a href="http://www.b2b2c.yunmall.68mall.com/shop-list-1-569.html" target="_blank">挂饰摆件类</a>
                                                </li>



                                                <li>
                                                    <a href="http://www.b2b2c.yunmall.68mall.com/shop-list-1-570.html" target="_blank">置物架类</a>
                                                </li>



                                                <li>
                                                    <a href="http://www.b2b2c.yunmall.68mall.com/shop-list-1-571.html" target="_blank">椅子类</a>
                                                </li>



                                                <li>
                                                    <a href="http://www.b2b2c.yunmall.68mall.com/shop-list-1-572.html" target="_blank">桌子类</a>
                                                </li>
























                                                <li>
                                                    <a href="http://www.b2b2c.yunmall.68mall.com/shop-list-1-555.html" target="_blank">查看更多 ></a>
                                                </li>














                                            </ul>
                                        </dd>
                                    </dl>


                                    <dl>
                                        <dt>
                                            <a href="http://www.b2b2c.yunmall.68mall.com/shop-list-1-556.html" target="_blank">女装 ></a>
                                        </dt>
                                        <dd>
                                            <ul>


                                                <li>
                                                    <a href="http://www.b2b2c.yunmall.68mall.com/shop-list-1-558.html" target="_blank">半裙类</a>
                                                </li>



                                                <li>
                                                    <a href="http://www.b2b2c.yunmall.68mall.com/shop-list-1-583.html" target="_blank">连衣裙类</a>
                                                </li>



                                                <li>
                                                    <a href="http://www.b2b2c.yunmall.68mall.com/shop-list-1-584.html" target="_blank">T恤类</a>
                                                </li>



                                                <li>
                                                    <a href="http://www.b2b2c.yunmall.68mall.com/shop-list-1-585.html" target="_blank">长裤类</a>
                                                </li>



                                                <li>
                                                    <a href="http://www.b2b2c.yunmall.68mall.com/shop-list-1-586.html" target="_blank">短裤类</a>
                                                </li>










































                                                <li>
                                                    <a href="http://www.b2b2c.yunmall.68mall.com/shop-list-1-556.html" target="_blank">查看更多 ></a>
                                                </li>
































                                            </ul>
                                        </dd>
                                    </dl>


                                    <dl>
                                        <dt>
                                            <a href="http://www.b2b2c.yunmall.68mall.com/shop-list-1-557.html" target="_blank">美妆 ></a>
                                        </dt>
                                        <dd>
                                            <ul>


                                                <li>
                                                    <a href="http://www.b2b2c.yunmall.68mall.com/shop-list-1-579.html" target="_blank">香皂手工皂</a>
                                                </li>



                                                <li>
                                                    <a href="http://www.b2b2c.yunmall.68mall.com/shop-list-1-580.html" target="_blank">化妆品类</a>
                                                </li>



                                                <li>
                                                    <a href="http://www.b2b2c.yunmall.68mall.com/shop-list-1-581.html" target="_blank">美妆工具</a>
                                                </li>



                                                <li>
                                                    <a href="http://www.b2b2c.yunmall.68mall.com/shop-list-1-582.html" target="_blank">洗护类</a>
                                                </li>











                                            </ul>
                                        </dd>
                                    </dl>


                                    <dl>
                                        <dt>
                                            <a href="http://www.b2b2c.yunmall.68mall.com/shop-list-1-602.html" target="_blank">服装配饰 ></a>
                                        </dt>
                                        <dd>
                                            <ul>


                                                <li>
                                                    <a href="http://www.b2b2c.yunmall.68mall.com/shop-list-1-603.html" target="_blank">手套</a>
                                                </li>



                                                <li>
                                                    <a href="http://www.b2b2c.yunmall.68mall.com/shop-list-1-604.html" target="_blank">领带</a>
                                                </li>



                                                <li>
                                                    <a href="http://www.b2b2c.yunmall.68mall.com/shop-list-1-605.html" target="_blank">披肩</a>
                                                </li>



                                                <li>
                                                    <a href="http://www.b2b2c.yunmall.68mall.com/shop-list-1-606.html" target="_blank">斗篷</a>
                                                </li>



                                                <li>
                                                    <a href="http://www.b2b2c.yunmall.68mall.com/shop-list-1-607.html" target="_blank">腰封</a>
                                                </li>




































                                                <li>
                                                    <a href="http://www.b2b2c.yunmall.68mall.com/shop-list-1-602.html" target="_blank">查看更多 ></a>
                                                </li>


























                                            </ul>
                                        </dd>
                                    </dl>


                                    <dl>
                                        <dt>
                                            <a href="http://www.b2b2c.yunmall.68mall.com/shop-list-1-622.html" target="_blank">化药生物 ></a>
                                        </dt>
                                        <dd>
                                            <ul>


                                                <li>
                                                    <a href="http://www.b2b2c.yunmall.68mall.com/shop-list-1-623.html" target="_blank">麻黄碱</a>
                                                </li>





                                            </ul>
                                        </dd>
                                    </dl>


                                    <dl>
                                        <dt>
                                            <a href="http://www.b2b2c.yunmall.68mall.com/shop-list-1-679.html" target="_blank">温室配套系统 ></a>
                                        </dt>
                                        <dd>
                                            <ul>


                                                <li>
                                                    <a href="http://www.b2b2c.yunmall.68mall.com/shop-list-1-681.html" target="_blank">测试001</a>
                                                </li>





                                            </ul>
                                        </dd>
                                    </dl>


                                </div>
                            </li>
                            <!-- 获取店铺导航 -->
                        </ul>
                        <ul class="shop-menu-right">



                            <li class="shop-nav">

                                <a href="javascript:void(0)">精品</a>

                            </li>

                            <li class="shop-nav">

                                <a href="javascript:void(0)">温室配套系统</a>

                            </li>

                            <li class="shop-nav">

                                <a href="javascript:void(0)">00</a>

                            </li>

                            <li class="shop-nav">

                                <a href="javascript:void(0)">111</a>

                            </li>

                            <li class="shop-nav">

                                <a href="javascript:void(0)">文章</a>

                            </li>

                            <li class="shop-nav">

                                <a href="javascript:void(0)">百度</a>

                            </li>

                            <li class="shop-nav">

                                <a href="javascript:void(0)">新鲜蔬菜</a>

                            </li>

                            <li class="shop-nav">

                                <a href="javascript:void(0)">国内水果</a>

                            </li>

                            <li class="shop-nav">

                                <a href="javascript:void(0)">进口水果</a>

                            </li>

                            <li class="shop-nav">

                                <a href="javascript:void(0)">新品尝鲜</a>

                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <script type='text/javascript'>
                function search_all() {
                    document.getElementById('search-form').action = "http://www.b2b2c.yunmall.68mall.com/search.html";
                    document.getElementById("search-form").submit();
                }
                function search_me() {
                    document.getElementById('search-form').action = "/shop/1/search.html";
                    document.getElementById("search-form").submit();
                }

                function toggleShop(shop_id, obj) {
                    $.collect.toggleShop(shop_id, function(result) {
                        if (result.code == 0) {
                            $(".collect-count").html(result.collect_count);
                            $(obj).parent().toggleClass("fav-shop-box-select");
                            if ($(obj).html() == "收藏本店") {
                                $(obj).html("取消收藏");
                                $(".collect-tip").html("已收藏");
                            } else {
                                $(obj).html("收藏本店");
                                $(".collect-tip").html("收藏");
                            }

                            if(result.show_collect_count == 1 && result.collect_count > 0){
                                $(".collect-tip").show();
                                $(".collect-count").show();
                            }else{
                                $(".collect-tip").hide();
                                $(".collect-count").hide();
                            }
                        }
                    }, true);
                }
            </script>


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
        <div class="helper-icon" style="right: -40px;">
		<span>
			<i class="fa fa-send-o"></i>
			模板助手
		</span>
        </div>
        <div id="helper_tool" class="helper-wrap" style="right: 0px;">
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
            <a class="floatPanel_setSiteStyle SZY-TOPIC-BACKGROUND-IMAGE">
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
                        <a href="javascript:void(0);" data-key='2'>商品模板</a>
                    </li>



                    <li>
                        <a href="javascript:void(0);" data-key='3'>通用模板</a>
                    </li>









                    <li>
                        <a href="javascript:void(0);" data-key='7'>专题模板</a>
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

                                <li class="drag" id="0" data-code="shop_focus">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/shop_focus.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="广告轮播图">广告轮播图</a>
                                </li>

                                <li class="drag" id="0" data-code="topic_focus">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/topic_focus.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="广告轮播图">广告轮播图</a>
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

                            <ul>

                                <li class="drag" id="0" data-code="goods_floor">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/goods_floor.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="楼层版式一">楼层版式一</a>
                                </li>

                                <li class="drag" id="0" data-code="goods_floor_s2">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/goods_floor_s2.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="楼层版式二">楼层版式二</a>
                                </li>

                                <li class="drag" id="0" data-code="goods_floor_s3">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/goods_floor_s3.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="楼层版式三">楼层版式三</a>
                                </li>

                                <li class="drag" id="0" data-code="goods_floor_s4">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/goods_floor_s4.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="楼层版式四">楼层版式四</a>
                                </li>

                                <li class="drag" id="0" data-code="goods_floor_s5">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/goods_floor_s5.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="楼层版式五">楼层版式五</a>
                                </li>

                                <li class="drag" id="0" data-code="goods_floor_s6">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/goods_floor_s6.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="楼层版式六">楼层版式六</a>
                                </li>

                                <li class="drag" id="0" data-code="goods_floor_s7">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/goods_floor_s7.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="楼层版式七">楼层版式七</a>
                                </li>

                                <li class="drag" id="0" data-code="goods_floor_s8">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/goods_floor_s8.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="楼层版式八">楼层版式八</a>
                                </li>

                                <li class="drag" id="0" data-code="goods_floor_s9">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/goods_floor_s9.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="楼层版式九">楼层版式九</a>
                                </li>

                                <li class="drag" id="0" data-code="shop_floor_s2">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/shop_floor_s2.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="楼层版式十">楼层版式十</a>
                                </li>

                                <li class="drag" id="0" data-code="shop_floor_s1">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/shop_floor_s1.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="楼层版式十一">楼层版式十一</a>
                                </li>

                                <li class="drag" id="0" data-code="market_goods_floor_s1">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/market_goods_floor_s1.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="楼层版式十二">楼层版式十二</a>
                                </li>

                                <li class="drag" id="0" data-code="market_goods_floor_s2">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/market_goods_floor_s2.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="楼层版式十三">楼层版式十三</a>
                                </li>

                                <li class="drag" id="0" data-code="market_goods_floor_s3">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/market_goods_floor_s3.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="楼层版式十四">楼层版式十四</a>
                                </li>

                                <li class="drag" id="0" data-code="market_goods_floor_s4">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/market_goods_floor_s4.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="楼层版式十五">楼层版式十五</a>
                                </li>

                                <li class="drag" id="0" data-code="market_goods_floor_s5">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/market_goods_floor_s5.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="楼层版式十六">楼层版式十六</a>
                                </li>

                                <li class="drag" id="0" data-code="market_goods_floor_s6">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/market_goods_floor_s6.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="楼层版式十七">楼层版式十七</a>
                                </li>

                                <li class="drag" id="0" data-code="goods_promotion">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/goods_promotion.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="促销版式一">促销版式一</a>
                                </li>

                                <li class="drag" id="0" data-code="goods_promotion_s2">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/goods_promotion_s2.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="促销版式二">促销版式二</a>
                                </li>

                            </ul>

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

                                <li class="drag" id="0" data-code="brand_s1">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/brand_s1.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="品牌版式一">品牌版式一</a>
                                </li>

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

                                <li class="drag" id="0" data-code="shop_street">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/shop_street.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="店铺版式一">店铺版式一</a>
                                </li>

                                <li class="drag" id="0" data-code="shop_street_s2">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/shop_street_s2.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="店铺版式二">店铺版式二</a>
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

                            <ul>

                                <li class="drag" id="0" data-code="topic_s1">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/topic_s1.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="专题活动一">专题活动一</a>
                                </li>

                                <li class="drag" id="0" data-code="topic_s2">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/topic_s2.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="专题活动二">专题活动二</a>
                                </li>

                                <li class="drag" id="0" data-code="topic_s3">
                                    <a class="panelModuleIcon" href="javascript:void(0);">
                                        <img src="/assets/d2eace91/images/design/icon/0/topic_s3.png">
                                    </a>
                                    <a class="panelModuleTitle" href="javascript:void(0);" title="专题活动三">专题活动三</a>
                                </li>

                            </ul>

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

                <div class="panelItem-box panelItem-box9">
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

                <div class="panelItem-box panelItem-box10">
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

                <div class="panelItem-box panelItem-box11">
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

                <div class="panelItem-box panelItem-box12">
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

                <div class="panelItem-box panelItem-box13">
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

                <div class="panelItem-box panelItem-box14">
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

                <div class="panelItem-box panelItem-box15">
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

    <style>
        .modal-body {
            padding: 15px;
        }

        .modal-body .btn.btn-primary {
            line-height: 20px;
        }

        .modal-body .simple-form-field .btn {
            line-height: 16px !important;
        }

        .modal-body .btn.btn-sm {
            padding: 2px 9px !important;
        }

        .modal-body .choose-goods-list .btn.btn-xs {
            padding: 1px 4px !important;
            font-size: 11px !important;
        }
    </style>

    <script src="/assets/d2eace91/js/jquery-ui.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/design/tplsetting.js?v=20180813"></script>
    <script type="text/javascript">
        //初始化数据
        var chk_value =[];
        var data = [];
        var data_m = {};
        var page = "topic";
        var NAV_CAT_TPL = "5";
        var topic_id = "{{ $topic_id }}";
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
        /*********外边js start**********/
        $().ready(function() {
            $(".colorPicker").colorpicker();
            $(".panel-collapse .panel-body").mCustomScrollbar();
        });

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
            $('#foldSidebar').addClass('styleDesignArrowDown').removeClass('styleDesignArrowUp');
        }

        $("#show_nav").click(function(){
            var $nav = $("#NAVIGATIONTPL");
            if($nav.css('display')=='none'){
                $nav.slideDown();
                $(this).text('隐藏导航');
            }else{
                $nav.slideUp();
                $(this).text('显示导航');
            }
        });

        $('.SZY-TOPIC-BACKGROUND-IMAGE').click(function(){
            $.loading.start();
            modal = $.modal($(this));
            if (modal) {
                modal.show();
                $.loading.stop();
            } else {
                modal = $.modal({
                    title: '活动背景设置',
                    trigger: $(this),
                    ajax: {
                        url: '/topic/topic/bg-setting',
                        data: {
                            topic_id : topic_id
                        }
                    },

                });
            }
        });
    </script>

    <script type="text/javascript">
        $(function(){
            updateEndTime();
        });
        //倒计时函数
        function updateEndTime()
        {
            var date = new Date();
            var time = date.getTime()+8*60*60*1000;

            $(".time-remain").each(function(i){

                var endDate =this.getAttribute("end_time"); //结束时间字符串

                //转换为时间日期类型
                var endTime  = new Date(endDate).getTime()
                var lag = (endTime - time) / 1000; //当前时间和结束时间之间的秒数
                if(lag > 0)
                {
                    var second = Math.floor(lag % 60);
                    var minite = Math.floor((lag / 60) % 60);
                    var hour = Math.floor((lag / 3600) % 24);
                    var day = Math.floor((lag / 3600) / 24);

                    $(this).find('span').find("#d").html(day);
                    $(this).find('span').find("#h").html(hour);
                    $(this).find('span').find("#m").html(minite);
                    $(this).find('span').find("#s").html(second);
                }
                else
                    $(this).find('span').html("活动已经结束啦！");
            });
            setTimeout("updateEndTime()",1000);
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".panelItemContent ").mCustomScrollbar();
            /*左侧浮动切换*/
            /*鼠标滑过切换tab*/
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
        });
    </script>

@stop