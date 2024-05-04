
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]-->
<html lang="zh-CN">
<head>
	<meta charset="utf-8" />
	<title>{{ $seo_title ?? '乐融沃B2B2C商城演示站' }}</title>
	<!-- 头部元数据 -->
	<meta name="csrf-param" content="_csrf">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta content="telephone=no,email=no,address=no" name="format-detection" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover, viewport-fit=cover">
	<meta name="msapplication-tap-highlight" content="no" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<meta name="wap-font-scale" content="no" />
	<meta name="Keywords" content="{{ $seo_keywords ?? '' }}" />
	<meta name="Description" content="{{ $seo_description ?? '' }}" />
	<meta name="is_frontend" content="yes" />
	<meta name="is_web_mobile" content="yes" />
	<meta name="js_version" content="1.1" />
	<meta name="is_webp" content="yes" />
	<!-- 网站头像 -->
	<link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
	<link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
	<meta name="m_main_color" content="" />
	<link href="/assets/d2eace91/css/swiper/swiper.min.css?v=1.4" rel="stylesheet" position="1">
	<link href="/css/common.css" rel="stylesheet">
	<link href="/css/iconfont/iconfont.css" rel="stylesheet">
	<!--整站改色 _start-->
	@if(sysconf('custom_style_enable_m_site') == 1)
		<link rel="stylesheet" href="/css/custom/m_site-color-style-0.css?v=1.6" id="site_style"/>
	@else
		<link rel="stylesheet" href="/css/color-style.css?v=1.2" id="site_style"/>
	@endif
	<script src="/assets/d2eace91/js/jquery.js?v=1.1"></script>
	<script src="/assets/d2eace91/js/szy.head.js?v=1.1"></script>
	<script src="/assets/d2eace91/js/jquery.base64.js?v=1.1"></script>
</head>
<body>
<!-- 内容 -->
<div id="index_content"><style type="text/css">
		.layer-div-position {
			position: fixed;
			left: 5px;
			top: 0px;
			height: 60px;
			width: 60px;
			z-index: 2;
			cursor: pointer;
		}
	</style>
	{{--引入右上角菜单--}}
	@include('layouts.partials.right_top_menu')
	<iframe src="" id="mapiframe" name="mapiframe" frameborder="0" width="100%"></iframe>
	<script type="text/javascript">
		//
	</script>
	<script type="text/javascript">
		//
	</script>
</div>
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

</div>
<script src="/assets/d2eace91/js/jquery.lazyload.js?v=1.1"></script>
<script src="/assets/d2eace91/js/layer/layer.js?v=1.1"></script>
<script src="/assets/d2eace91/js/jquery.cookie.js?v=1.1"></script>
<script src="/assets/d2eace91/js/jquery.history.js?v=1.1"></script>
<script src="/assets/d2eace91/js/jquery.method.js?v=1.1"></script>
<script src="/assets/d2eace91/js/jquery.widget.js?v=1.1"></script>
<script src="/assets/d2eace91/js/jquery.modal.js?v=1.1"></script>
<script src="/assets/d2eace91/js/table/jquery.tablelist.js?v=1.1"></script>
<script src="/assets/d2eace91/js/szy.page.more.js?v=1.1"></script>
<script src="/assets/d2eace91/js/swiper/swiper.jquery.min.js?v=1.1"></script>
<script src="/js/common.js"></script>
<script src="/js/jquery.fly.min.js"></script>
<script src="/js/placeholder.js"></script>
<script src="/assets/d2eace91/js/szy.cart.mobile.js?v=1.1"></script>
<script src="/assets/d2eace91/js/message/message.js?v=1.1"></script>
<script src="/assets/d2eace91/js/message/messageWS.js?v=1.1"></script>
<script>
	window._AMapSecurityConfig = {
		securityJsCode: "{{ sysconf('amap_js_security_code') }}",
	};

	var domain = "https://";
	if (sessionStorage.geolocation) {
		var data = $.parseJSON(sessionStorage.geolocation);
		$('#mapiframe').attr('src', domain + 'm.amap.com/navigation/carmap/saddr=' + data.lng + ',' + data.lat + ',我的位置&daddr={{ $dest }},{{ $title }}&sort=dist');
	} else {
		$('#mapiframe').attr('src', domain + 'm.amap.com/navi/?map&dest={{ $dest }}&destName={{ $title }}&naviBy=car&key={{ sysconf('amap_js_key') }}');
	}
	//
	var ifm = document.getElementById("mapiframe");
	ifm.height = document.documentElement.clientHeight;
	if (!/*@cc_on!@*/0) { //如果不是IE，IE的条件注释
		ifm.onload = function() {
			var appendHtml = '<div class="layer-div-position"></div>';
			$('body').append(appendHtml);
		};
	} else {
		ifm.onreadystatechange = function() { // IE下的节点都有onreadystatechange这个事件
			if (iframe.readyState == "complete") {
				var appendHtml = '<div class="layer-div-position"></div>';
				$('body').append(appendHtml);
			}
		};
	}
	$('body').on('click', '.layer-div-position', function() {
		window.history.back(-1);
	});
	//
	$().ready(function() {
		// 缓载图片
		$.imgloading.loading();
	});
	//
	/**
	 $().ready(function(){
        WS_AddUser({
            user_id: 'user_43',
            url: "wss://push.xxx.com:4431/",
            type: "add_user"
        });
    });
	 **/
	function currentUserId(){
		return '{{ $user_info['user_id'] ?? '' }}';
	}
	function getIntegralName(){
		return '积分';
	}
	function addPoint(ob) {
		if (ob != null && ob != 'undefined') {
			if (ob.point && ob.point > 0 && ob.user_id && ob.user_id == currentUserId()) {
				$.intergal({
					point: ob.point,
					name: getIntegralName()
				});
			}
		}
	}
	//
</script>
</body>
</html>
