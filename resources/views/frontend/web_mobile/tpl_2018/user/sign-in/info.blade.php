@extends('layouts.user_layout')

{{--header_css--}}
@section('header_css')
    <link href="/css/jqx.base.css" rel="stylesheet">
    <link href="/css/swiper.min.css" rel="stylesheet">
    <link href="/css/signin.css" rel="stylesheet">
@stop

{{--header_js--}}
@section('header_js')

@stop

@section('content')

    <header class="header-top-nav">
        <div class="header">
            <div class="header-left">
                <a class="sb-back" href="javascript:history.back(-1);" title="返回" szy_tag_compiled="1">
                    <i class="iconfont">&#xe606;</i>
                </a>
            </div>
            <div class="header-middle">{{ $sign_in_title }}</div>
            <div class="header-right">
                <!-- 控制展示更多按钮 -->
                <aside class="show-menu-btn">
                    <div class="show-menu" id="show_more">
                        <a href="javascript:void(0);" szy_tag_compiled="1">
                            <i class="iconfont">&#xe6cd;</i>
                        </a>
                    </div>
                </aside>
            </div>
        </div>
    </header>
    <div class="sign-box" style="background-color:">
        <div class="sign-top">
            <div class="sign-record">
                <div class="calendar-left">
                    <img src="/images/continuity-pic.png" alt="连续签到">
                    <p><span>{{ $continue_sign_in }}</span>天</p>
                </div>
                @if($today_is_sign_in)
                    <div class="calendar-middle ">
                        <a href="javascript:;" class="sign-btn">签到成功</a>
                    </div>
                @else
                    <div class="calendar-middle unsigned">
                        <a href="javascript:;" class="sign-btn signin-go">立即签到</a>
                    </div>
                @endif

                <div class="calendar-right">
                    <img src="/images/cumulativec-pic.png" alt="累计签到">
                    <p><span>{{ $addup_sign_in }}</span>天</p>
                </div>
            </div>
            <p class="everyday-gift">每日签到送{{ $day_award['points'] }}</p>
            <a href="javascript:;" class="sign-rule">
                <i class="iconfont">&#xe71d;</i>
                签到规则
            </a>
        </div>
        <div class="calendar">
            <div class="calendar-container">
                <!-- 日历 -->
                <div id='jqxcalendar' class="calendar-box"></div>
                <!-- 连续签到 -->
                <div class="continuity-group">
                    <div class="continuity-group-item">
                        <div class="continuity-list ">
                            <p class="continuity-title">{{ $start_time }}-{{ $end_time }} 连续签到可领取以下奖励</p>
                            <ul class="swiper-wrapper">
                                @foreach($cycle_days_list as $key=>$item)
                                    <!-- 未领取奖励的样式 -->
                                        <li class="swiper-slide not-received-item" data-days="{{ $key }}" data-award='{!! $item !!}' data-recive="0">
                                            <p>连续 {{ $key }} 天</p>
                                            <p class="gift"><span>{{ json_decode($item,true)[1] }}</span>积分</p>
                                            <img src="/images/continuity-icon.png" alt="">
                                        </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- 签到成功弹层 -->
                <div class="sign-layer sign-success">
                </div>
                <!-- 连签礼物弹层 -->
                <div class="sign-layer sign-gift">
                    <div class="success-content">
                        <div class="pic">
                            <img src="/images/sign-gift.png" alt="">
                        </div>
                        <p id="award_desc">加油加油，马上可以获得以下奖励！</p>
                        <!-- 连签奖励 -->
                        <ul class="reward-list">
                            <li class="reward"><span></span>10积分<a href="javascript:void(0)" onclick="$.go('/user/integral/shop-points')">查看</a></li>
                            <li class="reward"><span></span>500元优惠券<a href="javascript:void(0)" onclick="$.go('/user/bonus.html?type=0')">查看</a></li>
                        </ul>
                    </div>
                    <a href="javascript:;" class="close-btn gift-close-btn" szy_tag_compiled="1">
                        <i class="iconfont"></i>
                    </a>
                </div>
                <!-- 签到规则弹层 -->
                <div class="sign-rule-layer">
                    <div class="rule-content">
                        <h2 class="title bdr-bottom">签到规则</h2>
                        <ul>
                            @foreach($sign_in_rule as $item)
                            <li><i>*</i>{!! $item !!}</li>
                            @endforeach
                        </ul>
                    </div>
                    <a href="javascript:;" class="close-rule-layer">
                        <i class="iconfont">&#xe681;</i>
                    </a>
                </div>
                <div class="layer-mask"></div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        (function(){
            var url = location.href;
            if ("" != "" && url.indexOf("user_id=") == -1 && window.history && history.pushState) {
                if (url.indexOf("?") == -1) {
                    url += "?user_id=";
                } else {
                    url += "&user_id=";
                }
            } else {
                url = location.href.split('#')[0];
            }
            var share_url = "";
            if (share_url == '') {
                share_url = url;
            }
            if (window.__wxjs_environment !== 'miniprogram') {
                window.history.replaceState(null, document.title, url);
            }
        })();
    </script>
    <script src="https://res.wx.qq.com/open/js/jweixin-1.6.0.js"></script>
    <script type="text/javascript">
        $().ready(function() {
            // $("body").append('<script src="https://res.wx.qq.com/open/js/jweixin-1.6.0.js"><\/script>');
            var url = location.href;
            if ("" != "" && url.indexOf("user_id=") == -1 && window.history && history.pushState) {
                if (url.indexOf("?") == -1) {
                    url += "?user_id=";
                } else {
                    url += "&user_id=";
                }
            } else {
                url = location.href.split('#')[0];
            }
            var share_url = "";
            if (share_url == '') {
                share_url = url;
            }
            //
            if (isWeiXin()) {
                $.ajax({
                    url: "/site/get-weixinconfig.html",
                    type: "POST",
                    dataType: "json",
                    data: {
                        url: url
                    },
                    success: function(result) {
                        if (result.code == 0) {
                            wx.config({
                                debug: false,
                                appId: result.data.appId,
                                timestamp: result.data.timestamp,
                                nonceStr: result.data.nonceStr,
                                signature: result.data.signature,
								jsApiList: result.data.jsApiList,
                                // jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage', 'wx-open-launch-weapp'],
                                // openTagList: ['wx-open-launch-weapp']
                            });
                        }
                    }
                });
            }
            //
            // 微信JSSDK开发
            wx && wx.ready(function() {
                // 分享给朋友
                wx.onMenuShareAppMessage({
                    title: '{{ $seo_title }}', // 标题
                    desc: '{{ $seo_description }}', // 描述
                    imgUrl: '{{ $seo_image }}', // 分享的图标
                    link: share_url,
                    fail: function(res) {
                        alert(JSON.stringify(res));
                    }
                });
                // 分享到朋友圈
                wx.onMenuShareTimeline({
                    title: '{{ $seo_title }}', // 标题
                    desc: '{{ $seo_description }}', // 描述
                    imgUrl: '{{ $seo_image }}', // 分享的图标
                    link: share_url,
                    fail: function(res) {
                        alert(JSON.stringify(res));
                    }
                });
                // window.history.replaceState(null, document.title, url);
            });
        });
    </script>
    <script type="text/javascript">
        $().ready(function() {
            setTimeout(function() {
                if (window.__wxjs_environment === 'miniprogram') {
                    var share_info = {
                        title: '{{ $seo_title }}',
                        imgUrl: '{{ $seo_image }}'
                    };
                    wx.miniProgram.postMessage({
                        data: share_info
                    });
                }
            }, 3000);
        });
    </script>
    <script type="text/javascript">
        //
    </script>
    {{--引入右上角菜单--}}
    @include('layouts.partials.right_top_menu')
    <!-- 积分消息 -->
    <!-- 消息提醒 -->
    <script type="text/javascript">
        //
    </script>
    <!-- 第三方流量统计 -->
    <div style="display: none;"></div>
    <!-- 底部 _end-->
    <div style="height: 54px; line-height: 54px" class="handle-spacing"></div>
    <script src="/assets/d2eace91/min/js/core.min.js"></script>
    <script src="/js/app.frontend.mobile.min.js"></script>
    <script src="/js/user.js"></script>
    <script src="/js/address.js"></script>
    <script src="/js/center.js"></script>
    <script src="/js/jquery.fly.min.js"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js"></script>
    <script src="/assets/d2eace91/js/swiper/swiper.jquery.min.js"></script>
    <script src="/js/jqxcore.js"></script>
    <script src="/js/jqxdatetimeinput.js"></script>
    <script src="/js/jqxcalendar.js"></script>
    <script src="/js/globalize.js"></script>
    <script src="/assets/d2eace91/min/js/message.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#jqxcalendar').jqxCalendar({
                //disabled:true,
                width: '90%',
                showOtherMonthDays: false,
                //readOnly: true,
                /*            showWeekNumbers: false,
                            showDayNames: true,
                            showOtherMonthDays: false,
                            readOnly: false,
                            showFooter: false,
                todayString: 'Today',
                selectionMode: 'range',
                backText: "Back",*/
            });
            /* $('#jqxcalendar').bind('valuechanged'), function(event){
                 var date = event.args.date;
                 //$('#log').text(date.toDateString())
             };*/
            /*$('#jqxcalendar').bind('backButtonClick', function () { alert('backButtonClick')});
             $('#jqxcalendar').bind('nextButtonClick', function () { alert('nextButtonClick') });
            $('#jqxcalendar').bind('valuechanged', function (event) { var jsDate = event.args.date; alert(jsDate) });
           $('#jqxcalendar').bind('cellMouseDown', function () { alert('cellMouseDown')});
           $('#jqxcalendar').bind('cellMouseUp', function () { alert('cellMouseUp')});
           $('#jqxcalendar').bind('cellSelected', function () { alert('cellSelected') });
           $('#jqxcalendar').bind('cellUnselected', function () { alert('cellUnselected') });*/
            var date_json = {!! $js_date !!};
            for (var i in date_json) {
                $("#jqxcalendar").jqxCalendar('addSpecialDate', new Date(date_json[i].y, date_json[i].m, date_json[i].d));
            }
            //$('#jqxcalendar').jqxCalendar('setDate', new Date(2019, 6, 1));
            // $('#jqxcalendar').jqxCalendar('setDate', new Date(2019, 6, 1));
            // $('#jqxcalendar').jqxCalendar('setDate', new Date(2019, 6, 5));
            //var date1 = new Date();
            //date1.setFullYear(2019, 6, 1);
            //$('#jqxcalendar').jqxCalendar('setDate', date1);
            // var date2 = new Date();
            //date2.setFullYear(2019, 6, 5);
            // $("#jqxcalendar").jqxCalendar('setRange', date1,date2);
        });
        $().ready(function(){
            //是否自动签到
            go_sign_in();
            $('.swiper-container').each(function() {
                $(this).swiper({
                    slidesPerView: 'auto',
                    observer: true,//修改swiper自己或子元素时，自动初始化swiper
                    observeParents: true,//修改swiper的父元素时，自动初始化swiper
                    freeMode: true
                })
            })
        });
        $('.signin-go').click(function () {
            $.loading.start();
            go_sign_in();
        })
        $("body").on("click", ".gift-close-btn", function () {
            $('.gift-close-btn').hide();
            $('.sign-gift').hide()
            $('.layer-mask').hide()
        })
        // 签到规则
        $('.sign-rule').click(function () {
            $('.sign-rule-layer, .layer-mask').show();
        });
        $('.close-rule-layer').click(function () {
            $('.sign-rule-layer, .layer-mask').hide();
        });
        // 提醒设置
        $('.sign-remind').click(function(){
            $('.sign-remind .fa').toggleClass('active');
            if($('.sign-remind .fa').hasClass('active'))
            {
                //此用户需要推送
                alert('推送');
            }else{
                //不推送
                alert('不推送');
            }
        })
        // 连签奖励弹层
        $('.continuity-list li').click(function(){
            var award = $(this).data('award');
            var recive = $(this).data('recive');
            if(award){
                var txt = '';
                for(var i in award){
                    var awardi = award[i];
                    awardi = awardi.replace("积分","积分");
                    if(i == 'points'){
                        txt += '<li class="reward"><div class="reward-pic"><img src="/images/points-icon.png" alt=""></div>'+awardi;
                        if(recive == '1'){
                            txt += '<a href="javascript:void(0)" onclick=$.go("/user/integral/shop-points")>查看</a></li>';
                        }else{
                            txt += '</li>';
                        }
                    }else if (i == 'bonus') {
                        txt += '<li class="reward"><div class="reward-pic"><img src="/images/bonus-icon.png" alt=""></div>'+awardi;
                        if(recive == '1')
                        {
                            txt += '<a href="javascript:void(0)" onclick=$.go("/user/bonus.html?type=0")>查看</a>';
                        }else{
                            txt += '</li>';
                        }
                    }
                }
                $('.sign-gift .reward-list').empty().html(txt);
            }
            if(recive == '1')
            {
                $("#award_desc").html('恭喜您！已获取以下奖励！');
            }else{
                $("#award_desc").html('加油加油，马上可以获得以下奖励！');
            }
            $('.close-btn').show();
            $('.sign-gift').show();
            $('.layer-mask').show();
        })
        //签到的方法
        function go_sign_in()
        {
            $.post('/user/sign-in/go.html', {}, function (result) {
                if (result.code == 0) {
                    $('.close-btn').show()
                    $('.sign-success').html(result.data)
                    $('.sign-success').show()
                    $('.layer-mask').show()
                } else {
                    $.msg(result.message, {
                        time: 3000
                    });
                }
            }, 'json');
        }
        //
        $().ready(function () {
            WS_AddPoint({
                user_id: '{{ $user_info['user_id'] ?? 0 }}',
                url: "{{ get_ws_url('7272') }}",
                type: "add_point_set"
            });
        });

        function addPoint(ob) {
            if (ob != null && ob != 'undefined') {
                if (ob.point && ob.point > 0 && ob.user_id && ob.user_id == '{{ $user_info['user_id'] ?? 0 }}') {
                    $.intergal({
                        point: ob.point,
                        name: '积分'
                    });
                }
            }
        }
        //
    </script>

@stop
