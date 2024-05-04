
<!DOCTYPE html>
<!--[if IE 8]> <html lang="zh-CN" class="ie8"> <![endif]-->
<html lang="zh-CN">
<head>
	<meta charset="utf-8" />
	<title>{{ $seo_title }}</title>
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
	<meta name="Keywords" content="" />
	<meta name="Description" content="" />
	<meta name="is_frontend" content="yes" />
	<meta name="is_web_mobile" content="yes" />
	<meta name="js_version" content="1.1" />
	<meta name="is_webp" content="yes" />
	<!-- 网站头像 -->
	<link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
	<link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}" />
	<meta name="m_main_color" content="" />
	<!--整站改色 _start-->
	<link href="/css/common.css" rel="stylesheet">
	<link href="/css/iconfont/iconfont.css" rel="stylesheet">
	<link href="/css/login.css?v=1.4" rel="stylesheet">
	<link href="/css/bonus_message.css?v=1.4" rel="stylesheet">
	@if(sysconf('custom_style_enable_m_site') == 1)
		<link rel="stylesheet" href="/css/custom/m_site-color-style-0.css?v=1.6" />
	@else
		<link rel="stylesheet" href="/css/color-style.css?v=1.2" />
	@endif
	<script src="/assets/d2eace91/js/jquery.js?v=1.1"></script>
	<script src="/assets/d2eace91/js/szy.head.js?v=1.1"></script>
	<script src="/assets/d2eace91/js/jquery.base64.js?v=1.1"></script>
</head>
<body>
<!-- 红包消息 -->
<div class="reg-content"><header id="header" class="header">
		<div class="header-left">
			<a href="javascript:history.back(-1)" class="sb-back">
				<i class="iconfont">&#xe606;</i>
			</a>
		</div>
		<div class="header-middle">注册成功</div>
	</header>
	<div class="register-success">
		<div class="register-success-icon">
			<i class="iconfont">&#xe62d;</i>
		</div>
		<p class="register-success-tip">恭喜，{{ $user->user_name }}注册成功！</p>
		<div class="register-success-btn">
			<a class="btn" href="/">商城首页</a>
			<a class="btn" title="继续访问之前的页面" href="/">继续访问</a>
		</div>
	</div></div>
<!-- 用户协议 -->
<div id="user_protocol">
	<div class="user-protocol-con">
		<header>
			<div class="header">
				<div class="header-left">
					<a class="sb-back" href="javascript:void(0)">
						<i class="iconfont">&#xe606;</i>
					</a>
				</div>
				<div class="header-middle">用户注册协议</div>
				<div class="header-right"></div>
			</div>
		</header>
		<div class="protocol">
			<div class="protocol-con"></div>
		</div>
	</div>
</div>
<!-- 底部 -->
<script type="text/javascript">
	//
</script>
<!-- 第三方流量统计 -->
<div style="display: none;">
	{{--第三方统计代码--}}
	{!! sysconf('stats_code_wap') !!}
</div>
<!-- 底部 _end-->
<script type="text/javascript">
	$().ready(function() {
		$(".user_protocol").click(function() {
			$('#user_protocol').addClass('show');
		});
		$('.header-left').click(function() {
			$('#user_protocol').removeClass('show');
		});
	});
</script>
</body>
</html>
