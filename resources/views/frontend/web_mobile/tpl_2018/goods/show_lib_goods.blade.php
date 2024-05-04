@extends('layouts.base')

{{--header_css--}}
@section('header_css')
    <link href="/css/goods.css?v=3" rel="stylesheet">
    <link href="/css/bonus_message.css" rel="stylesheet">
    <link href="/css/distributor-reg-check.css" rel="stylesheet">
    <link href="/css/template.css?v=3" rel="stylesheet">
    <link href="/css/login.css" rel="stylesheet">
@stop

{{--header_js--}}
@section('header_js')

@stop



@section('content')

    <!-- 内容 -->
    <div id="index_content">
        <!--头部多门店切换-->
        <div class="goods-header fixed-header">
            <!-- -->
            <div class="goods-header-left">
                <a href="javascript:history.back(-1)" class="iconfont icon-fanhui1"></a>
            </div>
            <ul class="goods-header-nav ub">
                <li class="cur ub-f1">商品</li>
                <li class="ub-f1">详情</li>
            </ul>
            <div class="goods-header-right">
                <a class="cart-btn cartbox " href="/cart.html">
                    <em class="SZY-CART-COUNT bg-color">0</em>
                </a>
                <!-- 控制展示更多按钮 -->
                <aside class="show-menu-btn">
                    <div class="show-menu iconfont icon-gengduo3" id="show_more"></div>
                </aside>
            </div>
        </div>
    {{--引入右上角菜单--}}
    @include('layouts.partials.right_top_menu')
    <!--商品-->
        <div class="goods-content user-goods-ka">
            <div class="swiper-container swiper-container-horizontal" id="goods_pic">
                <div class="swiper-wrapper SZY-GOODS-IMAGE">
                    @foreach($sku['sku_images'] as $v)
                        <div class="swiper-slide">
                            <a href="javascript:void(0)">
                                <img data-src="{{ $v[1] }}" src="/images/m_blank.png" class="swiper-lazy">
                                <div class="swiper-lazy-preloader"></div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>

                @if(!empty($goods['goods_video']))
                <!-- 视频 -->
                    <a class="video-icon" href="javascript:void(0)"></a>
                @endif

            </div>
            <!-- 免费购 -->
            <!-- 商品团购倒计时 -->
            <!--团购未开始样式-->
            <!-- 批发商品 -->
            <div class="goods-info bdr-bottom">
                <div class="goods-info-top">
                    <h3>
                        <span class="SZY-GOODS-NAME">{{$sku['sku_name'] }}</span>
                    </h3>
                </div>
                <span class="goods-depict color">{{ $goods['goods_subname'] }}</span>
                <div class="goods-price">
                    <div class="now-prices">
                        <em class="SZY-GOODS-PRICE price-color">￥{{ $sku['goods_price'] }}</em>
                        <del class="SZY-MARKET-PRICE" @if(empty($sku['market_price']))style="display: none;"@endif>￥{{ $sku['market_price'] }}</del>
                    </div>
                    <span class="sold">销量：{{ $goods['sale_num'] }}件</span>
                </div>
                <!--会员权益卡 内容 start-->
                <!--会员权益卡 内容 end-->
                <!-- 商品赠品 -->
                <div class="SZY-GIFT-LIST">
                </div>
                <!-- 红包 -->
                <!-- 促销活动弹出层 _start -->
                <div class="f_block spec-menu-hide" id="proms_coupon">
                    <div class="prom-coupon">
                        <div class="discount-coupon-header">
                            <h2>促销</h2>
                            <a class="choose-attribute-close" href="javascript:void(0)" onclick="close_choose_proms();"></a>
                        </div>
                        <ul class="coupon-list">
                            <li class="items SZY-MEMBER-PRICES" style="display: none">
                                <div class="pro-item">
                                    <div class="pro-type">
                                        <span class="pro-type-name">会员特价</span>
                                    </div>
                                    <div class="pro-info">
                                        <span class="SZY-MEMBER-MESSAGE"></span>
                                    </div>
                                </div>
                            </li>
                            <li class="items SZY-RANK-PRICES" style="display: none;">
                                <div class="pro-item more-member-info">
                                    <div class="pro-type">
                                        <span class="pro-type-name">会员特价</span>
                                    </div>
                                    <div class="pro-info">
                                        <span class="SZY-RANK-MESSAGE"></span>
                                        <div class="member-rules-bd">
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <!-- <li class="items hide">
                                <div class="pro-item">
                                    <div class="pro-type">
                                        <span class="pro-type-name">限购</span>
                                    </div>
                                    <div class="pro-info">
                                        <p>购买1~2件时享受折扣，超出数量以结算为准</p>
                                    </div>
                                </div>
                            </li> -->
                            <!-- -->
                            <!-- 搭配套餐弹出层 _start -->
                            <!-- 搭配套餐弹出层 _end -->
                            <!-- 京豆_start -->
                            <li class="items SZY-INTEGRAL-ITEM" style="display: none">
                                <div class="pro-item">
                                    <div class="pro-type">
                                        <span class="pro-type-name">积分</span>
                                    </div>
                                    <div class="pro-info">
                                        <p></p>
                                    </div>
                                </div>
                            </li>
                            <!-- 京豆_end -->
                        </ul>
                    </div>
                </div>
                <!-- 促销活动弹出层 _end -->
            </div>
            <div class="blank-div"></div>
            <!--已选-->
            {{--判断 是否显示--}}
            @if(!empty($goods['spec_list']))
            <div class="selected-attr SZY-GOODS-SPEC ub" onClick="select_spec('select')">
                <span>规格</span>
                <i class="i_dd ub-f1">
                    {{ $sku['spec_attr_value'] }}
                </i>
                <span class="more">
        <i class="iconfont">&#xe607;</i>
    </span>
            </div>
            @endif
            <!-- 虚拟商品判断 -->
            <!-- 门店展示 -->
            <div id="store_exhibition"></div>
            <!-- 拼团活动_start -->
            <!-- 拼团活动_end -->
            <!-- 砍价活动_start -->
            <!-- 砍价活动_end -->
            <!-- 店铺信息 _star-->
            <!-- 店铺信息 _end-->
            <div class="scroll-tips" style="display: none">
                <div class="line"></div>
                <span class="text">
            <i class="icon"></i>
            点击进入商品详情
        </span>
            </div>
        </div>
        <!--详情-->
        <div class="blank-div"></div>
        <div class="goods-desc-main user-goods-ka" style="display: none;">
            <ul class="goods-details-nav clearfix">
                <li class="current">商品详情</li>
                <li>规格参数</li>
            </ul>
            <div class="product_images product_desc goods-details-tab" id="product_desc">
                <div class="detail-content goods-detail-content product_tab_chr">
                    <div class="more-loader-spinner">
                        <img src="/images/loading.gif" width="20" height="20">
                        数据加载中...
                    </div>
                </div>
                <div class="tip-space-box hide">
                    <div class="tip-space">
                        <div class="loaded-bg">我是有底线的</div>
                    </div>
                    <div class="blank-div"></div>
                </div>
            </div>
            <div class="goods-details-tab" style="display: none">
                <!-- 商品规格参数 -->
                <table class="attribute-table">
                    <tbody>
                    <tr>
                        <td>商品名称</td>
                        <td>{{ $goods['goods_name'] }}</td>
                    </tr>
                    <tr>
                        <td>商品编号</td>
                        <td>{{ $goods['goods_id'] }}</td>
                    </tr>
                    <tr>
                        <td>店铺</td>
                        <td>{{ $shop_info['shop']['shop_name'] }}</td>
                    </tr>

                    <!-- 商品规格 -->
                    @if(!empty($goods['spec_list']))
                        @foreach($goods['spec_list'] as $v)
                            <tr>
                                <td>{{ $v['attr_name'] }}</td>
                                <td>

                                    {{ implode(' ', array_column($v['attr_values'], 'attr_value')) }}

                                </td>
                            </tr>
                        @endforeach
                    @endif


                    {{--商品属性--}}
                    @if(!empty($goods['attr_list']))
                        @foreach($goods['attr_list'] as $v)
                            <tr>
                                <td>{{ $v['attr_name'] }}</td>
                                <td>

                                    {{ $v['attr_values'] }}

                                </td>
                            </tr>
                        @endforeach
                    @endif

                    </tbody>
                </table>
            </div>
        </div>
        <!--用户评价-->
        <div class="goods-evaluate user-goods-ka hide" id="goods-evaluate"></div>
        <!-- 服务承诺 -->
        <!--红包弹出层-->
        <div class="f_block spec-menu-hide" id="select_coupon">
            <div class="discount-coupon">
                <div class="discount-coupon-header">
                    <h2>
                        领取红包
                        <a class="choose-attribute-close" href="javascript:void(0)" onclick=" close_choose_coupon();"></a>
                    </h2>
                </div>
                <div class="coupon-list">
                    <ul class="coupon-item-ing">
                    </ul>
                </div>
            </div>
        </div>
        <!--微信分享弹出层-->
        <div class="give-share-popup hide" onclick="colse_bdshare_popup()">
            <img src="/images/give-share-popup.png">
        </div>
        <!--小程序分享弹出层-->
        <div class="mini-program-share-popup hide">
            <img src="/images/mini-program-share-popup.png">
        </div>
        <script type="text/javascript">
            //
        </script>
        <!-- 分享 -->
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
                @if(!empty($user_info))
                    var share_url = "{{ route('mobile_show_goods',['goods_id'=>$goods['goods_id']]) }}?user_id={{ $user_info['user_id'] }}";
                @else
                    var share_url = "";
                @endif

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
                    var share_url = "{{ route('mobile_show_goods',['goods_id'=>$goods['goods_id']]) }}?user_id={{ $user_info['user_id'] }}";
                @else
                    var share_url = "";
                @endif

                if (share_url == '') {
                    share_url = url;
                }
                //
                if (isWeiXin()) {
                    $.ajax({
                        type: "GET",
                        url: "/site/get-weixinconfig.html",
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
                wx.ready(function() {
                    // 分享给朋友
                    wx.onMenuShareAppMessage({
                        title: '{{ $seo_title }}', // 标题
                        desc: '{{ $seo_description }}', // 描述
                        imgUrl: '{{ get_image_url($seo_image) }}', // 分享的图标
                        link: share_url,
                        fail: function(res) {
                            alert(JSON.stringify(res));
                        }
                    });

                    // 分享到朋友圈
                    wx.onMenuShareTimeline({
                        title: '{{ $seo_title }}', // 标题
                        desc: '{{ $seo_description }}', // 描述
                        imgUrl: '{{ get_image_url($seo_image) }}', // 分享的图标
                        link: share_url,
                        fail: function(res) {
                            alert(JSON.stringify(res));
                        }
                    });
                    // 小程序分享
                    wx && wx.miniProgram.getEnv(function(res) {
                        if (res.miniprogram) {
                            wx.miniProgram.postMessage({
                                data: {
                                    title: '{{ $seo_title }}',
                                    imgUrl: '{{ get_image_url($seo_image) }}'
                                }
                            });
                        }
                    });
                    // window.history.replaceState(null, document.title, url);
                });
                // 返回定位选项卡历史位置——————————————————————————START
                $('body').on('click', ".scroll-y-menu li", function (res){
                    var parent_id = $(this).parents('.scroll-y-menu').parent().parent().prop('id');
                    $('#' + parent_id + ' .scroll-y-menu li').each(function (n,j){
                        if($(this).hasClass('active'))
                        {
                            localStorage.setItem("History_tab", [parent_id, n]);
                        }
                    })
                });
                var history_tab = localStorage.getItem('History_tab');
                if(history_tab && history_tab != '' && typeof(history_tab) != 'undefined' && typeof(history_tab) != 'null')
                {
                    var history_arr = history_tab.split(',');
                    var history_uid = history_arr[0];
                    var history_li = history_arr[1];
                    //;
                    var obj = $("#" + history_uid + " .scroll-y-menu li");
                    console.log(obj)
                    console.log(history_uid);
                    console.log(history_li);
                    if(obj.eq(history_li).length > 0)
                    {
                        obj.removeClass('active');
                        var floor_li = $("#" + history_uid + " div.tab-con");
                        localStorage.setItem("History_tab", '')
                        floor_li.hide();
                        floor_li.eq(history_li).show()
                        console.log(history_li)
                        obj.eq(history_li).addClass('active')
                    }
                }
                //——————————————————————————END————————————————————————
            });
        </script>
        <!-- 多门店是否进行商品售罄推荐-start -->
        <!-- 多门店是否进行商品售罄推荐-end -->
        <!--分享选择弹出-->
        <div class="share-select-con spec-menu-hide">
            <div class="share-select-items">
                <!-- -->
                @if(is_weixin())
                    <div class="share-item share-link" onClick="bdshare_popup()">
                        <img src="/images/goods/icon-share-weixin.png">
                        <span class="select-text">微信好友</span>
                    </div>
                @endif
                <div class="share-item qr-code">
                    <img src="/images/goods/icon-share-card.png">
                    <span class="select-text">商品海报</span>
                </div>
            </div>
            <div class="share-select-footer">
                <a href="javascript:void(0)" class="btn-cancel">取消</a>
            </div>
        </div>
        <script type="text/javascript">
            //
        </script>
        <script type="text/javascript">
            //
        </script>
        <!-- 预售规则弹出层end -->
        <script type="text/javascript">
            //
        </script>
        <!--底部菜单 start-->
        <div class="goods-footer-nav bdr-top">
            <a href="/" class="nav-button">
                <em class="goods-index-nav"></em>
                <span>店铺</span>
            </a>
            <a href="javascript:void(0);" class="nav-button">
                <em class="goods-collect-nav"></em>
                <span>收藏</span>
            </a>
            <a href="javascript:void(0);" class="nav-button">
                <em class="goods-message-nav"></em>
                <span>客服</span>
            </a>
            <div class="btn-group">
                <dl class="ub">
                    <dd class="flow">
                        <a href="javascript:void(0)" class="button" onClick="select_spec('lib-goods')">加入购物车</a>
                    </dd>
                    <dd>
                        <a href="javascript:void(0)" class="button" href="javascript:void(0)" onClick="select_spec('buy-goods')"">立即购买</a>
                    </dd>
                </dl>
            </div>
        </div>
        <div class="choose-attribute-mask"></div>
        <div class="choose-attribute-main" id="choose_attr">
            <div class="choose-attribute-header clearfix">
                <div class="choose-attribute-pic">
                    <img class="SZY-GOODS-IMAGE-THUMB" src="{{ get_image_url($sku['sku_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_450,w_450" />
                </div>
                <div class="attribute-header-right">
                    <span class="goodprice price-color choose-result-price SZY-GOODS-PRICE"> ￥{{ $sku['goods_price'] }} </span>
                    <p>
                    </p>
                    @if(!empty($sku['spec_attr_value']))
                        <span class="choose-result-attr SZY-GOODS-SPEC">
                        已选：
                        <i>
                            {{ $sku['spec_attr_value'] }}
                        </i>
                    </span>
                    @endif
                </div>
                <a class="choose-attribute-close" href="javascript:close_choose_spec();" title="关闭"> </a>
            </div>
            <div class="choose-attribute-content">
                <div class="attr-list choose SZY-GOODS-SPEC-ITEMS">

                    {{--商品规格--}}
                    @if(!empty($goods['spec_list']))
                        @foreach($goods['spec_list'] as $k=>$v)
                            <dl class="attr">
                                <dt class="dt">{{ $v['attr_name'] }}</dt>
                                <dd class="dd">
                                    <ul>

                                    @foreach($v['attr_values'] as $kk=>$vv)
                                        <!-- 属性值被选中的状态 _start-->
                                            <li class="@if(in_array($vv['spec_id'], $sku['spec_ids'])) selected @endif"
                                                data-spec-id="{{ $vv['spec_id'] }}" data-attr-id="{{ $v['attr_id'] }}" data-is-default="{{ $v['is_default'] }}" data-points-goods="0">
                                                <a href="javascript:void(0);">{{ $vv['attr_value'] }}</a>
                                            </li>
                                            <!-- 属性值被选中的状态 _end-->
                                        @endforeach

                                    </ul>
                                </dd>
                            </dl>
                        @endforeach
                    @endif

                    <div class="goods-buy-number">
                        <div class="title1">购买数量</div>
                        <div class="item1">
                            <div class="goods-num amount amount-btn cart-box">
                                <span class="decrease amount-minus">
                                    <i class="row"></i>
                                </span>
                                <input type="number" class="amount-input num" value="1" data-amount-min="1" data-amount-max="{{ $sku['goods_number'] }}" maxlength="8" title="请输入购买量" onclick="$(this).select();">
                                <span class="increase amount-plus">
                                    <i class="row"></i>
                                    <i class="col"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    @if($goods['goods_moq'] > 0)
                        <div class="purchase-msg color">
                            起订量：
                            <i>{{ $goods['goods_moq'] }}&nbsp;件</i>
                        </div>
                    @endif

                    <div style="height: 10px"></div>

                </div>
            </div>
            <div class="choose-foot">
                <a href="javascript:void(0)" class="SZY-BUY-BUTTON bg-color">确定</a>
                <a href="javascript:void(0)" class="SZY-BUY-SELECT button-attr buy-goods">立即购买</a>
                <a href="javascript:void(0)" class="SZY-BUY-SELECT button-attr add-cart">加入购物车</a>
            </div>
        </div>
        <script type="text/javascript">
            //
        </script>
        <!--底部菜单 end-->
        <section class="mask-div" style="display: none;" onclick="close_coupon();"></section>
        <script type="text/javascript">
            //
        </script>
        <!-- 返回顶部 -->
        <a href="javascript:void(0);" class="back-to-top gotop hide"><img src="/images/topup.png"></a>
        <script type="text/javascript">
            //
        </script><!--身份验证-->
        <!--pop-login-main增加show样式为显示状态-->
        <div class="pop-login-main">
            <header id="header" class="header">
                <div class="header-left">
                    <a href="javascript:void(0)" class="sb-back ">
                        <i class="iconfont">&#xe606;</i>
                    </a>
                </div>
                <div class="header-middle">身份验证</div>
                <div class="header-right"></div>
            </header>
            <div class="middle-content m-t-0">
                <div class="form-group-box">
                    <!--  用户名  -->
                    <div class="form-group form-group-spe">
                        <dl>
                            <dt> <span>手机号：</span> </dt>
                            <dd>
                                <div class="form-control-box">
                                    <input type="text" class="form-control error"  value="" placeholder="" autocomplete="off" aria-invalid="true">
                                </div>
                            </dd>
                        </dl>
                    </div>
                    <!--  验证码  -->
                    <div class="form-group captcha">
                        <dl class="form-group-spe captcha" id="o-authcode">
                            <dt>验证码</dt>
                            <dd>
                                <div class="form-control-box input_box">
                                    <i class="icon"></i>
                                    <input type="text" id="captcha_sms" name="SmsLoginModel[captcha]" class="text" tabindex="2" placeholder="验证码" />
                                    <label class="captcha"> </label>
                                </div>
                                <span id="captcha-error" data-error-id="captcha" class="form-control-error">
                            <i class="fa fa-warning"></i>
                        </span>
                            </dd>
                        </dl>
                    </div>
                    <!--  动态验证码  -->
                    <div class="form-group form-group-spe">
                        <dl>
                            <dt> <span>动态密码：</span> </dt>
                            <dd>
                                <div class="form-control-box">
                                    <input type="number"  class="text" tabindex="3" placeholder="动态密码" pattern="[0-9]*">
                                    <a id="btn_send_sms_code" href="javascript:void(0);" class="phonecode phonecode1">获取验证码</a> </div>
                            </dd>
                        </dl>
                    </div>
                    <div class="submit-btn">
                        <input type="submit" class="btn-submit" id="login_btn" value="确定">
                    </div>
                </div>
            </div>
        </div><div class="preview-attribute-pic hide"></div>
        <script type="text/javascript">
            //
        </script>
        <!-- 预售倒计时 -->
        <script id="SZY_SKU_LIST" type="text">
            {{--sku list--}}
            {!! json_encode($goods['sku_list']) !!}
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
        <!-- 定位 -->
		<script type="text/javascript">
			window._AMapSecurityConfig = {
				securityJsCode: "{{ sysconf('amap_js_security_code') }}",
			};
		</script>
        <script src="https://webapi.amap.com/maps?v=1.4.6&key={{ sysconf('amap_js_key') }}"></script>
        <script src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
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
        <video id="main_video" class="main-video" controls="controls" style="display: none" webkit-playsinline="true" x5-playsinline="" playsinline="" width="100%" height="300px">
            <source src="{{ get_video_url($goods['goods_video']) }}" type="video/mp4">
        </video>
        <script type="text/javascript">
            //
        </script>
        <div style="height: 50px;"></div></div>
    {{--引入右上角菜单--}}
    @include('layouts.partials.right_top_menu')
    <!-- 底部 _end-->
    <script type="text/javascript">
        //
    </script>
    <!-- 积分提醒 -->
    <!-- 消息提醒 -->
    <script type="text/javascript">
        //
    </script>
    <!-- 第三方流量统计 -->
    <div style="display: none;">
        {{--第三方统计代码--}}
        {!! sysconf('stats_code_wap') !!}
    </div>
    <script src="/assets/d2eace91/min/js/core.min.js?v=5"></script>
    <script src="/assets/d2eace91/js/swiper/swiper.jquery.min.js"></script>
    <script src="/js/app.frontend.mobile.min.js"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js?v=5"></script>
    <script src="/assets/d2eace91/js/jquery.region.mobile.js"></script>
    <script src="/js/goods.js?v=5"></script>
    <script src="/assets/d2eace91/js/geolocation/amap.js"></script>
    <script src="/js/multistore_position.js"></script>
    <script src="/assets/d2eace91/min/js/message.min.js"></script>
    <script>
        $('.mini-program-share-popup').click(function () {
            $(this).addClass('hide');
            $("body").css("top", "auto");
            $("body").removeClass("visibly");
            $(window).scrollTop(scrollheight);
        })
        //
        var goods_pic_swiper;
        $(function(){
            goods_pic_swiper = new Swiper('#goods_pic', {
                lazyLoading : true,
                lazyLoadingInPrevNext: true,
                autoplayDisableOnInteraction: true,
                pagination : '.swiper-pagination',
                paginationType : 'fraction',
                //loop: true,
                observer:true,//修改swiper自己或子元素时，自动初始化swiper
            });
        });
        //
        function colse_share_select(){
            $('.share-select-con').removeClass('spec-menu-show').addClass('spec-menu-hide');
            $('.share-select-con').hide();
            $('.mask-div').hide();
        }
        $('.share-select-footer a').click(function(){
            colse_share_select();
        })
        $('.good-share').click(function(){
            $('.mask-div').show();
            $('.share-select-con').removeClass('spec-menu-hide').addClass('spec-menu-show');
            $('.share-select-con').show();
        })
        $('.procedure-tip-btn').click(function(){
            $('.pre-sale-rule-box').addClass('show');
            $('.pre-sale-rule-close').addClass('show');
        });
        $('.pre-sale-rule-close,.pre-sale-rule-box,.rule-footer-btn').click(function(){
            $('.pre-sale-rule-box').removeClass('show');
            $('.pre-sale-rule-close').removeClass('show');
        });
        $('body').on('click', '.content-down',function(){
            $(".give-share-popup").removeClass('hide');
            scrollheight = $(document).scrollTop();
            $("body").css("top", "-" + scrollheight + "px");
            $("body").addClass("visibly");
        });
        /* 分享弹出 */
        function bdshare_popup() {
            colse_share_select();
            if (window.__wxjs_environment !== 'miniprogram') {
                $(".give-share-popup").removeClass('hide');
            } else {
                $('.mini-program-share-popup').removeClass('hide');
            }
            scrollheight = $(document).scrollTop();
            $("body").css("top", "-" + scrollheight + "px");
            $("body").addClass("visibly");
        }
        function colse_bdshare_popup() {
            $(".give-share-popup").addClass('hide');
            $("body").css("top", "auto");
            $("body").removeClass("visibly");
            $(window).scrollTop(scrollheight);
        }
        $('body').on('click','.colse-bdshare-popup',function(){
            $(".give-share-popup").addClass('hide');
            $("body").css("top", "auto");
            $("body").removeClass("visibly");
            $(window).scrollTop(scrollheight);
        });
        //
        $('.SZY-RANK-PRICE').click(function(){
            //return;
            $('.mask-div').show();
            $('.rank-price-content').removeClass('rank-price-back').addClass('rank-price-show');
            scrollheight = $(document).scrollTop();
            $("body").css("top", "-" + scrollheight + "px");
            $("body").addClass("visibly");
        });
        $('.rank-price-btn a').click(function(){
            $('.mask-div').hide();
            $('.rank-price-content').removeClass('rank-price-show').addClass('rank-price-back');
            $("body").css("top", "auto");
            $("body").removeClass("visibly");
            $(window).scrollTop(scrollheight);
        });
        //获取滚动高度
        function scrollTop(){
            return Math.max(
                //chrome
                document.body.scrollTop,
                //document.getElementsByTagName('goods-content').scrollTop
                //firefox/IE
                document.documentElement.scrollTop
            );
        }
        //获取页面文档的总高度
        function documentHeight(){
            //现代浏览器（IE9+和其他浏览器）和IE8的document.body.scrollHeight和document.documentElement.scrollHeight都可以
            return Math.max(document.body.scrollHeight,document.documentElement.scrollHeight);
        }
        //获取页面浏览器视口的高度
        function windowHeight(){
            //document.compatMode有两个取值。BackCompat：标准兼容模式关闭。CSS1Compat：标准兼容模式开启。
            return (document.compatMode == "CSS1Compat")? document.documentElement.clientHeight : document.body.clientHeight;
        }
        function handleScroll() {
            var $detailAnchor = $('.goods-header'),
                setScrollTop = 1,
                setScrollTop1 = 100,
                setScrollHeight = 200,
                st = $(window).scrollTop();
            if (st >= setScrollTop && st <= setScrollTop1) {
                $detailAnchor.addClass('fixed-header');
                var btn_anchorOpacity1 = ((setScrollTop1 - st) / (setScrollTop1 - setScrollTop)).toFixed(2);
                var content_anchorOpacity1 = ((st - setScrollTop) / (setScrollHeight - setScrollTop)).toFixed(2);
                $('.goods-header-nav,.goods-header .goods-header-right a').css({
                    'opacity': content_anchorOpacity1,
                });
                $('.goods-header.fixed-header .goods-header-left a').css('background-color', 'rgba(41,47,54,' + btn_anchorOpacity1 * 0.5 + ')');
                $('.goods-header.fixed-header .goods-header-right #show_more').css('background-color', 'rgba(41,47,54,' + btn_anchorOpacity1 * 0.5 + ')');
            } else if (st > setScrollTop1) {
                $detailAnchor.removeClass('fixed-header');
                var anchorOpacity2 = st <= setScrollHeight ? ((st - setScrollTop) / (setScrollHeight - setScrollTop)).toFixed(2) : 1;
                $detailAnchor.css('background-color', 'rgba(255,255,255,' + anchorOpacity2 + ')');
                $('.goods-header-nav,.goods-header .goods-header-right a').css({
                    'opacity': anchorOpacity2
                });
                $('.goods-header .goods-header-left a').css('background-color', '');
                $('.goods-header .goods-header-right #show_more').css('background-color', '');
            }
            if (st < setScrollTop) {
                $detailAnchor.addClass('fixed-header');
                $('.goods-header .goods-header-right #show_more,.goods-header.fixed-header .goods-header-left a').css('background-color','rgba(41,47,54, 0.5)');
                $('.goods-header-nav,.goods-header .goods-header-right a').css({
                    'opacity':0,
                });
            }
            if(st > $('.goods-details-nav').offset().top && $('.goods-desc-main').css('display') != 'none'){
                $('.goods-header-nav li').eq(1).addClass('cur').siblings().removeClass('cur');
            }else if($('.goods-desc-main').css('display') != 'none'){
                $('.goods-header-nav li').eq(0).addClass('cur').siblings().removeClass('cur');
            }
        }
        $(window).on('scroll',handleScroll);
        function getHistoryUrl(url){
            url = url.split('#split');
            return url[0];
        }
        var goods_name = '{{ $goods['goods_name'] }}';
        window.addEventListener("popstate",function(res) {
            if(location.href.indexOf('#goods') != -1){
                $('.goods-header-nav li').eq(0).addClass('cur').siblings().removeClass('cur');
                $('.goods-header').addClass('fixed-header');
                $('.user-goods-ka').show().siblings('.goods-evaluate').hide();
                $('html,body').scrollTop($('.user-goods-ka').eq(0).offset().top + 5);
            }else if(location.href.indexOf('#desc') != -1){
                $('.goods-header-nav li').eq(1).addClass('cur').siblings().removeClass('cur');
                $('.goods-header').removeClass('fixed-header');
                $('.user-goods-ka').show().siblings('.goods-evaluate').hide();
                $('html,body').scrollTop($('.user-goods-ka').eq(1).offset().top + 5);
            }else if(location.href.indexOf('#comment') != -1){
                $('.goods-header-nav li').eq(2).addClass('cur').siblings().removeClass('cur');
                $('.goods-header').removeClass('fixed-header');
                $('.goods-evaluate').show().siblings('.user-goods-ka').hide();
                $('.goods-header').addClass('fixed-header-two');
            }else{
                $('.goods-header-nav li').eq(0).addClass('cur').siblings().removeClass('cur');
                $('.goods-header').addClass('fixed-header');
                $('.user-goods-ka').show().siblings('.goods-evaluate').hide();
                $('html,body').scrollTop($('.user-goods-ka').eq(0).offset().top + 5);
            }
            // 防止页面标题为空的问题
            setTimeout(function(){
                $('title').html(goods_name);
            },100);
        });
        $('.goods-header-nav li').click(function(){
            if($(this).hasClass('cur')){
                return;
            }
            if($('.goods-header').hasClass('fixed-header-two')){
                $('.goods-header').removeClass('fixed-header-two');
            }
            if($(this).index() == 0){
                $(this).addClass('cur').siblings().removeClass('cur');
                $('.goods-header').addClass('fixed-header');
                $('.user-goods-ka').show().siblings('.goods-evaluate').hide();
                $('html,body').animate({
                    scrollTop: $('.user-goods-ka').eq(0).offset().top + 5
                }, 500);
                history.pushState(null, goods_name, getHistoryUrl(location.href)+'#split#goods');
            }else if($(this).index() == 1){
                $(this).addClass('cur').siblings().removeClass('cur');
                $('.goods-header').removeClass('fixed-header');
                $('.user-goods-ka').show().siblings('.goods-evaluate').hide();
                $('html,body').animate({
                    scrollTop: $('.user-goods-ka').eq(1).offset().top + 5
                }, 500);
                history.pushState(null, goods_name, getHistoryUrl(location.href)+'#split#desc');
            }else if($(this).index() == 2){
                $(this).addClass('cur').siblings().removeClass('cur');
                $('.goods-header').removeClass('fixed-header');
                $('.goods-evaluate').show().siblings('.user-goods-ka').hide();
                $('.goods-header').addClass('fixed-header-two');
                history.pushState(null, goods_name, getHistoryUrl(location.href)+'#split#comment');
            }
        });
        $('.goods-details-nav li').click(function(){
            $(this).addClass('current').siblings().removeClass('current');
            $('.goods-details-tab').eq($(this).index()).show().siblings('.goods-details-tab').hide();
        });
        // 销量和收藏数切换
        $('.sale-collect-nav li').click(function(){
            $(this).addClass('current').siblings().removeClass('current');
            $('.sale-collect-tab').eq($(this).index()).show().siblings('.sale-collect-tab').hide();
        });
        // 点击跳转详情
        $('.scroll-tips').click(function() {
            $('html,body').scrollTop(0);
            $('.goods-header-nav li').removeClass('cur');
            $('.goods-header-nav li').eq(1).addClass('cur');
            $('.user-goods-ka').eq(1).show().siblings('.user-goods-ka').hide();
        });
        // 点击跳转到评价详情
        $('.SZY-ALL-COMMENT').click(function(){
            $('.goods-header-nav li').removeClass('cur');
            $('.goods-header-nav li').eq(2).addClass('cur');
            $('.user-goods-ka').eq(2).show().siblings('.user-goods-ka').hide();
            $('.goods-header').addClass('fixed-header-two');
            history.pushState({}, '', getHistoryUrl(location.href)+'#split#comment');
        });
        //
        $().ready(function() {
            // 步进器
            var goods_number_amount = $(".amount-input").amount({
                value: '1',
                min: '1',
                max: '{{ $goods['goods_number'] }}',
                change: function(element, value) {
                    var sku_id = element.data('sku_id');
                    if (value % this.step != 0) {
                        $.msg("商品数量必须是" + this.step + "的整数倍");
                        $(element).val(parseInt(value / this.step) * this.step);
                        return false;
                    }
                },
                max_callback: function() {
                    $.msg("最多只能购买" + this.max + "件");
                },
                min_callback: function() {
                    $.msg("商品数量必须大于" + (this.min - 1));
                }
            });
            // 立即购买
            $('body').on('click', '.buy-goods', function() {
                var act_type = "";
                var purchase = "15";
                var pre_sale = "2";
                var virtual = "0";
                var is_lib_goods = "{{ $is_lib_goods }}";
                if (is_lib_goods == true) {
                    return;
                }
                if ($(this).hasClass("disabled")) {
                    return;
                }
                var sku_id = getSkuId();
                var number = $(".goods-num").find('.num').val();
                var data = {};
                if (act_type == 'purchase' || act_type == 'pre_sale') {
                    data.act_type = act_type;
                }
                if (virtual > 0) {
                    data.virtual = virtual;
                }
                $.cart.quickBuy(sku_id, number, data);
            });
            // 添加购物车
            $('body').on('click', '.add-cart', function(event) {
                if ($(this).hasClass("disabled")) {
                    return;
                }
                //var image_url = $(".SZY-GOODS-IMAGE-THUMB").attr("src");
                var number = $(".goods-num").find('.num').val();
                var sku_id = getSkuId();
                $.cart.add(sku_id, number, {
                    is_sku: true,
                    //image_url: image_url,
                    //event: event,
                    callback: function(result) {
                        if (result.code == 0) {
                            close_choose_spec();
                            $(".goods-num").find('.num').val(1);
                        }
                    }
                });
                return false;
            });
            // 立即兑换
            $('body').on('click', '.exchange-goods', function(event) {
                if ($(this).hasClass("disabled")) {
                    var goods_number = "";
                    if (goods_number == 0) {
                        $.msg('库存不足');
                    } else {
                        $.msg('积分不足');
                    }
                    return;
                }
                var sku_id = getSkuId();
                var number = $(".goods-num").find('.num').val();
                var data = {};
                data.exchange = true;
                $.cart.quickBuy(sku_id, number, data);
            });
            // 小程序控制客服
            /* if (window.__wxjs_environment === 'miniprogram') {
                var service_tel = '13207377959';
                if (service_tel != '' || service_tel != null) {
                    $('.customer').attr('href', 'tel:' + service_tel);
                    $('.customer').attr('class', 'nav-button customer');
                    $('.customer').html('<em class="goods-phone-nav"></em><span>电话</span>');
                } else {
                    $('.customer').attr('href', 'javascript:void(0)');
                    $('.customer').attr('onClick', '$.msg("卖家没有设置联系电话")');
                    $('.customer').attr('class', 'nav-button customer');
                }
            } */
        });
        //
        @if(!empty($user_info))
            var url =  location.href;
            if (url.indexOf("user_id=") == -1 && window.history && history.pushState){
                if(url.indexOf("?") == -1){
                    url += "?user_id=" + "{{ $user_info['user_id'] }}";
                }else{
                    url += "&user_id=" + "{{ $user_info['user_id'] }}";
                }
                history.replaceState(null, document.title, url);
            }
        @endif
        //
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
        //
        $(document).ready(function(){
            /*图片预览 start*/
            $("#goods_pic .SZY-GOODS-IMAGE").on("click", ".swiper-slide a img", function() {
                //$(this).parents('#goods_pic').addClass('preview-picture');
                if ($(this).parents('#goods_pic').hasClass('preview-picture')) {
                    $('#goods_pic').removeClass('preview-picture');
                    $('.icon-guanbi').remove();
                }else{
                    $('#goods_pic').addClass('preview-picture');
                    //document.getElementById("goods_pic").innerHTML+'<i class='iconfont icon-guanbi'></i>';
                    var em=document.createElement("i");
                    em.setAttribute("class", "iconfont icon-guanbi");
                    $('#goods_pic').append(em);
                }
            });
            $(document).bind("click",function(e){
                if($('#goods_pic').hasClass('preview-picture')){
                    var target  = $(e.target);
                    if(target.closest(".swiper-slide").length == 0){
                        $('#goods_pic').removeClass('preview-picture');
                        $('.icon-guanbi').remove();
                    }
                }
            });
            $('body').on('click','.icon-guanbi',function(){
                $('#goods_pic').removeClass('preview-picture');
                $('.icon-guanbi').remove();
            });
        });
        /*图片预览 end*/
        /*弹层内容预览*/
        $('.choose-attribute-pic').on('click','img',function(){
            var imgBox = $(this).parents(".choose-attribute-pic").find("img");
            $(".preview-attribute-pic").append('<img src="' + imgBox.attr("src") + '" / >');
            $(".preview-attribute-pic").removeClass('hide');
            var em=document.createElement("i");
            em.setAttribute("class", "iconfont icon-guanbi");
            $('.preview-attribute-pic').append(em);
        })
        $(".preview-attribute-pic,.preview-attribute-pic .icon-guanbi").on("click", function() {
            $(this).addClass('hide');
            $(".preview-attribute-pic img").remove();
            $('.icon-guanbi').remove();
        });
        //
        var sku_freights = [];
        $().ready(function() {
            //加载图文详情
            loadDesc();
            // 门店自提
            $("body").on('click', '.pickup', function() {
                $.go('/pickup/0.html');
            });
        });
        //加载图文详情
        function loadDesc() {
            $.ajax({
                type: "get",
                url: "/goods/desc",
                dataType: 'json',
                data: {
                    sku_id: "{{ $sku['sku_id'] }}",
                    is_lib_goods: "{{ $is_lib_goods }}"
                },
                success: function(result) {
                    if(result.desc_type == 0){
                        $(".goods-detail-content").html(result.pc_desc);
                    }
                    if(result.desc_type == 1){
                        var mobile_desc = '';
                        $.each(result.mobile_desc,function(i,desc){
                            if(desc.type==1){
                                var img = '<img src = '+desc.content+'>';
                                mobile_desc =  mobile_desc + img;
                            }else{
                                mobile_desc =  mobile_desc + '<div>'+desc.content+'</div>';
                            }
                        });
                        $(".goods-detail-content").html(mobile_desc);
                    }
                    if($('.user-goods-ka').eq(0).css('display') != 'none'){
                        $('.user-goods-ka').eq(1).show();
                        $('.tip-space-box').show();
                    }
                }
            });
        }

        var main_image_size = "2";
        var sku_ids = $.parseJSON($("#SZY_SKU_LIST").html());
        function getSkuId() {
            var spec_ids = [];
            $(".choose").find(".attr").each(function() {
                var spec_id = $(this).find(".selected").data("spec-id");
                spec_ids.push(spec_id);
            });
            var sku_id = $.cart.getSkuId(spec_ids, sku_ids);
            return sku_id;
        }
        function getSkuInfo(sku_id, is_default, callback) {
            if(sku_id == null || sku_id == undefined){
                // 回调
                if ($.isFunction(callback)) {
                    callback.call({}, null);
                }
                return;
            }
            if ($(document).data("SZY-SKU-" + sku_id)) {
                var sku = $(document).data("SZY-SKU-" + sku_id);
                sku.is_default = is_default;
                // 回调
                if ($.isFunction(callback)) {
                    callback.call({}, sku);
                }
            } else {
                var data = {
                    sku_id: sku_id,
                    is_lib_goods: "{{ $is_lib_goods }}"
                };
                //
                $.get('/goods/sku', data, function(result) {
                    if (result.code == 0) {
                        var sku = result.data;
                        sku.is_default = is_default;
                        $(document).data("SZY-SKU-" + sku_id, sku);
                        // 回调
                        if ($.isFunction(callback)) {
                            callback.call({}, sku);
                        }
                    } else {
                        $.msg(result.message, {
                            time: 5000
                        });
                    }
                }, "json");
            }
        }

        // 设置SKU信息
        function setSkuInfo(sku) {
            if (sku == undefined || sku == null || sku == false) {
                $(".SZY-BUY-BUTTON").addClass("disabled");
                $('.SZY-BUY-BUTTON').text('库存不足');
                $(".SZY-GOODS-NUMBER").html("库存不足");
                return;
            }
            var is_original = $("body").data("is-original");
            var goods_number = sku.goods_number;
            if (goods_number > 0) {
                // if (sku_freights[local_region_code]) {
                //     if (sku_freights[local_region_code].limit_sale == 1) {
                //         // 区域限售商品
                //         //goods_number = sku_freights[local_region_code].goods_number;
                //     }
                // } else {
                //     changeLocation(local_region_code).always(function(result) {
                //         if (result.code == 0 && result.data.limit_sale == 1) {
                //             setSkuInfo(sku);
                //         }
                //     });
                //     return;
                // }
            }
            // 判断促销模块是否显示
            var show_activity = false;
            //
            // 会员特价
            if (sku.member_price_message) {
                $(".SZY-MEMBER-PRICES").show();
                $(".SZY-MEMBER-MESSAGE").html(sku.member_price_message);
                // 展示促销
                show_activity = true;
            } else {
                $(".SZY-RANK-PRICES").hide();
            }
            // 商品规格
            console.log(sku)
            $(".selected-attr.SZY-GOODS-SPEC").html("已选：<i class='i_dd ub-f1'>"+sku.spec_attr_value+"</i>    <span class='more'><i class='iconfont'>&#xe607;</i></span>");
            $(".choose-result-attr.SZY-GOODS-SPEC").html("已选：<i class='i_dd'>"+sku.spec_attr_value+"</i>");
            // 商品名称
            $(".SZY-GOODS-NAME").html(sku.sku_name);
            if (sku.is_default == 1) {
                $(".SZY-GOODS-IMAGE-THUMB").attr("src", sku.sku_images[0][1]);
                var html = '';
                $.each(sku.sku_images, function(i, v) {
                    html += "<div class='swiper-slide'><a href='javascript:void(0)'><img width='100%' src='" + v[main_image_size] + "'></a></div>";
                });
                $(".SZY-GOODS-IMAGE").html(html);
                goods_pic_swiper.update();
                goods_pic_swiper.startAutoplay();
                goods_pic_swiper.reLoop();
            }
            //限时折扣 显示原价
            if (sku.activity && sku.activity.act_type == '11' && sku.activity.act_status == 1) {
                //$(".SZY-MARKET-PRICE").html(sku.original_price_format);
                var discount_msg='';
                if(sku.activity.discount_mode==0){
                    discount_msg=sku.activity.discount_num+'折';
                }else if(sku.activity.discount_mode==1){
                    discount_msg='减'+sku.activity.discount_num+'元';
                }else if(sku.activity.discount_mode==2){
                    discount_msg='优惠 '+(sku.original_price-sku.activity.discount_num);
                }else{
                    discount_msg='--';
                }
                $(".SZY-ACTIVITY").find(".discount").html(discount_msg);
                $(".discount").html(discount_msg);
            }
            // 售价
            if(is_original == 0 && sku.activity){
                $(".SZY-GOODS-PRICE").html(sku.activity.act_price_format);
            }else{
                $(".SZY-GOODS-PRICE").html(sku.goods_price_format);
            }
            $(".RANK-PRICE-FORMAT").html(sku.rank_price_format);
            $(".SAVE-PRICE-FORMAT").html(sku.save_price_format);
            // 市场价
            $(".SZY-MARKET-PRICE").html(sku.market_price_format);
            if (parseFloat(sku.market_price) == 0) {
                $(".SZY-MARKET-PRICE").hide();
            } else {
                $(".SZY-MARKET-PRICE").show();
            }
            // 预售定金显示
            if (parseFloat(sku.earnest_money) > 0 && $('.SZY-EARNST-MONEY').length > 0) {
                $('.SZY-EARNST-MONEY').html(sku.earnest_money_format);
                $('.SZY-TAIL-MONEY').html(sku.tail_money_format);
            }
            // 库存
            if(is_original == 1){
                goods_number = sku.original_number;
            }
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
            // 最大购买数量
            if(sku.goods_max_number == null || sku.goods_max_number == undefined || isNaN(sku.goods_max_number)){
                sku.goods_max_number = goods_number;
            }
            $(".amount-input").data("amount-step", sku.cart_step);
            $(".amount-input").data("amount-min", sku.cart_step);
            $(".amount-input").data("amount-max", sku.goods_max_number);
            if (goods_number > 0 && $(".amount-input").val() == 0) {
                $(".amount-input").val(sku.cart_step);
            } else if (goods_number == 0 && $(".amount-input").val() != 0) {
                $(".amount-input").val(0);
            } else if ($(".amount-input").val() < sku.cart_step){
                $(".amount-input").val(sku.cart_step);
            } else if ($(".amount-input").val() % sku.cart_step != 0){
                $(".amount-input").val(sku.cart_step);
            }
            var goods_number_input = parseInt($(".amount-input").val());
            if (goods_number_input > goods_number) {
                $(".amount-input").val(goods_number);
            }
            // 运费信息
            if (sku.freight) {
                $(".freight-info").html(sku.freight.freight_info);
            }
            // 处理赠品
            if (sku.gift_list && sku.gift_list.length > 0) {
                $(".SZY-GIFT-LIST").html("");
                var element = $($.parseHTML('<div class="prom-gift ub"></div>'));
                element.append('<div class="dt">赠品</div><div class="dd"></div>');
                for (var i = 0; i < sku.gift_list.length; i++) {
                    var gift = sku.gift_list[i];
                    element.find('.dd:last').append('<div class="prom-gift-list"><a href="/'+ gift.gift_sku_id +'.html" title="'+gift.sku_name+'"><img src="'+gift.goods_image_thumb+'" width="20" height="20" class="gift-img" /></a><em class="gift-number color">× '+gift.gift_number+'</em></div>')
                }
                $(".SZY-GIFT-LIST").append($(element));
            } else {
                $(".SZY-GIFT-LIST").html('');
            }
            //订单返现
            if (sku.cash_back.message) {
                show_activity = true;
            }
            // 积分抵扣
            if (sku.integral_label) {
                $(".SZY-INTEGRAL-LABEL").show();
                $(".SZY-INTEGRAL-ITEM").show();
                $(".SZY-INTEGRAL-ITEM .pro-info p").html(sku.integral_label);
                show_activity = true;
            }else{
                $(".SZY-INTEGRAL-LABEL").hide();
                $(".SZY-INTEGRAL-ITEM").hide();
            }
            if (show_activity) {
                $(".SZY-ACTIVITY").show();
            } else {
                $(".SZY-ACTIVITY").hide();
            }
            goods_pic_swiper.updateSlidesSize();
            goods_pic_swiper.updatePagination();
            goods_pic_swiper.slideTo(0, 1000, false);
            goods_pic_swiper.startAutoplay();
        }
        $().ready(function() {
            // 检查SKU组合
            $.cart.checkSkus($(".SZY-GOODS-SPEC-ITEMS"), sku_ids);
            // 绑定规格事件
            $.cart.checkSpecs($(".SZY-GOODS-SPEC-ITEMS"), sku_ids, $(".SZY-GOODS-SPEC-ITEMS").find("li"), function(sku) {
                // 是否为默认规格
                var is_default = $(this).data("is-default");
                // SKU存在
                getSkuInfo(sku.sku_id, is_default, function(sku) {
                    setSkuInfo(sku);
                    $("title").html(sku.sku_name);
                });
            }, function() {
                // SKU不存在
                setSkuInfo(false);
                $("title").html("{{ $goods['goods_name'] }}");
            });
            // 添加收藏
            $(".collect-goods").click(function(event) {
                var target = $(this);
                var goods_id = $(this).data("goods-id");
                var sku_id = getSkuId();
                $.loading.start();
                $.collect.toggleGoods(goods_id, sku_id, function(result) {
                    $.loading.stop();
                    if (result.data == 1) {
                        target.find('.goods-collect-nav').addClass("selected");
                        target.children().next().html("已收藏");
                    } else {
                        target.find('.goods-collect-nav').removeClass("selected");
                        target.children().next().html("收藏");
                    }
                }, true);
            });
            // 领取红包
            $("body").on("click", ".bonus-receive", function() {
                var bonus_id = $(this).data("bonus-id");
                var target = $(this);
                $.bonus.receive(bonus_id, function(result) {
                    if (result.code == 0) {
                        if(result.data == 0){
                            $(target).html("已领取").removeClass("bg-color").removeClass("bonus-receive").addClass("bonus-received").addClass('color');
                        }
                        $.msg(result.message,{
                            icon_type: 1
                        });
                        return;
                    } else if (result.code == 130) {
                        $(target).html("已领取").removeClass("bg-color").removeClass("bonus-receive").addClass("bonus-received").addClass('color');
                    } else if (result.code == 131) {
                        $(target).html("已抢光").removeClass("bg-color").removeClass("bonus-receive").addClass("bonus-bonus-receivend");
                        $(target).parents('.coupon-info').addClass('coupon-item-ed');
                    }
                    $.msg(result.message, {
                        time: 5000
                    });
                });
            });
            //立即砍价
            $('body').on('click', '.cut-money', function() {
                var goods_id = $(this).data('goods_id');
                var openid = $(this).data('open_id');
                $.ajax({
                    type: 'GET',
                    url: '/goods/bargain',
                    data: {
                        goods_id: goods_id,
                        openid: openid
                    },
                    dataType: 'json',
                    success: function(result) {
                        if(result.code == 0){
                            /* $('#act_bargain').html(result.bar_data);
                            $('#act_bargain_footer').html(result.bar_foot_data);
                            $('#act_bargain_info').html(result.bar_info_data); */
                            $('.mask-div').show();
                            $('.cut-money-info').show();
                            $('.bar-amount').html('￥'+result.bar_info.bar_amount);
                            replaceUrl('bar_id', result.bar_info.bar_id);
                        }else{
                            $.msg(result.message);
                        }
                    }
                })
            });
            //立即砍价
            $('body').on('click', '.help-cut-money', function() {
                var bar_id = $(this).data('bar_id');
                var openid = $(this).data('open_id');
                $.ajax({
                    type: 'GET',
                    url: '/goods/help-bargain',
                    data: {
                        bar_id: bar_id,
                        openid: openid
                    },
                    dataType: 'json',
                    success: function(result) {
                        if(result.code == 0){
                            /* $('#act_bargain').html(result.bar_data);
                            $('#act_bargain_footer').html(result.bar_foot_data); */
                            $('.mask-div').show();
                            $('.cut-money-info').show();
                            $('.bar-amount').html('￥'+result.bar_amount);
                        }else{
                            $.msg(result.message);
                        }
                    }
                })
            });
            // 设置默认权益卡
            $.get('/goods/set-default-card', {
                shop_id: "{{ $shop_info['shop']['shop_id'] }}"
            }, function(result) {
                if (result.code == 0) {
                    window.location.reload();
                    $.msg(result.message);
                } else {
                }
            }, "json");
        });
        function replaceUrl(name, value) {
            var obj = new Object();
            obj[name] = value;
            History.replaceState(obj, '', '?' + name + '=' + value);
        }

        //
        var goods_share_mode = "js"
        var qrcode_type = '0';
        var click_loading = false;
        // 商品分享
        $('body').on('click', '.qr-code', function(event){
            colse_share_select();
            var obj = $(this);
            if($('#goods_share_'+$(obj).attr('data-uuid')).length > 0){
                $('#goods_share_'+$(obj).attr('data-uuid')).show();
                return ;
            }
            if(click_loading == false){
                click_loading = true;
                $(obj).goodsshare({
                    goods_id: '{{ $goods['goods_id'] }}',
                    mode: goods_share_mode,
                    qrcode_type: qrcode_type,
                    callback: function(res){
                        click_loading = false;
                        $(obj).attr('data-uuid',res.uuid);
                    }
                });
            }
        });
        $('.qr-code').show();
        //
        $().ready(function() {
            $.multiposition.load(function(data) {
                if (typeof (callback) != 'undefined' && $.isFunction(callback)) {
                    callback(data);
                }
            });
        });
        //
        var local_region_code = '0';
        function changeLocation(region_code) {
            if (region_code == undefined || region_code == null || region_code.length == 0) {
                return;
            }
            var sku_id = getSkuId();
            return $.get("/goods/change-location.html", {
                "sku_id": sku_id,
                "region_code": region_code,
            }, function(result) {
                if (result.code == 0) {
                    local_region_code = region_code;
                    sku_freights[region_code] = result.data;
                    if (result.data.limit_sale == 1 && result.data.is_last == 0) {
                        return;
                    }
                    $(".freight-info").html(result.data.freight_info);
                    if ($(document).data("SZY-SKU-" + sku_id)) {
                        var sku = $(document).data("SZY-SKU-" + sku_id);
                        setSkuInfo(sku);
                    } else {
                        $(".freight-info").html(result.data.freight_info);
                        if (result.data.goods_number > 0) {
                            if ("1" == "1") {
                                $(".SZY-GOODS-NUMBER").html("库存：" + result.data.goods_number + "件");
                            }else{
                                $(".SZY-GOODS-NUMBER").html("");
                            }
                            $('.SZY-BUY-BUTTON').text('确定');
                        } else {
                            $(".SZY-GOODS-NUMBER").html("库存不足");
                            $(".SZY-BUY-BUTTON").addClass("disabled");
                            $('.SZY-BUY-BUTTON').text('库存不足');
                        }
                    }
                }
            }, "json");
        }
        function getRegionChooser() {
            var region_chooser = $(".region-chooser-container").regionchooser({
                change: function(value, names, is_last) {
                    if (!is_last) {
                        return;
                    }
                    changeLocation(value);
                }
            });
        }
        //
        var region_chooser = null;
        $().ready(function(){
            // local_region_code = "53,01,03";
            local_region_code = "{{ $region_code }}";
            //if (local_region_code && local_region_code.length > 0) {
            //    changeLocation(local_region_code);
            //}
            region_chooser = $(".region-chooser-container").regionchooser({
                value: local_region_code,
                change: function(value, names, is_last) {
                    if (!is_last) {
                        return;
                    }
                    changeLocation(value);
                }
            });
        })
        //
        // 定位后要触发的方法体
        $().ready(function() {
            $.geolocation({
                callback: function(data) {
                    get_exhibition(data);
                }
            });
            // 异步获取当前人与当前访问小店的信息
            function get_exhibition(postion){
                if(postion.lat > 0 && postion.lng > 0){
                    $.post("/multistore/help/get-exhibition",{
                        lat: postion.lat,
                        lng: postion.lng,
                    }, function(result){
                        if(result.code == 0) {
                            $("#store_exhibition").html(result.data);
                        }else{
                            $.msg(result.message);
                        }
                    },"json");
                }
            }
        });

        //
        $('.video-icon').click(function(){
            $('.goods-header').hide();
            $('#main_video').show();
            document.getElementById('main_video').play();
        });
        $(function() {
            var elevideo = document.getElementById("main_video");
            /*播放开始*/
            elevideo.addEventListener('play', function () {
                $('.goods-header').hide();
            });
            /*视频播放暂停*/
            elevideo.addEventListener('pause', function () {
                $('.goods-header').show();
            });
            /*视频结束*/
            elevideo.addEventListener('ended', function () {
                $('#main_video').hide();
                $('.goods-header').show();
                exitFullscreen();
            }, false);
        });
        /*视频错误*/
        $('#main_video').bind('error', function(){
            $('#main_video').hide();
            $('.goods-header').show();
            exitFullscreen();
        });
        /*退出全屏*/
        function exitFullscreen(){
            if(document.exitFullscreen){
                document.exitFullscreen();
            }else if(document.mozCancelFullScreen){
                document.mozCancelFullScreen();
            }else if(document.webkitCancelFullScreen){
                document.webkitCancelFullScreen();
            }
        }
        //
        $().ready(function() {
            // 缓载图片
            $.imgloading.loading();
        });
        //

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
