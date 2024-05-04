
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]-->
<html xmlns="http://www.w3.org/1999/xhtml">
<html lang="zh-CN">
<head>
    <title>{{ sysconf('site_name') }}</title>
    <!-- 头部元数据 -->
    <meta name="csrf-param" content="_csrf">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="Keywords" content="{{ sysconf('site_name') }}" />
    <meta name="Description" content="" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
    <meta name="format-detection" content="telephone=no">
    <!-- 网站头像 -->
    <link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
    <!-- 网站头像 -->
    <link rel="stylesheet" href="/assets/d2eace91/iconfont/iconfont.css?v=1.3"/>
    <link rel="stylesheet" href="/css/common.css?v=1.3"/>
    <!--整站改色 _start-->
    <link rel="stylesheet" href="/css/color-style.css?v=1.3"/>
    <!--整站改色 _end-->
    <script src="/assets/d2eace91/js/jquery.js?v=1.3"></script>
    <script src="/assets/d2eace91/js/jquery.cookie.js?v=1.3"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=1.3"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=1.3"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=1.3"></script>
    <script src="/js/common.js?v=1.3"></script>
    <!-- 图片缓载js -->
    <script src="/assets/d2eace91/js/jquery.lazyload.js?v=1.3"></script>
    <script type="text/javascript">
        $().ready(function() {


        })
    </script>

    {{-- 国家默哀日期 --}}
    {!! $national_memorial_day_html ?? '' !!}
</head>
<body class="pace-done">
<div id="bg" class="bg" style="display: none;"></div>

<!-- 站点头部 -->

<!-- 判断url链接 -->



<!-- 引入头部文件 -->
<!-- 站点选择 -->
<div class="header-top">
    <div class="header-box">






        <!-- 站点 -->
        <!--站点 start-->
        <div class="SZY-SUBSITE">

        </div>
        <!--站点 end-->


        <!-- 登录信息 -->
        <font id="login-info" class="login-info SZY-USER-NOT-LOGIN">
            <!--<em>欢迎来到测试站点! </em>-->
            <a class="login color" href="/login.html" target="_top">请登录</a>
            <a class="register" href="/register.html" target="_top">免费注册</a>
        </font>
        <font id="login-info" class="login-info SZY-USER-ALREADY-LOGIN" style="display: none;">
            <em>
                <a href="/user.html" target="_blank" class="color SZY-USER-NAME"></a>
                <!--欢迎您回来!-->
            </em>
            <a href="/site/logout.html" data-method="post">退出</a>
        </font>

        <ul>
            <li>
                <a class="menu-hd home" href="/" target="_top">
                    <i class="iconfont color">&#xe6a3;</i>
                    商城首页
                </a>
            </li>
            <li class="menu-item">
                <div class="menu">
                    <a class="menu-hd myinfo" href="/user.html" target="_blank">
                        <i class="iconfont color">&#xe6a5;</i>
                        我的商城
                        <b></b>
                    </a>
                    <div id="menu-2" class="menu-bd">
                        <span class="menu-bd-mask"></span>
                        <div class="menu-bd-panel">
                            <a href="/user/order.html" target="_blank">已买到的宝贝</a>
                            <a href="/user/address.html" target="_blank">我的地址管理</a>
                            <a href="/user/collect/goods.html" target="_blank">我收藏的宝贝</a>
                            <a href="/user/collect/shop.html" target="_blank">我收藏的店铺</a>
                        </div>
                    </div>
                </div>
            </li>
            <li class="menu-item cartbox">
                <div class="menu">
                    <a class="menu-hd cart" href="/cart.html" target="_top">
                        <i class="iconfont color">&#xe6a8;</i>
                        购物车
                        <span class="SZY-CART-COUNT">0</span>
                        <b></b>
                    </a>
                    <div id="menu-4" class="menu-bd cart-box-main">
                        <span class="menu-bd-mask"></span>
                        <div class="dropdown-layer">
                            <div class="spacer"></div>
                            <div class="dropdown-layer-con cartbox-goods-list">


                                <!-- 正在加载 -->
                                <div class="cart-type">
                                    <i class="cart-type-icon"></i>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <a class="menu-hd" href="/" target="_blank">卖家中心</a>
            </li>

            <li class="menu-item">
                <div class="menu">
                    <a class="menu-hd we-chat" href="javascript:;" target="_top">
                        <i class="iconfont color">&#xe6a4;</i>
                        关注商城
                        <b></b>
                    </a>
                    <div id="menu-5" class="menu-bd we-chat-qrcode">
                        <span class="menu-bd-mask"></span>
                        <a target="_top">
                            <img src="{{ get_image_url(sysconf('mall_wx_qrcode')) }}" alt="官方微信" />
                        </a>
                        <p class="font-14">关注官方微信</p>
                    </div>
                </div>
            </li>


            <li class="menu-item">
                <div class="menu">
                    <a class="menu-hd mobile" href="javascript:;" target="_top">
                        <i class="iconfont color">&#xe60b;</i>
                        手机版
                        <b></b>
                    </a>
                    <div id="menu-6" class="menu-bd qrcode">
                        <span class="menu-bd-mask"></span>
                        <a target="_top">
                            <img src="{{ get_image_url(sysconf('mall_wx_qrcode')) }}" alt="手机客户端" />
                        </a>
                        <p>手机客户端</p>
                    </div>
                </div>
            </li>


            <li class="menu-item">
                <div class="menu">
                    <a href="javascript:;" class="menu-hd site-nav">
                        商家支持
                        <b></b>
                    </a>
                    <div id="menu-7" class="menu-bd site-nav-main">
                        <span class="menu-bd-mask"></span>
                        <div class="menu-bd-panel">
                            <div class="site-nav-con">

                                <a href="/" target="_blank"  title="新手帮助">新手帮助</a>

                                <a href="/" target="_blank"  title="入驻说明">入驻说明</a>

                                <a href="/shop/4" target="_blank"  title="抢红包">抢红包</a>

                            </div>
                        </div>
                    </div>
                </div>
            </li>

        </ul>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $(".SZY-SEARCH-BOX-TOP .SZY-SEARCH-BOX-SUBMIT-TOP").click(function() {
            if ($(".search-li-top.curr").attr('num') == 0) {
                var keyword_obj = $(this).parents(".SZY-SEARCH-BOX-TOP").find(".SZY-SEARCH-BOX-KEYWORD");

                var keywords = $(keyword_obj).val();
                if ($.trim(keywords).length == 0 || $.trim(keywords) == "请输入关键词") {
                    keywords = $(keyword_obj).data("searchwords");
                }
                $(keyword_obj).val(keywords);
            }
            $(this).parents(".SZY-SEARCH-BOX-TOP").find(".SZY-SEARCH-BOX-FORM").submit();
        });
    });
