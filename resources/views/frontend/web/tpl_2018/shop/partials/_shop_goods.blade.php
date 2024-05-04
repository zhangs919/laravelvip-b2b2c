@if(!empty($list))
    @foreach($list as $k=>$v)
        <!-- -->
        <li class="item @if(($k % 4) == 0){{ 'last' }}@endif">
            <div class="item-con">

                @if($v['is_new'])
                <!---->
                <div class="item-tag-box">
                    <div class="item-tag">
                        <!---->
                        <span>新品</span>
                        <!---->
                        <i></i>
                    </div>
                </div>
                @endif


                <!--售罄-->

                <div class="item-pic">

					@if(!empty($v['tag_image']))
						<!--商品标签添加 start-->
						<div class="goodstag-seat location{{ $v['tag_position'] }}" id="show_seat">
							<div class="goodstag-item tag" id="iconfont_show">
								<img src="{{ $v['tag_image'] }}">
							</div>
						</div>
						<!--商品标签添加 end-->
					@endif


                    <a href="{{ route('pc_show_goods',['goods_id'=>$v['goods_id']]) }}" title="{{ $v['goods_id'] }}" target="_blank">
                        <img src="{{ get_image_url($v['goods_image'], 'goods_image') }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" alt="">
                    </a>
                </div>
                <div class="img-scroll" style="display: none;">{{--todo 商品相册--}}
                    <a href="javascript:void(0);" class="img-prev">&lt;</a>
                    <a href="javascript:void(0);" class="img-next">&gt;</a>
                    <div class="img-wrap">
                        <ul class="img-main" style="left: 0px;">

                            <li class="img-item">
                                <a href="javascript:;" title="">
                                    <img class="" width="25" height="25" alt="" src="{{ get_image_url($v['goods_image'], 'goods_image') }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" data-original="{{ get_image_url($v['goods_image'], 'goods_image') }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" data-src="{{ get_image_url($v['goods_image'], 'goods_image') }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320">
                                </a>
                            </li>


                        </ul>
                    </div>
                </div>
                <div class="item-info">
                    <div class="item-price">
                        <em class="sale-price color">￥{{ $v['goods_price'] }}</em>
                        <!-- 商品原价 -->


                        <em class="sale-count">已售{{ $v['sale_num'] }}件</em>

                    </div>
                    <div class="item-name">
                        <!-- 注意商品名称长度，需考虑包邮、赠品标签 -->
                        <a href="{{ route('pc_show_goods',['goods_id'=>$v['goods_id']]) }}" target="_blank" title="{{ $v['goods_name'] }}">


                            <!-- 活动色块 -->


                            {{ $v['goods_name'] }}
                        </a>
                        <!-- 包邮、赠品标签  _star -->


                        @if($v['goods_freight_fee'] <= 0)
                            <i class="free-shipping">包邮</i>
                        @endif


                        <!-- 包邮、赠品标签  _end -->
                    </div>
                    <div class="item-con-info">
                        <div class="fl">
                            <div class="item-operate">

                                <a href="javascript:;" onclick="toggleGoods({{ $v['goods_id'] }},{{ $v['sku_id'] }},this)" class="operate-btn collet-btn @if($v['is_collected']) curr @endif ">
                                    @if($v['is_collected'])
                                        <i class="iconfont">&#xe6b1;</i>
                                        <span> 已收藏 </span>
                                    @else
                                        <i class="iconfont">&#xe6b3;</i>
                                        <span> 收藏 </span>
                                    @endif
                                    {{--<i class="iconfont"></i>--}}
                                    {{--<span> 收藏 </span>--}}
                                </a>


                                <a href="{{ route('pc_show_goods',['goods_id'=>$v['goods_id']]) }}#goods_evaluate" target="_blank" class="operate-btn comment-btn">
                                    <i class="iconfont"></i>
                                    {{ $v['comment_num'] }}
                                </a>

                            </div>
                        </div>
                        <div class="fr">
                            <div class="item-add-cart">
                                <!--售罄时，为加入购物车按钮添加sell-out-btn样式-->

                                @if($v['goods_number'] <= 0)
                                    <a href="javascript:void(0);" data-goods-id="{{ $v['goods_id'] }}" class="add-cart sell-out-btn" title="卖光了"></a>
                                @else
                                    <a href="javascript:void(0);" style="background-image: url(/images/add-cart.jpg); background-size: 30px 30px;" data-goods-id="{{ $v['goods_id'] }}" data-image-url="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" class="add-cart" title="加入购物车"></a>
                                @endif


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    @endforeach
@endif
