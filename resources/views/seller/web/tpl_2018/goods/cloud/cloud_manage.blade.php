{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=20181020"/>
@stop

{{--content--}}
@section('content')

    <div class="section-type-box">
        <ul>
            <li class="m-b-10">
                <div class="icon section-icon col-sm-4">
				<span class="section-logo section-logo-collection">
					<i></i>
				</span>
                </div>
                <div class="desc col-sm-8">
                    <h3 class="f20 section-title">云产品库采集</h3>
                    <p class="m-t-5">云产品库由官方人员时刻进行维护的商品数据库，供商家挑选采集，一键导入，即可售卖，让店铺运营更方便、轻松。</p>
                    <a href="/goods/cloud/goods-list" class="btn btn-primary m-t-20">立即采集</a>
                </div>
                <div class="section-label">付费</div>
            </li>
            <li class="m-b-20">
                <div class="icon section-icon col-sm-4">
				<span class="section-logo section-logo-category">
					<i></i>
				</span>
                </div>
                <div class="desc col-sm-8">
                    <h3 class="f20 section-title">淘宝/天猫数据采集</h3>
                    <p class="m-t-5">系统支持将淘宝、天猫商品数据采集进入店铺，也支持采集淘宝、天猫商品评论。系统支持3种采集淘宝、天猫商品数据方式，批量采集、按商品分类采集；丰富的采集形式，是商家维护商品的重要工具。</p>
                    <a href="/goods/collect/show" class="btn btn-primary m-t-20">立即采集</a>
                </div>
                <div class="section-label">付费</div>
            </li>
            <li class="m-b-20">
                <div class="icon section-icon col-sm-4">
				<span class="section-logo section-logo-brand">
					<i></i>
				</span>
                </div>
                <div class="desc col-sm-8">
                    <h3 class="f20 section-title">系统商品库采集</h3>
                    <p class="m-t-5">系统产品库是由平台方管理员进行统一维护、供店铺挑选商品数据库，店铺可挑选计划售卖的商品，一键导入，随时售卖，让店铺运营更轻松。</p>
                    <a href="/goods/lib-goods/index.html" class="btn btn-primary m-t-20">立即采集</a>
                </div>
                <div class="section-label free">免费</div>
            </li>


        </ul>
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


{{--footer script page元素同级下面--}}
@section('footer_script')

@stop

{{--outside body script--}}
@section('outside_body_script')

@stop