</script>

<div class="header">
    <div class="w1210">
        <div class="logo-info">
            <a href="/" class="logo">

                <img src="{{ get_image_url(sysconf('mall_logo')) }}" />

            </a>




        </div>
        <div class="search SZY-SEARCH-BOX">
            <form class="search-form SZY-SEARCH-BOX-FORM" method="get" action="/search.html">
                <div class="search-info">
                    <div class="search-type-box">
                        <ul class="search-type" style="display: none;">
                            <li class="search-li curr" num="0">宝贝</li>
                            <li class="search-li" num="1">店铺</li>
                        </ul>
                        <i></i>
                    </div>
                    <div class="search-box">
                        <div class="search-box-con">
                            <input type="text" class="keyword search-box-input SZY-SEARCH-BOX-KEYWORD" name="keyword" tabindex="9" autocomplete="off" data-searchwords="" placeholder="" value="" />
                        </div>
                    </div>
                    <input type='hidden' id="searchtype" name='type' value="0" class="searchtype" />
                    <input type="button" id="btn_search_box_submit" value="搜索" class="button bg-color btn_search_box_submit SZY-SEARCH-BOX-SUBMIT" />
                </div>
                <!---热门搜索热搜词显示--->
                <div class="search-results hide SZY-SEARCH-BOX-HELPER">
                    <ul class="history-results SZY-SEARCH-RECORDS">
                        <li class="title">
                            <span>最近搜索</span>
                            <a href="javascript:void(0);" class="clear-history clear">
                                <i></i>
                                清空
                            </a>
                        </li>
                        <!--
                        <li class="active rec_over" id="索引">
                            <span>
                                <a href="/search.html?keyword=关键词" title="关键词">关键词</a>
                                <i onclick="search_box_remove('索引')"></i>
                            </span>
                        </li>
                        -->
                    </ul>
                    <ul class="rec-results SZY-HOT-SEARCH">
                        <li class="title">
                            <span>正在热搜中</span>
                            <i class="close"></i>
                        </li>
                        <!--
                        <li>
                            <a target="_blank" href="" title=""></a>
                        </li>
                         -->
                    </ul>
                </div>
                <script type="text/javascript">
                    $(document).ready(function() {
                        // 搜索框提示显示
                        $('.SZY-SEARCH-BOX .SZY-SEARCH-BOX-KEYWORD').focus(function() {
                            $(".SZY-SEARCH-BOX .SZY-SEARCH-BOX-HELPER").show();
                        });
                        // 搜索框提示隐藏
                        $(".SZY-SEARCH-BOX-HELPER .close").on('click', function() {
                            $(".SZY-SEARCH-BOX .SZY-SEARCH-BOX-HELPER").hide();
                        });
                        // 清除记录
                        $(".SZY-SEARCH-BOX-HELPER .clear").click(function() {
                            var url = '/search/clear-record.html';
                            $.post(url, {}, function(result) {
                                if (result.code == 0) {
                                    $(".history-results .active").empty();
                                } else {
                                    $.msg(result.message);
                                }
                            }, 'json');
                        });
                    });
                    function search_box_remove(key) {
                        console.info(key);
                        var url = '/search/delete-record.html';
                        $.post(url, {
                            data: key
                        }, function(result) {
                            if (result.code == 0) {
                                $("#search_record_" + key).remove();
                            } else {
                                $.msg(result.message);
                            }
                        }, 'json');
                    }
                    $(document).on("click", function(e) {
                        var target = $(e.target);
                        if (target.closest(".SZY-SEARCH-BOX").length == 0) {
                            $('.SZY-SEARCH-BOX-HELPER').hide();
                        }
                    })
                </script>
            </form>
            <ul class="hot-query SZY-DEFAULT-SEARCH">
            </ul>
        </div>

    </div>
