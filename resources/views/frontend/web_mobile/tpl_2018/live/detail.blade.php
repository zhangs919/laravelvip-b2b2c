@extends('layouts.base')

{{--header_css--}}
@section('header_css')
    <link href="/css/live.css" rel="stylesheet">

@stop

{{--header_js--}}
@section('header_js')

@stop



@section('content')

    <!-- 内容 -->
    <div id="index_content">
        <!-- 消息提醒 -->
        <link href="//g.alicdn.com/de/prismplayer/2.6.0/skins/default/aliplayer-min.css" rel="stylesheet">
        <div class="prism-player" id="J_prismPlayer" style="position: absolute"></div>
        <div class="video-con">
            <div class="live-handle">
                <!-- <a href="javascript:void(0)" class="handle-btn share"></a> -->
                <!-- <a href="javascript:window.history.go(-1);" class="handle-btn colse"></a> -->
            </div>
            <div class="author-box">
                <div class="author-left ub">
                    <img class="author-header" src="{{ get_image_url($shop_info['shop_image']) }}">
                    <div class="author-item">
                        <p class="text-ellipsis">{{ $shop_info['shop_name'] }}</p>
                        <p>
                            <span class="online-num"></span>
                            观看
                        </p>
                    </div>
                </div>
                <!--已收藏就添加class：collected-btn-->
                @if(!$is_collect)
                    <div class="collect-btn " data-shop_id="{{ $live['shop_id'] }}">
                        <i class="collect-btn-icon"></i>
                        <span class="collect-btn-text">关注</span>
                    </div>
                @else
                    <div class="collect-btn collected-btn" data-shop_id="{{ $live['shop_id'] }}">
                        <i class="collect-btn-icon"></i>
                        <span class="collect-btn-text">已关注</span>
                    </div>
                @endif
            </div>
            <!--有人进直播间时添加show-->
            <div class="come-user SZY-LIVE-MESSAGE-FIRST"></div>
            <!--浏览者-->
            <div class="visitors">
                <div class="visitor SZY-LIVE-MESSAGE-SECOND"></div>
            </div>
            <!--留言人-->
            <ul class="writers SZY-LIVE-MESSAGE-THIRD"></ul>
            <!--底部信息-->
            <div class="live-bottom ub">
                <div class="cart-box">
                    <a class="cart-btn"></a>
                    <span class="goods-num">{{ count($goods_list) }}</span>
                </div>
                <div class="fixed-chatting ub-f1 ub chatting-con">
                    <input class="ub-f1 input-con" type="text" name="say_content" placeholder="和主播聊点什么吧~">
                    <a href="javascript:void(0)" class="send-btn send-btn1" onclick="say()"></a>
                    <input type="submit" class="send-btn bg-color send-btn2 hide" onclick="say()" value="发送">
                </div>
            </div>
            <!--发送聊天层-->
            @if(!empty($goods_list))
            <!--购物车商品信息-->
            <div class="live-cartbox-layer">
                <div class="mask-div"></div>
                <div class="cartbox-con spec-menu-hide">

                    <ul class="goods-list">

                        @foreach($goods_list as $key=>$item)
                        <li class="goods-item" data-index="{{ $key+1 }}" id="goods_{{ $item['goods_id'] }}">
                            <div class="goods-index">{{ $key+1 }}</div>
                            <div class="goods-pic">
                                <a href="/goods-{{ $item['goods_id'] }}.html">
                                    <img src="{{ get_image_url($item['goods_image']) }}">
                                </a>
                            </div>
                            <dl class="goods-info">
                                <dt class="goods-name">
                                    <a href="/goods-{{ $item['goods_id'] }}.html" class="item-title">{{ $item['goods_name'] }}</a>
                                </dt>
                                <dd class="goods-price price-color">￥{{ $item['goods_price'] }}</dd>
                                <dd>
                                    <a class="look-btn add-cart" data-goods_id="{{ $item['goods_id'] }}" href="javascript:void(0)">加入购物车</a>
                                    <a class="look-btn goods-explain" data-goods_id="{{ $item['goods_id'] }}" data-index="{{ $key+1 }}" href="javascript:void(0)">宝贝讲解</a>
                                </dd>
                            </dl>
                        </li>
                        @endforeach
                    </ul>
                    <div class="cart-goods-num cartbox">
                        <a href="/cart.html">
                            <em class="bg-color SZY-CART-COUNT">{{ $cart_goods_count }}</em>
                            <i class="iconfont">&#xe60c;</i>
                        </a>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <script type="text/javascript">
            (function(){
                var url = location.href;
                if ("{{ $user_info['user_id'] ?? '' }}" != "" && url.indexOf("user_id=") == -1 && window.history && history.pushState){
                    if(url.indexOf("?") == -1){
                        url += "?user_id=" + "{{ $user_info['user_id'] ?? '' }}";
                    }else{
                        url += "&user_id=" + "{{ $user_info['user_id'] ?? '' }}";
                    }
                }else{
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
                if ("{{ $user_info['user_id'] ?? '' }}" != "" && url.indexOf("user_id=") == -1 && window.history && history.pushState){
                    if(url.indexOf("?") == -1){
                        url += "?user_id=" + "{{ $user_info['user_id'] ?? '' }}";
                    }else{
                        url += "&user_id=" + "{{ $user_info['user_id'] ?? '' }}";
                    }
                }else{
                    url = location.href.split('#')[0];
                }

                @if(!empty($user_info))
                    var share_url = "{{ route('live.show',['id'=>$live['id']]) }}?user_id={{ $user_info['user_id'] }}";
                @else
                    var share_url = "";
                @endif

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
                        title: "{{ $live['live_name'] }}", // 标题
                        desc: "{{ $live['description'] }}", // 描述
                        imgUrl: "{{ get_image_url($live['share_img']) }}#{{ time() }}", // 分享的图标
                        link: share_url,
                        fail: function(res) {
                            alert(JSON.stringify(res));
                        }
                    });
                    // 分享到朋友圈
                    wx.onMenuShareTimeline({
                        title: "{{ $live['live_name'] }}", // 标题
                        desc: "{{ $live['description'] }}", // 描述
                        imgUrl: "{{ get_image_url($live['share_img']) }}#{{ time() }}", // 分享的图标
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
                            title: "{{ $live['live_name'] }}",
                            imgUrl: "{{ get_image_url($live['share_img']) }}#{{ time() }}"
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
        <script type="text/javascript">
            //
        </script>
        <script type="text/javascript">
            //
        </script>
        <script type="text/javascript">
            //
        </script>
        <script type="text/javascript">
            //
        </script>
        <script type="text/javascript">
            //
        </script>
        <script src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
        <script type="text/javascript">
            //
        </script>
    </div>
    {{--引入右上角菜单--}}
    @include('layouts.partials.right_top_menu')
    <!-- 第三方流量统计 -->
    <div style="display: none;">

    </div>
    <!-- 底部 _end-->
    <script src="/assets/d2eace91/min/js/core.min.js"></script>
    <script src="/js/app.frontend.mobile.min.js"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js"></script>
    <script src="/assets/d2eace91/js/message/message.js?v=1.2"></script>
    <script src="/assets/d2eace91/js/message/messageWS.js?v=1.2"></script>
{{--    <script src="/assets/d2eace91/min/js/message.min.js"></script>--}}
    <script src="//g.alicdn.com/de/prismplayer/2.6.0/aliplayer-min.js"></script>
    <script>
        var h=($(document).height());
        var w=($('.writers').height());
        var v=$('.visitors').height();
        var b=h-50;
        $('.writers').css('top',b-w);
        $('.visitors').css('top','b-w-v');
        //
        $('.cart-btn').click(function() {
            $('.mask-div').show();
            $('.cartbox-con').removeClass('spec-menu-hide').addClass('spec-menu-show');
        });
        $('.mask-div').click(function() {
            $('.mask-div').hide();
            $('.cartbox-con').addClass('spec-menu-hide').removeClass('spec-menu-show');
        });
        //
        // 添加收藏
        $('body').on('click', '.collect-btn', function(event) {
            var target = $(this);
            var shop_id = $(target).data('shop_id');
            $.loading.start();
            $.collect.toggleShop(shop_id, function(result) {
                $.loading.stop();
                if (result.data == 1) {
                    $(target).addClass('collected-btn');
                    $(target).find('.collect-btn-text').html('已关注');
                } else {
                    $(target).removeClass('collected-btn')
                    $(target).find('.collect-btn-text').html('关注');
                }
            });
        });
        //加入购物车
        $('body').on('click', '.add-cart', function(event) {
            var this_target = $(this);
            var image_url = $(this).data('image_url');
            $.cart.add(this_target.data("goods_id"), "1", {
                image_url: image_url,
                event: event,
                show_message: [false, true],
                is_sku: false,
                callback: function(result) {
                    if (result.code == 0) {
                    }
                }
            });
            return false;
        });
        //
        // var url = "wss://push.lrw.com:4431";
        var url = "{{ get_ws_url('4431') }}";
        var user_id = '{{ $user['user_id'] }}';
        var user_name = "{{ $user['user_name'] }}";
        var user_headimg = '{{ get_image_url(@$user_info['headimg'], 'headimg') }}';
        var room_id = '{{ $room_id }}';
        var ws = null;
        var is_tourist = '{{ $is_tourist }}';
        // 当前的累计观看人数
        var view_number = '{{ $live['view_number'] }}';
        function link_websocket(){
            if(ws == null || ws.readyState == 3){
                ws = szy_websocket({
                    object: {
                        url : url,
                        user_id: user_id,
                        user_name: user_name,
                        user_headimg: user_headimg,
                        room_id: room_id,
                        // 初始化观看人数
                        total_num_init: view_number,
                        type: 'live_login_set'
                    },
                    onmessage: function(event) {
                        var data = JSON.parse(event.data);
                        this.log("接收到服务器发送的数据：");
                        this.log(data);
                        switch (data['type']) {
                            case 'live_login_set': // 进入直播间
                                if(data['user_id'] != user_id){
                                    $('.SZY-LIVE-MESSAGE-FIRST').html('');
                                    $('.SZY-LIVE-MESSAGE-FIRST').html(data['user_name']+" 来了");
                                    $('.SZY-LIVE-MESSAGE-FIRST').addClass('show');
                                    setTimeout(function(){
                                        $('.SZY-LIVE-MESSAGE-FIRST').removeClass('show');
                                    },2000);
                                }
                                // 观看总人数
                                if(view_number > data['total_num']){
                                    data['total_num'] = view_number;
                                }
                                // 更新观看总人数
                                $('.online-num').html(data['total_num'] + '人');
                                if(data['user_id'] == user_id){
                                    console.log(data['user_id'])
                                    console.log(user_id)
                                    // 更新直播间在线人数
                                    $.post('/live/index/edit-online-number',{
                                        id: data['room_id'],
                                        online_num: data['online_num'], // 实时在线人数
                                        view_num: data['total_num'], // 观看总人数
                                    },function(result){
                                    },'JSON');
                                }
                                break;
                            case 'live_say_set': // 用户对话
                                if(data['from_user_id'] != user_id){
                                    var color = getColorByRandom();
                                    if($('.SZY-LIVE-MESSAGE-THIRD')[0].scrollTop + $('.SZY-LIVE-MESSAGE-THIRD').height() >= ($('.SZY-LIVE-MESSAGE-THIRD')[0].scrollHeight-10)){
                                        $('.SZY-LIVE-MESSAGE-THIRD').append('<li class="writer-item"><span class="nick-name" style="color:'+color+'">' + data['from_user_name'] + '</span><span>说：' + data['content'] + '</span></li>');
                                        $('.SZY-LIVE-MESSAGE-THIRD').scrollTop($('.SZY-LIVE-MESSAGE-THIRD')[0].scrollHeight);
                                    }else{
                                        $('.SZY-LIVE-MESSAGE-THIRD').append('<li class="writer-item"><span class="nick-name" style="color:'+color+'">' + data['from_user_name'] + '</span><span>说：' + data['content'] + '</span></li>');
                                    }
                                }
                                break;
                            case 'live_goods_get': // 获取直播商品
                                var index = $('#goods_' + data['goods_id']).data('index');
                                var content = data['content'].replace('{0}', index);
                                $('.SZY-LIVE-MESSAGE-SECOND').html('');
                                $('.SZY-LIVE-MESSAGE-SECOND').html(content);
                                $('.SZY-LIVE-MESSAGE-SECOND').addClass('show');
                                setTimeout(function(){
                                    $('.SZY-LIVE-MESSAGE-SECOND').removeClass('show');
                                },2000);
                                break;
                            case 'live_close_get':
                                // 关闭直播
                                window.location.reload();
                                break;
                            case 'live_out_set': // 退出直播间
                                //$('.SZY-LIVE-MESSAGE-FIRST').append('<div class="come-user show">' + data['content'] + '</div>');
                                break;
                            default:
                                break;
                        }
                    },
                    // 关闭连接
                    onclose: function(event) {
                        // 关闭定时器
                        if (this.interval_id != null) {
                            clearInterval(this.interval_id);
                            this.interval_id = null;
                        }
                        // 记录日志
                        this.log("已经与服务器断开连接，当前连接状态：" + this.readyState);
                        // 断重连
                        if (szy_websocket_connection_interval > 0) {
                            this.log((szy_websocket_connection_interval / 1000) + "秒后尝试重新连接...");
                            setTimeout(function() {
                                link_websocket();
                            }, szy_websocket_connection_interval);
                        }
                    },
                });
            }else if(ws.readyState == 1){
                ws.send({
                    url : url,
                    user_id: user_id,
                    user_name: user_name,
                    room_id: room_id,
                    type: 'live_login_set'
                });
            }
        }
        // 连接websocket
        link_websocket();
        function say(){
            //if(is_tourist == 1){
            //    $.msg('游客身份不能发送消息');
            //    return false;
            //}
            var content = $.trim($('input[name="say_content"]').val());
            if (content != '') {
                var color = getColorByRandom();
                if($('.SZY-LIVE-MESSAGE-THIRD')[0].scrollTop + $('.SZY-LIVE-MESSAGE-THIRD').height() >= ($('.SZY-LIVE-MESSAGE-THIRD')[0].scrollHeight-10)){
                    $('.SZY-LIVE-MESSAGE-THIRD').append('<li class="writer-item"><span class="nick-name" style="color:'+color+'">' + user_name + '</span><span>说：' + content + '</span></li>');
                    $('.SZY-LIVE-MESSAGE-THIRD').scrollTop($('.SZY-LIVE-MESSAGE-THIRD')[0].scrollHeight);
                }else{
                    $('.SZY-LIVE-MESSAGE-THIRD').append('<li class="writer-item"><span class="nick-name" style="color:'+color+'">' + user_name + '</span><span>说：' + content + '</span></li>');
                }
                $('input[name="say_content"]').val('');
                var message = {};
                message.type = 'live_say_set';
                message.room_id = room_id
                message.user_id = user_id;
                message.user_name = user_name;
                message.user_headimg = user_headimg;
                message.content = content;
                ws.send(JSON.stringify(message));
                $('.SZY-LIVE-MESSAGE-THIRD').scrollTop($('.SZY-LIVE-MESSAGE-THIRD')[0].scrollHeight);
                $('.chatting-con').removeClass('chatting').addClass('fixed-chatting');
                $('.cart-box').removeClass('hide');
                $('.send-btn2').addClass('hide');
                $('.send-btn1').removeClass('hide');
            }
            return false;
        }
        $('.goods-explain').click(function(){
            if($(this).hasClass('disabled')){
                return false;
            }
            if(is_tourist == 1){
                $.msg('游客身份不能发送消息');
                return false;
            }
            var goods_id = $(this).data('goods_id');
            var index = $(this).data('index');
            var content = '请主播讲解一下'+index+'号宝贝';
            var message = {};
            message.type = 'live_say_set';
            message.room_id = room_id
            message.user_id = user_id;
            message.user_name = user_name;
            message.user_headimg = user_headimg;
            message.content = content;
            ws.send(JSON.stringify(message));
            $('.SZY-LIVE-MESSAGE-THIRD').scrollTop($('.SZY-LIVE-MESSAGE-THIRD')[0].scrollHeight);
            $.msg('收到请求，稍后主播将为你讲解');
            $(this).addClass('disabled');
        });
        //
        var colorList =['#ff6c74','#017def','#f29445','#5fb760','#b064ec', '#4B0082', '#0000CD','#00BFFF','#40E0D0','#FF0000'];
        var lineList=colorList;
        for(var i=0;i<lineList.length;i++){
            var bgColor = getColorByRandom(colorList);
        }
        function getColorByRandom(){
            var colorIndex = Math.floor(Math.random()*colorList.length);
            var color = colorList[colorIndex];
            return color;
        }
        // 解决苹果返回上一页不刷新的问题
        $(function () {
            var isPageHide = false;
            window.addEventListener('pageshow', function () {
                if (isPageHide) {
                    window.location.reload();
                }
            });
            window.addEventListener('pagehide', function () {
                isPageHide = true;
            });
        })
        //
        var player = new Aliplayer({
            autoplay: true,
            id: 'J_prismPlayer',
            isLive:true,
            playsinline:true,
            width:"100%",
            height:"100%",
            controlBarVisibility:'always',
            cover: '{{ get_image_url($live['live_img']) }}',
            source:"{{ $pull_stream }}",
            // source:"http://image.laravelvip.com/images/videos/site/1/gallery/2019/03/17/15528319959755.mp4",
            useH5Prism:true,
            useFlashPrism:false,
            x5_fullscreen: false, //全屏播放
            x5_type:'h5', //声明启用同层H5播放器，支持的值：h5
            x5_video_position: 'center',
            skinLayout:[
                { name:"bigPlayButton", align:"blabs", x:"70", y:"150" },
                { name: "H5Loading", align: "cc" }
            ]
        }, function (player) {
            console.log("播放器创建了。");
            $('#J_prismPlayer video').attr('poster','{{ get_image_url($live['live_img']) }}');
        });

        player.on('onM3u8Retry',function(){
            alert('主播离开请稍后......');
        });
        player.on('liveStreamStop',function(){
            //console.info('直播失败或已结束');
            $.confirm("直播失败或已结束,是否返回直播列表", function() {
                $.go('/live.html');
            });
        });
        //
        var szy_ajax_user_info_enable = false;
        function autoPlay() {
            wx.config({
                // 配置信息, 即使不正确也能使用 wx.ready
                debug: false,
                appId: '',
                timestamp: 1,
                nonceStr: '',
                signature: '',
                jsApiList: []
            });
            wx.ready(function() {
                var video=$(player.el()).find('video')[0];
                video.play();
            });
        };
        // 解决ios不自动播放的问题
        autoPlay();
        //键盘点击事件判断
        var winHeight = $(window).height();   //获取当前页面高度
        $('body').on('click', '.input-con', function() {
            $(window).resize(function(){
                var thisHeight=$(this).height();
                if(winHeight - thisHeight >50){
                    $('.chatting-con').removeClass('fixed-chatting').addClass('chatting');
                    $('.send-btn1').addClass('hide');
                    $('.send-btn2').removeClass('hide');
                    $('.cart-box').addClass('hide');
                }else{
                    //当软键盘收起，在此处操作
                    $('.input-con').blur();
                    $('.chatting-con').removeClass('chatting').addClass('fixed-chatting');
                    $('.cart-box').removeClass('hide');
                    $('.send-btn2').addClass('hide');
                    $('.send-btn1').removeClass('hide');
                }
            });
        });
        function isIOS(){
            var u = navigator.userAgent;
            var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/); //ios终端
            return isiOS;
        }
        function iosInput() {
            if(isIOS()){
                $('.live-bottom').css('position','absolute');
                //解决第三方软键盘唤起时底部input输入框被遮挡问题
                var bfscrolltop = document.body.scrollTop;
                //获取软键盘唤起前浏览器滚动部分的高度
                $(".input-con").focus(function(){
                    //在这里‘input.inputframe’是我的底部输入栏的输入框，当它获取焦点时触发事件
                    interval = setInterval(function(){
                        //设置一个计时器，时间设置与软键盘弹出所需时间相近
                        document.body.scrollTop = document.body.scrollHeight;
                        $('.chatting-con').removeClass('fixed-chatting').addClass('chatting');
                        $('.cart-box').addClass('hide');
                        $('.send-btn1').addClass('hide');
                        $('.send-btn2').removeClass('hide');
                        //获取焦点后将浏览器内所有内容高度赋给浏览器滚动部分高度
                    },100)
                }).blur(function(){
                    //设定输入框失去焦点时的事件
                    clearInterval(interval);
                    //清除计时器
                    var _val = $('.input-con').val();
                    if(_val.length == undefined || _val == ''){
                        $('.chatting-con').removeClass('chatting').addClass('fixed-chatting');
                        $('.send-btn2').addClass('hide');
                        $('.send-btn1').removeClass('hide');
                    }
                    document.body.scrollTop = bfscrolltop;
                });
            }
        }
        iosInput();
        if($.isFunction(window['isWeiXinAndIos']) == false){
            function isWeiXinAndIos() {
                var ua = '' + window.navigator.userAgent.toLowerCase()
                var isWeixin = /MicroMessenger/i.test(ua)
                var isIos = /\(i[^;]+;( U;)? CPU.+Mac OS X/i.test(ua)
                return isWeixin && isIos
            }
            var myFunction = null;
            var isWXAndIos = isWeiXinAndIos();
            if (isWXAndIos) {
                document.body.addEventListener('focusin', () => {
                    clearTimeout(myFunction);
                });
                document.body.addEventListener('focusout', () => {
                    clearTimeout(myFunction);
                    myFunction = setTimeout(function() {
                        window.scrollTo({
                            top: 0,
                            left: 0,
                            behavior: 'smooth'
                        });
                    }, 200);
                });
            }
        }
        //
    </script>

@stop
