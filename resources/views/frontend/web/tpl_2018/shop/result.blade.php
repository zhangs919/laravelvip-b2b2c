@extends('layouts.shop_apply_layout')

@section('content')

    <!--头部信息-->
    <div class="header-layout">
        <div class="header-conter">
            <h2 class="header_logo">
                <a href="/" class="logo">
                    <img src="{{ get_image_url(sysconf('mall_logo')) }}" />
                </a>
            </h2>
            <div class="header-extra">
                <div class="progress">
                    <div class="progress-wrap">
                        <div class="progress-item @if($progress >= 0){{ 'ongoing' }}@else{{ 'tobe' }}@endif">
                            <div class="number">1</div>
                            <div class="progress-desc">开店申请</div>
                        </div>
                    </div>
                    <div class="progress-wrap">
                        <div class="progress-item  @if($progress >= 2){{ 'ongoing' }}@else{{ 'tobe' }}@endif ">
                            <div class="number">2</div>
                            <div class="progress-desc">网站审核</div>
                        </div>
                    </div>
                    <div class="progress-wrap">
                        <div class="progress-item @if($progress >= 4){{ 'ongoing' }}@else{{ 'tobe' }}@endif">
                            <div class="number">3</div>
                            <div class="progress-desc">支付开店款项</div>
                        </div>
                    </div>

                    <div class="progress-wrap">
                        <div class="progress-item  @if($progress == 5){{ 'ongoing' }}@else{{ 'tobe' }}@endif ">
                            <div class="number">√</div>
                            <div class="progress-desc">创建店铺</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 内容 -->
    <div class="content">
        <!--开店成功时显示-->
        @if($progress == 2)
        <div class="operat-tips success">
            <h4>
                <i></i>
                您的开店申请已成功提交！
            </h4>
            <ul class="operat-panel">
                <li>
                    <span>我们将在3个工作日内（不包括国家法定假日）完成审核并短信或邮件的方式通知您；</span>
                </li>
                <li>
				<span>
					您也可以登录
					<a class="btn-link" href="/shop/apply.html">商家入驻中心</a>
					及时查看审核状态；
				</span>
                </li>
                <li>
                    <span>开店申请审核通过后，您可在线缴纳店铺使用费及保证金，缴纳成功后，即开店成功； </span>
                </li>
                <li>
                    <span> 如有疑问请联系网站客服。 </span>
                </li>
            </ul>
            <div class="bottom">
                <a class="btn btn-primary confirm">撤销申请 </a>
                <a class="btn" href="/">返回首页 </a>
            </div>
        </div>
        @endif

        <!--开店失败时显示-->


        <!--网站审核成功时显示-->
        @if($progress == 4 && $type != 6)
        <div class="operat-tips success">
            <h4>
                <i></i>
                您的开店申请已通过审核，请尽快付款！
            </h4>
            <p>
                待支付金额：
                <font class="amount">{{ format_price($shop['system_fee']+$shop['insure_fee']) }}</font>
                元
            </p>
        </div>
        <div class="pay-type">
            <h2 class="payment-title">支付方式</h2>
            <ul id="paylist" class="payment-tab">

                @foreach($pay_list as $v)
                <!-- 货到付款特殊处理 -->
                <li class="clearfix" @if($v['disabled'] == 1)style="display: none;"@endif>
                    <label>
                        <input type="radio" id="pac_code_{{ $v['id'] }}" name="pay_code" class="pay_code" value="{{ $v['code'] }}" >
                        <img src="/assets/d2eace91/images/payment/{{ $v['code'] }}.jpg" alt="" class="pay-img" />
                    </label>
                    <div class="pay-tips" style="display: none;">
                        <div class="pay-tips-name">
                            <i></i>
                            {{ $v['tips'] }}
                        </div>
                    </div>
                </li>
                @endforeach

            </ul>
            <div class="text-c">
                <a href="javascript:void(0);" class="btn btn-primary pay_now">立即支付</a>
                <input type="hidden" id="shop_amount" value="{{ format_price($shop['system_fee']+$shop['insure_fee']) }}">
            </div>
        </div>
        @endif


        <!--付款成功，去开店-->
        @if($progress == 5)
        <div class="operat-tips success-5">
            <h4>
                <i></i>
                <span class="message">
             	<h5>恭喜您，您已成功开店！</h5>
                <p>您可以登录<a href="{{ route('seller_home') }}" class=" btn-link">卖家中心</a>打理店铺啦！</p>
            </span>
            </h4>
            <div class="guide">
                <h5>店铺运营准备工作：</h5>
                <ul>
                    <li>店铺基本信息配置<i></i></li>
                    <li>店铺客服设置<i></i></li>
                    <li>店铺会员等级设置<i></i></li>
                    <li>店铺商品维护<i></i></li>
                    <li>交易设置<i></i></li>
                    <li>店铺装修</li>
                </ul>
            </div>
        </div>
        @endif

        <!--支付失败时显示-->
        @if($progress == 6 || $type == 6)
            <div class="operat-tips lose">
                <h4>
                    <i></i>
                    尚未缴费成功！
                </h4>
                <p>
                    待支付金额：
                    <font class="amount">{{ format_price($shop['system_fee']+$shop['insure_fee']) }}</font>
                    元
                </p>
                <p>未支付成功，店铺无法正常经营，请您尽快完成支付！</p>
            </div>

            <div class="pay-type">
                <h2 class="payment-title">支付方式</h2>
                <ul id="paylist" class="payment-tab">

                @foreach($pay_list as $v)
                    <!-- 货到付款特殊处理 -->
                        <li class="clearfix" @if($v['disabled'] == 1)style="display: none;"@endif>
                            <label>
                                <input type="radio" id="pac_code_{{ $v['id'] }}" name="pay_code" class="pay_code" value="{{ $v['code'] }}" >
                                <img src="/assets/d2eace91/images/payment/{{ $v['code'] }}.jpg" alt="" class="pay-img" />
                            </label>
                            <div class="pay-tips" style="display: none;">
                                <div class="pay-tips-name">
                                    <i></i>
                                    {{ $v['tips'] }}
                                </div>
                            </div>
                        </li>
                    @endforeach

                </ul>
                <div class="text-c">
                    <a href="javascript:void(0);" class="btn btn-primary pay_now">立即支付</a>
                    <input type="hidden" id="shop_amount" value="{{ format_price($shop['system_fee']+$shop['insure_fee']) }}">
                </div>
            </div>
        @endif


    </div>
    <!-- 付款信息弹框 -->
    <div id="bg" class="bg" style="display: none"></div>
    <div class="bomb-box payment-box" style="display: none">
        <div class="box-title">请付款</div>
        <div class="box-oprate payment-box-oprate"></div>
        <div class="content-info">
            <p class="warning">
                <i></i>
                <span>请您在新打开的页面上完成付款。</span>
            </p>
            <p class="prompt">付款完成前请不要关闭此窗口</p>
            <p class="prompt">完成付款后请根据您的情况点击下面的按钮</p>
            <p class="btns">
                <a href="/shop/apply/result.html" class="pay_result">已完成付款</a>
                <a href="/shop/apply/result.html?type=6" class="m-l-10 pay_result">付款遇到问题</a>
            </p>
        </div>
    </div>
    <script type="text/javascript">
        $().ready(function() {
            $("body").on("click", ".btn.btn-primary.confirm", function() {
                $.confirm("撤销申请之后您再想开店，需要重新提交开店申请，您确定要撤销开店申请吗？", function() {
                    $.go("/shop/apply/cancel.html");
                });
            });
            $("body").on("click", ".pay_now", function() {
                var target = $(this);
                $.ajax({
                    url: '/shop/apply/pay.html',
                    type: 'POST',
                    dataType: 'json',
                    async: false,
                    data: {
                        amount: $("#shop_amount").val(),
                        paycode: $('input:radio:checked').val()
                    },
                    success: function(result) {
                        if (result.code == 0) {
                            $(".pay_now").removeClass('pay_now').html("正在提交...");
                            $('.payment-box').show();
                            $('#bg').show();
                            window.open().location = result.data;
                        } else {
                            $.msg(result.message, {
                                time: 3000
                            });
                        }
                    }
                }).always(function() {
                    $(target).data("loading", false).html("确认交易");
                });
            });

        });
    </script>

@stop