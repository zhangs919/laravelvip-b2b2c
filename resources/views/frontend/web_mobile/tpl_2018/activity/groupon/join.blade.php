@extends('layouts.base')

{{--header_css--}}
@section('header_css')
    <link href="/css/group_buy.css?v=1.4" rel="stylesheet">
    <link href="/css/common.css?v=1.4" rel="stylesheet">
    <link href="/css/together_group-result.css?v=1.4" rel="stylesheet">
@stop

{{--header_js--}}
@section('header_js')

@stop


@section('content')

    <!---团购首页头部--->
    <header>
        <div class="header">
            <div class="header-left">
                <a class="sb-back" href="javascript:history.back(-1)" title="返回">
                    <i class="iconfont">&#xe606;</i>
                </a>
            </div>
            <div class="header-middle">
                参团详情
            </div>
            <div class="header-right">
                <!-- 控制展示更多按钮 -->
                <aside class="show-menu-btn">
                    <div class="show-menu" id="show_more">
                        <a href="javascript:void(0)">
                            <i class="iconfont">&#xe6cd;</i>
                        </a>
                    </div>
                </aside>
            </div>
        </div>
    </header>
    {{--引入右上角菜单--}}
    @include('layouts.partials.right_top_menu')
    <!-- banner模块 _star -->
    <!-- banner _star -->
    <div class="swiper-container">
        <div class="swiper-wrapper">
        </div>
    </div>
    <script type="text/javascript">
        //
    </script>
    <!-- banner模块 _end -->
    <!-- 活动展示 _star -->
    <section>
        <div class="goods-box">
            <div class="goods-info">
                <a href="http://m.xxxx.com/goods-27.html">
                    <div class="goods-img">
                        <img alt="" src="http://xxxx/system/config/default_image/default_goods_image_0.gif?x-oss-process=image/resize,m_pad,limit_0,h_220,w_220" />
                    </div>
                </a>
                <div class="goods-detail">
                    <a href="http://m.xxxxx.com/goods-27.html">
                        <p class="goods-name">aaaa</p>
                    </a>
                    <p class="goods-price">
                    <span>
                        <b class="price-color">￥0.10</b>
                    </span>
                        <span class="group-num">3人团</span>
                    </p>
                    <!-- 当组团成功时，给下面的div标签追加class值为 “success” ； 反之，组团不成功，给下面的div标签追加class值为 fail” -->
                    <div class="img-result success"></div>
                </div>
            </div>
        </div>
        <div class="group-users">
            <div class="group-users-info">
                <!-- 当参团人数5人以上（包括5人）给下面的div标签追加class值为 “users-list-many” -->
                <div class="users-list users-list-many">
                    <a class="users-list-item">
                        <img alt="" src="http://images.xxxx.com/system/config/default_image/default_user_portrait_0.png" />
                        <i>团</i>
                    </a>
                </div>
                <!---拼团中-->
                <!--拼团成功-->
                <div class="group-success-con">
                    <div class="group-success-tip">
                        <i class="iconfont">&#xe62c;</i>
                        拼团成功
                    </div>
                </div>
                <a class="invite-btn invite-join bg-color" href="/">去首页逛逛</a>
                <a class="invite-btn" href="/groupon.html">查看更多拼团</a>
                <!--分享朋友圈页面显示内容 _end-->
            </div>
        </div>
        <!--参团时间-->
        <div class="join-time">
            <span class="title">开团时间</span>
            <span class="time-info">2024-05-16 21:50:10</span>
        </div>
        <!--拼团玩法-->
        <div class="play-rule">
            <p class="paly-rule-title">
                <span class="title">拼团玩法</span>
                <a href="/groupon-rule-22" class="see-info">
                    查看详情
                    <i class="iconfont">&#xe607;</i>
                </a>
            </p>
            <ul class="paly-rule-step">
                <li class="item item-active">
                    选择
                    <br>
                    心仪商品
                </li>
                <li class="item item-active">
                    支付开团
                    <br>
                    或参团
                    <span class="iconfont icon">&#xe607;</span>
                </li>
                <li class="item item-active">
                    等待好友
                    <br>
                    参团支付
                    <span class="iconfont icon">&#xe607;</span>
                </li>
                <li class="item item-active">
                    达到人数
                    <br>
                    拼团成功
                    <span class="iconfont icon">&#xe607;</span>
                </li>
            </ul>
        </div>
    </section>
    <!--分享朋友圈弹框 _start 弹出层显示就增加样式show-->
    <div class="body-mask">
        <div class="mask-share">
            <p>点击右上角按钮</p>
            <p>将它分享给您的好友吧</p>
        </div>
    </div>
    <!--分享朋友圈弹框 _end-->
    <!--面对面扫描弹出层 start-->
    <div class="group-qrcode" style="display: none">
        <div class="qrcode-container">
            <div class="qrcode">
                <div class="qrcode-img">
                    <img src="http://m.xxxx.com/mj90i2j/activity/groupon/qrcode.html?group_sn=xxxxxxxx" style="display: block;">
                </div>
            </div>
            <span class="qrcode-text">用手机微信扫一扫二维码，参加我的团</span>
        </div>
    </div>
    <!--面对面扫描弹出层 end-->
    <!-- 分享 -->
    <script src="//res.wx.qq.com/open/js/jweixin-1.3.2.js"></script>
    <script type="text/javascript">
        //
    </script>
    <!--分享成功弹出层 start-->
    <div class="group-share-popup" style="display: none">
        <div class="mask-group-share"></div>
        <div class="group-share-body">
            <div class="group-share-body-con">
                <div class="title">
                    <i class="icon"></i>
                    <span>分享成功</span>
                </div>
                <p class="desc">继续分享才能大大提高成团率哦~</p>
                <div class="confirm-button">
                    <a href="javascript:;">继续分享</a>
                </div>
                <div class="hint-title">
                    <p>好货提示</p>
                </div>
                <p class="hint-text">90%的人都在这发现了心仪好货~</p>
                <div class="cancel-button">
                    <a href="/index.html">前往商城首页</a>
                </div>
            </div>
        </div>
    </div>
    <!--分享成功弹出层 end-->
    <div class="mask-div"></div>
    <div class="choose-attribute-main choose-attr-box" id="choose_attr" style="display: none">
        <div class="choose-attribute-header clearfix">
            <div class="choose-attribute-pic">
                <img class="SZY-GOODS-IMAGE-THUMB" src="http://images.xxxx.com/system/config/default_image/default_goods_image_0.gif?x-oss-process=image/resize,m_pad,limit_0,h_450,w_450" />
            </div>
            <div class="attribute-header-right">
                <span class="goodprice price-color choose-result-price SZY-GOODS-PRICE"> ￥0.10 </span>
                <p>
                    <i class="SZY-GOODS-NUMBER">库存：87件</i>
                    <i>（每人限购5件）</i>
                </p>
            </div>
            <a class="choose-attribute-close" href="javascript:close_choose_spec();" title="关闭"> </a>
        </div>
        <div class="choose-attribute-content">
            <div class="attr-list choose SZY-GOODS-SPEC-ITEMS">
                <!-- 商品属性 -->
                <div class="goods-buy-number">
                    <div class="title1">购买数量</div>
                    <div class="item1">
                        <div class="goods-num amount amount-btn cart-box">
                        <span class="decrease amount-minus">
                            <i class="row"></i>
                        </span>
                            <input type="text" class="amount-input num" value="1" data-amount-max="87" maxlength="8" title="请输入购买量" onFocus="this.blur()">
                            <span class="increase amount-plus">
                            <i class="row"></i>
                            <i class="col"></i>
                        </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="choose-foot">
            <a href="javascript:void(0)" class="SZY-BUY-BUTTON bg-color">确定</a>
        </div>
    </div>
    <script id="SZY_SKU_LIST" type="text">
{"":{"sku_id":"61","spec_ids":"","goods_price":"98.00","goods_number":"998","spec_names":null}}
</script>
    <script type="text/javascript">
        //
    </script>
    <!-- 活动展示 _end -->
    {{--引入底部菜单--}}
    @include('frontend.web_mobile.modules.library.site_footer_menu')
    <!-- 第三方流量统计 -->
    <div style="display: none;"></div>
    <!-- 底部 _end-->
    <script type="text/javascript">
        //
    </script>
    <script type="text/javascript">
        //
    </script>
    <script src="/assets/d2eace91/js/swiper/swiper.jquery.min.js?v=1.1"></script>
    <script src="/assets/d2eace91/min/js/core.min.js"></script>
    <script src="/js/app.frontend.mobile.min.js"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js?v=1.1"></script>
    <script>
        $().ready(function() {
            if (isWeiXin()) {
                var url = location.href.split('#')[0];
                var share_url = "";
                if (share_url == '') {
                    share_url = url;
                }
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
                                jsApiList: ['onMenuShareTimeline', 'onMenuShareAppMessage']
                            });
                        }
                    }
                });
                // 微信JSSDK开发
                wx && wx.ready(function() {
                    // 分享给朋友
                    wx.onMenuShareAppMessage({
                        title: 'xx', // 标题
                        desc: 'xx', // 描述
                        imgUrl: '', // 分享的图标
                        link: share_url,
                        fail: function(res) {
                            alert(JSON.stringify(res));
                        },
                        success: function() {
                            //$(".group-share-popup").show();
                        },
                    });
                    // 分享到朋友圈
                    wx.onMenuShareTimeline({
                        title: 'xx', // 标题
                        desc: 'xx', // 描述
                        imgUrl: '', // 分享的图标
                        link: share_url,
                        fail: function(res) {
                            alert(JSON.stringify(res));
                        },
                        success: function() {
                            //$(".group-share-popup").show();
                        },
                    });
                });
            }
        });
        //
        var sku_list = $.parseJSON($("#SZY_SKU_LIST").html());
        var sku_freights = [];
        //当前选中的skuid
        var sku_id = "61";
        var getSkuData = null;
        var getSkuInfo = null;
        //显示属性弹层
        function show_choose_spec(){
            $('.mask-div').show();
            $('#choose_attr').show();
            $('#choose_attr').removeClass('spec-menu-hide').addClass('spec-menu-show');
            setTimeout(function(){
                $('.choose-attribute-close').addClass('show');
            },500);
            $('.main').height($(window).height()).css({
                overflow: "hidden"
            });
        }
        //隐藏属性弹层
        function close_choose_spec() {
            $(".mask-div").hide();
            $('#choose_attr').hide();
            $('#choose_attr').removeClass('spec-menu-show').addClass('spec-menu-hide');
            $('.choose-attribute-close').removeClass('show');
            $(".main").removeAttr("style");
        }
        var is_share = "0";
        if(is_share == 1) {
            $('.main').height($(window).height()).css({
                overflow: "hidden"
            }); //禁止页面滚动条
            $(".body-mask").show();
            if (window.__wxjs_environment == 'miniprogram') {
                $(".body-mask").addClass('miniprogram-mask');
            }
        }
        var getSkuInfo = null;
        $().ready(function() {
            // 步进器
            var goods_number_amount = $(".amount-input").amount({
                value: '1',
                min: '1',
                max: '87',
                change: function(element, value) {
                },
                max_callback: function() {
                    $.msg("最多只能购买" + this.max + "件");
                },
                min_callback: function() {
                    $.msg("商品数量必须大于" + (this.min - 1));
                }
            });
            // 检查SKU组合
            $.cart.checkSkus($(".SZY-GOODS-SPEC-ITEMS"), sku_list);
            // 绑定点击规格事件
            var specObj = $.cart.checkSpecs({
                sku_list: sku_list,
                container: $(".SZY-GOODS-SPEC-ITEMS"),
                objects: $(".SZY-GOODS-SPEC-ITEMS").find("li"),
                // 处理选中的SKU
                done_callback: function(sku){
                    // 设置当前选中的 sku_id
                    sku_id = sku.sku_id;
                    // 更新 sku
                    setSkuInfo(sku);
                    // 标题
                    $("title").html(sku.sku_name);
                },
                // 处理未选中SKU时的事件
                fail_callback: function(result){
                    // SKU不存在
                    setSkuInfo(false);
                    // 标题
                    $("title").html("aaaa");
                },
            });
            getSkuData = specObj.getSkuData;
            getSkuInfo = specObj.getSkuInfo;
            // 立即购买
            $(".buy-goods").click(function() {
                if ($(this).hasClass("disabled")) {
                    return;
                }
                var sku_list_count = 1;
                if(sku_list_count > 1){
                    for(var i in sku_list){
                        if(sku_list[i].sku_id == sku_id){
                            getSkuInfo({
                                sku_id: sku_id
                            }).then(function(sku_obj){
                                setSkuInfo(sku_obj);
                                $("title").html(sku_obj.sku_name);
                            });
                        }
                    }
                    show_choose_spec();
                }else{
                    //var group_sn = $(this).data("id");
                    //group_buy(group_sn);
                    show_choose_spec();
                }
            })
            //规格属性选择后确认
            $(".SZY-BUY-BUTTON").click(function() {
                var group_sn = $(".buy-goods").data("id");
                group_buy(group_sn);
            })
            // 分享朋友圈
            $(".share-btn").click(function() {
                $('.main').height($(window).height()).css({
                    overflow: "hidden"
                }); //禁止页面滚动条
                $(".body-mask").show();
                if (window.__wxjs_environment == 'miniprogram') {
                    $(".body-mask").addClass('miniprogram-mask');
                }
            });
            $(".body-mask").click(function() {
                $(".body-mask").hide();
                if (window.__wxjs_environment == 'miniprogram') {
                    $(".body-mask").removeClass('miniprogram-mask');
                }
                $(".main").removeAttr("style"); //恢复页面滚动条
            })
            $(".scan-qrcode").click(function() {
                $('.main').height($(window).height()).css({
                    overflow: "hidden"
                }); //禁止页面滚动条
                $(".group-qrcode").show();
            });
            $(".group-qrcode").click(function() {
                $(".group-qrcode").hide();
                $(".main").removeAttr("style"); //恢复页面滚动条
            })
        });
        function group_buy(group_sn){
            var data = {};
            data.group_sn = group_sn;
            // 商品特殊属性
            data.goods_id = "27";
            var number = $(".amount-input").val();
            $.cart.quickBuy(sku_id, number, data);
        }
        // 设置SKU信息
        function setSkuInfo(sku) {
            if (sku == undefined || sku == null || sku == false) {
                $(".SZY-BUY-BUTTON").addClass("disabled");
                $('.SZY-BUY-BUTTON').text('库存不足');
                $(".SZY-GOODS-NUMBER").html("库存不足");
                return;
            }
            var goods_number = sku.goods_number;
            // 商品规格
            $(".SZY-GOODS-SPEC").html("规格：<i class='i_dd'>"+sku.spec_attr_value+"</i>");
            if (sku.is_default == 1) {
                $(".SZY-GOODS-IMAGE-THUMB").attr("src", sku.sku_images[0][1]);
            }
            // 售价
            if(sku.activity){
                $(".SZY-GOODS-PRICE").html(sku.activity.act_price_format);
            }else{
                $(".SZY-GOODS-PRICE").html(sku.goods_price_format);
            }
            // 库存
            if (goods_number > 0) {
                if ("1" == 1) {
                    $(".SZY-GOODS-NUMBER").html("库存：" + goods_number + "件");
                }else{
                    $(".SZY-GOODS-NUMBER").html("");
                }
            } else {
                $(".SZY-GOODS-NUMBER").html("库存不足");
            }
            if (goods_number == 0) {
                $(".SZY-BUY-BUTTON").addClass("disabled");
                $(".SZY-BUY-SELECT").addClass("disabled");
                $('.SZY-BUY-BUTTON').text('库存不足');
            } else {
                $(".SZY-BUY-BUTTON").removeClass("disabled");
                $(".SZY-BUY-SELECT").removeClass("disabled");
                $('.SZY-BUY-BUTTON').text('确定');
            }
        }
        //
        var swiper;
        $(function(){
            swiper = new Swiper('.swiper-container', {
                pagination: '.swiper-pagination',
                loop : true,
                paginationClickable: true,
                autoplay: 3000,
                autoplayDisableOnInteraction: false
            })
        });
        //
        $().ready(function() {
            updateEndTime();
        });
        //倒计时函数
        function updateEndTime() {
            var date = new Date();
            var time = date.getTime(); //当前时间距1970年1月1日之间的毫秒数
            $(".settime").each(function(i) {
                var endDate = this.getAttribute("endTime"); //结束时间字符串
                //转换为时间日期类型
                var endDate1 = eval('new Date(' + endDate.replace(/\d+(?=-[^-]+$)/, function(a) {
                    return parseInt(a, 10) - 1;
                }).match(/\d+/g) + ')');
                var endTime = endDate1.getTime(); //结束时间毫秒数
                var lag = (endTime - time) / 1000; //当前时间和结束时间之间的秒数
                if (lag > 0) {
                    var second = Math.floor(lag % 60);
                    var minite = Math.floor((lag / 60) % 60);
                    var hour = Math.floor((lag / 3600) % 24);
                    var day = Math.floor((lag / 3600) / 24);
                    $(this).html(day + "天" + hour + "时" + minite + "分" + second + "秒");
                } else
                    $(this).html("团购已经结束啦！");
            });
            setTimeout("updateEndTime()", 1000);
        }
        //
        $().ready(function() {
        })
        //
    </script>

@stop