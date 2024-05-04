<!DOCTYPE html>
<!--[if IE 8]>
<html lang="zh-CN" class="ie8"> <![endif]-->
<html lang="zh-CN">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<title>工商资质</title>
	<meta content="telephone=no,email=no,address=no" name="format-detection"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
	<meta name="msapplication-tap-highlight" content="no"/>
	<meta name="apple-mobile-web-app-capable" content="yes"/>
	<meta name="apple-mobile-web-app-status-bar-style" content="black"/>
	<meta name="wap-font-scale" content="no"/>
	<meta name="Keywords" content=""/>
	<meta name="Description" content=""/>
	<!-- 网站头像 -->
	<link rel="icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}"/>
	<link rel="shortcut icon" type="image/x-icon" href="{{ get_image_url(sysconf('favicon')) }}"/>
	<link href="/css/iconfont/iconfont.css" rel="stylesheet">
	<link href="/css/app.frontend.mobile.min.css" rel="stylesheet">
	<link href="/css/license.css" rel="stylesheet">
	<script src="/assets/d2eace91/js/jquery.js"></script>
	<script src="/assets/d2eace91/js/szy.head.js"></script>

	{{--国家默哀日期--}}
	{!! $national_memorial_day_html ?? '' !!}
</head>
<body>
@if($show_data)
	<div class="w990 box-mod">
		<div class="box-hd">
			<h3>{{ $site_name }}经营者营业执照信息</h3>
			<p>
				根据国家市场监管管理总局
				<a href="https://www.gov.cn/zhengce/zhengceku/2021-03/16/content_5593226.htm" target="_blank">《网络交易监督管理办法》</a>
				要求对网店营业执照信息公示如下：
			</p>
		</div>
		@if($shop_info->shop_type == 2 && !empty($shop_field_value->license))
			<div class="box-bd">
				<div class="box-item">
					<img src="{{ get_image_url($shop_field_value->license) }}" alt="" />
					<p>经营者信息以营业执照为准</p>
				</div>
			</div>
		@elseif($shop_info->shop_type == 1 && !empty($shop_field_value->special_aptitude))
			<div class="box-bd">
				<div class="box-item">
					<img src="{{ get_image_url($shop_field_value->special_aptitude) }}" alt="" />
					<p>经营者信息以营业执照为准</p>
				</div>
			</div>
		@endif

	</div>
@else
	<div class="w990 bomb-box-mod">
		<div class="bomb-box">
			<h5>网店经营者营业执照信息</h5>
			<div class="content">
				<div class="box-hd">
					<h3>{{ $site_name }}经营者营业执照信息</h3>
					<p>根据国家工商总局《网络交易管理办法》要求对网店营业执照信息公示如下：</p>
				</div>

				<div class="check">
					<form id="CaptchaModel" class="form-horizontal" name="CaptchaModel"
						  action="/shop/index/license.html?id={{ $id }}" method="post">
						@csrf
						<div class="form-group form-group-spe">
							<dl>
								<dt>
									<span>请输入图中的验证码后查看：</span>
								</dt>
								<dd>
									<div class="form-control-box">
										<input type="text" id="captcha" class="input-small"
											   name="CaptchaModel[captcha]">
										<label class="captcha">
											<img id="captcha-image" class="captcha-image" name="CaptchaModel[captcha]"
												 src="/site/captcha.html?v={{ uniqid() }}" alt="点击换图" title="点击换图"
												 style="vertical-align: middle; cursor: pointer;">
											<script data-captcha-id="captcha-image" type="text">
												{"refreshUrl":"\/site\/captcha.html?refresh=1","hashKey":"niiCaptcha\/site\/captcha"}
											</script>
										</label>
									</div>
								</dd>
							</dl>
						</div>
						{{--                    <div class="invalid"></div>--}}
						<div class="form-group form-group-spe">
							<dl>
								<dt>
								</dt>
								<dd>
									<div class="form-control-box">
										<input type="button" class="btn" id="btn_submit" name="btn_submit" value="提交">
									</div>
								</dd>
							</dl>
						</div>
						{{--                    <div class="invalid"></div>--}}
					</form>
				</div>

			</div>
		</div>
	</div>
@endif



<!-- 验证规则 -->
<script id="client_rules" type="text">
	[]
	{{--    [{"id": "captchamodel-captcha", "name": "CaptchaModel[captcha]", "attribute": "captcha", "rules": {"captcha":{"hash":461,"hashKey":"niiCaptcha/site/captcha","caseSensitive":false},"messages":{"captcha":"验证码不正确。"}}},]--}}
</script>
<script type="text/javascript">
	//
</script>
<script src="/assets/d2eace91/min/js/core.min.js"></script>
<script src="/js/app.frontend.mobile.min.js"></script>
<script src="/assets/d2eace91/min/js/validate.min.js"></script>
<script>
	$().ready(function () {
		var validator = $("#CaptchaModel").validate();
		// 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
		$.validator.addRules($("#client_rules").html());
		$("#btn_submit").click(function () {
			if (!validator.form()) {
				return;
			}
			$("#CaptchaModel").submit();
			return false;
		});
	});
	//
</script>
</body>
</html>
