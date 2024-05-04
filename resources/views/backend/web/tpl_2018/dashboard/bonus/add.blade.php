{{--模板继承--}}
@extends('layouts.app')

{{--css style page元素同级上面--}}
@section('style')
    <link rel="stylesheet" href="/assets/d2eace91/css/styles.css?v=1.2">
@stop

{{--content--}}
@section('content')

    <div class="table-content">
        <div class="release-activity-type">
            <ul>
                <li class="m-b-10">
                    <div class="icon col-sm-4">
						<span class="activity-logo activity-logo-4">
														<!--会员送红包-->
							<i class="fa fa-user"></i>
													</span>
                        <a href="add?bonus_type=4" class="btn btn-primary">立即发布</a>
                    </div>
                    <div class="desc col-sm-8">
                        <h3 class="f20">会员送红包</h3>
                        <p class="m-t-5">平台主动派发，系统提醒用户获得红包</p>
                    </div>
                </li>
                <li class="m-b-10">
                    <div class="icon col-sm-4">
						<span class="activity-logo activity-logo-9">
														<!--推荐送红包-->
							<i class="fa fa-user"></i>
													</span>
                        <a href="add?bonus_type=9" class="btn btn-primary">立即发布</a>
                    </div>
                    <div class="desc col-sm-8">
                        <h3 class="f20">推荐送红包</h3>
                        <p class="m-t-5">推荐会员注册，系统自动发放红包作为奖励</p>
                    </div>
                </li>
                <li class="m-b-10">
                    <div class="icon col-sm-4">
						<span class="activity-logo activity-logo-6">
														<!--注册送红包-->
							<i class="fa fa-edit"></i>
													</span>
                        <a href="add?bonus_type=6" class="btn btn-primary">立即发布</a>
                    </div>
                    <div class="desc col-sm-8">
                        <h3 class="f20">注册送红包</h3>
                        <p class="m-t-5">新注册会员自动发放</p>
                    </div>
                </li>
                <li class="m-b-10">
                    <div class="icon col-sm-4">
						<span class="activity-logo activity-logo-10">
														<!--积分送红包-->
							<i class="fa fa-integral"></i>
													</span>
                        <a href="add?bonus_type=10" class="btn btn-primary">立即发布</a>
                    </div>
                    <div class="desc col-sm-8">
                        <h3 class="f20">积分兑换红包</h3>
                        <p class="m-t-5">积分商城使用积分兑换红包</p>
                    </div>
                </li>

            </ul>
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