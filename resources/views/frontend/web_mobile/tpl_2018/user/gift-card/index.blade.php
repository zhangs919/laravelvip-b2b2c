@extends('layouts.user_layout')

{{--header_css--}}
@section('header_css')

@stop



@section('content')

    <header>
        <div class="header">
            <div class="header-left">
                <a class="sb-back" href="javascript:history.back(-1)" title="返回">
                    <i class="iconfont">&#xe606;</i>
                </a>
            </div>
            <div class="header-middle">提货券提货</div>
        </div>
    </header>
    <div class="middle-content m-t-0">
        <form id="GiftCardModel" class="form-horizontal" name="GiftCardModel" action="/user/gift-card/index.html" method="post">
            <input type="hidden" name="_csrf" value="6P0LkjlE87KY9ppdwaUCrd1PwlQEEYRB_B5T0C5AF6KspGXxewfA_OvD3DaP42acsg64O3RkxTiYLxy_b21hzQ==">	<!-- 提货券卡号 -->
            <div class="form-group form-group-spe" >
                <dl>
                    <dt>
                        <span>提货券卡号：</span>
                    </dt>
                    <dd>
                        <div class="form-control-box">

                            <input type="text" id="giftcardmodel-card_no" class="form-control" name="GiftCardModel[card_no]" placeholder="请输入提货券卡号" autofocus="autofocus">


                        </div>

                    </dd>
                </dl>
            </div>
            <div class="invalid"></div>	<!-- 提货券密码 -->
            <div class="form-group form-group-spe" >
                <dl>
                    <dt>
                        <span>提货券密码：</span>
                    </dt>
                    <dd>
                        <div class="form-control-box">

                            <input type="password" id="giftcardmodel-card_pass" class="form-control" name="GiftCardModel[card_pass]" placeholder="请输入提货券密码">


                        </div>

                    </dd>
                </dl>
            </div>
            <div class="invalid"></div>	<!-- 验证码：输错三次后显示 -->

            <div class="submit-btn">
                <a class="btn-submit" id="btn_submit" type="submit" href="javascript:void(0)">确认提交</a>
            </div>
        </form>
    </div>

    <!-- 表单验证 -->
    <script src="/assets/d2eace91/js/validate/jquery.validate.js?v=20190221"></script>
    <script src="/assets/d2eace91/js/validate/jquery.validate.custom.js?v=20190221"></script>
    <script src="/assets/d2eace91/js/validate/messages_zh.js?v=20190221"></script>
    <!-- 验证码脚本 -->
    <script src="/assets/d2eace91/js/jquery.captcha.js?v=20190221"></script>
    <script id="client_rules" type="text">
[{"id": "giftcardmodel-card_no", "name": "GiftCardModel[card_no]", "attribute": "card_no", "rules": {"required":true,"messages":{"required":"提货券卡号不能为空。"}}},{"id": "giftcardmodel-card_pass", "name": "GiftCardModel[card_pass]", "attribute": "card_pass", "rules": {"required":true,"messages":{"required":"提货券密码不能为空。"}}},{"id": "giftcardmodel-captcha", "name": "GiftCardModel[captcha]", "attribute": "captcha", "rules": {"captcha":{"hash":442,"hashKey":"niiCaptcha/site/captcha","caseSensitive":false},"messages":{"captcha":"验证码不正确。"}}},]
</script>
    <script type="text/javascript">
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
                            $.msg(result.message);
                            if (result.error_count == 3) {
                                setTimeout(function() {
                                    $.go("/user/gift-card/goods.html");
                                }, 2000);
                            }
                        }
                    }
                });
            });
            $("input").watch();

            setTimeout(function(){
                $('#giftcardmodel-card_no').trigger("click").focus();
            },200);
        });
    </script>



    <script src="/js/jquery.fly.min.js?v=20190221"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js?v=20190221"></script>

    {{--引入右上角菜单--}}
    @include('layouts.partials.right_top_menu')

    <!-- 第三方流量统计 -->
    <div style="display: none;"></div>
    <!-- 底部 _end-->



@stop