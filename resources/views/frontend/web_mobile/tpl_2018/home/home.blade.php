@extends('layouts.base')

{{--header_css--}}
@section('header_css')

@stop

{{--header_js--}}
@section('header_js')
    {{--首页内容--}}
    <script src="/assets/d2eace91/js/jquery.js?v=20180528"></script>
    <script src="/mobile/js/common.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/jquery.lazyload.js?v=20180528"></script>
    <!-- JS -->
    <script src="/assets/d2eace91/js/jquery.cookie.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=20180528"></script>

    <!-- 飞入购物车 -->
    <script src="/mobile/js/index.js?v=20180813"></script>
    <script src="/mobile/js/swiper.jquery.min.js?v=20180813"></script>
    <script src="/mobile/js/jquery.fly.min.js?v=20180813"></script>
    <script src="/mobile/js/swiper.jquery.min.js?v=20180528"></script>
    <!-- GPS获取坐标 -->
    <script src="http://webapi.amap.com/maps?v=1.3&key={{ sysconf('amap_web_key') }}"></script>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script src="/assets/d2eace91/js/geolocation/amap.js?v=20180528"></script>
    <script type="text/javascript">
        function geolocation() {
            if (!sessionStorage.geolocation) {
                setTimeout(function() {
                    $.geolocation();
                }, 500);
            }
        }
        geolocation();
    </script>
@stop



