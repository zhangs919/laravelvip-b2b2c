<div class="shop-list-wall">
	@if(!empty($list))
		@foreach($list as $v)
		<div class="shop">
			<div class="shop-info">
				<div class="shop-tit">
					<a href="{{ route('pc_shop_home', ['shop_id'=>$v['shop_id']]) }}" target="_blank" title="">
						<img
							src="{{ get_image_url($v['shop_logo'], 'shop_logo') }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80"
							class="shop-logo">
					</a>
					<div class="detail">
						<a href="{{ route('pc_shop_home', ['shop_id'=>$v['shop_id']]) }}" target="_blank" title="">
							<p class="shop-name">{{ $v['shop_name'] }}</p>
						</a>

						<p class="shop-rank">
							<img
								src="{{ get_image_url($v['credit_img']) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80"
								title="{{ $v['credit_name'] }}"/>
						</p>

						<p class="shop-extend">
							<label>卖家：</label>
						<div class="extend-right">
							<a href="{{ route('pc_shop_home', ['shop_id'=>$v['shop_id']]) }}" target="_blank" title="">
								<span class="btn-link">{{ $v['user_name'] }}</span>
							</a>
							<!-- -->
							@if(!empty($v['customer_main']))
								{{--客服工具 默认0 0无客服 1QQ 2旺旺--}}
								@if($v['customer_main']['customer_tool'] == 2)
									<span class="ww-light">
                                <!-- 旺旺不在线 i 标签的 class="ww-offline" -->

										<!-- s等于1时带文字，等于2时不带文字 -->
                                <a target="_blank"
								   href="http://amos.alicdn.com/getcid.aw?v=2&uid={{ $v['customer_main']['customer_account'] }}&site=cntaobao&s=2&groupid=0&charset=utf-8">
                                    <img border="0"
										 src="http://amos.alicdn.com/online.aw?v=2&uid={{ $v['customer_main']['customer_account'] }}&site=cntaobao&s=2&charset=utf-8"
										 alt="淘宝旺旺" title=""/>
                                    <span></span>
                                </a>

                            </span>
								@elseif($v['customer_main']['customer_tool'] == 1)
									<!-- s等于1时带文字，等于2时不带文字 -->
									<a target="_blank"
									   href="http://wpa.qq.com/msgrd?v=3&uin={{ $v['customer_main']['customer_account'] }}&site=qq&menu=yes"
									   class="service-btn">
										<img border="0" onload="load_qq_customer_image(this, 'http://')"
											 src="http://wpa.qq.com/pa?p=2:{{ $v['customer_main']['customer_account'] }}:52"
											 alt="QQ" title="" style="height: 20px;"/>
										<span></span>
									</a>
								@else
									{{--默认 平台客服--}}
									<a href='{{ $v['customer_main']['yikf_url'] ?? 'javascript:;' }}'
									   class="ww-light  color" target="_blank" title="点击联系在线客服">
										<i class="iconfont">&#xe6ad;</i>
									</a>
								@endif
							@endif
						</div>
						</p>
						<p class="like">
								<span>
									销量：
									<span class="num">{{ $v['sale_num'] }}</span>
								</span>
							<span>
									共
									<span class="num">{{ $v['count_goods'] }}</span>
									件宝贝
								</span>
						</p>
						<div class="evaluate">
							<label>好评率：</label>
							<span>{{ $v['evaluate'] }}%</span>
							@if(!empty($v['shop_contract']))
							<div class="item-icons">
								@foreach($v['shop_contract'] as $sc)
									<img
										src="{{ $sc['contract_image'] }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80"
										alt="{{ $sc['contract_name'] }}" title="{{ $sc['contract_name'] }}"/>
								@endforeach
							</div>
							@endif
						</div>

					</div>
				</div>

				<ul class="assess">
					<li>
						<p class="assess-name">描述相符</p>
						<p class="assess-score ">
							<span class="average">{{ $v['desc_score'] }}</span>
						</p>
					</li>
					<li>
						<p class="assess-name">服务态度</p>
						<p class="assess-score ">
							<span class="average">{{ $v['service_score'] }}</span>
						</p>
					</li>
					<li>
						<p class="assess-name">发货速度</p>
						<p class="assess-score ">
							<span class="average">{{ $v['send_score'] }}</span>
						</p>
					</li>
				</ul>

			</div>
			<ul class="goods-wall">
				<!-- -->
				@if(!empty($v['goods']))
					@foreach($v['goods'] as $g)
						<li>
							<a href="{{ route('pc_show_goods', ['goods_id'=>$g['goods_id']]) }}" target="_blank"
							   title="{{ $g['goods_name'] }}">
								<img
									src="{{ get_image_url($g['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320"
									class="goods-pic">
								<div class="mask">
									<span class="price">￥{{ $g['goods_price'] }}</span>
									<span class="sell">销量 {{ $g['sale_num'] }}</span>
								</div>
							</a>
						</li>
					@endforeach
				@else
					<div class="tip-box">
						<div class="tip-text">该店铺暂未上传商品</div>
					</div>
				@endif
			</ul>
		</div>
		@endforeach
	@else
		<div class="tip-box">
			<img src="{{ get_image_url(sysconf('default_noresult')) }}" class="tip-icon">
			<div class="tip-text">抱歉！没有搜索到您想要的结果……</div>
		</div>
	@endif
</div>
<div class="pull-right page-box">
	{!! $pageHtml !!}
</div>

