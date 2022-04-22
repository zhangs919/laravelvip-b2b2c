{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/js/ztree/zTreeStyle.css?v=1.2">
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
@stop

{{--alet message page元素同级上面--}}
@section('alert_msg')

@stop

{{--content--}}
@section('content')

    <div class="section-type-box">
        <ul>
            <li class="m-b-10">
                <div class="icon section-icon col-sm-4">
                    <span class="section-logo section-logo-collection"><i></i></span>
                </div>
                <div class="desc col-sm-8">
                    <h3 class="f20 section-title">数据采集</h3>
                    <p class="m-t-5">数据采集为商城提供采集功能，采集商品进入本地商品库供各个商家导入使用，解决了商品手动添加商品进入本地商品库的繁琐步骤，省时省力，节约人工维护成本。</p>
                    <a href="/goods/yun/goods-list" class="btn btn-primary m-t-20">立即采集</a>
                </div>
            </li>
            <li class="m-b-20">
                <div class="icon section-icon col-sm-4">
                    <span class="section-logo section-logo-category"><i></i></span>
                </div>
                <div class="desc col-sm-8">
                    <h3 class="f20 section-title">分类库</h3>
                    <p class="m-t-5">分类库为商城提供丰富的商品分类，商城无需手动添加运营的商品分类，一键导入，灵活便捷，解决商城添加商品分类的繁琐操作，省时省力，节约人工维护成本。</p>
                    <a href="category-import" class="btn btn-primary m-t-20">立即导入</a>
                </div>
            </li>
            <li class="m-b-20">
                <div class="icon section-icon col-sm-4">
                    <span class="section-logo section-logo-brand"><i></i></span>
                </div>
                <div class="desc col-sm-8">
                    <h3 class="f20 section-title">品牌库</h3>
                    <p class="m-t-5">品牌库为商城提供丰富的商品品牌，商城无需手动添加运营的商品品牌，一键导入，灵活便捷，解决商城添加商品品牌的繁琐操作，省时省力，节约人工维护成本。</p>
                    <a href="brand-import" class="btn btn-primary m-t-20">立即导入</a>
                </div>
            </li>


        </ul>
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