@section('content')

    {{--首页内容--}}
    <link rel="stylesheet" href="/mobile/css/index.css?v=20180428"/>
    <link rel="stylesheet" href="/mobile/css/swiper.min.css?v=20180428"/>
    <div class="app-download">
        <div class="app-download-tip-box">
            <div class="app-download-tip">
                <a href="javascript:void(0);" class="colse-download-tip">
                    <i></i>
                </a>
                <div class="tip-info">

                    {{--<img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/system/config/mobile_setting_index/m_app_icon_0.jpg">--}}
                    <img src="{{ get_image_url(sysconf('m_app_icon')) }}">

                    <div class="tip-text">
                        <h4>享受更加流畅的商城体验</h4>
                        <p>赶快下载乐融沃B2B2C商城演示站APP</p>
                    </div>
                </div>
                <a class="download-btn" href="#" data-ios="http://www.laravelvip.com/app_down/ios-down.html" data-android="http://www.laravelvip.com/app_down/android-down.html">立即下载</a>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        if (sessionStorage.colse_app_download == '1') {
            $('.app-download').remove();
        } else {
            var pla = ismobile(1);
            var href_android = $('.download-btn').data('android');
            var href_ios = $('.download-btn').data('ios');
            //苹果
            if (pla == '0') {
                if (href_ios == '') {
                    $('.app-download').remove();
                } else {
                    $('.download-btn').attr('href', href_ios);
                }
            } else {
                if (href_android == '') {
                    $('.app-download').remove();
                } else {
                    $('.download-btn').attr('href', href_android);
                }
            }
        }
        function ismobile(test) {
            var u = navigator.userAgent, app = navigator.appVersion;
            if (/AppleWebKit.*Mobile/i.test(navigator.userAgent) || (/MIDP|SymbianOS|NOKIA|SAMSUNG|LG|NEC|TCL|Alcatel|BIRD|DBTEL|Dopod|PHILIPS|HAIER|LENOVO|MOT-|Nokia|SonyEricsson|SIE-|Amoi|ZTE/.test(navigator.userAgent))) {
                if (window.location.href.indexOf("?mobile") < 0) {
                    try {
                        if (/iPhone|mac|iPod|iPad/i.test(navigator.userAgent)) {
                            return '0';
                        } else {
                            return '1';
                        }
                    } catch (e) {
                    }
                }
            } else if (u.indexOf('iPad') > -1) {
                return '0';
            } else {
                return '1';
            }
        };
    </script>
    <header class="header-con header-con1">
        <div class="header">
            <div class="header-content">

                <div class="qrcode SZY-SCANQRCODE-LEFT"><a href="/category.html"><em class="top-left"></em><span class="bottom-nav">分类</span></a></div>
                <div class="box-search current">
                    <a class="react" href="javascript:void(0)">
                        <i class="icon-search iconfont"></i>
                        <span class="single-line">搜索商品/店铺</span>
                    </a>
                </div>
                <div class="nav-wap-right">
                    <a href="/user/message/internal.html">
                        <em class="top-right">
                            <i class="message-num SZY-INTERNAL-COUNT">0</i>
                        </em>
                        <span class="bottom-nav">消息</span>
                    </a>
                </div>


            </div>
        </div>
        <div style="height: 50px; line-height: 50px;" id="bottom_div"></div>
    </header>
    <!--搜索内容start-->
    <section id="search_content">
        <div class="search-header">
            <div class="search-left">
                <a href="javascript:void(0)" class="sb-back" title="返回"></a>
            </div>
            <div class="search-middle">
                <div class="search-info">
                    <div class="search-type">
                        <div class="search-type-txt">商品</div>
                        <div class="search-type-info">
                            <ul class="search-type-ul">
                                <li id="select_goods">
                                    <i class="iconfont">&#xe63f;</i>
                                    商品
                                </li>
                                <li id="select_shop">
                                    <i class="iconfont">&#xe601;</i>
                                    店铺
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="text-box">
                        <form id="headerSearchForm" method="get" name="" action="/search.html" onSubmit="">
                            <input type='hidden' name='type' id="searchtype" value="">
                            <input type="text" class="text" id="keyword" name="keyword" tabindex="9" autocomplete="off" data-searchwords="乐融沃" data-placeholder="乐融沃" placeholder="乐融沃" value="">
                            <a href="javascript:void(0)" class="submit"></a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="search-right">
                <a href="javascript:void(0)" class="clear_input submit" style="display: block;">搜索</a>
            </div>
        </div>
        <div class="search-con">
            <div id="search_goods">
                <section class="hot-search">
                    <h3>
                        历史记录
                        <i class="delete-btn iconfont" id="clear">&#xe61b;</i>
                    </h3>
                    <ul class="history-results SZY-SEARCH-RECORD">
                    </ul>
                </section>
            </div>

            <!---热门搜索热搜词显示--->
            <section class="recently-search">
                <h3>热门搜索</h3>

                <ul>

                    <li>
                        <a href="search.html?keyword=乐融沃" title="乐融沃">乐融沃</a>
                    </li>

                </ul>

            </section>

        </div>
        <a class="colse-search-btn" href="javascript:void(0)"></a>
    </section>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".submit").click(function() {
                if ($("#searchtype").val() == '') {
                    var keywords = $("#headerSearchForm").find("#keyword").val();
                    if ($.trim(keywords).length == 0 || $.trim(keywords) == "请输入关键词") {
                        keywords = $("#headerSearchForm").find("#keyword").data("searchwords");
                    }
                    $("#headerSearchForm").find("#keyword").val(keywords);
                } else {
                    var keywords = $("#headerSearchForm").find("#keyword").val();
                    if ($.trim(keywords).length == 0 || $.trim(keywords) == "请输入关键词") {
                        $("#headerSearchForm").find("#keyword").val('');
                    }
                }
                $("#headerSearchForm").submit();
            });

            //搜索记录
            $.get('/index/information/search-record', function(result) {
                var sr = '';
                $.each($(result.data), function(index, val) {
                    if (val != '') {
                        sr += '<li><a href="/search?keyword=' + val + '">' + val + '</a></li>';
                    }
                });
                if (sr != '') {
                    $('#search_goods').show();
                    $('.SZY-SEARCH-RECORD').html(sr);
                } else {
                    $('#search_goods').hide();
                }
            }, 'json');

            //清空
            $('#clear').click(function() {
                var url = '/search/clear-record.html';
                $.confirm("您确认删除所有的历史记录？", function() {
                    $.post(url, {}, function(result) {
                        if (result.code == 0) {
                            $(".history-results").empty();
                            $('#search_goods').hide();
                        }
                    }, 'json');
                });
            });

            $('.search-type-txt').click(function() {
                $('.search-type-info').toggle();
            });
            $('#select_goods').on('click', function() {
                if ($('#searchtype').val() != '') {
                    $("input[name='keyword']").val('');
                    $("input[name='keyword']").attr('placeholder', $("input[name='keyword']").data('placeholder'));
                }
                $('#searchtype').val('');
                $('.search-type-txt').html("商品");
                $('.search-type-info').hide();
                $("input[name='keyword']").focus();
            });
            $('#select_shop').on('click', function() {
                if ($('#searchtype').val() != '1') {
                    $("input[name='keyword']").val('');
                    $("input[name='keyword']").attr('placeholder', '');
                }
                $('#searchtype').val('1');
                $('.search-type-txt').html("店铺");
                $('.search-type-info').hide();
                $("input[name='keyword']").focus();
            });
        });
    </script>
    <!--搜索内容end-->
    <script type="text/javascript">
        // 头部导航
        if ($(window).scrollTop() > 100) {
            $(".header-con .header,.header-con .header .header-content .box-search, .app-download-tip-box").addClass("current");
        } else {
            $(".header-con .header,.app-download-tip-box").removeClass("current");
        }
        $(window).scroll(function() {
            if ($(window).scrollTop() > 100) {
                $(".header-con .header,.header-con .header .header-content .box-search, .app-download-tip-box").addClass("current");
            } else {
                $(".header-con .header,.app-download-tip-box").removeClass("current");
            }
        });

        $('.box-search').click(function() {
            $('#search_content').addClass("show");
            $('#index_content').hide();
            $('.header').hide();
            $("input[name='keyword']").focus();
        });
        $('.sb-back').click(function() {
            $('#search_content').removeClass('show');
            $('#index_content').show();
            $('.header').show();
            $("input[name='keyword']").blur();
        });
        $('.colse-search-btn').click(function() {
            $('#search_content').removeClass('show');
            $('#index_content').show();
            $('.header').show();
            $("input[name='keyword']").blur();
        });

        if(window.__wxjs_environment === 'miniprogram'){
            $('.service-online').hide();
        }
    </script>
    <!-- 内容 -->
    <div id="index_content"><!-- 微商城首页模板文件 -->
        <div class="template-one">
            <!--模块内容-->
            <!-- #tpl_region_start -->

            {!! $tplHtml !!}

            <!-- #tpl_region_end -->
        </div>



    </div>

    <a href="javascript:void(0);" class="back-to-top gotop hide"><img src="/mobile/images/topup.png"></a>
    <script type="text/javascript">
        $().ready(function(){
            //首先将#back-to-top隐藏
            //$("#back-to-top").addClass('hide');
            //当滚动条的位置处于距顶部1000像素以下时，跳转链接出现，否则消失
            $(function ()
            {
                $(window).scroll(function()
                {
                    if ($(window).scrollTop()>600)
                    {
                        $('body').find(".back-to-top").removeClass('hide');
                    }
                    else
                    {
                        $('body').find(".back-to-top").addClass('hide');
                    }
                });
                //当点击跳转链接后，回到页面顶部位置
                $(".back-to-top").click(function()
                {
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


    {{--引入底部菜单--}}
    @include('frontend.web_mobile.modules.library.site_footer_menu')





    <!-- 扫码设置 -->
    <!-- 如果微信浏览器开启扫码功能 -->
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script type="text/javascript">
        //获取微信配置信息
        var url = location.href.split('#')[0];
        $.get('/index/information/is-weixin.html', function(result) {
            if (result.code == 0) {
                if ($('.SZY-SCANQRCODE-LEFT')) {
                    $('.SZY-SCANQRCODE-LEFT').html('<a href="javascript:void(0)" class="SZY-SCAN-QR-CODE"><em class="top-icon"></em><span class="bottom-nav">扫码</span></a>');
                }
                if ($('.SZY-SCANQRCODE-RIGHT')) {
                    $('.SZY-SCANQRCODE-RIGHT').html('<a href="javascript:void(0)" class="SZY-SCAN-QR-CODE"><em class="top-icon"></em><span class="bottom-nav">扫码</span></a>');
                }

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
                                    "onMenuShareTimeline", "onMenuShareAppMessage", "scanQRCode"]
                            });

                            wx.ready(function() {
                                // 分享给朋友
                                wx.onMenuShareAppMessage({
                                    title: '啊啊啊', // 标题
                                    desc: 'sad撒多按时', // 描述
                                    imgUrl: '{{ get_image_url(sysconf('seo_index_image')) }}', // 分享的图标
                                    link: url,
                                    fail: function(res) {
                                        alert(JSON.stringify(res));
                                    }
                                });

                                // 分享到朋友圈
                                wx.onMenuShareTimeline({
                                    title: '啊啊啊', // 标题
                                    desc: 'sad撒多按时', // 描述
                                    imgUrl: '{{ get_image_url(sysconf('seo_index_image')) }}', // 分享的图标
                                    link: url,
                                    fail: function(res) {
                                        alert(JSON.stringify(res));
                                    }
                                });
                                // 在这里调用 API
                                $(".SZY-SCAN-QR-CODE").click(function() {
                                    if (result.errCode != 0) {
                                        $.msg("扫码功能需要去后台微信设置里填写正确的信息");
                                        return false;
                                    }
                                    wx.scanQRCode({
                                        needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
                                        scanType: ["qrCode", "barCode"], // 可以指定扫二维码还是一维码，默认二者都有
                                        success: function(res) {
                                            //alert(JSON.stringify(res));
                                            //过滤结果,非本站的二维码不可以扫描
                                            $.get('/index/information/go', {
                                                url: res.resultStr
                                            }, function(result) {
                                                if (result.code == 0) {
                                                    $.go(result.data.url);
                                                } else {
                                                    $.msg(result.message);
                                                }
                                            }, 'json');
                                        }
                                    });
                                });

                                $(".SZY-SCAN-PAYMENT-CODE").click(function() {
                                    if (result.errCode != 0) {
                                        $.msg("扫码功能需要去后台微信设置里填写正确的信息");
                                        return false;
                                    }
                                    wx.scanQRCode({
                                        needResult: 1, // 默认为0，扫描结果由微信处理，1则直接返回扫描结果，
                                        scanType: ["qrCode", "barCode"], // 可以指定扫二维码还是一维码，默认二者都有
                                        success: function(res) {
                                            // 获取结果
                                            $.loading.start();
                                            $.get('/user/scan-code/scan.html', {
                                                code: res.resultStr,
                                            }, function(result) {
                                                if (result.code == 0) {
                                                    $.loading.stop();
                                                    $.go('/user/scan-code/index.html?payment_iden=' + result.data.payment_iden);
                                                } else {
                                                    $.msg(result.message, {
                                                        time: 2000
                                                    });
                                                }
                                            }, 'json');

                                        }
                                    });

                                });
                            });
                        }
                    }
                });

            } else {

                if ($('.SZY-SCANQRCODE-LEFT')) {
                    $('.SZY-SCANQRCODE-LEFT').html('<a href="/category.html"><em class="top-left"></em><span class="bottom-nav">分类</span></a>');
                }
                if ($('.SZY-SCANQRCODE-RIGHT')) {
                    $('.SZY-SCANQRCODE-RIGHT').html('');
                }
                $(".SZY-SCAN-QR-CODE").click(function() {
                    $.msg('请在微信下使用扫码');
                });
            }
        }, 'json');
    </script>

    <!-- 第三方流量统计 -->
    <div style="display: none;">
        {{--第三方统计代码--}}
        {!! sysconf('stats_code_wap') !!}
    </div>
    <div class="weixin-box" style="display:none">
        <div class="weixin-tip-box">
            <div class="weixin-tip">
                <div class="tip-info">

                    <img src="http://68yun.oss-cn-beijing.aliyuncs.com/images/15164/system/config/mobile_setting_index/m_follow_wechat_icon_0.jpg">

                    <div class="tip-text">
                        <h4>同城</h4>
                        <p>赶快关注辽宁微信公众号</p>
                    </div>
                </div>
                <a class="attention-btn" href="javascript:void(0);">立即关注</a>
            </div>
        </div>
    </div>
    <div class="fixed-weixin-layer">
        <div class="fixed-weixin-con">
            <div class="fixed-weixin-tip">
                <p>长按二维码，关注公众号</p>
                <div class="qr-box ub">

                    <img src="{{ get_image_url(sysconf('mall_wx_qrcode')) }}">

                    <div class="finger-print">
                        <div class="scan-line"></div>
                    </div>
                </div>
            </div>
            <div class="other-way">
                <h2 class="other-way-title">无法识别二维码</h2>
                <ul>
                    <li>1、打开微信，点击添加朋友</li>
                    <li>2、点击“公众号”</li>
                    <li>3、搜索公众号：辽宁</li>
                    <li>4、点击”关注“，完成</li>
                </ul>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('body').on('click', '.attention-btn', function() {
            $('.fixed-weixin-layer').show();
        });
    </script>
    <script type="text/javascript">
        $.get('/index/information/is-follow.html', function(result) {
            if (result.is_show == 1) {
                $('.weixin-box').show();
            } else {
                $('.weixin-box').hide();
            }
        }, 'json');
    </script>


    <script type="text/javascript">
        $().ready(function() {
            // 缓载图片
            $.imgloading.loading();
        });
        //图片预加载
        document.onreadystatechange = function() {
            if (document.readyState == "complete") {
                $.imgloading.setting({
                    threshold: 1000
                });
                $.imgloading.loading();
            }
        }
    </script>
    <!-- 底部 _end-->
    <!-- 消息提醒 -->

    <!-- 消息提醒 -->
    <script src="/assets/d2eace91/js/message/message.js?v=20180528"></script>
    <script src="/assets/d2eace91/js/message/messageWS.js?v=20180528"></script>
    <script type="text/javascript">
        $.get('/site/get-session-id', {}, function(result) {
            WS_AddOrder({
                user_id: result.data,
                url: "{{ get_ws_url('7272') }}",
                type: "new_order_remind_set"
            });
        }, 'JSON');

        function newOrderRemind(ob) {
            if (ob != null && ob != 'undefined') {
                var message = '<div class="bubble-container show"><div class="bubble-item"><div class="bubble-image" style="background-image: url(' + ob.headimg + ')"></div><div class="bubble-text">' + ob.user_name + '在1秒前下单了</div></div></div>';
                $('body').append(message);
                setTimeout(function() {
                    $('body').find('.bubble-container').remove();
                }, 5000);
            }
        }
        var second = 5000;
        // 模拟新订单提醒
        $.get('/site/get-new-order-list.html', {}, function(result) {
            if (result.code == 0) {
                remind(result);
            }
        }, 'JSON');

        function remind(result) {
            var count = result.count;
            var num = randomNum(0, count - 1);
            var ob = result.data[num];
            setTimeout(function() {
                newOrderRemind(ob);
                remind(result);

            }, second);

            second = randomNum(5000, 30000)
        }

        function randomNum(minNum, maxNum) {
            switch (arguments.length) {
                case 1:
                    return parseInt(Math.random() * minNum + 1, 10);
                    break;
                case 2:
                    return parseInt(Math.random() * (maxNum - minNum + 1) + minNum, 10);
                    break;
                default:
                    return 0;
                    break;
            }
        }
    </script>

@stop