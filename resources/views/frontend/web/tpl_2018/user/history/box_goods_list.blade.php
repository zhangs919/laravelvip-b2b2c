@if(!empty($list))
	<div class="history-panel">
		<ul>
			@foreach($list as $v)
				<li>
					<div class="p-img">
						<a href="{{ route('pc_show_goods', ['goods_id' => $v['goods_id']]) }}" target="_blank">
							<img src="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" alt="{{ $v['goods_name'] }}" />
						</a>
					</div>
					<div class="p-name">
						<a href="{{ route('pc_show_goods', ['goods_id' => $v['goods_id']]) }}" target="_blank">{{ $v['goods_name'] }}</a>
					</div>
					<div class="p-comm">
						<span class="p-price price-color">￥{{ $v['goods_price'] }}</span>
					</div>
				</li>
			@endforeach
		</ul>
	</div>
@else
	<!-- 没有浏览历史的展示形式 _start -->
	<div class="tip-box">
		<img src="{{ get_image_url(sysconf('default_noresult')) }}" class="tip-icon" />
		<div class="tip-text">
			您还没有在商城留下任何足迹哦
			<br />
			<a class="color" href="./">赶快去看看吧</a>
		</div>
	</div>
	<!-- 没有浏览历史的展示形式 _end-->
@endif
