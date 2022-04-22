@extends('layouts.base')

@section('header_css')
    <link rel="stylesheet" href="/css/flow.css?v=20180702"/>
@stop

@section('header_js')

@stop

{{--follow_box 注意此效果只在首页面展示--}}
@section('follow_box')

@stop

@section('style_js')
    <!--页面css/js-->

@stop

{{--不显示分类box--}}
@section('category_box')

@show

@section('content')

    <div class="w990" id="content">

        {{--引入列表--}}
        @include('cart.partials._cart_list')

    </div>

@stop

@section('footer_js')
    <script src="/assets/d2eace91/js/layer/layer.js?v=20180726"></script>
    <script src="/assets/d2eace91/js/jquery.method.js?v=20180726"></script>
    <script src="/assets/d2eace91/js/jquery.widget.js?v=20180726"></script>
    <script src="/assets/d2eace91/js/szy.cart.js?v=20180726"></script>
    <script src="/js/common.js?v=20180726"></script>
    <script src="/js/tabs.js?v=20180726"></script>
    <script src="/js/cart.js?v=20180726"></script>
@stop