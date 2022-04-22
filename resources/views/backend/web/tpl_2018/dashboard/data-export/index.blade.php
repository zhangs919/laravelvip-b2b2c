{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/revision-styles.css?v=1.2">
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="app-board">
        <div class="app-board-img">
            <img src="/assets/d2eace91/images/marketing/sjdc.jpg">
        </div>
        <div class="app-board-intro">
            <h3>数据导出</h3>
            <p class="intro">数据导出是官方推出的一款付费应用插件，该功能可以将商城商品数据、会员数据、店铺数据、订单数据、账单数据等信息导出存放， 方便商家进行线下数据统计。</p>
            <div class="btn-area">

            </div>
        </div>
    </div>

    <div class="app-info-content">
        <h2 class="title">应用详情</h2>
        <div class="app-info">
            <div class="app-desc">
                <h2>应用描述</h2>
                <p class="desc-content">数据导出是官方新推出一款付费类应用插件。该功能帮助商家进行线下数据统计。</p>
                <p class="desc-content">应用一旦订购，不支持退款，不支持转到其他店铺。</p>
            </div>
            <div class="app-image">
                <h2>应用截图</h2>
                <p class="tutorial-image">
                    <img src="/assets/d2eace91/images/marketing/export/desc1.jpg">
                </p>
                <p class="tutorial-image">
                    <img src="/assets/d2eace91/images/marketing/export/desc2.jpg">
                </p>
                <p class="tutorial-image">
                    <img src="/assets/d2eace91/images/marketing/export/desc3.jpg">
                </p>
            </div>
        </div>
    </div>

@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block page元素同级下面--}}
@section('extra_html')

@stop

{{--helper_tool--}}
@section('helper_tool')

@stop

{{--自定义css样式--}}
@section('style_css')

@stop

{{--footer script page元素同级下面--}}
@section('footer_script')

@stop

{{--outside body script--}}
@section('outside_body_script')

@stop