{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css"/>
    <link href="/assets/d2eace91/css/revision-styles.css" rel="stylesheet">

@stop

{{--content--}}
@section('content')

    <div class="app-board">
        <div class="app-board-img">
            <img src="/assets/d2eace91/images/marketing/zb.jpg">
        </div>
        <div class="app-board-intro">
            <h3>直播</h3>
            <p class="intro">网络直播是一种新兴的网络社交方式，网络直播平台也成为了一种崭新的社交媒体。通过视频直播解决用户对产品的疑惑。通过直播展现产品的具体结构、性能、优势，也可以展现企业品牌的实力和认证信息等等。</p>
            <div class="btn-area">
                <a class="btn btn-primary m-r-5 hide">联系客服</a>
                <p class="m-t-10 c-blue">请联系平台方管理员进行购买</p>
            </div>
        </div>
    </div>
    <div class="app-info-content">
        <h2 class="title">应用详情</h2>
        <div class="app-info">
            <div class="app-desc">
                <h2>应用描述</h2>
                <p class="desc-content">网络直播是一种新兴的网络社交方式，网络直播平台也成为了一种崭新的社交媒体。通过视频直播解决用户对产品的疑惑。通过直播展现产品的具体结构、性能、优势，也可以展现企业品牌的实力和认证信息等等。</p>
                <p class="desc-content">将其用于在线研讨会、营销会议等网络活动场景，扩大市场活动，有效提高管理和运营效率，直接促进企业销售业绩提升，使企业竞争力得到极大提升。</p>
                <p class="desc-content">利用网络视频直播，可以有效解决信息不对称问题，用户不用到现场就能直观地看到并了解商品，更加便民</p>
                <p class="desc-content">直播三大优势：成本低廉，方便快捷，互动性强</p>
                <p class="desc-content">应用一旦订购，不支持退款，不支持转到其他店铺。</p>
            </div>
            <div class="app-image">
                <h2>应用截图</h2>
                <p class="tutorial-image">
                    <img src="/assets/d2eace91/images/marketing/live/desc1.jpg">
                </p>
                <p class="tutorial-image">
                    <img src="/assets/d2eace91/images/marketing/live/desc2.jpg">
                </p>
                <p class="tutorial-image">
                    <img src="/assets/d2eace91/images/marketing/live/desc3.jpg">
                </p>
                <p class="tutorial-image">
                    <img src="/assets/d2eace91/images/marketing/live/desc4.jpg">
                </p>
                <p class="tutorial-image">
                    <img src="/assets/d2eace91/images/marketing/live/desc5.jpg">
                </p>
            </div>
        </div>
    </div>
    
@stop

{{--script page元素内--}}
@section('script')

@stop

{{--extra html block--}}
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