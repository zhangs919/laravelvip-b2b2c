@extends('layouts.user_layout')

{{--header_js--}}
@section('header_js')

@stop

@section('content')

	<!-- 正文，由view提供 -->
	<div class="con-right fr">
		<div class="con-right-text">
			<div class="tabmenu">
				<ul class="tab">
					<li class="active">权益卡</li>
				</ul>
				<div class="user-tab-right">
					<a href="/user/rights-card/index.html">返回权益卡列表</a>
				</div>
			</div>
			<div class="content-info">
				<div class="pr-model">
					<div class="card-info-inner">
						<div class="card-l">
							<div class="shop-info">
								<img src="https://xxxx/images/shop/309/images/2019/01/25/15484069028906.png?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80">
								<span>三只松鼠旗舰店</span>
								<div class="card-state">
									使用中
								</div>
							</div>
							<div class="card-title">
								高级会员(VIP2)
								<span class="default">默认</span>
							</div>
							<div class="card-type">
								类型：
								按规则发放
							</div>
							<div class="card-time">
								有效期：
								永久有效
							</div>
						</div>
						<div class="card-r">
							<!--开通显示-->
							<div class="card-r-title" style="margin: 25px 0 30px;">卡号：951450927434003</div>
						</div>
						<a class="card-del-btn" title="点击删除权益卡"></a>
					</div>
				</div>
				<div class="pr-model">
					<div class="pr-model-title">
						<i class="icon"></i>
						尊享权益
					</div>
					<div class="privilege-box">
						<div class="privilege-item">
							<a href="javascript:void(0);">
								<span class="privilege-icon zx"></span>
								<span class="privilege-name">折扣</span>
								<span class="privilege-desc">消费享2.00折</span>
							</a>
						</div>
						<div class="clear"></div>
					</div>
					<!--红包列表直接展示出来效果-->
					<div class="card-coupon-list hb-list">
						<ul>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!--红包弹框-->
		<div class="card-coupon-pop bonus" style="display: none;">
			<div class="card-coupon-l">
				<p class="ctitle-1">领券专区</p>
				<p class="ctitle-2">PLUS会员专享券</p>
				<p class="ctitle-line"></p>
				<p class="ctitle-3">每天都有新惊喜</p>
			</div>
			<!--右侧红包列表-->
			<div class="card-coupon-list">
				<a class="card-arrow-btn before">
					<i></i>
				</a>
				<a class="card-arrow-btn after">
					<i></i>
				</a>
				<ul>
				</ul>
			</div>
		</div>
		<script type="text/javascript">
            //
		</script></div>

@stop

{{--底部js--}}
@section('footer_js')
	<script src="/js/common.js"></script>
	<script src="/js/user.js"></script>
	<script src="/assets/d2eace91/js/yii.js"></script>
	<script src="/assets/d2eace91/js/layer/layer.js"></script>
	<script src="/assets/d2eace91/js/jquery.method.js"></script>
	<script src="/assets/d2eace91/js/jquery.modal.js"></script>
	<script src="/assets/d2eace91/js/common.js"></script>
	<script src="/assets/d2eace91/js/table/jquery.tablelist.js"></script>
	<script src="/assets/d2eace91/js/jquery.cookie.js"></script>
	<script src="/js/jquery.fly.min.js"></script>
	<script src="/assets/d2eace91/js/szy.cart.js"></script>
	<script src="/assets/d2eace91/min/js/message.min.js"></script>
	<script>
        $("body").on("click", ".bonus-receive", function() {
            var bonus_id = $(this).data("bonus-id");
            var user_card_id = "192";
            var target = $(this);
            $.post("/user/rights-card/receive.html", {
                bonus_id: bonus_id,
                user_card_id: user_card_id
            }, function(result) {
                if (result.code == 0) {
                    if (result.code == 0) {
                        // 0-已领取 1-还可以继续领取
                        if (result.data == 0) {
                            $(target).html("已领取").removeClass("bonus-receive").addClass("bonus-received");
                        }
                        $.msg(result.message);
                        return;
                    } else if (result.code == 130) {
                        $(target).html("已领取").removeClass("bonus-receive").addClass("bonus-received");
                    } else if (result.code == 131) {
                        $(target).html("已抢光").removeClass("bonus-receive").addClass("bonus-received");
                    } else {
                    }
                    $.msg(result.message, {
                        time: 5000
                    });
                } else {
                    $.msg(result.message, {
                        time: 5000
                    });
                }
            }, "JSON").always(function() {
                $.loading.stop();
            });
        });
        // 设为默认
        $("body").on("click", ".set-default", function() {
            $.loading.start();
            var user_card_id = "192";
            $.post("/user/rights-card/set-default.html", {
                id: user_card_id
            }, function(result) {
                if (result.code == 0) {
                    // $(".set-default").hide();
                    window.location.reload();
                    $.msg(result.message);
                } else {
                    $.msg(result.message, {
                        time: 5000
                    });
                }
            }, "JSON").always(function() {
                $.loading.stop();
            });
        });
        // 删除卡片
        $("body").on("click", ".card-del-btn", function() {
            var user_card_id = "192";
            var card_type = "0";
            if (card_type == 2) {
                $.msg('付费权益卡不可删除！');
                return;
            }
            var is_default = "1";
            if (is_default == 1) {
                $.msg('默认权益卡不可删除！');
                return;
            }
            $.loading.start();
            $.confirm("删除后，您将不再享受相应的会员权益，确定要删除吗？", function() {
                $.ajax({
                    type: 'GET',
                    url: '/user/rights-card/delete',
                    data: {
                        id: user_card_id
                    },
                    dataType: 'json',
                    success: function(result) {
                        if (result.code == 0) {
                            $.msg(result.message, {
                                time: 1000
                            }, function() {
                                $.go('/user/rights-card/index.html');
                            });
                        } else {
                            $.msg(result.message);
                        }
                    }
                });
            });
        });
        $("body").on("click", ".quick-get", function() {
            $.loading.start();
            var rank_id = "54";
            $.post("/user/rights-card/quick-get.html", {
                rank_id: rank_id
            }, function(result) {
                if (result.code == 0) {
                    $.go('/user/rights-card/info?id=' + result.id);
                    $.msg(result.message, {
                        time: 5000
                    });
                } else {
                    $.msg(result.message, {
                        time: 5000
                    });
                }
            }, "JSON").always(function() {
                $.loading.stop();
            });
        });
        //
        $(document).ready(function() {
            $(".SZY-SEARCH-BOX-TOP .SZY-SEARCH-BOX-SUBMIT-TOP").click(function() {
                if ($(".search-li-top.curr").attr('num') == 0) {
                    var keyword_obj = $(this).parents(".SZY-SEARCH-BOX-TOP").find(".SZY-SEARCH-BOX-KEYWORD");
                    var keywords = $(keyword_obj).val();
                    if ($.trim(keywords).length == 0 || $.trim(keywords) == "请输入关键词") {
                        keywords = $(keyword_obj).data("searchwords");
                    }
                    $(keyword_obj).val(keywords);
                }
                $(this).parents(".SZY-SEARCH-BOX-TOP").find(".SZY-SEARCH-BOX-FORM").submit();
            });
        });
        //
        $().ready(function() {
        })
        //
        $().ready(function() {
            WS_AddPoint({
                user_id: '{{ $user_info['user_id'] ?? 0 }}',
                url: "{{ get_ws_url('4431') }}",
                type: "add_point_set"
            });
        }, 'JSON');
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
