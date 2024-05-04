@extends('layouts.user_layout')

{{--header_css--}}
@section('header_css')
@stop

@section('content')

	<div class="except-powered-by"
	>
		<div class="header header-fixed-transparent">
			<div class="header-left">
				<a class="sb-back" href="javascript:history.back(-1)" title="返回">
					<i class="iconfont icon-fanhui1"></i>
				</a>
			</div>
			<div class="header-middle"></div>
			<div class="header-right">
				<!-- 控制展示更多按钮 -->
				<aside class="show-menu-btn">
					<div class="show-menu iconfont icon-gengduo3" id="show_more"></div>
				</aside>
			</div>
		</div>
		<style>
			.handle-spacing {
				display: none;
			}
		</style>
		<div class="payment-container bg-color" style=" background-size: cover;background-position: center center;">
			<div class="paymen-code-box">
				<div class="pay-user clearfix">
					<div class="avatar-img">
						<div class="avatar-img-info">
							<img src="{{ get_image_url($user_info->headimg, 'headimg') }}">
						</div>
					</div>
					<div class="pay-user-info bg-color">{{ $user_rank_info['rank_name'] }}：{{ $user_info->user_name }}</div>
				</div>
				<div class="bar-code dividing-line">
					<div class="bar-code-img">
						<div class="SZY-BARCODE-SMALL"></div>
					</div>
					<div class="bar-code-text">
						<span class="SZY-PAYMENT-CODE-FORMAT">7117**********5543</span>
						<em class="bar-code-view">查看数字</em>
					</div>
				</div>
				<div class="qr-code">
					<div class="SZY-QRCODE"></div>
				</div>
				<ul class="user-account-balance ub">
					<li class="ub-f1">
						<em class="balance-num color" style="color:!important;">￥{{ $user_info->user_money_limit ?? 0 }}</em>
						<span class="balance-text">总资产</span>
					</li>
					<li class="ub-f1">
						<em class="balance-num color" style="color:!important;">￥{{ $user_info->user_money ?? 0 }}</em>
						<span class="balance-text">可提现资金</span>
					</li>
					<li class="ub-f1">
						<em class="balance-num color" style="color:!important;">￥{{ $user_info->user_money_limit ?? 0 }}</em>
						<span class="balance-text">不可提现资金</span>
					</li>
				</ul>
				<div class="paymen-code-bottom">
					<ul class="ub">
						<li class="ub-f1 curr refresh-code">
							<a href="javascript:void(0)">
								<i class="iconfont">&#xe659;</i>
								<span>付款码</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
			<!--点击查看数字弹出层-->
			<div id="bar-code-layer">
				<div class="bar-code-num">
					<p>
						<i></i>
						<span>付款码数字仅用于展示给收银员，请勿泄露给其他人</span>
					</p>
					<div class="bar-code-info">
						<div class="bar-code-max">
							<div class="SZY-BARCODE"></div>
						</div>
						<div class="bar-code-text SZY-PAYMENT-CODE"></div>
					</div>
				</div>
			</div>
		</div>
		<script src="//res.wx.qq.com/open/js/jweixin-1.6.0.js"></script>
		<script type="text/javascript">
			//
		</script>
		<script type="text/javascript">
			//
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
		<div style="display: none;">

		</div>
	</div>
	<!-- 底部 _end-->
	<div class="handle-spacing"></div>
	<script src="/assets/d2eace91/min/js/core.min.js?v=20201016"></script>
	<script src="/js/app.frontend.mobile.min.js"></script>
	<script src="/assets/d2eace91/min/js/validate.min.js?v=20201016"></script>
	<script src="/js/user.js?v=1.1"></script>
	<script src="/js/address.js?v=1.1"></script>
	<script src="/js/center.js?v=1.1"></script>
	<script src="/assets/d2eace91/js/szy.cart.mobile.js?v=1.1"></script>
	<script src="/assets/d2eace91/js/jquery.qrcode.min.js?v=1.1"></script>
	<script src="/assets/d2eace91/js/jquery-barcode.min.js?v=1.1"></script>
	<script src="/assets/d2eace91/min/js/message.min.js"></script>
	<script>
		$('body').on('click', '.bar-code-view', function () {
			$("#bar-code-layer").show();
		});
		$('body').on('click', '#bar-code-layer', function () {
			$("#bar-code-layer").hide();
		});
		//强制横屏
		var width = document.documentElement.clientWidth;
		var height = document.documentElement.clientHeight;
		if (width < height) {
			$print = $('#bar-code-layer');
			$print.width(height);
			$print.height(width);
			$print.css('top', (height - width) / 2);
			$print.css('left', 0 - (height - width) / 2);
			$print.css('transform', 'rotate(90deg)');
			$print.css('transform-origin', '50% 50%');
		}
		//
		var code = '711704524090555543';
		var code_format = '7117**********5543';
		var status = '0';
		var amount = '0';
		var pay_user_id = '0';
		var wait = 120;
		var stop = false;

		function countdown() {
			if (wait <= 0 && stop == false) {
				wait = 120;
				$.post('/user/scan-code/get-code', {
					status: status,
					amount: amount
				}, function (result) {
					getCode(result.data.code, result.data.code_format);
					code = result.data.code;
					code_format = result.data.code_format;
					status = result.data.status;
					amount = result.data.amount;
					pay_user_id = result.data.pay_user_id;
				}, 'json')
				countdown();
			} else {
				wait--;
				setTimeout(function () {
					countdown();
				}, 1000)
			}
		}

		var second = 10;

		function listening() {
			if (second <= 0 && stop == false) {
				second = 10;
				$.get('/user/scan-code/listening.html', {
					id: '1103'
				}, function (result) {
					if (result.code == 0) {
						if (result.data.status != 0) {
							$('.pay-status').html(result.message);
							/*                    if(result.data.pay_user.nickname){
													$('.pay-user').html(result.data.pay_user.nickname);
												}else{
													$('.pay-user').html(result.data.pay_user.user_name);
												}
							*/
							if (result.data.status == 2 && code == result.data.code) {
								stop = true;
								$.go('/user/scan-code/result.html?shop_id=' + result.data.shop_id + '&order_sn=' + result.data.order_sn);
							}
						}
					}
				}, 'json')
				listening();
			} else {
				second--;
				setTimeout(function () {
					listening();
				}, 1000)
			}
		}

		//
		$().ready(function () {
			getCode(code, code_format);
			countdown();
			listening();
			$('.refresh-code').click(function () {
				$.loading.start();
				$.post('/user/scan-code/get-code', {
					status: status,
					amount: amount
				}, function (result) {
					getCode(result.data.code, result.data.code_format);
					code = result.data.code;
					code_format = result.data.code_format;
					status = result.data.status;
					amount = result.data.amount;
					pay_user_id = result.data.pay_user_id;
					$.loading.stop();
				}, 'json')
			});
		});

		function getCode(code, code_format) {
			$('.SZY-QRCODE').html('');
			$('.SZY-QRCODE').qrcode({
				//render: "canvas", //也可以替换为table
				width: 140,
				height: 140,
				text: code
			});
			$(".SZY-BARCODE").barcode(code, "code128", {
				barWidth: 3,
				barHeight: 80,
				showHRI: false
			});
			$(".SZY-BARCODE-SMALL").barcode(code, "code128", {
				addQuietZone: false,
				barWidth: 2,
				barHeight: 50,
				showHRI: false
			});
			$('.SZY-PAYMENT-CODE-FORMAT').html(code_format);
			$('.SZY-PAYMENT-CODE').html(code);
		}

		//
		/**
		 $().ready(function(){
         WS_AddUser({
            user_id: 'user_{{ $user_info['user_id'] ?? 0 }}',
            url: "{{ get_ws_url('4431') }}",
            type: "add_user"
        });
    });
		 **/
		function currentUserId(){
			return "{{ $user_info['user_id'] ?? 0 }}";
		}

		function getIntegralName() {
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
@stop
