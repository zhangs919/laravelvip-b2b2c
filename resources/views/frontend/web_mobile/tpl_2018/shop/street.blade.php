@extends('layouts.base')

{{--header_css--}}
@section('header_css')

@stop

{{--header_js--}}
@section('header_js')
    <script src="/assets/d2eace91/js/jquery.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/jquery.cookie.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/jquery.modal.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20180813"></script>
    <script src="/js/common.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=20180813"></script>
    <!-- 图片缓载js -->
    <script src="/assets/d2eace91/js/jquery.lazyload.js?v=20180813"></script>
    <!-- 飞入购物车 -->
    <script src="/js/jquery.fly.min.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js?v=20180813"></script>
    <script type="text/javascript">
        $().ready(function() {


        })
    </script>
@stop



@section('content')

    <!-- 内容 -->
    <div id="index_content">
        <link rel="stylesheet" href="/css/shop_street.css?v=20180702"/>
        <script src="/js/shopstreet.js?v=20180813"></script>
        <div class="shop-street-top">
            <div class="header">
                <div class="shop-street-left">
                    <a href="javascript:history.back(-1)" class="sb-back" title="返回"></a>
                </div>
                <div class="header-middle">
                    <div class="search-box">
                        <input name="name" id="shop_name" type="text" placeholder="请输入店铺名称" class="text" value="">
                        <input type="submit" class="submit" id="shop_search" value=''>
                    </div>
                </div>
                <div class="header-right">
                    <aside class="show-menu-btn">
                        <div id="show_more" class="show-menu"></div>
                    </aside>
                </div>
            </div>
            <div class="shop-nav">
                <a href="javascript:void(0)" class="nav-item invalid">全部分类</a>
                <a href="javascript:void(0)" class="nav-item invalid">附近商家</a>
                <a href="javascript:void(0)" class="nav-item invalid">智能排序</a>
            </div>
        </div>

        <div class="classify-content shop-submenu" style="display: none">
            <div class="shop-submenu-left">
                <ul class="SZY-SHOP-STREET-CLS">
                    <li data-val='0' data-text='全部分类'  class="current">
                        <span class="submenu-name">全部</span>
                    </li>

                    <li data-val='1' >
                        <span class="submenu-name">家用电器</span>
                    </li>

                    <li data-val='2' >
                        <span class="submenu-name">手机数码</span>
                    </li>

                    <li data-val='3' >
                        <span class="submenu-name">电脑办公</span>
                    </li>

                    <li data-val='4' >
                        <span class="submenu-name">家居家纺</span>
                    </li>

                    <li data-val='5' >
                        <span class="submenu-name">男装女装</span>
                    </li>

                    <li data-val='6' >
                        <span class="submenu-name">鞋靴箱包</span>
                    </li>

                    <li data-val='7' >
                        <span class="submenu-name">护肤化妆</span>
                    </li>

                    <li data-val='8' >
                        <span class="submenu-name">母婴玩具</span>
                    </li>

                    <li data-val='9' >
                        <span class="submenu-name">图书音像</span>
                    </li>

                    <li data-val='10' >
                        <span class="submenu-name">休闲运动</span>
                    </li>

                    <li data-val='11' >
                        <span class="submenu-name">汽车汽配</span>
                    </li>

                    <li data-val='12' >
                        <span class="submenu-name">食品酒水</span>
                    </li>

                    <li data-val='13' >
                        <span class="submenu-name">保健器械</span>
                    </li>

                    <li data-val='14' >
                        <span class="submenu-name">营养滋补</span>
                    </li>

                    <li data-val='72' >
                        <span class="submenu-name">自驾游服务商</span>
                    </li>

                </ul>
            </div>
            <div class="shop-submenu-right">

                <ul class="SZY-SHOP-STREET-CLS-CHR hide" id="cls_list_1">
                    <li data-val='1' data-cls_id='1_1_0' data-text='家用电器' class="">
                        <span class="submenu-name">全部</span>
                    </li>

                    <li data-val='15' data-cls_id='2_15_1' data-text='大家电' >
                        <span class="submenu-name">大家电</span>
                    </li>

                    <li data-val='16' data-cls_id='2_16_1' data-text='厨卫大电' >
                        <span class="submenu-name">厨卫大电</span>
                    </li>

                    <li data-val='17' data-cls_id='2_17_1' data-text='厨房小电' >
                        <span class="submenu-name">厨房小电</span>
                    </li>

                    <li data-val='18' data-cls_id='2_18_1' data-text='生活电器' >
                        <span class="submenu-name">生活电器</span>
                    </li>

                    <li data-val='19' data-cls_id='2_19_1' data-text='个护健康' >
                        <span class="submenu-name">个护健康</span>
                    </li>

                    <li data-val='20' data-cls_id='2_20_1' data-text='五金家装' >
                        <span class="submenu-name">五金家装</span>
                    </li>

                    <li data-val='75' data-cls_id='2_75_1' data-text='冰箱' >
                        <span class="submenu-name">冰箱</span>
                    </li>

                    <li data-val='76' data-cls_id='2_76_1' data-text='飞博腾' >
                        <span class="submenu-name">飞博腾</span>
                    </li>

                    <li data-val='77' data-cls_id='2_77_1' data-text='飞博腾1' >
                        <span class="submenu-name">飞博腾1</span>
                    </li>

                </ul>

                <ul class="SZY-SHOP-STREET-CLS-CHR hide" id="cls_list_2">
                    <li data-val='2' data-cls_id='1_2_0' data-text='手机数码' class="">
                        <span class="submenu-name">全部</span>
                    </li>

                    <li data-val='21' data-cls_id='2_21_2' data-text='手机通讯' >
                        <span class="submenu-name">手机通讯</span>
                    </li>

                    <li data-val='22' data-cls_id='2_22_2' data-text='手机配件' >
                        <span class="submenu-name">手机配件</span>
                    </li>

                    <li data-val='23' data-cls_id='2_23_2' data-text='摄影摄像' >
                        <span class="submenu-name">摄影摄像</span>
                    </li>

                    <li data-val='24' data-cls_id='2_24_2' data-text='影音娱乐' >
                        <span class="submenu-name">影音娱乐</span>
                    </li>

                    <li data-val='25' data-cls_id='2_25_2' data-text='智能设备' >
                        <span class="submenu-name">智能设备</span>
                    </li>

                    <li data-val='26' data-cls_id='2_26_2' data-text='电子教育' >
                        <span class="submenu-name">电子教育</span>
                    </li>

                </ul>

                <ul class="SZY-SHOP-STREET-CLS-CHR hide" id="cls_list_3">
                    <li data-val='3' data-cls_id='1_3_0' data-text='电脑办公' class="">
                        <span class="submenu-name">全部</span>
                    </li>

                    <li data-val='27' data-cls_id='2_27_3' data-text='电脑整机' >
                        <span class="submenu-name">电脑整机</span>
                    </li>

                    <li data-val='28' data-cls_id='2_28_3' data-text='电脑配件' >
                        <span class="submenu-name">电脑配件</span>
                    </li>

                    <li data-val='29' data-cls_id='2_29_3' data-text='办公设备' >
                        <span class="submenu-name">办公设备</span>
                    </li>

                    <li data-val='30' data-cls_id='2_30_3' data-text='文具耗材' >
                        <span class="submenu-name">文具耗材</span>
                    </li>

                </ul>

                <ul class="SZY-SHOP-STREET-CLS-CHR hide" id="cls_list_4">
                    <li data-val='4' data-cls_id='1_4_0' data-text='家居家纺' class="">
                        <span class="submenu-name">全部</span>
                    </li>

                    <li data-val='31' data-cls_id='2_31_4' data-text='家纺' >
                        <span class="submenu-name">家纺</span>
                    </li>

                    <li data-val='32' data-cls_id='2_32_4' data-text='家具' >
                        <span class="submenu-name">家具</span>
                    </li>

                    <li data-val='33' data-cls_id='2_33_4' data-text='灯具' >
                        <span class="submenu-name">灯具</span>
                    </li>

                    <li data-val='34' data-cls_id='2_34_4' data-text='生活日用' >
                        <span class="submenu-name">生活日用</span>
                    </li>

                    <li data-val='35' data-cls_id='2_35_4' data-text='家装软饰' >
                        <span class="submenu-name">家装软饰</span>
                    </li>

                </ul>

                <ul class="SZY-SHOP-STREET-CLS-CHR hide" id="cls_list_5">
                    <li data-val='5' data-cls_id='1_5_0' data-text='男装女装' class="">
                        <span class="submenu-name">全部</span>
                    </li>

                    <li data-val='36' data-cls_id='2_36_5' data-text='女装' >
                        <span class="submenu-name">女装</span>
                    </li>

                    <li data-val='37' data-cls_id='2_37_5' data-text='男装' >
                        <span class="submenu-name">男装</span>
                    </li>

                    <li data-val='38' data-cls_id='2_38_5' data-text='内衣' >
                        <span class="submenu-name">内衣</span>
                    </li>

                    <li data-val='39' data-cls_id='2_39_5' data-text='配饰' >
                        <span class="submenu-name">配饰</span>
                    </li>

                    <li data-val='40' data-cls_id='2_40_5' data-text='童装童鞋' >
                        <span class="submenu-name">童装童鞋</span>
                    </li>

                </ul>

                <ul class="SZY-SHOP-STREET-CLS-CHR hide" id="cls_list_6">
                    <li data-val='6' data-cls_id='1_6_0' data-text='鞋靴箱包' class="">
                        <span class="submenu-name">全部</span>
                    </li>

                    <li data-val='41' data-cls_id='2_41_6' data-text='时尚女鞋' >
                        <span class="submenu-name">时尚女鞋</span>
                    </li>

                    <li data-val='42' data-cls_id='2_42_6' data-text='流行男鞋' >
                        <span class="submenu-name">流行男鞋</span>
                    </li>

                    <li data-val='43' data-cls_id='2_43_6' data-text='潮流女包' >
                        <span class="submenu-name">潮流女包</span>
                    </li>

                    <li data-val='44' data-cls_id='2_44_6' data-text='精品男包' >
                        <span class="submenu-name">精品男包</span>
                    </li>

                    <li data-val='45' data-cls_id='2_45_6' data-text='功能箱包' >
                        <span class="submenu-name">功能箱包</span>
                    </li>

                </ul>

                <ul class="SZY-SHOP-STREET-CLS-CHR hide" id="cls_list_7">
                    <li data-val='7' data-cls_id='1_7_0' data-text='护肤化妆' class="">
                        <span class="submenu-name">全部</span>
                    </li>

                    <li data-val='47' data-cls_id='2_47_7' data-text='面部护肤' >
                        <span class="submenu-name">面部护肤</span>
                    </li>

                    <li data-val='48' data-cls_id='2_48_7' data-text='洗发洗护' >
                        <span class="submenu-name">洗发洗护</span>
                    </li>

                    <li data-val='49' data-cls_id='2_49_7' data-text='身体护肤' >
                        <span class="submenu-name">身体护肤</span>
                    </li>

                    <li data-val='50' data-cls_id='2_50_7' data-text='口腔护理' >
                        <span class="submenu-name">口腔护理</span>
                    </li>

                    <li data-val='51' data-cls_id='2_51_7' data-text='香水彩妆' >
                        <span class="submenu-name">香水彩妆</span>
                    </li>

                </ul>

                <ul class="SZY-SHOP-STREET-CLS-CHR hide" id="cls_list_8">
                    <li data-val='8' data-cls_id='1_8_0' data-text='母婴玩具' class="">
                        <span class="submenu-name">全部</span>
                    </li>

                    <li data-val='52' data-cls_id='2_52_8' data-text='奶粉' >
                        <span class="submenu-name">奶粉</span>
                    </li>

                    <li data-val='53' data-cls_id='2_53_8' data-text='营养辅食' >
                        <span class="submenu-name">营养辅食</span>
                    </li>

                    <li data-val='54' data-cls_id='2_54_8' data-text='童车童床' >
                        <span class="submenu-name">童车童床</span>
                    </li>

                    <li data-val='55' data-cls_id='2_55_8' data-text='玩具' >
                        <span class="submenu-name">玩具</span>
                    </li>

                    <li data-val='56' data-cls_id='2_56_8' data-text='婴儿用品' >
                        <span class="submenu-name">婴儿用品</span>
                    </li>

                </ul>

                <ul class="SZY-SHOP-STREET-CLS-CHR hide" id="cls_list_9">
                    <li data-val='9' data-cls_id='1_9_0' data-text='图书音像' class="">
                        <span class="submenu-name">全部</span>
                    </li>

                    <li data-val='57' data-cls_id='2_57_9' data-text='教育' >
                        <span class="submenu-name">教育</span>
                    </li>

                    <li data-val='58' data-cls_id='2_58_9' data-text='生活' >
                        <span class="submenu-name">生活</span>
                    </li>

                    <li data-val='59' data-cls_id='2_59_9' data-text='科技' >
                        <span class="submenu-name">科技</span>
                    </li>

                </ul>

                <ul class="SZY-SHOP-STREET-CLS-CHR hide" id="cls_list_10">
                    <li data-val='10' data-cls_id='1_10_0' data-text='休闲运动' class="">
                        <span class="submenu-name">全部</span>
                    </li>

                    <li data-val='63' data-cls_id='2_63_10' data-text='户外装备' >
                        <span class="submenu-name">户外装备</span>
                    </li>

                    <li data-val='64' data-cls_id='2_64_10' data-text='运动服饰' >
                        <span class="submenu-name">运动服饰</span>
                    </li>

                    <li data-val='65' data-cls_id='2_65_10' data-text='体育用品' >
                        <span class="submenu-name">体育用品</span>
                    </li>

                </ul>

                <ul class="SZY-SHOP-STREET-CLS-CHR hide" id="cls_list_11">
                    <li data-val='11' data-cls_id='1_11_0' data-text='汽车汽配' class="">
                        <span class="submenu-name">全部</span>
                    </li>

                    <li data-val='60' data-cls_id='2_60_11' data-text='维修保养' >
                        <span class="submenu-name">维修保养</span>
                    </li>

                    <li data-val='61' data-cls_id='2_61_11' data-text='汽车配饰' >
                        <span class="submenu-name">汽车配饰</span>
                    </li>

                    <li data-val='62' data-cls_id='2_62_11' data-text='美容清洗' >
                        <span class="submenu-name">美容清洗</span>
                    </li>

                </ul>

                <ul class="SZY-SHOP-STREET-CLS-CHR hide" id="cls_list_12">
                    <li data-val='12' data-cls_id='1_12_0' data-text='食品酒水' class="">
                        <span class="submenu-name">全部</span>
                    </li>

                    <li data-val='66' data-cls_id='2_66_12' data-text='休闲食品' >
                        <span class="submenu-name">休闲食品</span>
                    </li>

                    <li data-val='67' data-cls_id='2_67_12' data-text='中外名酒' >
                        <span class="submenu-name">中外名酒</span>
                    </li>

                    <li data-val='68' data-cls_id='2_68_12' data-text='粮油调味' >
                        <span class="submenu-name">粮油调味</span>
                    </li>

                    <li data-val='71' data-cls_id='2_71_12' data-text='水果生鲜' >
                        <span class="submenu-name">水果生鲜</span>
                    </li>

                </ul>

                <ul class="SZY-SHOP-STREET-CLS-CHR hide" id="cls_list_13">
                    <li data-val='13' data-cls_id='1_13_0' data-text='保健器械' class="">
                        <span class="submenu-name">全部</span>
                    </li>

                </ul>

                <ul class="SZY-SHOP-STREET-CLS-CHR hide" id="cls_list_14">
                    <li data-val='14' data-cls_id='1_14_0' data-text='营养滋补' class="">
                        <span class="submenu-name">全部</span>
                    </li>

                    <li data-val='69' data-cls_id='2_69_14' data-text='保健器械' >
                        <span class="submenu-name">保健器械</span>
                    </li>

                    <li data-val='70' data-cls_id='2_70_14' data-text='护理护具' >
                        <span class="submenu-name">护理护具</span>
                    </li>

                </ul>

                <ul class="SZY-SHOP-STREET-CLS-CHR hide" id="cls_list_72">
                    <li data-val='72' data-cls_id='1_72_0' data-text='自驾游服务商' class="">
                        <span class="submenu-name">全部</span>
                    </li>

                    <li data-val='73' data-cls_id='2_73_72' data-text='山东出发' >
                        <span class="submenu-name">山东出发</span>
                    </li>

                    <li data-val='74' data-cls_id='2_74_72' data-text='草原自驾游' >
                        <span class="submenu-name">草原自驾游</span>
                    </li>

                </ul>

            </div>
        </div>
        <div class="distance-box shop-submenu SZY-SHOP-STREET-DISTANCE" style="display: none">
	<span>
		<a href="javascript:void(0)" class="current" data-val='' data-text='附近商家'>全部</a>
	</span>
            <span>
		<a href="javascript:void(0)" data-val='1' data-text='1千米'>1千米</a>
	</span>
            <span>
		<a href="javascript:void(0)" data-val='3' data-text='3千米'>3千米</a>
	</span>
            <span>
		<a href="javascript:void(0)" data-val='5' data-text='5千米'>5千米</a>
	</span>
            <span>
		<a href="javascript:void(0)" data-val='10' data-text='10千米'>10千米</a>
	</span>
        </div>
        <div class="sort-box shop-submenu SZY-SHOP-STREET-SORT" style="display: none">
            <!-- 销量降序class名：icon-descending，升序class名为：icon-ascending-->
            <span>
		<a href="javascript:void(0)" data-val='sale' data-text='销量'>销量</a>
	</span>
            <!--信誉 -->
            <span>
		<a href="javascript:void(0)" data-val='credit' data-text='信誉'>信誉</a>
	</span>
            <!--距离-->
            <span>
		<a href="javascript:void(0)" data-val='distance' data-text='距离'>距离</a>
	</span>
        </div>
        <div class="mask-div"></div>
        <div class='shop-street-list'></div>
        <!-- GPS获取坐标 -->
        <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
        <script type="text/javascript">
            $().ready(function() {
                $.get("/index/information/is-weixin.html", function(result) {
                    if (result.code == 0) {
                        var url = location.href.split('#')[0];

                        var share_url = "";

                        if (share_url == '') {
                            share_url = url;
                        }

                        $.ajax({
                            type: "GET",
                            url: "/site/index",
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
                        });
                    }
                }, 'json');
            });
        </script>

        <script src="http://webapi.amap.com/maps?v=1.4.6&key={{ sysconf('amap_js_key') }}"></script>
        <script src="/assets/d2eace91/js/geolocation/amap.js?v=20180813"></script>
        <script type="text/javascript">
            $().ready(function() {
                var tablelist = null;
                $('.shop-street-list').html('<div class="shop-loading-con"><img src="/assets/d2eace91/images/common/shop_loading_icon.png"><div class="shop-loading-text">正在为您定位,搜索附近店铺...</div></div>');
                if (sessionStorage.geolocation) {
                    var data = $.parseJSON(sessionStorage.geolocation);
                    loadlist(data);
                    return;
                } else {
                    //获取坐标
                    $.geolocation({
                        callback: function(data) {
                            loadlist(data);
                        }
                    });
                }

            });
            function loadlist(data) {
                if (data) {
                    $.ajax({
                        url: '/shop/street/index',
                        dataType: 'json',
                        data: {
                            output: 1,
                            lat: data.lat,
                            lng: data.lng,
                            sort: 'distance-asc',
                            name: $('#shop_name').val(),
                            cls_id: '',
                        },
                        success: function(result) {
                            $('.shop-street-list').html(result.data);
                            $('.shop-nav a').removeClass('invalid');
                            is_opening();
                        }
                    });
                }
            }
            //判断商家是否休息
            function is_opening() {
                var ids = [];
                $.each($('.SZY-IS-OPEN.valid'), function(a, b) {
                    ids.push($(b).data('shop_id'));
                    $(b).removeClass('valid');
                });
                $.get('/shop/street/open-list', {
                    'ids': ids
                }, function(result) {
                    if (result.data != null) {
                        $.each(result.data, function(i, v) {
                            if (!v.is_opening) {
                                $('.is-opening-' + v.shop_id).html('<span class="shop-rest">商家休息</span>');
                            }
                        });
                    }
                }, 'json');
            }
        </script>
        <div class="show-menu-info" id="menu">
            <ul>
                <li><a href="/"><span class="index-menu"></span><i>商城首页</i></a></li>
                <li><a href="/category.html"><span class="category-menu"></span><i>分类</i></a></li>
                <li><a href="/cart.html"><span class="cart-menu"></span><i>购物车</i></a></li>
                <li style=" border:0;"><a href="/user.html"><span class="user-menu"></span><i>我的</i></a></li>
            </ul>
        </div>
        <!-- 返顶 -->
        <a href="javascript:void(0);" class="back-to-top gotop hide"><img src="/images/topup.png"></a>
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


    </div>
    <div class="show-menu-info" id="menu">
        <ul>
            <li><a href="/"><span class="index-menu"></span><i>商城首页</i></a></li>
            <li><a href="/category.html"><span class="category-menu"></span><i>分类</i></a></li>
            <li><a href="/cart.html"><span class="cart-menu"></span><i>购物车</i></a></li>
            <li style=" border:0;"><a href="/user.html"><span class="user-menu"></span><i>我的</i></a></li>
        </ul>
    </div>
    <!-- 第三方流量统计 -->
    <div style="display: none;">
        {{--第三方统计代码--}}
        {!! sysconf('stats_code_wap') !!}
    </div>
    <!-- 底部 _end-->
    <script type="text/javascript">
        $().ready(function(){
            // 缓载图片
            $.imgloading.loading();
        });
    </script>

@stop