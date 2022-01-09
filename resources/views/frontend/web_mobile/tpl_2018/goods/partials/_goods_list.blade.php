<!-- 默认缓载图片 -->
<div id="goods_list">

    <div class="tablelist-append clearfix">
        @foreach($list as $v)
        <!-- -->
        <div class="product single_item info" data-page="{{ $page_array['cur_page'] + 1 }}">
            <li>
                <div class="item">
                    <div class="item-tag-box">
                        <!--热卖icon位置为：0px 0px，新品icon位置为：0px -35px，精品icon位置：0px -70px-->
                        <!---->
                        <!---->
                    </div>
                    <div class="item-pic">
                        <a href="javascript:void(0)" style="background: url({{ get_image_url(sysconf('default_lazyload_mobile')) }}) no-repeat center center; display: block; background-size: 100px;" data-goods_url="{{ route('mobile_show_goods', ['goods_id' => $v['goods_id']]) }}" data-scroll="{{ $page_array['cur_page'] + 1 }}" class="GO-GOODS-INFO" title="{{ $v['goods_name'] }}">
                            <img class="lazy square" src="/assets/d2eace91/images/common/blank.png" data-original="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" data-original-webp="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320/format,webp/quality,q_75" alt="{{ $v['goods_name'] }}">
                        </a>

                        @if($v['goods_number'] <= 0)
                        <span class="sell-out"></span>
                        @endif

                        <span class="pre-sale-tip hide">预售</span>
                    </div>
                    <dl>
                        <dt>
                            <a href="javascript:void(0)" data-goods_url="{{ route('mobile_show_goods', ['goods_id' => $v['goods_id']]) }}" data-scroll="{{ $page_array['cur_page'] + 1 }}" class="GO-GOODS-INFO" title="{{ $v['goods_name'] }}">{{ $v['goods_name'] }}</a>
                        </dt>
                        <a class="shop-name" href="{{ route('mobile_shop_home', ['shop_id' => $v['shop_id']]) }}">
                            <i class="iconfont color"></i>
                            {{ $v['shop_name'] }}
                            <!-- -->
                        </a>
                        <dd>
                            <i class="price-color">￥{{ $v['goods_price'] }}</i>


                        </dd>
                        <div class="item-con-info">

                            <div class="cart-box" id="number_{{ $v['goods_id'] }}">

                                <a href="javascript:void(0);" data-goods_id="{{ $v['goods_id'] }}"
                                   class="increase add-cart @if($v['goods_number'] <= 0){{ 'sell-out-btn' }}@endif iconfont"></a>

                                <input class="num hide" type="text" size="4" maxlength="5" value="0" onFocus="this.blur()">
                                <i class="decrease iconfont hide" data-goods_id="{{ $v['goods_id'] }}"></i>
                            </div>
                        </div>
                    </dl>
                </div>
            </li>
        </div>
        @endforeach

    </div>
    <!-- 分页 -->
    <div id="pagination" class="page">
        <div class="more-loader-spinner">

        </div>
        <script data-page-json="true" type="text" id="page_json">
        {!! $page_json !!}
        </script>
    </div>

</div>