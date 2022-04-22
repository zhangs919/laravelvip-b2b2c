{{--模板继承--}}
@extends('layouts.seller_layout')

{{--css style page元素同级上面--}}
@section('style')
@stop

{{--content--}}
@section('content')

	<div class="promotion-content">
		<div class="promotion-item bg1">
			<h1>到店送红包</h1>
			<p>用户主动领取，领取的场景是：手机或PC端的商品详情页、购物车、红包集市、手机端的店铺红包列表</p>
			<a class="btn btn-primary" href="add?bonus_type=1">立即发布</a>
			<div class="promotion-img">
				<!--到店送红包-->
				<i class="fa fa-bank"></i>
			</div>
		</div>
		<div class="promotion-item bg2">
			<h1>收藏送红包</h1>
			<p>系统自动派发，系统提醒用户获得红包：会员仅当首次收藏店铺时有效 收藏红包仅能创建一次，不可删除，您可以选择作废或者过期后重新创建该类型红包</p>
			<a class="btn btn-primary" href="add?bonus_type=2">立即发布</a>
			<div class="promotion-img">
				<!--收藏送红包-->
				<i class="fa fa-star"></i>
			</div>
		</div>
		<div class="promotion-item bg4">
			<h1>会员送红包</h1>
			<p>卖家主动派发，系统提醒用户获得红包</p>
			<a class="btn btn-primary" href="add?bonus_type=4">立即发布</a>
			<div class="promotion-img">
				<!--会员送红包-->
				<i class="fa fa-user"></i>
			</div>
		</div>
		<div class="promotion-item bg10">
			<h1>积分兑换红包</h1>
			<p>积分商城使用积分兑换红包</p>
			<a class="btn btn-primary" href="add?bonus_type=10">立即发布</a>
			<div class="promotion-img">
				<!--积分送红包-->
				<i class="fa fa-leaf"></i>
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