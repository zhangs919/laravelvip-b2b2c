@extends('layouts.user_layout')

{{--header_css--}}
@section('header_css')

@stop

{{--header_js--}}
@section('header_js')

@stop

@section('content')

    <!-- 正文，由view提供 -->
    <div class="con-right fr">
        <script src="/js/common.js?v=20190221"></script>
        <script src="/js/user.js?v=20190221"></script>
        <div class="con-right-text">
            <div class="tabmenu">
                <div class="user-status">
			<span class="user-statu active">
				<a href="javascript:;" class="color">
					<span>提货券提货</span>
					<span class="vertical-line">|</span>
				</a>
			</span>
                    <span class="user-statu">
				<a href="/user/order/list.html?is_gift=1">
					<span>提货列表</span>
				</a>
			</span>
                </div>
            </div>
            <div class="content">
                <form id="GiftCardModel" class="form-horizontal form-gift-card" name="GiftCardModel" action="/user/gift-card/index.html" method="post">
                    <input type="hidden" name="_csrf" value="UVzmjqgKUngBgclpy2UE-yJJ-7GUkhmGSfzfG22ibLIkZd_48WsaE0T2kwaPUmGJbiyy5P7XdLY5xYUoHsgL4w==">		<!-- 提货券卡号 -->
                    <div class="form-group form-group-spe" >
                        <label for="giftcardmodel-card_no" class="input-left">
                            <span class="spark">*</span>
                            <span>提货券卡号：</span>
                        </label>
                        <div class="form-control-box">

                            <input type="text" id="giftcardmodel-card_no" class="form-control" name="GiftCardModel[card_no]">


                        </div>

                        <div class="invalid"></div>
                    </div>		<!-- 提货券密码 -->
                    <div class="form-group form-group-spe" >
                        <label for="giftcardmodel-card_pass" class="input-left">
                            <span class="spark">*</span>
                            <span>提货券密码：</span>
                        </label>
                        <div class="form-control-box">

                            <input type="password" id="giftcardmodel-card_pass" class="form-control" name="GiftCardModel[card_pass]" autocomplete="new-password">
                            <i class="fa fa-eye-slash pwd-toggle" data-id="giftcardmodel-card_pass"></i>


                        </div>

                        <div class="invalid"></div>
                    </div>		<!-- 验证码：输错三次后显示 -->

                    <div class="act">
                        <input type="button" class="btn btn-primary" value="确认提交" id="btn_submit">
                    </div>
                </form>	</div>
        </div>
        <!-- 表单验证 -->
        <!-- 验证码脚本 -->
        <script id="client_rules" type="text">
[{"id": "giftcardmodel-card_no", "name": "GiftCardModel[card_no]", "attribute": "card_no", "rules": {"required":true,"messages":{"required":"提货券卡号不能为空。"}}},{"id": "giftcardmodel-card_pass", "name": "GiftCardModel[card_pass]", "attribute": "card_pass", "rules": {"required":true,"messages":{"required":"提货券密码不能为空。"}}},{"id": "giftcardmodel-captcha", "name": "GiftCardModel[captcha]", "attribute": "captcha", "rules": {"captcha":{"hash":414,"hashKey":"niiCaptcha/site/captcha","caseSensitive":false},"messages":{"captcha":"验证码不正确。"}}},]
</script>

    </div>

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
    <script src="/assets/d2eace91/js/jquery.captcha.js"></script>
    <script src="/assets/d2eace91/min/js/validate.min.js"></script>
    <script src="/assets/d2eace91/min/js/message.min.js"></script>
    <script>
        $().ready(function() {
            var validator = $("#GiftCardModel").validate();
            // 验证规则，此验证规则会影响编辑器中JavaScript的的格式化操作
            $.validator.addRules($("#client_rules").html());
            $("#btn_submit").click(function() {
                if (!validator.form()) {
                    return;
                }
                $.loading.start();
                var card_no = $("#giftcardmodel-card_no").val();
                var card_pass = $("#giftcardmodel-card_pass").val();
                $.ajax({
                    cache: false,
                    type: "POST",
                    data: {
                        card_no: card_no,
                        card_pass: card_pass
                    },
                    url: "/user/gift-card/index",
                    success: function(result) {
                        var result = eval('(' + result + ')');
                        if (result.code == 0) {
                            $.go("/user/gift-card/goods.html");
                        } else {
                            $.msg(result.message, {
                                time: 3000
                            });
                            setTimeout(function() {
                                $.go("/user/gift-card/index.html");
                            }, 3000);
                        }
                    },
                    error: function(result) {
                        $.alert("异常", {
                            icon: 2
                        });
                    }
                });
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