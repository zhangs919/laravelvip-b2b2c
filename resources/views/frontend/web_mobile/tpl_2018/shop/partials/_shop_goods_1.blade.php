<div class="right-con-bd table-right-box" id="table_list">
    <div class="hidden_cat " hidden>
        <div class="right-category-box">
            <div class="swiper-container" id="swiper-container1">
                <ul class="swiper-wrapper SZY-CAT-UL-2">
                    @foreach($chr_list as $item)
                        <li class="swiper-slide SZY-SHOP-GOODS-CHR SZY-CAT-LI-2-{{ $item['cat_id'] }} @if($cat_id == $item['cat_id']){{ 'current' }}@endif" data-cat_id="{{ $item['cat_id'] }}">
                            {{ $item['cat_name'] }}</li>
                    @endforeach
                    <li class="swiper-slide"></li>
                </ul>
                <div class="down-more-btn">
                    <i class="iconfont">&#xe609;</i>
                </div>
            </div>
            <ul class="second-goods-classify hide SZY-CAT-UL-HIDE-2">
                @foreach($chr_list as $item)
                <li class="SZY-SHOP-GOODS-CHR SZY-CAT-LI-2-{{ $item['cat_id'] }} @if($cat_id == $item['cat_id']){{ 'current' }}@endif" data-cat_id="{{ $item['cat_id'] }}">
                    {{ $item['cat_name'] }}</li>
                @endforeach
            </ul>
            <div class="right-con-top">
                <!-- 筛选 -->
                <div class="filter-term">
                    <div class="record-info">
                        <em>{{ $cat_name }}</em>
                        ({{ $total }})
                    </div>
                    <ul>
                        <li class="SORT current" id="0-0-0-0-0-3-0-0">
                            <span>综合</span>
                        </li>
                        <!-- 点击销量排序由高到低 -->
                        <li class="SORT " id="0-0-0-0-1-3-0-0">
                            <span>销量</span>
                        </li>
                        <!-- 价格升降li增加样式：icon-DESC  icon-ASC -->
                        <li class="icon-sort-price icon SORT " id="0-0-0-0-4-3-0-0">
                            <span>价格</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <input type="hidden" class="list-height" value="3.3">
        <input type="hidden" class="cat_index" value="">
    </div>
    <ul class="tablelist-append">
        @foreach($list as $v)
            <!-- -->
            <li class="item">
                <div class="item-pic">
                    <div class="item-tag-box">
                        @if($v['is_new'])
                            <span class="icon-new">新品</span>
                        @endif

                        @if($v['is_hot'])
                            <span class="icon-hot">爆款</span>
                        @endif

                        @if($v['is_best'])
                            <span class="icon-best">精品</span>
                        @endif
                    </div>
                    <a class="SZY-PIC-BG" href="/goods-{{ $v['goods_id'] }}.html" style="background: url({{ get_image_url(sysconf('default_lazyload_mobile')) }}) no-repeat center center; background-size: contain;">
                        <img class="lazy square" src="/assets/d2eace91/images/common/blank.png" data-original="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" data-original-webp="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320/format,webp" alt="{{ $v['goods_name'] }}">
                    </a>
                </div>
                <div class="item-info ">
                    <div class="item-name ">
                        <a href="/goods-{{ $v['goods_id'] }}.html" title="{{ $v['goods_name'] }}">
                            <!-- 活动色块 -->
                            {{ $v['goods_name'] }}
                        </a>
                    </div>
                    <div class="item-price">
                        <em class="price-color">￥{{ $v['goods_price'] }}</em>
                        <!-- 会员价标签  _start -->
                        <!-- 商品原价 -->
                    </div>
                    <!--包邮-->
                    <span class="act-sign-tip free-shipping">包邮</span>
                    <div class="cart-box" id="number_{{ $v['goods_id'] }}">
                        <i class="increase add-cart iconfont icon-jia1 " data-goods_id="{{ $v['goods_id'] }}" data-step="1" data-image_url="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80" data-max_number="{{ $v['goods_number'] }}"></i>
                        <input class="num @if($v['cart_num'] == 0){{ 'hide' }}@endif SZY-NUMBER-{{ $v['goods_id'] }}" type="text" size="4" maxlength="5" value="{{ $v['cart_num'] }}" disabled>
                        <i class="decrease remove-cart iconfont icon-jian2 @if($v['cart_num'] == 0){{ 'hide' }}@endif" data-sku_open="{{ $v['sku_open'] }}" data-step="1" data-goods_id="{{ $v['goods_id'] }}"></i>
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
            {!! $page_json !!}
        </script>
    </div>
    <div class="blank" style="height: 50px; clear: both;"></div>
</div>
