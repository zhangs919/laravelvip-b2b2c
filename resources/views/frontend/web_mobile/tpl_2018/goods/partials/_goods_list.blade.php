<!-- 默认缓载图片 -->
<div id="goods_list">

    @if(!empty($list))
        <div class="tablelist-append clearfix">
        @foreach($list as $v)
            <!-- -->
                <div class="product single_item info">
                    <li data-goods_url="{{ route('mobile_show_goods', ['goods_id' => $v['goods_id']]) }}"
                        class="GO-GOODS-INFO" data-cur_page="{{ $page_array['cur_page'] + 1 }}">
                        <div class="item info SZY-GOODS-ITEM ">
                            <div class="item-pic SZY-PIC-BG"
                                 style="background: url({{ get_image_url(sysconf('default_lazyload_mobile')) }}) no-repeat center center; display: block; background-size: 100px;">
                                <!--商品标签添加 start-->
                                <div class="item-tag-box">
                                </div>
                                <!--商品标签添加 end-->
                                <img class="lazy square" src="/assets/d2eace91/images/common/blank.png"
                                     data-original="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320"
                                     data-original-webp="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320/format,webp"
                                     alt="{{ $v['goods_name'] }}">
                            </div>
                            <dl class="">
                                <dt class="">
									<!-- 会员价标签 -->
									<!-- 活动色块 -->
                                    {{ $v['goods_name'] }}
                                </dt>
                                <!-- -->
                                <div class="item-con-info">
                                    <dd>
                                        <i class="price-color">￥{{ $v['goods_price'] }}</i>
                                        <!-- 商品原价 -->
                                    </dd>
                                    <div class="cart-box" id="number_{{ $v['goods_id'] }}">
                                        <i class="increase add-cart iconfont icon-gouwuche"
                                           data-goods_id="{{ $v['goods_id'] }}" data-step="1"
                                           data-image_url="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80"></i>
                                    </div>
                                </div>
								<!--包邮-->
								@if($v['is_free'])
								<span class="act-sign-tip free-shipping">包邮</span>
								@endif
								<span class="goods-sales"> 销量：{{ $v['sale_num'] }}</span>
								<a class="shop-name" href="{{ route('mobile_shop_home', ['shop_id' => $v['shop_id']]) }}">
									@if($v['is_own_shop'])
									<span class="self-sell">自营</span>
									@endif
									<span class="goods-list-shop">{{ $v['shop_name'] }}</span>
                                    <em>进店</em>
                                </a>
                            </dl>
                        </div>
                    </li>
                </div>

            @endforeach

        </div>
        <!-- 分页 -->
		<div id="pagination" class="page">
			<div class="more-loader-spinner">
				<div class="is-loaded">
					<div class="loaded-bg">我是有底线的</div>
				</div>
			</div>
			<script data-page-json="true" type="text" id="page_json">
				{!! $page_json !!}
			</script>
		</div>
		<div class="page-num hide">
                <span>
                    <em>{{ $page_array['cur_page'] }}</em>
                    /
                    <em>{{ $page_array['page_count'] }}</em>
                </span>
		</div>


    @else
        <div class="no-data-div">
            <div class="no-data-img">
                <img src="/images/bg_empty_data.png">
            </div>
            <dl>
                <dt>暂无相关记录</dt>
            </dl>
        </div>
    @endif
</div>
