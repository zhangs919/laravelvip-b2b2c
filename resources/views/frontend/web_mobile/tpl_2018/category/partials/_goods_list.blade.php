<!-- 默认缓载图片 -->
<div id="goods_list">

    @if(!empty($goods_list))
    <ul class="clearfix tablelist-append">

        @foreach($goods_list as $v)
        <!-- -->
        <li class="item">
            <div class="item-pic">
                <!---->
                <a class="SZY-PIC-BG" href="/goods-{{ $v['goods_id'] }}.html" style="background: url({{ get_image_url(sysconf('default_lazyload_mobile')) }}) no-repeat center center; display: block; background-size: 100px;">
                    <img class="lazy square" src="/assets/d2eace91/images/common/blank.png" data-original="{{ get_image_url($v['goods_image'], 'goods_image') }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" data-original-webp="{{ get_image_url($v['goods_image'], 'goods_image') }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320/format,webp" alt="{{ $v['goods_name'] }}">
                </a>
            </div>
            <div class="item-info">
                <div class="item-name ">
                    <a href="/goods-{{ $v['goods_id'] }}.html" title="{{ $v['goods_name'] }}">


                        <!-- 活动色块 -->


                        {{ $v['goods_name'] }}
                    </a>
                </div>


                <div class="goods-sales">销量：{{ $v['sale_num'] }}</div>

                <div class="item-price">
                    <em class="price-color">￥{{ $v['goods_price'] }}元</em>
                </div>
                <div class="cart-box" id="number_{{ $v['goods_id'] }}">

                    <i class="increase add-cart iconfont icon-jia1 @if($v['goods_number'] == 0){{ 'disabled' }}@endif" data-goods_id="{{ $v['goods_id'] }}" data-step="1" data-image_url="{{ get_image_url($v['goods_image'],'goods_image') }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" data-max_number="{{ $v['goods_number'] }}"></i>

                    <input class="num hide" type="text" size="4" maxlength="5" value="0" onFocus="this.blur()">
                    <i class="decrease remove-cart iconfont icon-jian2 hide" data-sku_open="{{ $v['sku_open'] }}" data-goods_id="{{ $v['goods_id'] }}"></i>
                </div>
            </div>
        </li>
        @endforeach

    </ul>
    <!-- 分页 -->
    <div id="pagination" class="page">
        <div class="more-loader-spinner">

            <div class="is-loaded">
                <div class="loaded-bg">我是有底线的</div>
            </div>

        </div>
        <script data-page-json="true" type="text" id="page_json">
            {!! $goods_page_json !!}
        </script>
    </div>
    @else
        <div class="no-data-div">
            <div class="no-data-img">
                <img src="/images/bg_empty_data.png" />
            </div>
            <dl>
                <dt>暂无相关记录</dt>
            </dl>
        </div>
    @endif

</div>