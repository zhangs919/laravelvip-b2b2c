{{--@extends('layouts.base')--}}

{{--header_css--}}
{{--@section('header_css')--}}
{{--    <link href="/css/shop_street.css?v=2" rel="stylesheet">--}}
{{--@stop--}}

{{--header_js--}}
{{--@section('header_js')--}}

{{--@stop--}}

{{--@section('content')--}}
{{--    <!-- 内容 -->--}}
{{--    <div id="index_content">--}}
{{--        <div class="shop-street-top">--}}
{{--            <div class="header-search-con">--}}
{{--                <div class="header-search-left">--}}
{{--                    <a href="javascript:history.back(-1)" class="sb-back  iconfont icon-fanhui1" title="返回"></a>--}}
{{--                </div>--}}
{{--                <div class="header-search-middle">--}}
{{--                    <div class="search-box">--}}
{{--                        <form method="GET" action="" onsubmit="return false;">--}}
{{--                            <input name="name" id="shop_name" type="search" placeholder="请输入店铺名称" class="text" value="">--}}
{{--                            <input type="submit" class="submit" id="shop_search" value=''>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="header-search-right">--}}
{{--                    <!-- 控制展示更多按钮 -->--}}
{{--                    <aside class="show-menu-btn">--}}
{{--                        <div id="show_more" class="show-menu iconfont icon-gengduo3"></div>--}}
{{--                    </aside>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="shop-nav">--}}
{{--                <a href="javascript:void(0)" class="nav-item invalid">全部分类</a>--}}
{{--                <a href="javascript:void(0)" class="nav-item invalid">附近商家</a>--}}
{{--                <a href="javascript:void(0)" class="nav-item invalid">智能排序</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="classify-content shop-submenu" style="display: none">--}}
{{--            <div class="shop-submenu-left">--}}
{{--                <ul class="SZY-SHOP-STREET-CLS">--}}
{{--                    <li data-val='0' data-text='全部分类'  class="current">--}}
{{--                        <span class="submenu-name">全部</span>--}}
{{--                    </li>--}}
{{--                    @foreach($format_class_list as $item)--}}
{{--                    <li data-val='{{ $item['cls_id'] }}' >--}}
{{--                        <span class="submenu-name">{{ $item['cls_name'] }}</span>--}}
{{--                    </li>--}}
{{--                    @endforeach--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--            <div class="shop-submenu-right">--}}
{{--                @foreach($format_class_list as $item)--}}
{{--                <ul class="SZY-SHOP-STREET-CLS-CHR hide" id="cls_list_{{ $item['cls_id'] }}">--}}
{{--                    <li data-val='{{ $item['cls_id'] }}' data-cls_id='1_{{ $item['cls_id'] }}_0' data-text='{{ $item['cls_name'] }}' class="">--}}
{{--                        <span class="submenu-name">全部</span>--}}
{{--                    </li>--}}
{{--                    @if(!empty($item['_child']))--}}
{{--                        @foreach($item['_child'] as $child)--}}
{{--                            <li data-val='{{ $child['cls_id'] }}' data-cls_id='2_{{ $child['cls_id'] }}_{{ $item['cls_id'] }}' data-text='{{ $child['cls_name'] }}' >--}}
{{--                                <span class="submenu-name">{{ $child['cls_name'] }}</span>--}}
{{--                            </li>--}}
{{--                        @endforeach--}}
{{--                    @endif--}}
{{--                </ul>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="distance-box shop-submenu SZY-SHOP-STREET-DISTANCE" style="display: none">--}}
{{--    <span>--}}
{{--        <a href="javascript:void(0)" class="current" data-val='' data-text='附近商家'>全部</a>--}}
{{--    </span>--}}
{{--            <span>--}}
{{--        <a href="javascript:void(0)" data-val='1' data-text='1千米'>1千米</a>--}}
{{--    </span>--}}
{{--            <span>--}}
{{--        <a href="javascript:void(0)" data-val='3' data-text='3千米'>3千米</a>--}}
{{--    </span>--}}
{{--            <span>--}}
{{--        <a href="javascript:void(0)" data-val='5' data-text='5千米'>5千米</a>--}}
{{--    </span>--}}
{{--            <span>--}}
{{--        <a href="javascript:void(0)" data-val='10' data-text='10千米'>10千米</a>--}}
{{--    </span>--}}
{{--        </div>--}}
{{--        <div class="sort-box shop-submenu SZY-SHOP-STREET-SORT" style="display: none">--}}
{{--            <!-- 销量降序class名：icon-descending，升序class名为：icon-ascending-->--}}
{{--            <span>--}}
{{--        <a href="javascript:void(0)" data-val='sale' data-text='销量'>销量</a>--}}
{{--    </span>--}}
{{--            <!--信誉 -->--}}
{{--            <span>--}}
{{--        <a href="javascript:void(0)" data-val='credit' data-text='信誉'>信誉</a>--}}
{{--    </span>--}}
{{--            <!--距离-->--}}
{{--            <span>--}}
{{--        <a href="javascript:void(0)" data-val='distance' data-text='距离'>距离</a>--}}
{{--    </span>--}}
{{--        </div>--}}
{{--        <div class="mask-div"></div>--}}
{{--        <div class='shop-street-list'></div>--}}
{{--        <!-- GPS获取坐标 -->--}}
{{--        <script type="text/javascript">--}}
{{--            (function() {--}}
{{--                var url = location.href;--}}
{{--                if ("" != "" && url.indexOf("user_id=") == -1 && window.history && history.pushState) {--}}
{{--                    if (url.indexOf("?") == -1) {--}}
{{--                        url += "?user_id=";--}}
{{--                    } else {--}}
{{--                        url += "&user_id=";--}}
{{--                    }--}}
{{--                } else {--}}
{{--                    url = location.href.split('#')[0];--}}
{{--                }--}}
{{--                var share_url = "";--}}
{{--                if (share_url == '') {--}}
{{--                    share_url = url;--}}
{{--                }--}}
{{--                /*  不明白为什么这么写   如果有问题在处理  20200810sunlizhi--}}
{{--                if (window.__wxjs_environment !== 'miniprogram') {--}}
{{--                    window.history.replaceState(null, document.title, url);--}}
{{--                }--}}
{{--                 */--}}
{{--            })();--}}
{{--        </script>--}}
{{--        <script src="//res.wx.qq.com/open/js/jweixin-1.6.0.js"></script>--}}
{{--        <script type="text/javascript">--}}
{{--            $().ready(function() {--}}
{{--                // $("body").append('<script src="https://res.wx.qq.com/open/js/jweixin-1.6.0.js"><\/script>');--}}
{{--                var url = location.href;--}}
{{--                if ("" != "" && url.indexOf("user_id=") == -1 && window.history && history.pushState) {--}}
{{--                    if (url.indexOf("?") == -1) {--}}
{{--                        url += "?user_id=";--}}
{{--                    } else {--}}
{{--                        url += "&user_id=";--}}
{{--                    }--}}
{{--                } else {--}}
{{--                    url = location.href.split('#')[0];--}}
{{--                }--}}
{{--                var share_url = "";--}}
{{--                if (share_url == '') {--}}
{{--                    share_url = url;--}}
{{--                }--}}
{{--                //--}}
{{--                if (isWeiXin()) {--}}
{{--                    $.ajax({--}}
{{--                        url: "/site/get-weixinconfig.html",--}}
{{--                        type: "POST",--}}
{{--                        dataType: "json",--}}
{{--                        data: {--}}
{{--                            url: url--}}
{{--                        },--}}
{{--                        success: function(result) {--}}
{{--                            if (result.code == 0) {--}}
{{--                                wx.config({--}}
{{--                                    debug: false,--}}
{{--                                    appId: result.data.appId,--}}
{{--                                    timestamp: result.data.timestamp,--}}
{{--                                    nonceStr: result.data.nonceStr,--}}
{{--                                    signature: result.data.signature,--}}
{{--                                    jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage', 'wx-open-launch-weapp'],--}}
{{--                                    openTagList: ['wx-open-launch-weapp']--}}
{{--                                });--}}
{{--                            }--}}
{{--                        }--}}
{{--                    });--}}
{{--                }--}}
{{--                //--}}
{{--                // 微信JSSDK开发--}}
{{--                wx && wx.ready(function() {--}}
{{--                    var share_from = $("input[name=share_from]").val();--}}
{{--                    // 分享给朋友--}}
{{--                    wx.onMenuShareAppMessage({--}}
{{--                        title: '{{ $seo_title }}', // 标题--}}
{{--                        desc: '{{ $seo_description }}', // 描述--}}
{{--                        imgUrl: '{{ get_image_url($seo_image) }}', // 分享的图标--}}
{{--                        link: share_url,--}}
{{--                        fail: function(res) {--}}
{{--                            alert(JSON.stringify(res));--}}
{{--                        },--}}
{{--                        success: function(res) {--}}
{{--                            if (share_from == 'gameplay') {--}}
{{--                                $.post("/user/gameplay/share", {--}}
{{--                                    gameplay_id: ''--}}
{{--                                }, function(result) {--}}
{{--                                    window.location.reload();--}}
{{--                                }, 'json')--}}
{{--                            }--}}
{{--                        }--}}
{{--                    });--}}
{{--                    // 分享到朋友圈--}}
{{--                    wx.onMenuShareTimeline({--}}
{{--                        title: '{{ $seo_title }}', // 标题--}}
{{--                        desc: '{{ $seo_description }}', // 描述--}}
{{--                        imgUrl: '{{ get_image_url($seo_image) }}', // 分享的图标--}}
{{--                        link: share_url,--}}
{{--                        fail: function(res) {--}}
{{--                            alert(JSON.stringify(res));--}}
{{--                        },--}}
{{--                        success: function(res) {--}}
{{--                            if (share_from == 'gameplay') {--}}
{{--                                $.post("/user/gameplay/share", {--}}
{{--                                    gameplay_id: ''--}}
{{--                                }, function(result) {--}}
{{--                                    window.location.reload();--}}
{{--                                }, 'json')--}}
{{--                            }--}}
{{--                        }--}}
{{--                    });--}}
{{--                    // 小程序分享--}}
{{--                    wx && wx.miniProgram.getEnv(function(res) {--}}
{{--                        if (res.miniprogram) {--}}
{{--                            if (share_from == 'gameplay') {--}}
{{--                                $.post("/user/gameplay/share", {--}}
{{--                                    gameplay_id: ''--}}
{{--                                }, function(result) {--}}
{{--                                    // window.location.reload();--}}
{{--                                }, 'json')--}}
{{--                            }--}}
{{--                            wx.miniProgram.postMessage({--}}
{{--                                data: {--}}
{{--                                    title: '{{ $seo_title }}',--}}
{{--                                    imgUrl: '{{ get_image_url($seo_image) }}',--}}
{{--                                }--}}
{{--                            });--}}
{{--                        }--}}
{{--                    });--}}
{{--                    // window.history.replaceState(null, document.title, url);--}}
{{--                });--}}
{{--                // 返回定位选项卡历史位置——————————————————————————START--}}
{{--                $('body').on('click', ".scroll-y-menu li", function (res){--}}
{{--                    var parent_id = $(this).parents('.scroll-y-menu').parent().parent().prop('id');--}}
{{--                    $('#' + parent_id + ' .scroll-y-menu li').each(function (n,j){--}}
{{--                        if($(this).hasClass('active'))--}}
{{--                        {--}}
{{--                            localStorage.setItem("History_tab", [parent_id, n]);--}}
{{--                        }--}}
{{--                    })--}}
{{--                });--}}
{{--                var history_tab = localStorage.getItem('History_tab');--}}
{{--                if(history_tab && history_tab != '' && typeof(history_tab) != 'undefined' && typeof(history_tab) != 'null')--}}
{{--                {--}}
{{--                    var history_arr = history_tab.split(',');--}}
{{--                    var history_uid = history_arr[0];--}}
{{--                    var history_li = history_arr[1];--}}
{{--                    //;--}}
{{--                    var obj = $("#" + history_uid + " .scroll-y-menu li");--}}
{{--                    console.log(obj)--}}
{{--                    console.log(history_uid);--}}
{{--                    console.log(history_li);--}}
{{--                    if(obj.eq(history_li).length > 0)--}}
{{--                    {--}}
{{--                        obj.removeClass('active');--}}
{{--                        var floor_li = $("#" + history_uid + " div.tab-con");--}}
{{--                        localStorage.setItem("History_tab", '')--}}
{{--                        floor_li.hide();--}}
{{--                        floor_li.eq(history_li).show()--}}
{{--                        console.log(history_li)--}}
{{--                        obj.eq(history_li).addClass('active')--}}
{{--                    }--}}
{{--                }--}}
{{--            });--}}
{{--        </script>--}}
{{--        <script type="text/javascript">--}}
{{--            //--}}
{{--        </script>--}}
{{--<script type="text/javascript">--}}
{{--	window._AMapSecurityConfig = {--}}
{{--		securityJsCode: "{{ sysconf('amap_js_security_code') }}",--}}
{{--	};--}}
{{--</script>--}}
{{--        <script src="https://webapi.amap.com/maps?v=1.4.6&key={{ sysconf('amap_js_key') }}"></script>--}}
{{--        <script type="text/javascript">--}}
{{--            //--}}
{{--        </script>--}}
{{--        <script type="text/javascript">--}}
{{--            //--}}
{{--        </script>--}}
{{--        <script type="text/javascript">--}}
{{--            //--}}
{{--        </script>--}}
{{--    --}}{{--引入右上角菜单--}}
{{--    @include('layouts.partials.right_top_menu')--}}

{{--    <!-- 返顶 -->--}}
{{--        <a href="javascript:void(0);" class="back-to-top gotop hide"><img src="/images/topup.png"></a>--}}
{{--        <script type="text/javascript">--}}
{{--            //--}}
{{--        </script>--}}
{{--        --}}{{--引入底部菜单--}}
{{--        @include('frontend.web_mobile.modules.library.site_footer_menu')--}}

{{--    </div>--}}
{{--    --}}{{--引入右上角菜单--}}
{{--    @include('layouts.partials.right_top_menu')--}}

{{--    <!-- 底部 _end-->--}}
{{--    <script type="text/javascript">--}}
{{--        //--}}
{{--    </script>--}}
{{--    <!-- 积分提醒 -->--}}
{{--    <!-- 消息提醒 -->--}}
{{--    <script type="text/javascript">--}}
{{--        //--}}
{{--    </script>    <!-- 第三方流量统计 -->--}}
{{--    <div style="display: none;"></div>--}}
{{--    <script src="/assets/d2eace91/min/js/core.min.js"></script>--}}
{{--    <script src="/assets/d2eace91/js/swiper/swiper.jquery.min.js"></script>--}}
{{--    <script src="/js/app.frontend.mobile.min.js"></script>--}}
{{--    <script src="/assets/d2eace91/js/szy.cart.mobile.js"></script>--}}
{{--    <script src="/js/shopstreet.js"></script>--}}
{{--    <script src="/assets/d2eace91/js/geolocation/amap.js"></script>--}}
{{--    <script src="/assets/d2eace91/min/js/message.min.js"></script>--}}
{{--    <script>--}}
{{--        var tablelist = null;--}}
{{--        $().ready(function() {--}}
{{--            $('.shop-street-list').html('<div class="location-con"><div class="store-loading" data-spm-anchor-id="a3204.12681481.0.i0"><i class="iconfont icon-dingwei1 color cat-header"></i><svg class="cat-shadow" height="20"><ellipse cx="149" cy="10" rx="24" ry="5" fill="#CDCDCD" fill-rule="evenodd"></ellipse></svg></div><p>正在加载附近商家...</p></div>');--}}
{{--            //获取坐标--}}
{{--            $.geolocation({--}}
{{--                callback: function(data) {--}}
{{--                    loadlist(data);--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--        function loadlist(data) {--}}
{{--            if (data) {--}}
{{--                $.ajax({--}}
{{--                    url: '/shop/street/index',--}}
{{--                    dataType: 'json',--}}
{{--                    data: {--}}
{{--                        output: 1,--}}
{{--                        lat: data.lat,--}}
{{--                        lng: data.lng,--}}
{{--                        sort: 'distance-asc',--}}
{{--                        name: $('#shop_name').val(),--}}
{{--                        cls_id: '',--}}
{{--                    },--}}
{{--                    success: function(result) {--}}
{{--                        $('.shop-street-list').html(result.data);--}}
{{--                        $('.shop-nav a').removeClass('invalid');--}}
{{--                        is_opening();--}}
{{--                        ref_disdance();--}}
{{--                    }--}}
{{--                });--}}
{{--            }--}}
{{--        }--}}
{{--        //判断商家是否休息--}}
{{--        function is_opening() {--}}
{{--            var ids = [];--}}
{{--            $.each($('.SZY-IS-OPEN.valid'), function(a, b) {--}}
{{--                ids.push($(b).data('shop_id'));--}}
{{--                $(b).removeClass('valid');--}}
{{--            });--}}
{{--            $.get('/shop/street/open-list', {--}}
{{--                'ids': ids--}}
{{--            }, function(result) {--}}
{{--                if (result.data != null) {--}}
{{--                    $.each(result.data, function(i, v) {--}}
{{--                        if (!v.is_opening) {--}}
{{--                            if ($.trim(v.opening_time)!=null && v.opening_time!=undefined) {--}}
{{--                                time=v.opening_time;--}}
{{--                            } else {--}}
{{--                                time = '暂停';--}}
{{--                            }--}}
{{--                            $('.is-opening-' + v.shop_id).html('<p class="shop-rest"><span class="shop-rest-left">商家休息</span><span class="shop-rest-right">'+time+'营业</span></p>');--}}
{{--                        }--}}
{{--                    });--}}
{{--                }--}}
{{--            }, 'json');--}}
{{--        }--}}
{{--        function ref_disdance(){--}}
{{--            var data = [];--}}
{{--            $.each($('.shop-distance-item.valid'),function(a,b){--}}
{{--                var value = {};--}}
{{--                value.shop_id = $(b).data('shop_id');--}}
{{--                value.shop_lng = $(b).data('shop_lng');--}}
{{--                value.shop_lat = $(b).data('shop_lat');--}}
{{--                data.push(value);--}}
{{--                $(b).removeClass('valid');--}}
{{--            });--}}
{{--            $.get('/shop/street/ref-disdance', {--}}
{{--                'data': data--}}
{{--            }, function(result) {--}}
{{--                if (result.data != null) {--}}
{{--                    $.each(result.data, function(i, v) {--}}
{{--                        $('#shop_distance_num_' + v.shop_id).html(v.distance);--}}
{{--                        $('#shop_time_' + v.shop_id).html(v.time);--}}
{{--                    });--}}
{{--                }--}}
{{--            }, 'json');--}}
{{--        }--}}
{{--        //--}}
{{--        // 当滚动条的位置距顶部一定高度时，将分类固定--}}
{{--        $(function() {--}}
{{--            $(window).bind('scroll', function() {--}}
{{--                var len = $(this).scrollTop()--}}
{{--                if (len >= 44) {--}}
{{--                    $('.shop-street-top').css({--}}
{{--                        "transform": "translate3d(0px, -44px, 0px)"--}}
{{--                    });--}}
{{--                } else {--}}
{{--                    $('.shop-street-top').css({--}}
{{--                        'transform': 'translate3d(0, 0, 0)'--}}
{{--                    });--}}
{{--                }--}}
{{--            })--}}
{{--        })--}}
{{--        //一键导航--}}
{{--        $('body').on('click', '.SZY-MAP-NAV', function() {--}}
{{--            var shoplat = $(this).data('lat');--}}
{{--            var shoplng = $(this).data('lng');--}}
{{--            var title = $(this).data('title');--}}
{{--            var content = $(this).data('content');--}}
{{--            if (isWeiXin()) {--}}
{{--                $.loading.start();--}}
{{--                var url = location.href.split('#')[0];--}}
{{--                $.ajax({--}}
{{--                    url: "/site/get-weixinconfig.html",--}}
{{--                    type: "POST",--}}
{{--                    data: {--}}
{{--                        url: url--}}
{{--                    },--}}
{{--                    dataType: 'json',--}}
{{--                    success: function(result) {--}}
{{--                        if (result.code == 0) {--}}
{{--                            wx.config({--}}
{{--                                debug: false,--}}
{{--                                appId: result.data.appId,--}}
{{--                                timestamp: result.data.timestamp,--}}
{{--                                nonceStr: result.data.nonceStr,--}}
{{--                                signature: result.data.signature,--}}
{{--                                jsApiList: [--}}
{{--                                    // 所有要调用的 API 都要加到这个列表中--}}
{{--                                    'openLocation', 'getLocation']--}}
{{--                            });--}}
{{--                            wx.openLocation({--}}
{{--                                latitude: shoplat, // 纬度，浮点数，范围为90 ~ -90--}}
{{--                                longitude: shoplng, // 经度，浮点数，范围为180 ~ -180。--}}
{{--                                name: title, // 位置名--}}
{{--                                address: content, // 地址详情说明--}}
{{--                                scale: 15, // 地图缩放级别,整形值,范围从1~28。默认为最大--}}
{{--                                infoUrl: '', // 在查看位置界面底部显示的超链接,可点击跳转--}}
{{--                                cbCompleteFun: function() {--}}
{{--                                    $.loading.stop();--}}
{{--                                }--}}
{{--                            });--}}
{{--                        } else {--}}
{{--                            if (window.__wxjs_environment !== 'miniprogram') {--}}
{{--                                $.go('/index/information/amap?start=,&dest=' + shoplng + ',' + shoplat + '&title=' + title);--}}
{{--                            } else {--}}
{{--                                $.msg("导航功能需要去后台微信设置里填写正确的信息");--}}
{{--                            }--}}
{{--                        }--}}
{{--                    }--}}
{{--                });--}}
{{--            } else {--}}
{{--                $.go('/index/information/amap?start=,&dest=' + shoplng + ',' + shoplat + '&title=' + title);--}}
{{--            }--}}
{{--        });--}}
{{--        //--}}
{{--        // 添加收藏--}}
{{--        $('body').on('click', '.shop-collet-btn', function(event) {--}}
{{--            var target = $(this);--}}
{{--            var shop_id = $(target).data('shop_id');--}}
{{--            $.collect.toggleShop(shop_id, function(result) {--}}
{{--                if (result.data == 1) {--}}
{{--                    $(target).addClass('shop-colleted');--}}
{{--                    $(target).html("<i class='iconfont'>&#xe614;</i>已关注");--}}
{{--                } else {--}}
{{--                    $(target).removeClass('shop-colleted');--}}
{{--                    $(target).html("<i class='iconfont'>&#xe615;</i>关注");--}}
{{--                }--}}
{{--                $('.SZY-COLLECT-COUNT-' + shop_id).html(result.collect_count);--}}
{{--                // 删除缓存--}}
{{--                sessionStorage.removeItem('shop_street_0__');--}}
{{--            }, 1);--}}
{{--        });--}}
{{--        //--}}
{{--    </script>--}}

{{--@stop--}}
