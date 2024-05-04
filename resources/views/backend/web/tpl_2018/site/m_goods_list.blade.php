<!-- 默认缓载图片 -->
<!-- 手机端精品推荐模板 -->
<!-- -->




<!---->

<div id="">
    <div class=" clearfix">

        @foreach($m_goods_list as $v)
        <ul class="product single_item info">
            <li>
                <div class="goods-info">
                    <div class="goods-pic">
                        <div class="item-tag-box">
                        </div>
                        <a class="SZY-PIC-BG"
                           href="/goods-{{ $v->goods_id }}.html" title="{{ $v->goods_name }}"
                           style="background: url{{ get_image_url('default_lazyload_mobile') }}) no-repeat center center; display: block; background-size: 100px;">
                            <img class="lazy square" src="/assets/d2eace91/images/common/blank.png" data-original="{{ get_image_url($v->goods_image) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320" alt="{{ $v->goods_name }}" data-original-webp="{{ get_image_url($v->goods_image) }}?x-oss-process=image/resize,m_pad,limit_0,h_320,w_320/format,webp">
                        </a>
                    </div>
                    <div class="goods-name">

                        <a href="/goods-{{ $v->goods_id }}.html" title="{{ $v->goods_name }}">
                            <!-- 服务标签 _start -->
                            <!-- 活动色块 -->
                            {{ $v->goods_name }}
                        </a>
                        <!--购物返豆币-->
                        <!--购物返豆币-->
                    </div>
                    <div class="price">
                            <span class="price-color">￥{{ $v->goods_price }}
                                <!-- 会员价标签  _start -->
                            </span>
                    </div>
                    <a href="javascript:void(0)" class="btns bg-color add-cart " title="加入购物车" data-goods_id='{{ $v->goods_id }}' data-image_url='{{ get_image_url($v->goods_image) }}?x-oss-process=image/resize,m_pad,limit_0,h_80,w_80'></a>
                </div>
            </li>
        </ul>
        @endforeach

    </div>
    <!-- 分页 -->

</div>