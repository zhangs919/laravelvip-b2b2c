@extends('layouts.base')

{{--header_css--}}
@section('header_css')
    <link rel="stylesheet" href="/css/flow.css?v=20180702"/>
@stop

{{--header_js--}}
@section('header_js')
    <script src="/js/jquery-1.9.1.min.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/layer/layer.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20180813"></script>
    <script src="/js/common.js?v=20180813"></script>
    <script src="/js/tabs.js?v=20180813"></script>
    <script src="/js/cart.js?v=20180813"></script>
@stop



@section('content')

    <!-- 引入头部文件 -->
    <div class="header">
        <div class="header-left">
            <a class="sb-back" href="javascript:history.back(-1)" title="返回"></a>
        </div>
        <div class="header-middle">购物车</div>
        <div class="header-right text-align-right ">
            <a href="javascript:void(0)" class="batch_delet text" id="batch_delet" data-id="0"></a>
        </div>
    </div>


    <!-- 待付款订单列表 start -->
    <!-- 待付款订单列表 end -->

    {{--引入列表--}}
    @include('cart.partials._cart_list')


    <script type="text/javascript">
        $().ready(function() {
            $('.num').click(function() {
                $(this).parent('.goods-num').find('.edit-quantity-mask').show();
                $(this).parent('.goods-num').find('.edit-quantity-mask').find('input[type="number"]').val($(this).val());
            });
        });
    </script>
    <section class="mask-div"></section>
    <script type="text/javascript">
        var shop_id = '';
        var num = $(".no_pay_list").height() + 180;
        $(".no-data-div").css('top', num);
    </script>

    {{--引入底部菜单--}}
    @include('frontend.web_mobile.modules.library.site_footer_menu')

    <!-- 加入购物车 -->
    <script src="/js/jquery.fly.min.js?v=20180813"></script>
    <script src="/assets/d2eace91/js/szy.cart.mobile.js?v=20180813"></script>

    <!-- 第三方流量统计 -->
    <div style="display: none;">
        {{--第三方统计代码--}}
        {!! sysconf('stats_code_wap') !!}
    </div>
    <!-- 底部 _end-->
@stop