</div>
<script type="text/javascript">
    //解决因为缓存导致获取分类ID不正确问题，需在ready之前执行
    $(".SZY-DEFAULT-SEARCH").data("cat_id", "");
    $().ready(function() {
        $(".SZY-SEARCH-BOX-KEYWORD").val("");
        $(".SZY-SEARCH-BOX-KEYWORD").data("search_type", "");
        //

        $(".SZY-SEARCH-BOX .SZY-SEARCH-BOX-SUBMIT").click(function() {
            if ($(".search-li.curr").attr('num') == 0) {
                var keyword_obj = $(this).parents(".SZY-SEARCH-BOX").find(".SZY-SEARCH-BOX-KEYWORD");
                var keywords = $(keyword_obj).val();
                if ($.trim(keywords).length == 0 || $.trim(keywords) == "请输入要搜索的关键词") {
                    keywords = $(keyword_obj).data("searchwords");
                }
                $(keyword_obj).val(keywords);
            }
            $(this).parents(".SZY-SEARCH-BOX").find(".SZY-SEARCH-BOX-FORM").submit();
        });
    });
</script>



<!-- 站点导航 -->

<!-- 内容 -->

<link href="/css/error.css" rel="stylesheet" type="text/css" />
<div class="error-content">
    <div class="w990">
        <div class="error">
            {{--<div class="error-l"></div>--}}
            <div class="error-r">
                <div class="error-title">
                    <p class="color" style="text-align: left; font-size: 24px;">系统提示</p>
                </div>
                <p class="error-line"></p>
                <div class="error-box">

{{--					@if($exception->getStatusCode() == 430)--}}
{{--                    	<p class="color" style="text-align: left; font-size: 16px;">@if($exception->getMessage() != ''){!! $exception->getMessage() !!}@else页面未找到。@endif</p>--}}
{{--					@else--}}
{{--						<p class="color" style="text-align: left; font-size: 16px;">@if($exception->getMessage() != '' && env('APP_DEBUG') === true){!! $exception->getMessage() !!}@else页面未找到。@endif</p>--}}
{{--					@endif--}}
					<p class="color" style="text-align: left; font-size: 16px;">@if($exception->getMessage() != '' && env('APP_DEBUG') === true){!! $exception->getMessage() !!}@else页面未找到。@endif</p>

                    <p class="error-btn">
                        您可以

                        <a href="@if(null !== url()->previous()){{ url()->previous() }}@else/@endif" class="color">返回上一页</a>

                        或者
                        <a href="/" class="color">返回首页</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- 站点底部-->


<!-- 底部 _start-->



<div class="site-footer">








    <div class="footer-related">














        <div class="footer-info">
            <div class="info-text">
                <!-- 底部导航 -->
                <p class="nav-bottom">


                    <a href="/company" target="_blank">公司简介</a>


                    <em>|</em>

                    <a href="/help/4.html" target="_blank">联系我们</a>


                    <em>|</em>

                    <a href="/agent.html" target="_blank">代理合作</a>


                    <em>|</em>

                    <a href="/help/2.html" target="_blank">帮助中心</a>


                    <em>|</em>

                    <a href="/shop/apply.html" target="_blank">商家入驻</a>


                    <em>|</em>

                    <a href="/company" target="_blank">联系我们</a>

                </p>
                <p>
                    {{--版权信息 备案号--}}
                    {!! sysconf('site_copyright') !!}
                    <a href="http://www.miibeian.gov.cn/" target="_blank">{{ sysconf('site_icp') }}</a>
                </p>
                <p class="company-info" style="display: none;">公司地址xxx</p>
                <p class="qualified">

                    <a href="/" target="_blank">
                        <img src="/oss/images/backend/1/images/2016/11/10/14787661020127.png" alt="" />
                    </a>

                    <a href="/" target="_blank">
                        <img src="/oss/images/backend/1/images/2016/11/10/14787669819785.png" alt="" />
                    </a>

                </p>
            </div>

            <div class="info-text"></div>

        </div>

    </div>
</div>
<!-- 底部 _end-->

<script src="/js/jquery.fly.min.js?v=1.3"></script>
<script src="/assets/d2eace91/js/szy.cart.js?v=1.3"></script>
<!--[if lte IE 9]>
<script src="/js/requestAnimationFrame.js?v=1.3"></script>
<![endif]-->
<script type="text/javascript">
    $().ready(function(){
        // 缓载图片
        $.imgloading.loading();
    });
</script>

<script id="yii_debug_toolbar" type="text">
	<![CDATA[YII-BLOCK-BODY-END]]>
</script>
<script type="text/javascript">
    $().ready(function(){
        $("body").append($.parseHTML($("#yii_debug_toolbar").html(), true));
    });
</script>

</body>
</html>
