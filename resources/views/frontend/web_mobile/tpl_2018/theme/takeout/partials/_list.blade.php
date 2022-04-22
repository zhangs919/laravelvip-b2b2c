<div class="list" id="table_list">

    {{--店铺内二级分类列表--}}
    @if(!empty($sub_shop_category) && $cat_id > 0)
        <ul class="itemtree">

            @foreach($sub_shop_category as $v)
                <li class="SZY-SHOP-GOODS-CHR @if($cat_id == $v->cat_id){{ 'current' }}@endif" data-cat_id="{{ $v->cat_id }}">{{ $v->cat_name }}</li>
            @endforeach

        </ul>

    @endif

    @if(!empty($goods_list))
    <div class="goods-list-box">
        <ul class="clearfix tablelist-append">

            @foreach($goods_list as $v)
            <!-- -->
            <li class="item">
                <div class="item-pic">
                    <!---->
                    <div class="item-tag-box">
                        <!---->
                        <!---->
                    </div>
                    <!---->
                    <a href="{{ route('mobile_show_goods', ['goods_id'=>$v['goods_id']]) }}" style="background: url({{ get_image_url(sysconf('default_lazyload_mobile')) }})">
                        <img class="lazy" src="/assets/d2eace91/images/common/blank.png" data-original="{{ get_image_url($v['goods_image'], 'goods_image') }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" data-original-webp="http://68dsw.oss-cn-beijing.aliyuncs.com/demo/shop/1/gallery/2017/08/25/15036311036909.jpg?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320/format,webp" alt="顺意生 新鲜蔬菜 新鲜小油菜 精品蔬菜油菜500g 保鲜配送">
                    </a>

                </div>
                <div class="item-info">
                    <div class="item-name">
                        <a href="{{ route('mobile_show_goods', ['goods_id'=>$v['goods_id']]) }}" title="{{ $v['goods_name'] }}">
                            <!-- 活动色块 -->


                            {{ $v['goods_name'] }}
                        </a>
                    </div>

                    <div class="goods-sales">销量：{{ $v['sale_num'] }}</div>

                    <div class="item-price">
                        <em class="price-color">￥{{ $v['goods_price'] }}</em>
                        <!-- 商品原价 -->

                    </div>
                    <div class="cart-box" id="number_{{ $v['goods_id'] }}">


                        <a class="increase add-cart iconfont icon-jia1" data-goods_id="{{ $v['goods_id'] }}"
                           data-image_url="{{ get_image_url($v['goods_image'], 'goods_image') }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80"></a>


                        <input class="num hide SZY-NUMBER-{{ $v['goods_id'] }}" type="text" size="4" maxlength="5" value="0" onFocus="this.blur()">
                        <a class="decrease remove-cart iconfont icon-jian2  remove-cart hide" data-goods_id="{{ $v['goods_id'] }}" data-sku_open="{{ $v['sku_open'] }}"></a>
                    </div>
                </div>
            </li>
            @endforeach


        </ul>
        <!-- 分页 -->
        <div id="pagination" class="page">
            <div class="more-loader-spinner">

            </div>
            <script data-page-json="true" type="text" id="page_json">
                {!! $page_json !!}
		    </script>
        </div>
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

    <div class="blank" style="height: 50px; clear: both;"></div>
</div>