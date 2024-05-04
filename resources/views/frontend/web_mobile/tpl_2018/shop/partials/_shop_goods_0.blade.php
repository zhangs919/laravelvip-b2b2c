<!-- 默认缓载图片 -->
<!--主体内容开始-->
<div class="goods-list-box" id="table_list">

    @if(!empty($list))
        <div class="tablelist-append clearfix">
            @foreach($list as $v)
            <!-- -->
            <li class="goods-list">
                <div class="item">
                    <div class="item-pic">
                        <!---->
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
                        <!---->
                        <a href="javascript:void(0)" style="background: url({{ get_image_url(sysconf('default_lazyload_mobile')) }}) no-repeat center center; display: block; background-size: 100px;" data-goods_url="/goods-{{ $v['goods_id'] }}.html" data-scroll="2" class="GO-GOODS-INFO" title="{{ $v['goods_name'] }}">
                            <img class="lazy square" src="/assets/d2eace91/images/common/blank.png" data-original="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" data-original-webp="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320/format,webp" alt="{{ $v['goods_name'] }}">
                        </a>

                    </div>
                    <dl>
                        <dt>
                            <a href="javascript:void(0)" data-goods_url="/goods-{{ $v['goods_id'] }}.html" data-scroll="2" class="GO-GOODS-INFO" title="{{ $v['goods_name'] }}">


                                <!-- 活动色块 -->


                                {{ $v['goods_name'] }}
                            </a>
                        </dt>
                        <dd class="price-color">￥{{ $v['goods_price'] }}
                            <!-- 会员价标签  _start -->
                        </dd>
                    </dl>
                    <div class="item-con-info">
                        <div class="cart-box" id="number_{{ $v['goods_id'] }}">
                            <a class="increase add-cart iconfont icon-jia1" data-goods_id="{{ $v['goods_id'] }}" data-step="1"
                               data-image_url="{{ get_image_url($v['goods_image']) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80"></a>
                            <input class="num @if($v['cart_num'] == 0){{ 'hide' }}@endif" type="text" size="4" maxlength="5" value="{{ $v['cart_num'] }}" onFocus="this.blur()">
                            <a class="decrease remove-cart iconfont icon-jian2 @if($v['cart_num'] == 0){{ 'hide' }}@endif" data-goods_id="{{ $v['goods_id'] }}" data-step="1" data-sku_open="{{ $v['sku_open'] }}" data-shop_id="{{ $v['shop_id'] }}" style="right: 60px;"></a>
                        </div>
                    </div>
                </div>
            </li>
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